@extends('layouts.non-auth')
@section('title') Reset Password @endsection
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
                                <h6 class="h5 mb-0 mt-4">Reset Password</h6>
                                <p class="text-muted mt-1 mb-4">Please enter new password</p>
                                <form action="{{ route('admin.password.update') }}" method="post" class="reset-form-validate authentication-form">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" placeholder="Email" value="{{ $email ?? old('email') }}" readonly/>
                                        
                                        @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Password</label>
                                        <div class="input-group validation-valid-element">
                                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" placeholder="*********" required="" name="password" data-error="password-error" aria-required="true" aria-invalid="false">
                                            <div class="input-group-append">
                                                <span class="input-group-text show-password">
                                                    <i class="icon-eye" data-show-pass="password" role="button"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="password-error"></div>

                                        @if($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Confirm Password</label>
                                        <div class="input-group validation-valid-element">
                                            <input type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" id="password_confirmation" placeholder="*********" required="" name="password_confirmation" data-error="password_confirmation-error" aria-required="true" aria-invalid="false">
                                            <div class="input-group-append">
                                                <span class="input-group-text show-password">
                                                    <i class="icon-eye" data-show-pass="password_confirmation" role="button"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="password_confirmation-error"></div>
                                        
                                        @if($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
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
<script defer src="{{ Helper::assets('assets/js/pages/account/reset.js') }}" type="text/javascript"></script>
@endsection