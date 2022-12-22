@extends('admin.layouts.main',['title' => 'Broker Inquiry'])

@section('breadcrumb')
<li class="breadcrumb-item pe-3"><a href="{{ route('admin.brokerInquiry') }}" class="pe-3"><i class="fa fa-home text-hover-primary"></i></a></li>
<li class="breadcrumb-item px-3 text-primary"><a href="{{ route('admin.brokerInquiry') }}" class="pe-3">Broker Inquiry</a> </li>
<li class="breadcrumb-item px-3 text-primary">Broker Inquiry View</li>
@endsection

@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->

    <div id="kt_content_container" class="container-fluid">
        @include('layouts.alerts.error')
        @include('layouts.alerts.alert')

        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10 shadow-lg">

                <div class="card-body pt-9 pb-0">
                    <!--profile image-->
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">Broker Inquiry Detail</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9">

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Agency/company Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['agency_company_name'] ) ? $inquiry['agency_company_name'] :'' }} </span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Agency/Company Address</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bolder fs-6 text-gray-800 me-2"> {{ !empty($inquiry['agency_company_address'] ) ? $inquiry['agency_company_address'] :'' }} </span>

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Company Phone</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ !empty($inquiry['company_phone'] ) ? $inquiry['company_phone'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Company Mobile</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800"> {{ !empty($inquiry['company_mobile'] ) ? $inquiry['company_mobile'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Zip Code</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['zip_code'] ) ? $inquiry['zip_code'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">PO Box</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['po_box'] ) ? $inquiry['po_box'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Trade Licence</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['trade_licence'] ) ? $inquiry['trade_licence'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Trade Licence Validity</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['trade_licence_validity'] ) ? $inquiry['trade_licence_validity'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Trade Licence</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['trade_licence'] ) ? $inquiry['trade_licence'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Rera</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['rera'] ) ? $inquiry['rera'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Rera Validity</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['rera_validity'] ) ? $inquiry['rera_validity'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Rera Validity</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['rera_validity'] ) ? $inquiry['rera_validity'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Rera</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['rera'] ) ? $inquiry['rera'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Tax Reg</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['tax_reg'] ) ? $inquiry['tax_reg'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Trn Validity</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['trn_validity'] ) ? $inquiry['trn_validity'] :'' }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="card-header cursor-pointer p-0">
                                <div class="card-title m-0">
                                    <h3 class="fw-bolder m-0">Bank Account Details</h3>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Beneficiary Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['beneficiary_name'] ) ? $inquiry['beneficiary_name'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Account</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['account'] ) ? $inquiry['account'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Swift Code</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['swift_code'] ) ? $inquiry['swift_code'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Iban</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['iban'] ) ? $inquiry['iban'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Bank Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['bank_name'] ) ? $inquiry['bank_name'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Bank Address</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['bank_address'] ) ? $inquiry['bank_address'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Account Currency</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['account_currency'] ) ? $inquiry['account_currency'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Name Of Authorized Signatory As Per passport</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['name_of_authorized_signatory_on_passport'] ) ? $inquiry['name_of_authorized_signatory_on_passport'] :'' }}</span>
                                </div>
                            </div>
                            <div class="card-header cursor-pointer p-0">
                                <div class="card-title m-0">
                                    <h3 class="fw-bolder m-0">Personal Details</h3>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Personal Email</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['personal_email'] ) ? $inquiry['personal_email'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Mobile</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['mobile'] ) ? $inquiry['mobile'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Address</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['address'] ) ? $inquiry['address'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Passport Number</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['passport_number'] ) ? $inquiry['passport_number'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Passport Validity</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['passport_validity'] ) ? $inquiry['passport_validity'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Nationality</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['nationality'] ) ? $inquiry['nationality'] :'' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-bold text-muted">Designation</label>
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ !empty($inquiry['designation'] ) ? $inquiry['designation'] :'' }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                            <!--end::Input group-->

                    </div>
                        <!--end::Card body-->
                </div>
         </div>

            <!-- end of image-->

     </div>
        <!--end::Navbar-->

  </div>
    <!--end::Container-->

@endsection

