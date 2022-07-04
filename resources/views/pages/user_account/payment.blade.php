<h1>My Payment</h1>
@if(isset($payments) && $payments != null)
    @if(isset($payment_counts))
        <div class="">
            <span  class="badge @if(isset($success_status_color)) {{ str_replace('btn-', 'bg-', $success_status_color) }} @else bg-success @endif rounded-pill">Success ({{ $payment_counts['success'] }})</span>
            <span  class="badge @if(isset($pending_status_color)) {{ str_replace('btn-', 'bg-', $pending_status_color) }} @else bg-secondary @endif rounded-pill">Pending ({{ $payment_counts['pending'] }})</span>
            <span class="badge @if(isset($failed_status_color)) {{ str_replace('btn-', 'bg-', $failed_status_color) }} @else bg-danger @endif rounded-pill">Failed ({{ $payment_counts['failed'] }})</span>
            <span class="badge bg-dark rounded-pill">Others ({{ $payment_counts['others'] }})</span>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#Order_ID</th>
                <th scope="col">Ordered Date | Time</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if($order->payment_status == 'failed')
                            <h6><span class="badge @if(isset($failed_status_color)) {{ str_replace('btn-', 'bg-', $failed_status_color) }} @else bg-danger @endif">{{ $order->payment_status }}</span></h6>
                        @elseif($order->payment_status == 'pending')
                            <h6><span class="badge @if(isset($pending_status_color)) {{ str_replace('btn-', 'bg-', $pending_status_color) }} @else bg-secondary @endif">{{ $order->payment_status }}</span></h6>
                        @elseif($order->payment_status == 'success')
                            <h6><span class="badge @if(isset($success_status_color)) {{ str_replace('btn-', 'bg-', $success_status_color) }} @else bg-success @endif">{{ $order->payment_status }}</span></h6>
                        @else
                            <h6><span class="badge bg-dark">{{ $order->payment_status }}</span></h6>
                        @endif
                    </td>
                    <td>Rs.{{ number_format($order->total) }}/=</td>
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
            No Payments in your Account
        </div>
    </div>
@endif
