@extends('frontend.layouts.master')

@section('frontend_title')
    Login Page
@endsection

@section('frontend_content')
    @include('frontend.layouts.inc.breadcumb', ['pagename' => 'login'])

    <div class="account-area ptb-100">

        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="account-form form-style">


                    <p>User Email Address <span class="text-danger">*</span></p>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email address" id="">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <p>Password <span class="text-danger">*</span></p>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter password" id="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <button type="submit" class="btn btn-danger">LogIn</button>
                    <div class="text-center">
                        <a href="{{ route('register.page') }}">Or Create an Account</a>
                    </div>
                </div>
            </form>
        </div>
    @endsection
