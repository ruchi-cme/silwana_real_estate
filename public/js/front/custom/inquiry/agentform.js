// $( ".datepicker" ).datepicker();


jQuery(document).ready(function () {
    jQuery('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        // startDate: '+1d'
    });
});

$('#brokerForm').validate({
    rules: {
        agency_company_name: { required: true },
        agency_company_address: { required: true },
        company_phone: { 
            required: true,
        },
        company_mobile: { 
            required: true,
        },
        company_email:{
            required : true,
        },
        zip_code :{
            required : true,
        },
        po_box : {
            required : true,
        },
        trade_licence : {
            required : true
        },
        trade_licence_validity : {
            required : true
        },
        rera : {
            required : true
        },
        rera_validity : {
            required : true,
            date : true,
        },
        tax_reg : {
            required : true
        },
        trn_validity : {
            required : true,
            date : true
        },
        beneficiary_name : {
            required : true
        },
        account : {
            required : true,
            number : true 
        },
        iban :{
            required : true
        },
        swift_code:{
            required:true
        },
        bank_name : {
            required : true
        },
        bank_address : {
            required : true
        },
        account_currency : {
            required : true
        },
        name_of_authorized_signatory_on_passport : {
            required : true
        },
        personal_email : {
            required:true
        },
        mobile : {
            required:true,
            number : true
        },
        address : {
            required:true
        },
        passport_number : {
            required:true
        },
        passport_validity : {
            required:true,
            date: true
        },
        nationality:{
            required:true
        },
        designation : {
            required : true
        }
    },
    submitHandler: function (form) {
        $('body').attr('disabled','disabled');
        $('#FormSubmit').attr('disabled','disabled');
        $('#FormSubmit').value('please wait');
        $(form).submit();
    }
});