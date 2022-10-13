$(document).ready(function() {

    $('.edit-profile-btn').click(function () {
        $('label.error').hide();
    });

        $("#profileModal").validate({
            firstname : 'required',
            lastname  : 'required',
            phone     : 'required',
            email: {
            required: true,
                email: true,//add an email rule that will ensure the value entered is valid email id.
                maxlength: 255,
            },
        });
    });




