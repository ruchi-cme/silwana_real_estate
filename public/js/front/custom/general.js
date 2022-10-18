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

    $("#projectImage").validate({

        rules: {

            "facing[]": "required",

        },
        messages: {

            "facing[]": "Please enter facing",
        }
    });

    $("#tableForm").validate({
        ignore: '',
        rules: {
            "block_name" :"required",
            "floor_no" : "required",
            "initial_name" : "initial_name",

            "facing[]" : "required",

        },
        messages: {
            "block_name" :"Please enter block name",
            "floor_no" : "Please enter floor number",
            "initial_name" : "Please enter initial name",
            "facing[]": "Please enter facing",
        }
    });
});




