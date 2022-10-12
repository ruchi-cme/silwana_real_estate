$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#inquiryForm').on('submit',function(e){
        e.preventDefault();

        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        let phone_no = $('#phone_no').val();
        let email_id = $('#email_id').val();
        let message = $('#message').val();


        $.ajax({
            url: "/home/submitInquiry",
            type:"POST",
            data:{

                first_name:first_name,
                last_name:last_name,
                email_id:email_id,
                phone_no:phone_no,
                message:message,
            },
            success:function(response){
                $('#successMsg').show();
                $('.inquiryText').val('');
                $('.text-danger').hide();

            },
            error: function(response) {

                $('#fnameErrorMsg').text(response.responseJSON.errors.first_name);
                $('#lnameErrorMsg').text(response.responseJSON.errors.last_name);
                $('#emailIdErrorMsg').text(response.responseJSON.errors.email_id);
                $('#phoneNoErrorMsg').text(response.responseJSON.errors.phone_no);
                $('#messageErrorMsg').text(response.responseJSON.errors.message);
            },
        });
    });







});
