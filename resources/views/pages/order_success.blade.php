@extends('template/template')
@section('body')
    <div class="container text-center">
        <div class="card w-75 mt-5 mb-5 text-center m-auto shadow border-0 rounded-3" style="background-color: #F6FAFD;" >
            <div class="card-body">
                <h5 class="card-title">Thank you for your order!</h5>
                <h6 class="card-subtitle mb-3 text-muted">Your order has been placed and will be processed as soon as possible.
                    Make sure you make note of your order id @if(session()->has('order_id')), which is <span class="badge bg-primary">{{ session()->get('order_id') }}</span>@endif.
                    You will be receiving an email shortly with confirmation of your order. You can now:
                </h6>
                <h6>you will be redirect after <span id="time">10</span>seconds</h6>
                <a href="{{ route('index') }}" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif d-inline-flex me-lg-3"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Continue Shopping</a>
                <a href="#" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif d-inline-flex"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Track Order</a>
            </div>
        </div>
    </div>
    <script>
        setInterval(Timer, 1000);

        function Timer() {
            let now = Number(document.getElementById("time").innerText);
            now--;
            if(now <= 0){
                document.location.href = 'my_account?state=orders'
            }else{
                document.getElementById("time").innerText =  now;
            }

        }
    </script>
@endsection
