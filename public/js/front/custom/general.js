$(document).ready(function() {

    $('.edit-profile-btn').click(function () {
        $('label.error').hide();
    });

    $("#profileModal").validate({
        ignore: '',
        rules: {
            email: {
                required: true,
                email: true,//add an email rule that will ensure the value entered is valid email id.
                maxlength: 255,
            },
            firstname: {
                required: true,
            },
            phone: {
                required: true,
                digits: true
            },
            lastname: {
                required: true,
            },

        }
    })

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

    $.validator.addMethod("mytst", function (value, element) {
        var flag = true;

        $("[name^=block_name]").each(function (i, j) {
            $(this).parent('p').find('label.error').remove();
            $(this).parent('p').find('label.error').remove();
            if ($.trim($(this).val()) == '') {
                flag = false;

                $(this).parent('p').append('<label  id="id_ct'+i+'-error" class="error">This field is required.</label>');
            }
        });


        return flag;


    }, "");
        $("#blockForm").validate({
            ignore: '',
            rules: {

                project_name: {
                    required: true,
                },
                total_block: {
                    required: true,
                    digits: true
                },
                type_of_block: {
                    required: true,
                },
                from: {
                    required: true,
                }
            },
            messages: {
                project_name: {
                    required: "Please enter project name",
                },
                total_block: {
                    required: "Please enter total block",
                },
                type_of_block: {
                    required: "Please enter type of block",
                },
            },
        })


});




