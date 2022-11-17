@extends('admin.layouts.main',['title' => 'Assign Project'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary">CMS</li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary " href="{{ route('admin.projectAssign') }}">Assign Project</a></li>
<li class="breadcrumb-item px-3 text-primary"> {{ !empty( $editData->id) ?   'Edit' :  'Create' }}</li>
@endsection

<style>
.error{
    color: #FF0000;
}
</style>
@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">

        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">

            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                <!--begin::Form-->

                @include('layouts.alerts.error')

                <form class="form" method="POST" action=" {{ !empty( $editData->id) ?  route('admin.projectAssign.update') : route('admin.projectAssign.store') }}" id="dataForm" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bolder">Assign Project</h2>
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> User</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="hidden" name="edit_user_id" value="{{!empty( $editData->user_id) ? $editData->user_id : '' }}"/>
                                    <select class="form-select form-select-solid form-select-lg" {{!empty( $editData->user_id) ? 'disabled' : ''}} name="user_id" id="user_id" data-placeholder="Select User" data-control="select2" >
                                        <option value="" >Select User</option>
                                        @if (!empty($user))
                                            @foreach ($user as $u)
                                                <option value="{{ $u->id }}" {{ !empty( $editData->user_id)  && ($editData->user_id ==   $u->id ) ? 'selected' : '' }}>{{ $u->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3 required"> Project</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid form-select-lg" multiple name="project_id[]" id="project_id" data-placeholder="Select Project" data-control="select2" >
                                        <option ></option>
                                        @php $projectData = getProject() ;
                                           $editPro = !empty($editData->project_id) ? explode(',',$editData->project_id) : '';
                                        @endphp

                                        @if (!empty($projectData))

                                            @foreach ($projectData as $pro)
                                                @php $sel = '';  @endphp
                                                @if(!empty($editPro) && in_array( $pro->project_id, $editPro))
                                                         @php  $sel = 'selected'; @endphp
                                                @endif
                                                    <option value="{{ $pro->project_id }}" {{ $sel }} >{{ $pro->project_name }}</option>

                                            @endforeach
                                        @endif

                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row text-center">
                                <input type="hidden" name="id" value="{{ !empty( $editData->id) ? $editData->id : '' }}" id="id">
                                <!--begin::Col-->
                                <!--begin::Actions-->
                                <div class="mb-0">
                                    <button type="button" data-form="amenityForm" class="btn btn-primary" id="create_button">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">{{ !empty( $editData->id) ?  'Update' : 'Create' }} </span>
                                        <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator-->
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Layout-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

@push('scripts')

    <script type="text/javascript">

        $(document).ready(function (e) {

            $("#dataForm").validate({
                ignore: '',
                rules: {
                    "user_id" : "required",
                    "project_id[]"  : "required",
                },
                messages: {
                    "user_id" : "Please select user",
                    "project_id[]"  : "Please select project",
                }
            });

            $('#create_button').on('click', function(event) {
                // prevent default submit action
                event.preventDefault();

                // test if form is valid
                if($('#dataForm').valid()  ) { console.log(2);
                    $( '#dataForm' ).submit();
                } else { console.log(3);
                    console.log("does not validate");
                    return false;
                }
            });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
