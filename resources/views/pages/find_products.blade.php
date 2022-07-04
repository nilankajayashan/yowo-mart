@extends('template/template')
@section('body')
    <?php

    $path = explode('/',Request::path());
    $url_category = $path[0];
    //get url parameters
    $full_url = explode('?',Request::fullUrl());
    if (count($full_url)>1){
        $param_list = explode('&',$full_url[1]);
    }
    ?>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Selected Filters</h5>
                        <hr>
                        @if($url_category != 'all')
                            <form action="{{ route('find', [ 'category' => 'all']) }}" method="get" class="mt-0">
                                @if(isset($param_list))
                                    @foreach($param_list as $param)
                                        <?php
                                        $param_data = explode('=', $param);
                                        ?>
                                        <input type="hidden" name="{{ $param_data[0] }}" value="{{ $param_data[1] }}">
                                    @endforeach
                                @endif
                                <h6>
                                    Category:&nbsp;{{ ucwords( str_replace('_',' ',str_replace('%20',' ',$url_category))) }}
                                    <button type="submit" class="btn-close float-end" aria-label="Close" ></button>
                                </h6>
                                <hr>
                            </form>
                        @endif
                        @if(isset($param_list))
                            <form action="{{ route('find', ['category' => $url_category]) }}" method="get" id="param_filters" class="mt-0">
                                @foreach($param_list as $param)
                                    <?php
                                    $param_data = explode('=', $param);
                                    ?>
                                    <input type="hidden" name="{{ $param_data[0] }}" id="{{ $param_data[0] }}" value="{{ $param_data[1] }}">
                                    @if($param_data[0] == 'search')
                                        <h6>
                                            {{ ucwords( str_replace('_',' ',$param_data[0])) }}:&nbsp;{{ ucwords( str_replace('_',' ',$param_data[1])) }}
                                            <button type="button" class="btn-close float-end btn-outline-danger" aria-label="Close" onclick="selectedSubFilterRemover('{{$param_data[0]}}')"></button>
                                        </h6>
                                        <hr>
                                    @endif
                                        @if($param_data[0] == 'price_min' || $param_data[0] == 'price_max' )
                                            <h6>
                                                {{ ucwords( str_replace('_',' ',$param_data[0])) }}:&nbsp;@if(isset($param_data[1]) && $param_data[1] != null){{ ucwords( str_replace('_',' ',$param_data[1])) }}@else 0 @endif
                                                <button type="button" class="btn-close float-end btn-outline-danger" aria-label="Close" onclick="selectedSubFilterRemover('{{$param_data[0]}}')"></button>
                                            </h6>
                                            <hr>
                                        @endif
                                @endforeach
                            </form>
                        @endif
                        <script>
                            function selectedSubFilterRemover(id){
                                document.getElementById(id).remove();
                                document.getElementById('param_filters').submit();
                            }
                        </script>
                    </div>
                </div>
{{--                price filter--}}
                <div class="card mt-3">
                    <div class="card-body m-0">
                        <form action="{{ route('find', ['category' => $url_category]) }}" method="get" name="price_form" class="mt-0">
                            @if(isset($param_list))
                                @foreach($param_list as $param)
                                    <?php
                                    $param_data = explode('=', $param);
                                    ?>
                                    @if($param_data[0] != 'price_min' && $param_data[0] != 'price_max')
                                        <input type="hidden" name="{{ $param_data[0] }}" value="{{ $param_data[1] }}">
                                    @endif
                                @endforeach
                            @endif
                            <label for="price" class="form-label">Price</label>
                            <br>
                            <div class="text-center">
                                <input type="number" id="price_min" min="0" max="9999999"  name="price_min" onchange="priceMin()" required>
                                {{--                                value="@if(isset($param_list))@foreach($param_list as $param) <?php $param_data = explode('=', $param);?> @if($param_data[0] == 'price_min')ok @endif @endforeach @else{{'0'}}@endif"--}}
                                <span>-</span>
                                <input type="number" id="price_max" min="0" max="9999999" name="price_max" onchange="priceMax()" required>
                            </div>
                            <input type="submit" value="Filter Price" class="btn btn-sm btn-outline-warning col-12 mt-2">
                        </form>
                        <script>
                            function priceMin(){
                                document.getElementById('price_max').min = document.getElementById('price_min').value;
                            }
                            function priceMax(){
                                document.getElementById('price_min').max = document.getElementById('price_max').value;
                            }
                        </script>
                    </div>
                </div>
{{--                end price filter--}}
                @if(isset($categories))
                    <div class="card mt-3">
                        @foreach($categories as $category)
                            <form action="{{ route('find', ['category' => $category->name]) }}" class="m-0 p-0">
                                @if(isset($param_list))
                                    @foreach($param_list as $param)
                                        <?php
                                        $param_data = explode('=', $param);
                                        ?>
                                        <input type="hidden" name="{{ $param_data[0] }}" value="{{ $param_data[1] }}">
                                    @endforeach
                                @endif
                                <input type="submit" value="{{$category->name}}" class="col-12 mt-0 p-1 bg-white border-0 text-start ps-4">
                            </form>
                            <hr class="m-0 p-0">
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-lg-9">
               @if(isset($products))

                   <div class="bg-light col-lg-12 rounded-top ps-3 pe-3 pt-2 pb-2">
                      <span class="d-inline-flex"> Items Per Page:</span>
                       <form action="{{ route('find',[ 'category' => $url_category]) }}" class="col-2 d-inline-flex" id="per_page_form">
                           <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="perPage" name="per_page" onchange="document.getElementById('per_page_form').submit()">
                               <option value="5" @if(isset($_COOKIE['per_page']) && $_COOKIE['per_page'] == '5') selected @endif>5 per page</option>
                               <option value="20" @if(isset($_COOKIE['per_page']) && $_COOKIE['per_page'] == '20') selected @endif>20 per page</option>
                               <option value="50" @if(isset($_COOKIE['per_page']) && $_COOKIE['per_page'] == '50') selected @endif>50 per page</option>
                               <option value="100" @if(isset($_COOKIE['per_page']) && $_COOKIE['per_page'] == '100') selected @endif>100 per page</option>
                           </select>
                       </form>
                   </div>
                   @foreach($products as $product)
                       <div class="row-view">
                           <div class="card mt-3 ms-3 me-3">
                               <div class="card-body">
                                   <div class="row">
                                       <div class="col-lg-2 m-0 p-0">
                                           <a href="{{ route('product-details',['product_id' => $product->product_id]) }}">
                                           <img src="{{ asset('product_images/'.$product->product_id.'/'.json_decode($product->main_image))  }}" alt="" class="card-img">
                                           </a>
                                       </div>
                                       <div class="col-lg-10 m-0 p-0">
                                           <div class="ms-5">
                                               <h5 class="card-title"><a href="{{ route('product-details',['product_id' => $product->product_id]) }}" class="text-decoration-none text-dark"> {{ $product->name }}</a></h5>
                                               <h6 class="">Model:&nbsp;{{ $product->model }}
                                                   @if(isset($product->weight) && $product->weight > 0)
                                                       &nbsp;|&nbsp;Weight:&nbsp;{{ $product->weight.'g' }}
                                                   @endif
                                                   @if(isset($product->dimensions) && $product->dimensions != '0|0|0')
                                                       <?php
                                                       $demensions = json_decode($product->dimensions);
                                                       ?>
                                                        @if(isset($demensions[0]) && $demensions[0] > 0)
                                                           &nbsp;|&nbsp;Length:&nbsp;{{ $demensions[0].'cm' }}
                                                       @endif
                                                       @if(isset($demensions[1]) && $demensions[1] > 0)
                                                           &nbsp;|&nbsp;Width:&nbsp;{{ $demensions[1].'cm' }}
                                                       @endif
                                                       @if(isset($demensions[2]) && $demensions[2] > 0)
                                                           &nbsp;|&nbsp;Height:&nbsp;{{ $demensions[2].'cm' }}
                                                       @endif
                                                   @endif
                                               </h6>
                                               <h3>Rs.{{ number_format($product->unit_price) }}/=</h3>

                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    @endforeach
                   {{$products->links()}}
               @endif
            </div>
        </div>
    </div>
@endsection
