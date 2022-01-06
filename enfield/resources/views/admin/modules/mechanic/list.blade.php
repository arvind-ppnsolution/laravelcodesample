@extends('admin.layouts.app')
@push('meta')
<title>Mechanic | {{ config('app.name') }}</title>
<meta content="Mechanic" name="description" />
<meta content="{{ config('app.name') }}" name="author" />
@endpush
@section('content')

<!-- end:: Header -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <div class="kt-subheader-search ">
        <div class="kt-container  kt-container--fluid ">
            <h3 class="kt-subheader-search__title">
                Search Mechanic
                <span class="kt-subheader-search__desc">Search your mechanic here</span>
            </h3>
            <form class="kt-form">
                <div class="kt-grid kt-grid--desktop kt-grid--ver-desktop">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <div class="row kt-margin-r-10">
                            <div class="col-lg-12">
                                <div class="kt-input-icon kt-input-icon--pill kt-input-icon--right">
                                    <input id="user_name" type="text" name="name" value="{{$name ? $name : ''}}"
                                        class="form-control form-control-pill" placeholder="Name">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                class="la la-puzzle-piece"></i></span></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-grid__item kt-grid__item--middle">
                        <div class="kt-margin-top-20 kt--visible-tablet-and-mobile"></div>
                        <button type="button" onclick="searchRecordList()"
                            class="btn btn-pill btn-upper btn-bold btn-font-sm kt-subheader-search__submit-btn searchBtn">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-soft-icons"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                    Mechanic
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="javascript:history.back()" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                        &nbsp;
                        <a type="button" class="btn btn-brand" href="{{route('mechanic.create')}}">
                            <span class="kt-hidden-mobile">Add New</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body ">

                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                    <select class="form-control" name="offset" id="offset"
                                        onchange="searchUserPageList()">
                                        <option value="10" {{$offset && $offset == '10' ? 'selected' : ''}}>10
                                        </option>
                                        <option value="25" {{$offset && $offset == '25' ? 'selected' : ''}}>25
                                        </option>
                                        <option value="50" {{$offset && $offset == '50' ? 'selected' : ''}}>50
                                        </option>
                                        <option value="100" {{$offset && $offset == '100' ? 'selected' : ''}}>100
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-10 kt-margin-b-20-tablet-and-mobile">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <table class="table table-bordered table-hover" id="record-list"
                    data-url="{{route('mechanic.list')}}">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Contact Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right"></td>
                        </tr>
                    </tfoot>
                    
                </table>

            </div>

            <div class="kt-portlet__body">

                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">

                                </div>
                                <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">

                                </div>
                                <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                                    <a href="{{asset('storage/app/import/sample/mechanic.xlsx')}}"
                                        download="mechanic.xlsx">
                                        <button type="button" style="margin-left:10px;"
                                            class="btn btn-warning float-right" title="Import">
                                            <span class="kt-hidden-mobile">Download Sample XLSX</span>
                                        </button>
                                    </a>
                                    <button type="button" style="margin-left:10px;"
                                        class="btn btn-brand float-right bulk_import bulk_import_btn" title="Import">
                                        <span class="kt-hidden-mobile bulk_import">Bulk Import</span>
                                    </button>
                                    <form style="display: none;" onsubmit="exportFill()"
                                        action="{{route('mechanic.export')}}" id="exportForm" method="POST">
                                        @csrf
                                        <input type="hidden" id="export_name" name="name"
                                            value="{{$name ? $name : ''}}" />
                                    </form>
                                    <button type="button" class="btn btn-brand float-right"
                                        onclick="$('#exportForm').submit()" title="Export">
                                        <span class="kt-hidden-mobile">Export to Excel</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--end: Search Form -->
            </div>

        </div>
    </div>

    <!-- end:: Content -->


    @stop

    @push('appendJs')
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript">
        var searchUrl = "{{route('mechanic.list')}}"
        var listUrl = "{{route('mechanic.index')}}"
        var deleteUrl = "{{route('mechanic.delete')}}"
        var changeUrl = "{{route('mechanic.status')}}"
        var total_pages = 1;
        var page = 1;
        var tblObj = $("#record-list");
        var bulkUploadUrl = "{{route('mechanic.import')}}";
    </script>
    <script type="text/javascript" src="{{ asset('public/admins/js/list-records.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script src="{{asset('public/admins/js/save-file.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        initDropforImport(false);
        var exportFill = function () {
            $('#export_name').val(getUrlParameter('name'));
            return true;
        }
    </script>
    @endpush