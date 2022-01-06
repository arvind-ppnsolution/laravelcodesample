@extends('admin.layouts.app')
@push('meta')
<title>Admin Profile | {{ config('app.name') }}</title>
<meta content="Admin Profile" name="description" />
<meta content="{{ config('app.name') }}" name="author" />
@endpush
@section('content')

<!-- end:: Header -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Admin Profile
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="javascript:history.back()" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            <button type="button" id="editBtn" class="btn btn-brand" onclick="enableEdit(this);">
                                <span class="kt-hidden-mobile">Edit</span>
                            </button>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('admin.profile.update')}}" method="post"
                        onsubmit="return updateProfile(this)">
                        <div class="alert alert-success alert-dismissible" role="alert" id="msg" style="display:none;">
                            <div class="alert-text"></div>
                            <div class="alert-close">
                                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
                            </div>
                        </div>
                        @csrf
                        <input type="hidden" name="image" id="user_image" value="{{Auth::user()->profile_image}}">
                        <input type="hidden" name="id" id="user_id" value="false">
                        <div class="kt-portlet__body">

                            <div class="form-group text-center">
                                <div class="col-lg-12">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
                                        <div class="kt-avatar__holder"
                                            style="background-image: url({{Auth::user()->profile_image ? asset('storage/app/images/users/'.Auth::user()->profile_image) : asset('public/admins/assets/img/placeholder-square.jpg')}})">
                                        </div>
                                        <label class="kt-avatar__upload" style="display:none;" id="updateProfilePic"
                                            data-toggle="kt-tooltip" title="" data-original-title="Change Image">
                                            <i class="fa fa-pen" onclick="$(this).parent('.dz-clickable').click()"></i>
                                        </label>
                                    </div>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{Auth::user()->first_name}}" readonly>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="">Last Name:</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{Auth::user()->last_name}}" readonly>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Email Id:</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email Id"
                                        value="{{Auth::user()->email}}" readonly>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Country Code:</label>
                                    <select class="form-control" name="country_code" disabled>
                                        @foreach(collect($country_codes)->sortBy('name') as $code)
                                        <option value="{{$code->dial_code}}"
                                            {{Auth::user()->country_code == $code->dial_code ? 'selected' : ''}}>
                                            {{$code->dial_code.' '.$code->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="">Mobile No.:</label>
                                    <input type="text" class="form-control" name="mobile" placeholder="Mobile No."
                                        value="{{Auth::user()->mobile}}" readonly>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                        </div>
                        <div class="kt-portlet__foot" style="display:none;">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary saveBtn">Update</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->


            </div>
        </div>
    </div>


    @stop

    @push('appendJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script src="{{asset('public/admins/js/save-file.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        var uploadUrl = "{{ route('admin.profile.upload') }}";
        var imgBaseUrl = "{{ asset('storage/app/images/users/').'/' }}";
    </script>
    <script>
        var enableEdit = function (ele) {
            $('input').attr('readonly', false);
            $('select').attr('disabled', false);
            $('.saveBtn').parents('.kt-portlet__foot').show();
            $('#updateProfilePic').show();
            $(ele).addClass('invisible');
            $('#updateProfilePic').addClass('upload_image_profile');
            initDropforUpdate('_profile', false, false);
        }
    </script>
    @endpush