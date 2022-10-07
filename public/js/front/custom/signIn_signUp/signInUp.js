$(document).ready(function() {

  /*  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/

    $(".btn-login1").click(function(e){

        e.preventDefault();

        var email = $("#email").val();

        var password = $("#password").val();

        $.ajax({

            type:'POST',

            url:"  home/login ",

            data:{email:email, password:password},

            success:function(result){
                console.log(result.errors);
                if(result.errors)
                {


                    jQuery.each(result.errors, function(key, value){ alert(value);
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<li>'+value+'</li>');
                    });
                }
                else
                {
                    jQuery('.alert-danger').hide();
                    $('#open').hide();
                    $('#login-modal').modal('hide');
                }

            }
        });

    });


});


