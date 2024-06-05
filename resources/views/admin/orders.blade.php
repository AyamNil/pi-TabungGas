@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Quantity</th>
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
                    <td>{{ $order->status }}</td>
                    <td>
                        <button class="btn btn-info" onclick="changeStatus('{{ $order->id }}', '{{ $order->status }}')">Change Status</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function changeStatus(orderId, currentStatus) {
        let newStatus = '';
        // Determine the new status based on the current status
        switch (currentStatus) {
            case 'pending':
                newStatus = 'processed';
                break;
            case 'processed':
                newStatus = 'completed';
                break;
            case 'completed':
                newStatus = 'delivered';
                break;
            default:
                return; // Do nothing if the current status is not recognized
        }

        // Make an AJAX request to update the order status
        fetch(`/admin/orders/${orderId}/update-status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assuming you're using CSRF protection
            },
            body: JSON.stringify({
                status: newStatus,
            })
        })
        .then(response => {
            if (response.ok) {
                // Reload the page or update the status column without reloading
                location.reload(); // Reload the page
                // Optionally, update the status column without reloading the page
                // document.getElementById(`status_${orderId}`).innerText = newStatus;
            } else {
                throw new Error('Failed to update status');
            }
        })
        .catch(error => {
            console.error(error);
            // Handle error
        });
    }
</script>
@endsection
