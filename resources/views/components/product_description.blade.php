<div class="container">
    <div class="row  m-3" >
        <img src="{{ asset('product_images/img.png') }}" alt=""  class="col-lg-1">
        <div class="col-lg-5">
            <h6 class="text-left">{{ ucwords($product->name) }}</h6>
            <h4 class="text-left">Rs:{{$product->unit_price}}/=</h4>
        </div>
        <div class="  col-lg-6 text-right allign-bottom">
            <form action="{{ route('add-to-cart') }}" method="post" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                <input type="number" name="quantity" id="quantity" class="me-1 form-control d-inline " min="1" value="1" style="width: 100px">
                <button type="submit" name="add-to-cart" id="add-to-cart" class="me-2 btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif border border-0 p-2 d-inline"><i class="fas fa-cart-plus"></i> ADD TO CART</button>
            </form>
            <form action="{{ route('add-wishlist') }}" method="post" class="d-inline p-2">
                @csrf
                <input type="hidden" value="{{ $product->product_id }}" name="product_id">
                <button type="submit" class="btn @if(isset($primary_button_color)) {{ str_replace('btn-', 'btn-outline-', $primary_button_color) }} @else text-outline-danger @endif"><i class="fa fa-heart" aria-hidden="true"></i> Wishlist</button>
            </form>
        </div>

    </div>
    <hr>
    <div class="row" >
        <h6 class="text-left">About Product</h6>
        {{ucfirst($product->description)}}
    </div>
</div>
