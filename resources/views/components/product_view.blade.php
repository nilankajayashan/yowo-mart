<div class="container mt-5">
    <div class="row">
        <div class="col-lg-7 ">
            <div class="row">
                <div class="col-lg-2 col-12 row p-0">
                    @if(true)
                        <div class="scrollSubImages m-0 p-0" id="scrollMenu">
                            @for($index = 0; $index < count(json_decode($product->additional_images));$index++)
                                <div role="button" class="col-lg-4 rounded-5 mt-2 subImage p-0 m-0 img-hover" style="width: 160px !important; height: 85px !important;" onclick="toMainImage('{{ asset('product_images/'.$product->product_id.'/'.json_decode($product->additional_images)[$index]) }}')">
                                <img class="m-0 p-0" style="width: 100px;" src=" @if(!isset($product->additional_images) || $product->additional_images == null || $product->additional_images == '[]' || $product->additional_images == '') {{ 'products/default/default.png' }} @else{{ asset('product_images/'.$product->product_id.'/'.json_decode($product->additional_images)[$index]) }} @endif ">
                                </div>
                            @endfor
                        </div>
                    @endif

                </div>
                <div class="col-lg-10">
                    <img class="m-2" src="{{ asset('product_images/'.$product->product_id.'/'.json_decode($product->main_image))  }}" alt="" style="width:100%;" id="main_image">
                </div>
            </div>
        </div>
        <div class="col-lg-5 border border-1 text-left bg-light rounded">
            <h2 class="@if(isset($primary_button_color)) {{ str_replace('btn-', 'text-', $primary_button_color) }} @else text-danger @endif"> Rs:{{ number_format($product->unit_price) }}/=</h2>
            <div>
{{--                <h6>Color:Darkblue/orange</h6>--}}

            </div>
            <div class="mb-2">
                <form action="{{ route('add-to-cart') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="number" name="quantity" id="quantity" class="d-inline-flex col-2 p-2" min="1" value="1">
                    <button type="submit" class="d-inline  p-2 col-9 btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif "><i class="fas fa-cart-plus"></i> ADD TO CART</button>
                </form>
            </div>
            <div class="mb-2">
                <form action="{{ route('add-wishlist') }}" method="post" class="">
                    @csrf
                    <input type="hidden" value="{{ $product->product_id }}" name="product_id">
                    <button type="submit" class="btn @if(isset($primary_button_color)) {{ str_replace('btn-', 'btn-outline-', $primary_button_color) }} @else text-outline-danger @endif col-11"><i class="fa fa-heart" aria-hidden="true"></i> Wishlist</button>
                </form>
            </div>
            <h6>Availability: {{ $product->quantity }}</h6>
            <h6 v-if="user_quantity != 1">Unit Price: Rs: {{ number_format($product->unit_price) }}/=</h6>
            <h6>Model: {{ $product->model }}</h6>
        </div>
    </div>
</div>
<script>
    let length = 0;
    let scrollMenu = document.getElementById('scrollMenu');

    function toMainImage(path){
        document.getElementById('main_image').style.backgroundImage = 'url("'+path+'")';
    }

    function scrollList(button) {
        if (button == 'up'){
            if(length <= scrollMenu.scrollTop){
                length += 50;
                scrollMenu.scrollTop = length;
            }
        } else{
            if(length > 0){
                length -= 50;
                scrollMenu.scrollTop =  length;
            }
        }
    }
    function toMainImage(path){
        document.getElementById('main_image').src = path;
    }
</script>

