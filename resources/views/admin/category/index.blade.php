@extends('admin.layouts.main',['title' => 'Category'])

@push('stylesheet')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">Category</li>
@endsection

@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            @include('layouts.alerts.error')
            @include('layouts.alerts.alert')

            <!--begin::Card-->
            <div class="card card-stretch shadow-lg card-scroll">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="fa fa-search position-absolute ms-6"></i>
                            <input type="text" id="search" data-kt-docs-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Category" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Add user-->
                            @can('category-create')
                            <a href="{{ route('admin.category.create') }}" class="btn btn-hover-scale btn-success">
                            <i class="fa fa-plus"></i> Add Category</a>
                            @endcan
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="progress m-5 progre" id="progress_placeholder">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <div class="card-body pt-0" id="datatable-card" style="display: none">
                    <!--begin::Table-->
                    <table id="datatable" class="table table-row-bordered">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

        <!--end::Container-->
    </div>
    <!--end::Post-->
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

@push('scripts')

<script src="{{ asset("plugins/custom/datatables/datatables.bundle.js") }}"></script>
{{-- <script src="{{ url('/assets') }}/js/delete.js"></script> --}}

<script>
    const datatable = $("#datatable").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        "scrollY": "50vh",
        "scrollX": true,
        "sScrollXInner": "100%",
        ajax: {
            url: "{{ route('admin.category') }}",
            error: function (request, err) {
                Toast.fire({
                    icon: 'error',
                    title: 'Speed Limit ???',
                    text: "Go slow, You're stressing the server"
                }); //display error toast
            }
        },
        columns: [{
                data: 'category_name'
            },
            {
                data: 'status'
            },
            {
                data: null
            },
        ],
        columnDefs: [{
                targets: -1,
                data: null,
                orderable: false,
                className: 'text-end',
                render: function (data, type, row) {
                    if (data.status == 'Active') {
                        $icon  = '<i class="fa fa-toggle-off"></i>'
                    }
                    else {
                        $icon  = '<i class="fa fa-toggle-on"></i>'
                    }
                    return `
                            <a href="category/create/${data.id}" class="btn btn-sm btn-icon btn-hover-scale btn-active-success me-2"
                            ><span class="svg-icon svg-icon-1"><i class="fa fa-edit"></i></span></a>
                            <a href="category/delete/${data.id}" class="btn btn-sm btn-icon btn-hover-scale btn-active-danger me-2"
                            ><span class="svg-icon svg-icon-1"><i class="fa fa-trash"></i></span></a>
                             <a href="category/changeStatus/${data.id}" class="btn btn-sm btn-icon btn-hover-scale btn-active-primary  me-2"
                            ><span class="svg-icon svg-icon-1">${ $icon }</span></a>
                            `;
                },
            },
            {
                targets: 1,
                render: function (data, type, row) {
                    return `
                                <span class="badge badge-primary">${data}</span>
                            `;
                },
            },
            {
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('padding-bottom', '0px')
                }
            }
        ],
        'scrollCollapse': true,
        "fnInitComplete": function () {
            $('#progress_placeholder').slideUp();
            $('#datatable-card').slideDown();
            datatable.columns.adjust();
        }
    });

    $('#search').keyup(function () {
        datatable.search($(this).val()).draw();
    })

    $('.deleteButton').click(function () { alert(d);
        var id = $(this).data('id');
        swal({
                title: "Are you sure!",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: "POST",
                    url: "{{url('/delete')}}",
                    data: {id:id},
                    success: function (data) {
                        //
                        alert(3);
                    }
                });
            });
    })

</script>
@endpush
