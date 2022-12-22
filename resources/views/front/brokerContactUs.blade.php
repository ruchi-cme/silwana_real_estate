
    <style>
       

       /* 
       Agent Registration
       */
       
       .agent-form {
           margin-top: 150px;
       }
       
       .panel-title {
           margin-bottom: 25px;
       }
       
       .form-control {
           text-transform: capitalize;
           background: #FFFFFF;
           border: 1px solid #B48D4E;
           border-radius: 10px;
           color: #8B8B8C;
           font-size: 16px;
           font-family: var(--medium);
           padding: 16px 25px;
       }
       
       .form-control:focus {
           box-shadow: none;
           border: 1px solid #B48D4E;
       }
       
       .form-design {
           background: #FFFFFF;
           box-shadow: 0px 20px 40px rgb(0 0 0 / 10%);
           border-radius: 25px;
           padding: 30px;
       }
       
       .submit-btn {
           width: 200px;
           margin: 20px 0;
       }
           </style>
<x-base>
<x-banner title="Contact Us" page="Contact Us"></x-banner>
    <section class="agent-form p-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="title text-center">
                            <h2 class="page-header">agent registration</h2>
                        </div>
                    </div>
                    <?php 
                        if(Session::has('Mymessage')){ 
                            echo  Session::get('Mymessage');
                        } 
                    ?>
                    <form id="brokerForm" action="{{url('brokercontatctUs')}}" Method="post">
                        @csrf
                        <div class="row form-design">
                            <div class="panel-heading">
                                <h3 class="panel-title">agency details</h3>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="agency_company_name"   class="form-control" placeholder="agency / company name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="agency_company_address"   class="form-control" placeholder="agency / company address">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="company_phone"   class="form-control phone_number" placeholder="company phone ">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="company_mobile"   class="form-control phone_number" placeholder="company mobile ">
                                </div>
                            </div>
                          
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="email" name="company_email"   class="form-control" placeholder="company email add">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="zip_code"   class="form-control" placeholder="ZIP code">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="po_box"   class="form-control" placeholder="PO box">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="trade_licence"   class="form-control" placeholder="Trade license">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="trade_licence_validity"   class="form-control datepicker" placeholder="Trade license validity">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="rera"   class="form-control" placeholder="RERA">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="rera_validity"  class="form-control datepicker" placeholder="RERA validity">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="tax_reg"   class="form-control" placeholder="tax reg">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="trn_validity"   class=" form-control datepicker" placeholder="TRN validity">
                                </div>
                            </div>

                            <div class="panel-heading">
                                <h3 class="panel-title">bank details</h3>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="beneficiary_name"   class="form-control" placeholder="beneficiary name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="account"   class="form-control" placeholder="account">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="iban"   class="form-control" placeholder="IBAN">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="swift_code"   class="form-control" placeholder="swift code">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="bank_name"   class="form-control" placeholder="bank name">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="bank_address"   class="form-control" placeholder="bank address">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="account_currency"   class="form-control" placeholder="account currency">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="name_of_authorized_signatory_on_passport"   class="form-control" placeholder="name of authorized signatory as per passport">
                                </div>
                            </div>
                           

                            <div class="panel-heading">
                                <h3 class="panel-title">personal details</h3>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="email" name="personal_email"   class="form-control" placeholder="email ID">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="mobile"   class="form-control" placeholder="mobile">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="address"   class="form-control" placeholder="address">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="passport_number"   class="form-control" placeholder="passport">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="passport_validity"   class="form-control datepicker" placeholder="passport validity">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="nationality"   class="form-control" placeholder="nationality">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="designation"   class="form-control" placeholder="designation">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <button type="submit" id="FormSubmit" class="cmn-btn submit-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
      
    </section>
    @section('scripts')
        <script   src="{{ asset('js/front/custom/inquiry') }}/{{ $js }}.js"> </script>
    @endsection
    </x-base>