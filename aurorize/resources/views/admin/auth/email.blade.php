@extends('layouts.non-auth')
@section('title') Forgot password @endsection
@section('content')
<div class="account-pages mb-md-2 mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 p-5">
                                <div class="mx-auto mb-5 text-center">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ Helper::assets('assets/images/logo.png') }}" class="site-logo" alt="Logo" />
                                    </a>
                                </div>
                                <h6 class="h5 mb-0 mt-4">Forgot password?</h6>
                                <p class="text-muted mt-1 mb-4">Please enter your registered email and we will send you the reset password instructions!</p>
                                <form action="{{ route('admin.password.email') }}" method="post" class="forgot-form-validate authentication-form">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input type="email" name="email" value="{{ old ('email')}}" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" placeholder="Email" />

                                        @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-grey">Back to <a href="{{ route('admin.login') }}" class="text-primary font-weight-medium ml-1">Sign in!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-bottom')
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/account/forgot-password.js') }}" type="text/javascript"></script>
@endsection
