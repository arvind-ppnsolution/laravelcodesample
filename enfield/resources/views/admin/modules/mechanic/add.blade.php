@extends('admin.layouts.app')
@push('meta')
<title>{{$item ? 'Update' : 'Add'}} Mechanic | {{ config('app.name') }}</title>
<meta content="{{$item ? 'Update' : 'Add'}} Mechanic" name="description" />
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
                                {{$item ? 'Update' : 'Add'}} Mechanic
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="javascript:history.back()" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            @if($item)
                            <button type="button" id="editBtn" class="btn btn-brand" onclick="enableEdit(this);">
                                <span class="kt-hidden-mobile">Edit</span>
                            </button>
                            @endif
                            
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('mechanic.store')}}" method="post"
                        onsubmit="return {{$item ? 'updateForm(this)' : 'formSubmit(this)'}}">
                        <div class="alert alert-success alert-dismissible" role="alert" id="msg" style="display:none;">
                            <div class="alert-text"></div>
                            <div class="alert-close">
                                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
                            </div>
                        </div>
                        @csrf
                        
                        @if($item)
                            <input type="hidden" name="id" id="user_id" value="{{$item->id}}">
                            @endif
                        <div class="kt-portlet__body">

                            <div class="form-group text-center">
                                <div class="col-lg-12">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
                                        <div class="kt-avatar__holder"
                                            style="background-image: url({{$item && $item->profile_image ? asset('storage/app/images/mechanic/'.$item->profile_image) : asset('public/admins/assets/img/placeholder-square.jpg')}})">
                                        </div>
                                        <label class="kt-avatar__upload" style="display:none;" id="updateProfilePic"
                                            data-toggle="kt-tooltip" title="" data-original-title="{{$item ? 'Change Image' : 'Upload Image'}}">
                                            <i class="fa fa-pen" onclick="$(this).parent('.dz-clickable').click()"></i>
                                        </label>
                                    </div>
                                    <input type="hidden" name="image" id="user_image" value="{{$item ? $item->profile_image : ''}}">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        value="{{$item ? $item->first_name : ''}}" {{$item ? 'readonly' : ''}}>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="">Last Name:</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        value="{{$item ? $item->last_name : ''}}" {{$item ? 'readonly' : ''}}>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Email Id:</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email Id"
                                        value="{{$item ? $item->email : ''}}" {{$item ? 'readonly' : ''}}>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Country Code:</label>
                                    <select class="form-control" name="country_code" {{$item ? 'disabled' : ''}}>
                                        @foreach(collect($country_codes)->sortBy('name') as $code)
                                        <option value="{{$code->dial_code}}"
                                            {{$item && $item->country_code == $code->dial_code ? 'selected' : ''}}>
                                            {{$code->dial_code.' '.$code->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="">Mobile No.:</label>
                                    <input type="text" class="form-control" name="mobile" placeholder="Mobile No."
                                        value="{{$item ? $item->mobile : ''}}" {{$item ? 'readonly' : ''}}>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                        </div>
                        <div class="kt-portlet__foot" style="{{$item ? 'display:none;' : ''}}">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary saveBtn">{{$item ? 'Update' : 'Add'}}</button>
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
        var uploadUrl = "{{ route('admin.mechanic.upload') }}";
        var imgBaseUrl = "{{ asset('storage/app/images/mechanic/').'/' }}";
    </script>
    @if($item)
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
    @else
    <script>
            $('#updateProfilePic').show();
            $('#updateProfilePic').addClass('upload_image_profile');
            initDropforUpdate('_profile', false, false);
    </script>
    @endif
    @endpush