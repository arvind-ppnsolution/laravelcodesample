<!--begin::Aside-->
<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
    style="background-image: url({{asset('/public/admins/assets/media/bg/bg-4.jpg')}});">
    <div class="kt-grid__item">
        <a href="#" class="kt-login__logo">
            <img src="{{asset('/public/admins/assets/media/logos/logo-6.png')}}" onerror="squarePlaceholderUrlAlt(this)" height="50">
        </a>
    </div>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
        <div class="kt-grid__item kt-grid__item--middle">
            <h3 class="kt-login__title">Welcome to {{ config('app.name') }}!</h3>
            <h4 class="kt-login__subtitle">The ultimate Bootstrap & Angular 6 admin theme framework for next generation
                web apps.</h4>
        </div>
    </div>
    @include('admin.auth.partials.copyright')
</div>