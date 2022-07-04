<h1>My Orders</h1>
@if(isset($orders) && $orders != null)
    <div class="table-responsive ps-3 pe-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#Order_ID</th>
                <th scope="col">Ordered Date | Time</th>
                <th scope="col">Status</th>
                <th scope="col">Total</th>
                <th scope="col">View</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if($order->order_status == 'failed')
                            <h6><span class="badge @if(isset($failed_status_color)) {{ str_replace('btn-', 'bg-', $failed_status_color) }} @else bg-danger @endif">{{ $order->order_status }}</span></h6>
                        @elseif($order->order_status == 'pending')
                            <h6><span class="badge @if(isset($pending_status_color)) {{ str_replace('btn-', 'bg-', $pending_status_color) }} @else bg-secondary @endif">{{ $order->order_status }}</span></h6>
                        @elseif($order->order_status == 'processing')
                            <h6><span class="badge @if(isset($processing_status_color)) {{ str_replace('btn-', 'bg-', $processing_status_color) }} @else bg-primary @endif">{{ $order->order_status }}</span></h6>
                        @elseif($order->order_status == 'processed')
                            <h6><span class="badge @if(isset($processed_status_color)) {{ str_replace('btn-', 'bg-', $processed_status_color) }} @else bg-info @endif">{{ $order->order_status }}</span></h6>
                        @elseif($order->order_status == 'shipped')
                            <h6><span class="badge @if(isset($shipped_status_color)) {{ str_replace('btn-', 'bg-', $shipped_status_color) }} @else bg-warning @endif">{{ $order->order_status }}</span></h6>
                        @elseif($order->order_status == 'completed')
                            <h6><span class="badge @if(isset($completed_status_color)) {{ str_replace('btn-', 'bg-', $completed_status_color) }} @else bg-success @endif">{{ $order->order_status }}</span></h6>
                        @else
                            <h6><span class="badge bg-dark">{{ $order->order_status }}</span></h6>
                        @endif
                    </td>
                    <td>Rs.{{ number_format($order->total) }}/=</td>
                    <td><a href="{{route('order-view',['order-id' => $order->id])}}" target="_blank"><i class="fa fa-eye text-primary" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
            No Orders in your Account
        </div>
    </div>
@endif
