<!-- begin: Header Menu -->
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
<div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item  {{ areActiveRoutes(['admin.dashboard'],'kt-menu__item--active') }} " aria-haspopup="true">
                <a href="{{route('admin.dashboard')}}" class="kt-menu__link ">
                    <span class="kt-menu__link-text">Dashboard</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel {{ areActiveDynamicRoutes([route('mechanic.index'), route('mechanic.create')],' kt-menu__item--open kt-menu__item--here') }}" data-ktmenu-submenu-toggle="click"
                aria-haspopup="true">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-text">Members</span>
                    <i class="kt-menu__hor-arrow la la-angle-down"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--submenu {{ areActiveDynamicRoutes([route('mechanic.index'), route('mechanic.create')],'kt-menu__item--open kt-menu__item--here') }}" data-ktmenu-submenu-toggle="hover"
                            aria-haspopup="true">
                            <a href="{{route('mechanic.index')}}" class="kt-menu__link">
                                <i class="kt-menu__link-icon flaticon2-avatar"></i>
                                <span class="kt-menu__link-text">Mechanic</span>
                            </a>

                        </li>
                        
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- end: Header Menu -->
