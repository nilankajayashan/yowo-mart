@extends('template/template')
@section('body')
    <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
        <div class="row">
            <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5">
                Checkout
            </h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 ">
                <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif p-0 m-0" style="float: right">
                    <li class="breadcrumb-item "><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">My Account</li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">
                        Checkout
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-lg-8  ps-lg-5 mt-3 mb-3">
            <form action="{{ route('checkout-complete') }}" method="post">
                @csrf
                <div class="row">
                    <h5>Shipping Details</h5>
                    <hr>
                    <div class="mb-3 col-lg-6">
                        <input type="text" class="form-control form-control @error('shipping_name') is-invalid @enderror" placeholder="Full Name" name="shipping_name" >
                        @error('shipping_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <input type="email" class="form-control form-control @error('shipping_email') is-invalid @enderror" placeholder="Email" name="shipping_email">
                        @error('shipping_email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <input type="tel" class="form-control form-control @error('shipping_mobile') is-invalid @enderror" placeholder="Contact Number" name="shipping_mobile">
                        @error('shipping_mobile')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <select class="form-select form-control @error('shipping_country') is-invalid @enderror" aria-label="Default select example" name="shipping_country" id="country" required>
                            <option selected disabled>Country</option>
                            <option value="sri lanka">Sri Lanka</option>
                        </select>
                        @error('shipping_country')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <select class="form-select form-control  @error('shipping_district') is-invalid @enderror" aria-label="Default select example" name="shipping_district" id="district" required>
                            <option selected disabled>District</option>
                            <option value="hambantota">Hambantota</option>
                        </select>
                        @error('shipping_district')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <select class="form-select form-control @error('shipping_city') is-invalid @enderror" aria-label="Default select example" name="shipping_city" id="city" required>
                            <option selected disabled>City</option>
                            <option value="beliatta">Beliatta</option>
                        </select>
                        @error('shipping_city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <input type="text" class="form-control form-control @error('shipping_postal_code') is-invalid @enderror" placeholder="Zip | Postal Code" name="shipping_postal_code" id="postal_code">
                        @error('shipping_postal_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <input type="text" class="form-control form-control @error('shipping_address') is-invalid @enderror" placeholder="Address Line 1" name="shipping_address1">
                        @error('shipping_address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-6">
                        <input type="text" class="form-control form-control" placeholder="Address Line 2" name="shipping_address2">
                    </div>


{{--                    billing form--}}
                    <h5>Billing Details</h5>
                    <hr>
                    <div class="form-check form-switch ms-3 mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="address_same" data-bs-toggle="collapse" data-bs-target="#billing_form" aria-expanded="true" aria-controls="collapseWidthExample" name="payment_same">
                        <label class="form-check-label" for="address_same">Billing Details Is Different</label>
                    </div>
                    <div class=" row collapse collapse-horizontal col-lg-12" id="billing_form">
                        <div class="mb-3 col-lg-6">
                            <input type="text" class="form-control form-control @error('payment_name') is-invalid @enderror" placeholder="Full Name" name="payment_name">
                            @error('payment_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <input type="email" class="form-control form-control @error('payment_email') is-invalid @enderror" placeholder="Email" name="payment_email">
                            @error('payment_email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <input type="tel" class="form-control form-control @error('payment_mobile') is-invalid @enderror" placeholder="Contact Number" name="payment_mobile">
                            @error('payment_mobile')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <select class="form-select form-control @error('payment_country') is-invalid @enderror" aria-label="Default select example" name="payment_country" id="country" required>
                                <option selected disabled>Country</option>
                                <option value="sri lanka">Sri Lanka</option>
                            </select>
                            @error('payment_country')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <input type="text" class="form-control form-control @error('payment_city') is-invalid @enderror" placeholder="City" name="payment_city">
                            @error('payment_city')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <input type="text" class="form-control form-control @error('payment_address') is-invalid @enderror" placeholder="Address" name="payment_address">
                            @error('payment_address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card col-lg-12 mt-lg-3" style="background-color: #F6FAFD;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 border border-1 border-start-0 border-top-0 border-bottom-0">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="shipping_method" role="switch" id="free-shipping" value="free_shipping">
                                    <label class="form-check-label" for="free-shipping">Free Shipping</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="shipping_method" role="switch" id="24-7-shipping" value="24_7_shipping">
                                    <label class="form-check-label" for="24-7-shipping">24/7 Shipping</label>
                                </div>
                                <hr>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Delivery Note" style="height: 100px" name="shipping_note"></textarea>
                                    <label for="floatingTextarea2">Delivery Note</label>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="payment_method" role="switch" id="cash-on-delivery" value="cod">
                                    <label class="form-check-label" for="cash-on-delivery">Cash On Delivery | COD</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="payment_method" role="switch" id="payhere" value="payhere">
                                    <label class="form-check-label" for="payhere">Payhere | Online</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn @if(isset($primary_button_color)) {{ $primary_button_color }} @else btn-success @endif col-12 mt-3  fw-bold"><i class="fas fa-credit-card text-warning"></i>&nbsp;Complete Your Order</button>
            </form>
        </div>
        <div class="card container col-lg-3 p-2  text-center h-100 toup">
            @if(isset($cart))
                <h5>Order Summery</h5>
            @endif
            @if(isset($cart))
                @foreach($cart as $cart)
                    <div class="card mb-3 ===" style="background-color:#F6FAFD;">
                        <div class="row g-0">

                            <div class="col-4 bg-white">
                                <img src="
@if(isset($main_images))
                                @foreach($main_images as $main_image)
                                @if($main_image['product_id'] == $cart->product_id){{ asset('product_images/'.$main_image['product_id'].'/'.json_decode($main_image['image']))  }}
                                @break
                                @endif
                                @endforeach
                                @endif " class="img-fluid rounded-start" alt="{{ $cart->name }}">
                            </div>
                            <div class="col-8">
                                <div class="card-body text-start">
                                    <h5 class="card-title">{{ $cart->name }}</h5>
                                    <br>
                                    <h6 class="card-title">Rs.{{ number_format($cart->unit_price) }}/=
                                    <span>X {{ $cart->user_quantity }}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if(isset($total))
                        <h5 class="text-start">Sub Total: Rs.{{ number_format($total) }}/=</h5>
                        <h6 class="text-start">Shipping: Rs.0/=</h6>
                        <hr>
                        <span class="text-center fs-5 @if(isset($primary_button_color)) {{ str_replace('btn-', 'text-', $primary_button_color) }} @else text-primary @endif fw-bolder">Total: Rs.{{ number_format($total) }}/=</span
                @endif
                @else
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Your Cart Is Empty!</h4>
                        <p>You can add product to simply your cart by clicking on 'ADD TO CART" Button anywhere</p>
{{--                        <hr>--}}
{{--                        <p class="mb-0">Learn more</p>--}}
                    </div>
                @endif

{{--            <div class="card p-2 text-center mt-3 col-12 shadow">--}}
{{--                <div class="card-body">--}}
{{--                    <form>--}}
{{--                        <div class="mb-3">--}}
{{--                            <input type="text" class="form-control-sm form-control" placeholder="Promo Code">--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn-sm btn btn-outline-warning col-12">Apply Promo</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <script>
        function valueAdder(id,value){
            let element = document.getElementById(id);
            element.value = value;
        }
        if(getCookie('shipping-details') != null){
            let shipping_details = JSON.parse(decodeURIComponent(getCookie('shipping-details')));
            valueAdder('country', shipping_details[0]['country']);
            valueAdder('district', shipping_details[0]['district']);
            valueAdder('city', shipping_details[0]['city']);
            valueAdder('postal_code', shipping_details[0]['postal_code']);
        }

    </script>
@endsection
