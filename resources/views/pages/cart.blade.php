@extends('template/template')
@section('body')
    <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
        <div class="row">
            <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5">
               Cart
            </h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 ">
                <ol class="breadcrumb text-light p-0 m-0" style="float: right">
                    <li class="breadcrumb-item "><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">
                        Cart
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row ps-3 pe-3 m-0">
        <div class="col-lg-8  p-3">
            @if(isset($cart))
                <table class="table">
                    <tbody>
                    @foreach($cart as $cart)
                    <tr>
                        <td>
                            <a href="{{ route('product-details',['product_id' => $cart->product_id]) }}">
                            <img src="
                            @if(isset($main_images))
                                @foreach($main_images as $main_image)
                                     @if($main_image['product_id'] == $cart->product_id){{ asset('product_images/'.$main_image['product_id'].'/'.json_decode($main_image['image']))  }}
                                        @break
                                    @endif
                                @endforeach
                            @endif
                                " alt="" style="width: 150px;"/>
                            </a>
                        </td>
                        <td>
                            <h5>{{ $cart->name }}</h5>
                            <h5>Rs:{{ number_format($cart->unit_price) }}/=</h5>
                        </td>
                        <td> <h5 class="d-inline">Quantity: {{ $cart->user_quantity }}</h5>
                            <a href="{{ route('remove-cart',['product_id' => $cart->product_id]) }}" class="float-end"><button class="btn btn-outline-danger btn-close d-inline-flex"></button></a>
                            <form action="{{ route('update_cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                <input type="number" name="quantity" id="quantity" class="ml-3  d-inline form-control" min="1" value="{{ $cart->user_quantity }}" style="width: 100px">
                                <button type="submit" class="btn @if(isset($ternary_button_color)) {{ str_replace('btn-', 'btn-outline-', $ternary_button_color) }} @else btn-outline-info @endif d-inline">Update</button>
                            </form>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Your Cart Is Empty!</h4>
                    <p>You can add product to simply your cart by clicking on 'ADD TO CART" Button anywhere</p>
                </div>
            @endif
        </div>
        <div class="card container col-lg-3 p-2  text-center toup border-0" >
           @if(isset($cart) && isset($total) )
                <h5>Sub Total</h5>
            <h4>Rs.{{ number_format($total) }}/=</h4>
            @endif
            <div class="card p-2 text-center col-12 shadow">
                <div class="card-body">
                    <form method="post" action="{{ route('save-shipping') }}">
                        @csrf
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="country" required>
                                <option selected disabled>Country</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="district" required>
                                <option selected disabled>District</option>
                                <option value="Hambantota">Hambantota</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="city" required>
                                <option selected disabled>City</option>
                                <option value="Beliatta">Beliatta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="postal_code" required>
                                <option selected disabled>Zip | Postal Code</option>
                                <option value="82400">82400</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn  @if(isset($secondary_button_color)) {{ str_replace('btn-', 'btn-outline-', $secondary_button_color) }} @else btn-outline-warning @endif  col-12">Apply Shipping</button>
                    </form>
                </div>
            </div>
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
            <div class="mt-3 ">
                <a @if(isset($cart)) href="{{ route('checkout') }}" @endif class="btn  @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif  col-12">Processed To Checkout</a>
            </div>
        </div>
    </div>
@endsection
