@extends('template/template')
@section('body')
    <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
        <div class="row">
            <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5" style="margin-left:50px">Password Forgot: Validate Reset Pin</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 text-warning">
                <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif p-0 m-0" style="float: right">
                    <li class="breadcrumb-item text-warning"><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">Password Forgot: Validate Reset Pin</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ps-3 pe-3 ps-lg-0 pe-lg-0">
        <div class="card container" style="top:-60px;" >
            <div class="row">
                <div class="col-lg-6 text-center">
                    <img src="@if(isset($secondary_button_color)) {{ asset('assets/password_reset_pin/'.str_replace('btn-', 'bg-', $secondary_button_color).'.svg') }} @else {{ asset('assets/password_reset_pin/bg-warning.svg') }} @endif" alt=""  class="col-10 p-3">
                </div>
                <div class="col-lg-6 p-3 ">
                    <h3><i class="fas fa-key"></i>&nbsp;Password Forgot: Validate Reset Pin</h3>
                    <h6>How To Reset Your Password</h6>
                    <ol>
                        <li class="text-decoration-line-through">Enter your registered email address @if(isset($shop_info)) {{ ' on '.$shop_info->name }} @endif and click '<b>Sent Reset Pin</b>' button. </li>
                        <li>Check your email inbox/spam folder and its will have email from us. with tittle '<b>Password Reset Pin</b>'. and copy the email contains password reset pin.</li>
                        <li>Enter/paste email contains Pin in password reset pin window. and set new password.</li>
                    </ol>
                    <form class="ms-3" method="post" action="{{ route('password-reset-pin-conform') }}">
                        @csrf
                        <div class="mb-3 text-center">
                            <label for="pin1" class="form-label fw-bolder">Password reset pin</label>
                            <br>
                            <input type="number" class=" @error('reset_pin') is-invalid @enderror d-inline-flex col-1 p-2 m-2 text-center" id="pin1" required="required" placeholder="0" onchange="makePin()" min="0" max="9" minlength="1" maxlength="1">
                            <input type="number" class=" @error('reset_pin') is-invalid @enderror d-inline-flex col-1 p-2 m-2 text-center" id="pin2" required="required" placeholder="0" onchange="makePin()" min="0" max="9" minlength="1" maxlength="1">
                            <input type="number" class=" @error('reset_pin') is-invalid @enderror d-inline-flex col-1 p-2 m-2 text-center" id="pin3" required="required" placeholder="0" onchange="makePin()" min="0" max="9" minlength="1" maxlength="1">
                            <input type="number" class=" @error('reset_pin') is-invalid @enderror d-inline-flex col-1 p-2 m-2 text-center" id="pin4" required="required" placeholder="0" onchange="makePin()" min="0" max="9" minlength="1" maxlength="1">
                            @error('reset_pin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <input type="hidden" name="reset_pin" id="pin">
{{--                        <input type="hidden" name="email" value="{{ session()->get('reset_email') }}">--}}
                        <button type="submit" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif col-12">Conform Reset Pin</button>
                    </form>
                    <form class="ms-3" method="post" action="{{ route('password-reset') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ session()->get('reset_email') }}">
                        <button type="submit" class="btn @if(isset($secondary_button_color)) {{ str_replace('btn-', 'btn-outline-', $secondary_button_color) }} @else btn-outline-warning @endif col-12 mt-3">Sent Reset Pin To: {{ session()->get('reset_email')  }}</button>
                    </form>
                    <a href="{{ route('login') }}" class="text-decoration-none @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif">Back to login</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function makePin(){
            let pin1 = document.getElementById('pin1').value;
            let pin2 = document.getElementById('pin2').value;
            let pin3 = document.getElementById('pin3').value;
            let pin4 = document.getElementById('pin4').value;
            document.getElementById('pin').value = pin1 + pin2 + pin3 + pin4;
        }
    </script>
@endsection
