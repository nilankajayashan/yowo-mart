@extends('template/template')
@section('body')
    @include('components.main_caresoul')

        {{--    trending products--}}
        @if(isset($latest_products))
            <div class="container mt-3">
                <h3>Latest Products</h3>
                <div class="row">
                    @foreach($latest_products as $product )
                        <div class="card text-center col-lg-3 border-0 product">

                            <div class="card-body">
                                <div class="justify-content-between row">
{{--                                    <h6 class="badge rounded-pill col-3 bg-warning"><span>10% OFF</span></h6>--}}
                                    <div class="col-12 text-end">
{{--                                        <span><i class="fa fa-code-compare" aria-hidden="true"></i>&nbsp;Compare</span>--}}
                                        <span>
                                            <form action="{{ route('add-wishlist') }}" method="post" class="d-inline-flex">
                                                @csrf
                                                <input type="hidden" value="{{ $product->product_id }}" name="product_id">
                                                <button type="submit" class="btn @if(isset($ternary_button_color)) {{ str_replace('btn-', 'btn-outline-', $ternary_button_color) }} @else btn-outline-danger @endif"><i class="fa fa-heart" aria-hidden="true"></i></button>
                                            </form>
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('product-details',['product_id' => $product->product_id]) }}">
                                    <img src="{{ asset('product_images/'.$product->product_id.'/'.json_decode($product->main_image))  }}" alt="" class="col-12">
                                </a>
{{--                                <p class="card-text text-start">{{ $product->tag }}</p>--}}
                                <h5 class="card-title text-start">{{ ucwords($product->name) }}</h5>
                                <div class="row">
                                    <p class="text-start col-6">Rs:{{ $product->unit_price }}/=</p>
                                    <img src="" alt="" class="text-end col-6">
                                </div>
                                <form action="{{ route('add-to-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    <input type="hidden" name="quantity" id="quantity" min="1" value="1">
                                    <button type="submit" name="add-to-cart" id="add-to-cart" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif col-12"><i class="fas fa-cart-plus"></i> ADD TO CART</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        {{--    trending products end--}}
@endsection
