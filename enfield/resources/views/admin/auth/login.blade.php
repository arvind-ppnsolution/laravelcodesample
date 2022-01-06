@extends('admin.auth.layouts.app')
@push('meta')
<title>Admin Login | {{ config('app.name') }}</title>
<meta content="Admin Login" name="description" />
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
                <h3>Sign In</h3>
            </div>

            <!--begin::Form-->
            <form class="kt-form" action="{{ route('admin.login.post')}}" onsubmit="return formLogin(this)"
                method="post">
                <input type="hidden" name="tz" id="tz">
                <div class="alert alert-success alert-dismissible" role="alert" id="msg" style="display:none;">
                    <div class="alert-text"></div>
                    <div class="alert-close">
                        <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
                    </div>
                </div>
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                    <div class="help-block"></div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Password" name="password"
                        autocomplete="off">
                    <div class="help-block"></div>
                </div>

                <!--begin::Action-->
                <div class="kt-login__actions">
                    <a href="{{route('admin.password.email.show')}}" class="kt-link kt-login__link-forgot">
                        Forgot Password ?
                    </a>
                    <button id="kt_login_signin_submit"
                        class="btn btn-primary btn-elevate kt-login__btn-primary saveBtn">Sign
                        In</button>
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