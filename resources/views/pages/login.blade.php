@extends('template/template')
@section('body')
        <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
            <div class="row">
                <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5" style="margin-left:50px">Login</h3>

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 text-warning">
                    <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif p-0 m-0" style="float: right">
                        <li class="breadcrumb-item text-warning"><a href="{{ route('index') }}" class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item  active @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="ps-3 pe-3 ps-lg-0 pe-lg-0">
            <div class="card container" style="top:-60px;" >
                <div class="row">
                    <div class="col-lg-5 p-3">
                        <h3><i class="fas fa-sign-in-alt"></i>&nbsp;Login</h3>
                        @error('error')
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                {{ $message }}
                            </div>
                        </div>
                        @enderror
                        <form class="ms-3" method="post" action="{{ route('login-submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required="required" placeholder="Email Address">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="8" maxlength="32" required="required" placeholder="Password">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <a href="{{ route('password-forgot') }}" class="text-decoration-none @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif">Password Forgoted?</a>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Check me out</label>
                            </div>
                            <button type="submit" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif col-12">Login</button>
                        </form>
                    </div>
                    <div class="col-lg-7 p-5 text-center">
                        <img src="@if(isset($secondary_button_color)) {{ asset('assets/login/'.str_replace('btn-', 'bg-', $secondary_button_color).'.svg') }} @else {{ asset('assets/login/bg-warning.svg') }} @endif" alt=""  class="col-9">
                    </div>
                </div>
            </div>
        </div>
        <script>
            checkUser();
            function checkUser() {
                let email = getCookie("email");
                let password = getCookie("password");
                if (email != "" && password != "") {
                    document.getElementById('email').value = email;
                    document.getElementById('password').value = password;
                }
            }
            function getCookie(cname) {
                let name = cname + "=";
                let decodedCookie = decodeURIComponent(document.cookie);
                let ca = decodedCookie.split(';');
                for(let i = 0; i <ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
        </script>
@endsection
