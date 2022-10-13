$(document).ready(function() {

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-login").click(function(e){

        e.preventDefault();

        var email = $("#email").val();

        var password = $("#password").val();

        $.ajax({

            type:'POST',

            url:"/home/login",

            data:{email:email, password:password},

            success:function(result){
                console.log(result);
                if(result.success){
                    window.location.reload();
                }
                else if(result.error){
                    $('#loginError').show();
                    $('#loginError').html(result.error);
                }
                else if(result.errors) { alert(1);
                    $('#loginError').html('');
                    jQuery.each(result.errors, function(key, value){
                        $('#loginError').show();
                        $('#loginError').append('<li>'+value+'</li>');
                    });
                }
                //  window.location.reload();
            }  ,
            error: function(response) {
                console.log(response);
                $('#loginError').html('');
                jQuery.each(response.errors, function(key, value){
                    $('#loginError').show();
                    $('#loginError').append('<li>'+value+'</li>');
                });
            },
        });

    });

    $(".btn-signup").click(function(e){

        e.preventDefault();

        var email = $("#semail").val();
        var password = $("#spassword").val();
        var name = $("#name").val();
        var phone = $("#phone").val();

        $.ajax({

            type:'POST',

            url:"/home/signup",

            data:{email:email, password:password, name:name, phone:phone},

            success:function(result){
                console.log(result);
                if(result.success){
                    window.location.reload();
                }
                else if(result.error){
                    $('#signupError').show();
                    $('#signupError').html(result.error);
                }
                else if(result.errors) {
                    $('#signupError').html('');
                    jQuery.each(result.errors, function(key, value){
                        $('#signupError').show();
                        $('#signupError').append('<li>'+value+'</li>');
                   });
                }
            }  ,
            error: function(response) {
                $('#signupError').html('');
                jQuery.each(response.errors, function(key, value){
                    $('#signupError').show();
                    $('#signupError').append('<li>'+value+'</li>');
                });


            },



        });

    });


});


