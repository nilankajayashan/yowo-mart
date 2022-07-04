@extends('template/template')
@section('body')
    <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
        <div class="row">
            <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5" style="margin-left:50px">Password Forgot: Change Password</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 text-warning">
                <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif p-0 m-0" style="float: right">
                    <li class="breadcrumb-item text-warning"><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">Password Forgot: Change Password</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ps-3 pe-3 ps-lg-0 pe-lg-0">
        <div class="card container" style="top:-60px;" >
            <div class="row">
                <div class="col-lg-6 text-center">
                    <img src="@if(isset($secondary_button_color)) {{ asset('assets/password_change/'.str_replace('btn-', 'bg-', $secondary_button_color).'.svg') }} @else {{ asset('assets/password_change/bg-warning.svg') }} @endif" alt=""  class="col-10 p-3">
                </div>
                <div class="col-lg-6 p-3 ">
                    <h3><i class="fas fa-key"></i>&nbsp;Password Forgot: Change Password</h3>
                    <h6>How To Reset Your Password</h6>
                    <ol>
                        <li class="text-decoration-line-through">Enter your registered email address @if(isset($shop_info)) {{ ' on '.$shop_info->name }} @endif and click '<b>Sent Reset Pin</b>' button. </li>
                        <li class="text-decoration-line-through">Check your email inbox/spam folder and its will have email from us. with tittle '<b>Password Reset Pin</b>'. and copy the email contains password reset pin.</li>
                        <li><span class="text-decoration-line-through">Enter/paste email contains Pin in password reset pin window. and</span> set new password.</li>
                    </ol>
                    <form method="post" action="{{ route('password-update') }}" id="update_password">
                        @csrf
                        <div class="mb-1">
                            <input type="password" class="form-control mb-3" name="password" id="password" minlength="8" placeholder="Enter new password" required>
                            <input type="password" class="form-control mb-3" name="password_conform" id="password_conform" placeholder="Enter password again" required>
                            <button class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif  col-12" type="submit" id="submit">Change Password</button>
                        </div>
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
    <script>
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password_conform").val();

            if (password != confirmPassword ) {
                $("#message").html("Password Conform Not Matched");
                $("#submit").prop("disabled", true);

            }else if(password == '' || password == ' '){
                $("#message").html("Please Enter password");
                $("#submit").prop("disabled", true);
            }
            else {
                $("#message").html("Update Password");
                $("#submit").prop("disabled", false);
            }
        }
        $(document).ready(function () {
            $("#message").html("Update Password");
            $("#password, #password_conform").keyup(checkPasswordMatch);
        });
    </script>
@endsection
