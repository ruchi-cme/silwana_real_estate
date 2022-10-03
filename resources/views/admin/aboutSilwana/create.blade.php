@extends('admin.layouts.main',['title' => 'About Silwana'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.admin') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3"><a class="text-hover-primary text-muted" href="{{ route('admin.silwana') }}">Silwana Page</a></li>
<li class="breadcrumb-item px-3 text-primary">{{ !empty( $pageData->silwana_detail_id) ? 'Edit' : 'Create' }} </li>
@endsection

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

                      <form class="form" method="POST" action="{{ !empty( $pageData->silwana_detail_id) ?  route('admin.silwana.update') : route('admin.silwana.store') }}" id="user_form" enctype="multipart/form-data">
                        @csrf

                        <!--begin::Card-->
                          <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10">
                              <!--begin::Card header-->
                              <div class="card-header">
                                  <!--begin::Card title-->
                                  <div class="card-title">
                                      <h2 class="fw-bolder">Page</h2>
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
                                          <div class="fs-6 fw-bold mt-2 mb-3 required">Name</div>
                                      </div>
                                      <!--end::Col-->
                                      <!--begin::Col-->
                                      <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                          <input type="text" placeholder="Enter Name" class="form-control form-control-solid" name="page" value="{{ !empty( $pageData->page) ? $pageData->page : '' }}" >
                                          <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                  </div>
                                  <!--end::Row-->

                                  <!--begin::Row-->
                                  <div class="row mb-8">
                                      <!--begin::Col-->
                                      <div class="col-xl-3">
                                          <div class="fs-6 fw-bold mt-2 mb-3 required">Detail</div>
                                      </div>
                                      <!--end::Col-->
                                      <!--begin::Col-->
                                      <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                          <textarea name="detail" placeholder="Enter Detail" class="form-control form-control-solid h-100px" >{{ !empty( $pageData->detail) ? $pageData->detail : '' }}</textarea>
                                          <div class="fv-plugins-message-container invalid-feedback"></div></div>

                                  </div>
                                  <!--end::Row-->

                                  <!--begin::Row-->
                                  <div class="row">
                                      <!--begin::Col-->
                                      <div class="col-xl-3">
                                          <div class="fs-6 fw-bold mt-2 mb-3">Image</div>
                                      </div>
                                      <!--end::Col-->
                                      <!--begin::Col-->
                                      <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                          <input type="file" class="form-control form-control-solid" name="page_image"  id="page_image">
                                          <input type="hidden" name="edit_page_image" value="{{ !empty($pageData->page_image) ?$pageData->page_image : '' }}" id="edit_amenity_image">
                                          <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                      <!--begin::Row-->
                                      <div class="col-xl-4 fv-row fv-plugins-icon-container  previewImage" style="display: none">
                                          <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                              <img id="preview-image-before-upload" src="" alt="preview image"  width="100px" height="100px">
                                          </div>
                                      </div>
                                      <!--end::Row-->
                                  </div>
                                  <!--end::Row-->

                                  <!--begin::Row-->
                                  <?php if (!empty( $pageData->page_image)) {
                                      ?>
                                  <div class="row">
                                      <!--begin::Col-->
                                      <div class="col-xl-3">
                                          <div class="fs-6 fw-bold mt-2 mb-3">previous Image</div>
                                      </div>
                                      <!--end::Col-->
                                      <!--begin::Col-->
                                      <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                          <img src="{{ asset('images/page').'/'.$pageData->page_image }}"  width="100px" height="100px">
                                      </div>
                                  </div>
                                      <?php
                                  }  ?>
                                      <!--end::Row-->
                                  <input type="hidden" name="silwana_detail_id" value="{{ !empty( $pageData->silwana_detail_id) ? $pageData->silwana_detail_id : '' }}">


                              </div>
                              <!--end::Card body-->
                          </div>
                        <!--end::Card-->

                          @if (!empty($pageDetail))
                              @foreach ($pageDetail as $row)
                                  <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10 example">
                                      <div class="example1">
                                          <!--begin::Card header-->
                                          <div class="card-header">
                                              <!--begin::Card title-->
                                              <div class="card-title">
                                                  <h2 class="fw-bolder">Page Details</h2>
                                              </div>
                                              <!--begin::Card title-->
                                          </div>
                                          <!--end::Card header-->
                                          <!--begin::Card body-->
                                          <div class="card-body pt-0">

                                              <!--begin::Row-->
                                              <input type="hidden" name="silwana_dtl_mpg_id[]" value="{{ !empty( $row['silwana_dtl_mpg_id']) ? $row['silwana_dtl_mpg_id'] : '' }}">

                                              <div class="row mb-8">
                                                  <!--begin::Col-->
                                                  <div class="col-xl-3">
                                                      <div class="fs-6 fw-bold mt-2 mb-3">Heading</div>
                                                  </div>
                                                  <!--end::Col-->
                                                  <!--begin::Col-->
                                                  <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                      <input type="text" placeholder="Enter Heading" class="form-control form-control-solid" name="heading[]" value="{{ !empty( $row['heading']) ? $row['heading'] : '' }}" >
                                                      <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                              </div>
                                              <!--end::Row-->

                                              <!--begin::Row-->
                                              <div class="row mb-8">
                                                  <!--begin::Col-->
                                                  <div class="col-xl-3">
                                                      <div class="fs-6 fw-bold mt-2 mb-3">Icon</div>
                                                  </div>
                                                  <!--end::Col-->
                                                  <!--begin::Col-->
                                                  <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                      <input type="text" placeholder="Enter Icon" class="form-control form-control-solid" name="icon[]" value="{{ !empty(  $row['icon']) ?  $row['icon'] : '' }}" >
                                                      <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                              </div>
                                              <!--end::Row-->

                                              <!--begin::Row-->
                                              <div class="row mb-8">
                                                  <!--begin::Col-->
                                                  <div class="col-xl-3">
                                                      <div class="fs-6 fw-bold mt-2 mb-3">Detail</div>
                                                  </div>
                                                  <!--end::Col-->
                                                  <!--begin::Col-->
                                                  <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                      <textarea name="heading_detail[]" placeholder="Enter Detail" class="form-control form-control-solid h-100px" >{{ !empty(  $row['heading_detail']) ?  $row['heading_detail'] : '' }}</textarea>
                                                      <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                              </div>
                                              <!--end::Row-->

                                              <!--begin::Row-->
                                              <div class="row">
                                                  <!--begin::Col-->
                                                  <div class="col-xl-3">
                                                      <div class="fs-6 fw-bold mt-2 mb-3">Image</div>
                                                  </div>
                                                  <!--end::Col-->
                                                  <!--begin::Col-->
                                                  <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                      <input type="file" class="form-control form-control-solid" name="heading_image[]" id="heading_image" >
                                                      <input type="hidden" name="edit_heading_image[]" value="{{ !empty( $row['heading_image']) ?  $row['heading_image'] : '' }}" id="edit_heading_image">

                                                      <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                              </div>
                                              <!--end::Row-->

                                              <!--begin::Row-->
                                                  <?php if (!empty($row['heading_image'])) {
                                                  ?>
                                              <div class="row">
                                                  <!--begin::Col-->
                                                  <div class="col-xl-3">
                                                      <div class="fs-6 fw-bold mt-2 mb-3">Preview Image</div>
                                                  </div>
                                                  <!--end::Col-->
                                                  <!--begin::Col-->
                                                  <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                      <img src="{{ asset('images/heading').'/'.$row['heading_image'] }}"  width="100px" height="100px">
                                                  </div>
                                              </div>
                                                  <?php
                                              }  ?>
                                                  <!--end::Row-->

                                              <!--begin::Row-->
                                              <div class="row headingPreviewImage" style="display: none">
                                                  <!--begin::Col-->
                                                  <div class="col-xl-3">
                                                      <div class="fs-6 fw-bold mt-2 mb-3">Current Selected Preview Image</div>
                                                  </div>
                                                  <!--end::Col-->
                                                  <!--begin::Col-->
                                                  <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                      <img id="heading-preview-image-before-upload" src="" alt="preview image" style="max-height: 100px;" width="100px">
                                                  </div>
                                              </div>
                                              <!--end::Row-->

                                              <!--begin::Actions-->
                                              <div class="mb-0" id="addRemoveButton">
                                                  <button type="button" id="remove" class="btn btn-primary"  onclick="remove($(this))">
                                                        <span class="indicator-label">Remove</span>
                                                       <span class="indicator-progress">Please wait...
        ' span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                        </button>
                                              </div>
                                              <!--end::Actions-->
                                          </div>
                                      </div>
                                      <!--end::Card body-->
                                  </div>
                              @endforeach
                          @else
                              <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10 example">
                                  <div class="example1">
                                      <!--begin::Card header-->
                                      <div class="card-header">
                                          <!--begin::Card title-->
                                          <div class="card-title">
                                              <h2 class="fw-bolder">Page Details</h2>
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
                                                  <div class="fs-6 fw-bold mt-2 mb-3">Heading</div>
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                  <input type="text" placeholder="Enter Heading" class="form-control form-control-solid" name="heading[]" value="{{ !empty( $pageData->heading) ? $pageData->heading : '' }}" >
                                                  <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                          </div>
                                          <!--end::Row-->

                                          <!--begin::Row-->
                                          <div class="row mb-8">
                                              <!--begin::Col-->
                                              <div class="col-xl-3">
                                                  <div class="fs-6 fw-bold mt-2 mb-3">Icon</div>
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                  <input type="text" placeholder="Enter Icon" class="form-control form-control-solid" name="icon[]" value="{{ !empty( $pageData->icon) ? $pageData->icon : '' }}" >
                                                  <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                          </div>
                                          <!--end::Row-->

                                          <!--begin::Row-->
                                          <div class="row mb-8">
                                              <!--begin::Col-->
                                              <div class="col-xl-3">
                                                  <div class="fs-6 fw-bold mt-2 mb-3">Detail</div>
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                  <textarea name="heading_detail[]" placeholder="Enter Detail" class="form-control form-control-solid h-100px" >{{ !empty( $pageData->heading_detail) ? $pageData->heading_detail : '' }}</textarea>
                                                  <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                          </div>
                                          <!--end::Row-->

                                          <!--begin::Row-->
                                          <div class="row">
                                              <!--begin::Col-->
                                              <div class="col-xl-3">
                                                  <div class="fs-6 fw-bold mt-2 mb-3">Image</div>
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                  <input type="file" class="form-control form-control-solid" name="heading_image[]" id="heading_image" >

                                                  <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                          </div>
                                          <!--end::Row-->

                                          <!--begin::Row-->
                                              <?php if (!empty( $pageData->heading_image)) {
                                              ?>
                                          <div class="row">
                                              <!--begin::Col-->
                                              <div class="col-xl-3">
                                                  <div class="fs-6 fw-bold mt-2 mb-3">Preview Image</div>
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                  <img src="{{ asset('images/heading').'/'.$pageData->heading_image }}"  width="100px" height="100px">
                                              </div>
                                          </div>
                                              <?php
                                          }  ?>
                                              <!--end::Row-->

                                          <!--begin::Row-->
                                          <div class="row headingPreviewImage" style="display: none">
                                              <!--begin::Col-->
                                              <div class="col-xl-3">
                                                  <div class="fs-6 fw-bold mt-2 mb-3">Current Selected Preview Image</div>
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                                  <img id="heading-preview-image-before-upload" src="" alt="preview image" style="max-height: 100px;" width="100px">
                                              </div>
                                          </div>
                                          <!--end::Row-->

                                          <!--begin::Actions-->
                                          <div class="mb-0" id="addRemoveButton">
                                          </div>
                                          <!--end::Actions-->
                                      </div>
                                  </div>
                                  <!--end::Card body-->
                              </div>
                          @endif


                          <div class="card shadow-lg card-flush pt-3 mb-5 mb-lg-10 new_div ">
                          </div>


                          <!--end::Card-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-2 order-lg-2">
                    <!--begin::Card-->
                    <div class="card shadow-lg card-flush pt-3 mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Summary</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->

                        <div class="card-footer">

                            <!--begin::Actions-->
                            <div class="mb-0">
                                <button type="button"  id="dynamic-ar" class="btn btn-primary add-btn-repeat" onclick="addElement($(this))"  >
                                    <!--begin::Indicator -->
                                    <span class="indicator-label">Add More Page Detail</span>
                                    <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!-- end::Indicator -->
                                </button>
                            </div>
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <div class="mb-0">
                                <button type="submit" data-form="user_form" class="btn btn-primary" id="create_button">
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">{{ !empty( $pageData->silwana_detail_id) ?  'Update' :  'Create' }} Page</span>
                                    <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@push('scripts')
    <script src="{{ asset('js/swal.js') }}" ></script>

    <script type="text/javascript">

        $(document).ready(function (e) {

            $('#preview-image-before-upload').attr('src','');
            $('#page_image').change(function(){

                $('.previewImage').css('display','block');
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

                $('#heading-preview-image-before-upload').attr('src','');
            /* $('#heading_image').change(function(){

                $('.headingPreviewImage').css('display','block');
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#heading-preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });*/
        });

       // var btn_delete = '<button type="button" >Delete</button>';
       // var btn_add = '<button class="add-btn-repeat" onclick="addElement($(this))" type="button">Add</button>';

        var btn_delete = '<button type="button" id="remove" class="btn btn-primary"  onclick="remove($(this))">' +
        '  <span class="indicator-label">Remove</span>' +
        ' <span class="indicator-progress">Please wait...' +
        ' span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> ' +
        '  </button>'



        function remove(e) {
            e.parents('.example').remove();
        }

        function addElement(e) {
            var newElement = $(".example").first().clone();
            newElement.find('input,textarea,file').val('');
            $('.new_div').append(newElement);
            $(".example").find('div#addRemoveButton').html(btn_delete);

        }

        var button = document.querySelector("#create_button");

        var target = document.querySelector("#blockUI_target");
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        // Defination -------------------------------------------------------------------------------------------------------------

        var blockUI = new KTBlockUI(target, {
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Checking...</div>',
        }); // Element to block white fetching AJAX data ----------------------------------------------------------------------


        button.addEventListener("click", function () {
            if (!$("#user_form")[0].checkValidity()) {
                $("#user_form")[0].reportValidity();

                Toast.fire({
                    icon: 'error',
                    title: 'Please Fill Required Fields',
                    text: "Make sure required fields are filled properly before moving on"
                }); //display error toast

                return 0;
            }
            // Activate indicator
            button.setAttribute("data-kt-indicator", "on");
            button.setAttribute("disabled", "true");

            form = document.getElementById(this.getAttribute('data-form'));
            form.submit();
        }); // Handle Button Click Event ----------------------------------------------------------------------------


        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        }); // focus on search input in select 2 -------------------------------------------------------------------
    </script>

@endpush
