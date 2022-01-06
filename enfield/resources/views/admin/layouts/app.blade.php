<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	@stack('meta')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--begin::Fonts -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

	<!--end::Fonts -->

	<!--begin::Page Vendors Styles(used by this page) -->
	<link href="{{asset('public/admins/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
		type="text/css" />
	<link href="{{asset('public/admins/assets/css/pages/wizard/wizard-3.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('public/admins/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('public/admins/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

	
	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="{{asset('public/admins/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('public/admins/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->

	<!--begin::Layout Skins(used by all pages) -->

	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="{{asset('public/admins/assets/media/logos/fevicon.ico')}}" />
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	@stack('stylesheets')
	<script>
		window.Laravel = {!!json_encode(["siteUrl" => url("/"), 'csrfToken' => csrf_token()]) !!}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfX7p9LOLp0MDsKiBmmIyJniJ5bdYBupg&libraries=places"
        ></script>
	<style>
	table thead{
	    color: #fff;
    background: #646c9a;
    text-transform: uppercase;
}

.datepicker table thead{
    background: none;
	text-transform: none;
}

.help-block{
	color: red;
}
	</style>
</head>
<!-- end::Head -->

<!-- begin::Body -->

<body
	class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

	<!-- begin:: Page -->

	@include('admin.partials.logo_toggler')

	<!-- end:: Header Mobile -->
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			<!-- begin:: Aside -->
			<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

			@include('admin.partials.sidebar')

			<!-- end:: Aside -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				@include('admin.partials.header')
				@yield('content')
			</div>
			@include('admin.partials.footer')
		</div>
	</div>
	</div>

	<!-- begin::Scrolltop -->
	<div id="kt_scrolltop" class="kt-scrolltop">
		<i class="fa fa-arrow-up"></i>
	</div>

	<!-- end::Scrolltop -->
	<script>
function squarePlaceholderUrlAlt(image) {
    image.onerror = "";
    image.src = "{{asset('public/admins/assets/img/placeholder-square.jpg')}}";
    return true;
}

function rectanglePlaceholderUrlAlt(image) {
    image.onerror = "";
    image.src = "{{asset('public/admins/assets/img/placeholder-rectangle.jpg')}}";
    return true;
}
</script>

	<!-- begin::Global Config(global config for global JS sciprts) -->
	<script>
		var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#22b9ff",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
	</script>

<script async defer>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap(ele_id) {
        
        var input = document.getElementsByClassName(ele_id)[0];
        var autocomplete = new google.maps.places.Autocomplete(input);
        
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);
     
            autocomplete.setTypes(['address']);
      }
    </script>

	<!-- end::Global Config -->

	<!-- jQuery  -->
	<script src="{{asset('public/admins/js/jquery.min.js')}}"></script>

	<!--begin::Global Theme Bundle(used by all pages) -->
	<script src="{{asset('public/admins/assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
	<script src="{{asset('public/admins/assets/js/scripts.bundle.js')}}" type="text/javascript"></script>

	<!--end::Global Theme Bundle -->

	<!--begin::Page Vendors(used by this page) -->
	<script src="{{asset('public/admins/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"
		type="text/javascript"></script>
	<!-- <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript">
	</script> -->
	<script src="{{asset('public/admins/assets/plugins/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>
	<!--end::Page Vendors -->

	<!--begin::Page Scripts(used by this page) -->
	<script src="{{asset('public/admins/assets/js/pages/dashboard.js')}}" type="text/javascript"></script>
	
	
	
	</script>

	<!--end::Page Scripts -->

	<script>
		window.addEventListener("pageshow", function (event) {
                    var historyTraversal = event.persisted ||
                        (typeof window.performance != "undefined" &&
                            window.performance.navigation.type === 2);
                    if (historyTraversal) {
                        // Handle page restore.
                        window.location.reload();
                    }
                });
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
	@stack('appendJs')
	@stack('appendToBody')

	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script type="text/javascript">
		axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');
	</script>
	<script src="{{asset('public/admins/js/post-jobs.js') }}" type="text/javascript" charset="utf-8"></script>
	
	@stack('appendToBodyBottom')
	
</body>

<!-- end::Body -->

</html>