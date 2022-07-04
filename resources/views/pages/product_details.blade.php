@extends('template/template')
@section('body')
    @if(isset($product))
        <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
            <div class="row">
                <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-start col-lg-6 col-12" >{{ ucwords($product->name) }}</h3>

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 ">
                    <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif p-0 me-3" style="float: right">
                        <li class="breadcrumb-item "><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">{{ ucwords($product->name) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center ps-3 pe-3">
            <div class="card col-lg-10 pb-3" style="min-height:500px;top:-60px;" >
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <li class="nav-item " role="presentation">
                        <button class="nav-link active rounded-0 border-0 bg-white text-dark" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 bg-white text-dark border-0" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">Description</button>
                    </li>
                    {{--                <li class="nav-item" role="presentation">--}}
                    {{--                    <button class="nav-link rounded-0 bg-white text-dark border-0" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="contact" aria-selected="false">Review (21)</button>--}}
                    {{--                </li>--}}
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        @include('components.product_view')
                    </div>
                    <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                        @include('components.product_description')
                    </div>
                    {{--                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">--}}
                    {{--                    review include here--}}
                    {{--                </div>--}}
                </div>

            </div>
        </div>
    @endif
@endsection
