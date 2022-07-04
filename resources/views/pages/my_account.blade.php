@extends('template/template')
@section('body')
    <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
        <div class="row">
            <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5 col-12">
                @if(isset($state))
                    @switch($state)
                        @case('my_account')
                            My Account
                            @break
                        @case('orders')
                            Orders
                            @break
                        @case('wishlist')
                            Wishlist
                            @break
                        @case('info')
                            Account Information
                            @break
                        @case('addresses')
                            Addresses
                            @break
                        @case('payment')
                            Payment
                            @break
                        @default
                            Page Not Found
                            @break
                    @endswitch
                @else
                    Page Not Found
                @endif
            </h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 ">
                <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif p-0 m-0" style="float: right">
                    <li class="breadcrumb-item "><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">My Account</li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">
                        @if(isset($state))
                            @switch($state)
                                @case('my_account')
                                My Account
                                @break
                                @case('orders')
                                Orders
                                @break
                                @case('wishlist')
                                Wishlist
                                @break
                                @case('info')
                                Account Information
                                @break
                                @case('addresses')
                                Addresses
                                @break
                                @case('payment')
                                Payment
                                @break
                                @default
                                Page Not Found
                                @break
                            @endswitch
                        @else
                            Page Not Found
                        @endif
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('logout') }}" class="float-end btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif me-5 mt-3">Logout&nbsp;<i class="fas fa-sign-out-alt"></i></a>
    </div>
    <div class="row m-0 ps-3 pe-3">
        <div class="card container col-lg-3 border-0 p-0" style="top:-60px;" >
            <div class="list-group">
                <a href="{{ route('my_account', ['state' => 'my_account']) }}" class="list-group-item list-group-item-action">
                    <div class="row ">
                        <div class="col-4  ">
                            <img src="{{ asset('profile.svg') }}" alt=""  class="col-12 rounded-circle shadow rounded">
                        </div>
                        <div class="col-8">
                            <h5>{{ ucwords(session()->get('auth_user')->name) }}</h5>
                            <h6>{{ ucwords(session()->get('auth_user')->email) }}</h6>
                        </div>
                    </div>
                </a>
                <div class="list-group-item list-group-item-action @if(isset($secondary_button_color)) {{ str_replace('btn-', 'bg-', $secondary_button_color) }} @else bg-warning @endif ">My List</div>
{{--                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">A second item</button>--}}
                <a href="{{ route('my_account', ['state' => 'orders']) }}" type="button" class="list-group-item list-group-item-action"><i class="fas fa-bags-shopping"></i>&nbsp;Orders <span class="float-end">@if(isset($counter)){{ $counter['orders'] }}@else 0 @endif</span></a>
                <a href="{{ route('my_account', ['state' => 'wishlist']) }}" type="button" class="list-group-item list-group-item-action"><i class="fas fa-bags-shopping"></i>&nbsp;Wishlist <span class="float-end">@if(isset($counter)){{ $counter['wishlist_products'] }}@else 0 @endif</span></a>
                <div class="list-group-item list-group-item-action @if(isset($secondary_button_color)) {{ str_replace('btn-', 'bg-', $secondary_button_color) }} @else bg-warning @endif">Account Setting</div>
                <a href="{{ route('my_account', ['state' => 'info']) }}" type="button" class="list-group-item list-group-item-action"><i class="fas fa-bags-shopping"></i>&nbsp;Profile Info</a>
                <a href="{{ route('my_account', ['state' => 'addresses']) }}" type="button" class="list-group-item list-group-item-action"><i class="fas fa-bags-shopping"></i>&nbsp;Addresses <span class="float-end">@if(isset($counter)){{ $counter['address'] }}@else 0 @endif</span></a>
                <a href="{{ route('my_account', ['state' => 'payment']) }}" type="button" class="list-group-item list-group-item-action"><i class="fas fa-bags-shopping"></i>&nbsp;Payment <span class="float-end">@if(isset($counter)){{ $counter['payments'] }}@else 0 @endif</span></a>

            </div>
        </div>
        <div class="col-lg-8 pt-lg-3">
            @if(isset($state))
                @switch($state)
                    @case('my_account')
                        @include('pages.user_account.my_account')
                        @break
                    @case('orders')
                        @include('pages.user_account.orders')
                        @break
                    @case('wishlist')
                        @include('pages.user_account.wishlist')
                        @break
                    @case('info')
                        @include('pages.user_account.account_info')
                        @break
                    @case('addresses')
                        @include('pages.user_account.addresses')
                        @break
                    @case('payment')
                        @include('pages.user_account.payment')
                        @break
                    @default
                        @include('pages.errors.401')
                        @break
                @endswitch
            @else
                @include('pages.errors.401')
            @endif
        </div>
    </div>
@endsection
