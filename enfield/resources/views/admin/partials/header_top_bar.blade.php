<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">

    {{-- @include('admin.partials._notifications') --}}

    <!--begin: User bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
            <img alt="Pic" src="{{asset('storage/app/images/users/'.Auth::user()->profile_image)}}" onerror="squarePlaceholderUrlAlt(this)" style="    width: 34px;
            height: 34px;
            background-size: cover;"/>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

            <!--begin: Head -->
            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                style="background-image: url({{asset('/public/admins/assets/media/misc/bg-1.jpg')}})">
                <div class="kt-user-card__avatar">
                    <img alt="Pic" src="{{asset('storage/app/images/users/'.Auth::user()->profile_image)}}" onerror="squarePlaceholderUrlAlt(this)"/>
                </div>
                <div class="kt-user-card__name">
                    {{Auth::user()->full_name}}
                </div>
            </div>

            <!--end: Head -->

            <!--begin: Navigation -->
            <div class="kt-notification">
                <a href="{{route('admin.profile')}}" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            My Profile
                        </div>
                        <div class="kt-notification__item-time">
                            Account settings and more
                        </div>
                    </div>
                </a>
                <a href="{{route('admin.password.change')}}" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-mail kt-font-warning"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            Change Password
                        </div>
                        <div class="kt-notification__item-time">
                            Change your password regularily to make your account more safe
                        </div>
                    </div>
                </a>
                <div class="kt-notification__custom kt-space-between">
                    <a href="javascript:void(0)" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold"
                        onclick="logout();">Sign Out</a>
                </div>
            </div>

            <!--end: Navigation -->
        </div>
    </div>

    <!--end: User bar -->

    
</div>

<!-- end:: Header Topbar -->

@push('appendJs')
<script>
    var logout = function () {
        window.history.replaceState({
            isBackPage: false,
            "html": 'jscv',
            "pageTitle": 'bsckj'
        }, "", "{{route('admin.login')}}");
        window.location.href = "{{route('admin.logout')}}";
    }
</script>
@endpush