@extends('layouts.app')

@section('content')
<div class="container" style="background: rgba(255, 255, 255, 0.13);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(7.5px);
-webkit-backdrop-filter: blur(7.5px);"">
    <div class="card p-3">
    <h1 class="fw-bold">Manage Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Quantity</th>
                <th>Kendaraan Pengiriman</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->qty }}</td>
                <td>{{ $order->delivery_vehicle }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <button class="btn fw-bold btn-warning" onclick="changeStatus('{{ $order->id }}', '{{ $order->status }}')"
                        @if($order->status === 'completed') disabled @endif>
                        Change Status
                    </button>
                    <button class="btn fw-bold btn-danger" onclick="deleteOrder('{{ $order->id }}')">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<script>
    function changeStatus(orderId, currentStatus) {
        let newStatus = '';
        console.log(orderId);
        console.log(currentStatus);
        // Determine the new status based on the current status
        if (currentStatus === 'pending') {
            newStatus = 'processing';
        } else if (currentStatus === 'processing') {
            newStatus = 'completed';
        } else if (currentStatus === 'completed') {
            console.error('Invalid status');
            return;
        } else {
            console.error('Invalid status');
            return;
        }
        console.log(newStatus);

        // Make an AJAX request to update the order status
        fetch(`/admin/orders/${orderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assuming you're using CSRF protection
                },
                body: JSON.stringify({
                    status: newStatus,
                }),
            })
            .then(response => {
                if (response.ok) {
                    location.reload(); // Reload the page
                } else {
                    throw new Error('Failed to change order status');
                }
            })
            .catch(error => {
                console.error(error);
                // Handle error
            });
    }

    function deleteOrder(orderId) {
        if (confirm('Are you sure you want to delete this order?')) {
            fetch(`/admin/orders/${orderId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assuming you're using CSRF protection
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload(); // Reload the page
                    } else {
                        throw new Error('Failed to delete order');
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Handle error
                });
        }
    }
</script>
@endsection
