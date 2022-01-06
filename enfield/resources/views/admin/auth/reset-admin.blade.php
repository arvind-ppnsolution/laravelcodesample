@extends('admin.auth.layouts.app')
@push('meta')
<title>Admin Reset Password | {{ config('app.name') }}</title>
<meta content="Admin Reset Password" name="description" />
<meta content="{{ config('app.name') }}" name="author" />
@endpush
@section('content')

<!--begin::Aside-->

<!--begin::Content-->
<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">


    <!--begin::Body-->
    <div class="kt-login__body">

        <!--begin::Signin-->
        <div class="kt-login__form">
            <div class="kt-login__title">
                <h3>Reset Password</h3>
            </div>

            <!--begin::Form-->
            <form class="kt-form" id="loginform" action="{{ route('password.update') }}" onsubmit="return formSubmit(this)" method="post">
                <input type="hidden" name="tz" id="tz">
                <div class="alert alert-success alert-dismissible" role="alert" id="msg" style="display:none;">
                    <div class="alert-text"></div>
                    <div class="alert-close">
                        <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{$email}}">

                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
                    <div class="help-block"></div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation"
                        autocomplete="off">
                        <div class="help-block"></div>
                    </div>

                <!--begin::Action-->
                <div class="kt-login__actions">
                    <a href="{{route('admin.login')}}" class="kt-link kt-login__link-forgot">
                        Have Password? Login Here
                    </a>
                    <button id="kt_login_signin_submit"
                        class="btn btn-primary btn-elevate kt-login__btn-primary saveBtn">Reset</button>
                </div>

                <!--end::Action-->
            </form>

            <!--end::Form-->


        </div>

        <!--end::Signin-->
    </div>

    <!--end::Body-->
</div>

<!--end::Content-->

@stop