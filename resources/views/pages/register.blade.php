@extends('template/template')
@section('body')
    <div class="container-fluid @if(isset($title_bar_color)) {{ $title_bar_color }} @else bg-dark @endif p-3" style="min-height:150px;">
        <div class="row">
            <h3 class="@if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif text-left col-lg-5" style="margin-left:50px">Register</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 ">
                <ol class="breadcrumb @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif  p-0 m-0" style="float: right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-decoration-none @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif">Home</a></li>
                    <li class="breadcrumb-item @if(isset($secondary_button_color)) {{ str_replace('btn-', 'text-', $secondary_button_color) }} @else text-warning @endif active " aria-current="page">Register</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ps-3 pe-3 ps-lg-0 pe-lg-0">
        <div class="card container " style="top:-60px;" >
            <div class="row">
                <div class="col-lg-7 p-3 text-center">
                    <img src="@if(isset($secondary_button_color)) {{ asset('assets/register/'.str_replace('btn-', 'bg-', $secondary_button_color).'.svg') }} @else {{ asset('assets/register/bg-warning.svg') }} @endif" alt=""  class="col-8">
                </div>
                <div class="col-lg-5 p-3">
                    <h3><i class="fas fa-user-plus"></i>&nbsp;Register</h3>
                    <form class="ms-3" method="post" action="{{ route('register-submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required="required" placeholder="Your Name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div><div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" required="required" placeholder="Your Email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="8" maxlength="32" required="required" placeholder="Password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn @if(isset($secondary_button_color)) {{ $secondary_button_color }} @else btn-warning @endif col-12">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
