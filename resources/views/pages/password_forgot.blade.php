@extends('template/template')
@section('body')
    <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
        <div class="row">
            <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5" style="margin-left:50px">Password Forgot</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 text-warning">
                <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif p-0 m-0" style="float: right">
                    <li class="breadcrumb-item text-warning"><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">Password Forgot</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ps-3 pe-3 ps-lg-0 pe-lg-0">
        <div class="card container" style="top:-60px;" >
            <div class="row">
                <div class="col-lg-6 text-center">
                    <img src="@if(isset($secondary_button_color)) {{ asset('assets/password_forgot/'.str_replace('btn-', 'bg-', $secondary_button_color).'.svg') }} @else {{ asset('assets/password_forgot/bg-warning.svg') }} @endif" alt=""  class="col-10 p-3">
                </div>
                <div class="col-lg-6 p-3 ">
                    <h3><i class="fas fa-key"></i>&nbsp;Password Forgot</h3>
                    <h6>How To Reset Your Password</h6>
                    <ol>
                        <li>Enter your registered email address @if(isset($shop_info)) {{ ' on '.$shop_info->name }} @endif and click '<b>Sent Reset Pin</b>' button.</li>
                        <li>Check your email inbox/spam folder and its will have email from us. with tittle '<b>Password Reset Pin</b>'. and copy the email contains password reset pin.</li>
                        <li>Enter/paste email contains Pin in password reset pin window. and set new password.</li>
                    </ol>
                    <form class="ms-3" method="post" action="{{ route('password-reset') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Registered email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required="required" placeholder="Registered Email Address">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button type="submit" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif  col-12">Sent Reset Pin</button>
                    </form>
                    <a href="{{ route('login') }}" class="text-decoration-none @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif">Back to login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
