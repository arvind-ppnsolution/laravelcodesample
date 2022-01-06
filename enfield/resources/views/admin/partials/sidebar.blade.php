<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
            data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  {{ areActiveRoutes(['admin.dashboard'],'kt-menu__item--active') }}"
                    aria-haspopup="true">
                    <a href="{{route('admin.dashboard')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-protection"></i>
                        <span class="kt-menu__link-text">Dashboard</span>
                    </a>
                </li>

                
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="javascript:void(0)" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-settings"></i>
                        <span class="kt-menu__link-text">Settings</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>