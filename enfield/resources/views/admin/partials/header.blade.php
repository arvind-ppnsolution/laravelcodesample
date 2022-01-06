<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
        <div class="kt-header__brand-logo">
            <a href="{{route('admin.dashboard')}}">
                <img alt="Logo" src="{{asset('/public/admins/assets/media/logos/icon-6.png')}}" onerror="squarePlaceholderUrlAlt(this)" height="75" />
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Title -->
    <h3 class="kt-header__title kt-grid__item">
        {{ config('app.name') }}
    </h3>

    <!-- end:: Title -->

    @include('admin.partials.header_menu')
    @include('admin.partials.header_top_bar')

</div>