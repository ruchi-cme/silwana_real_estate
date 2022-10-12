$(document).ready(function() {

  /*  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/

    $(".btn-login").click(function(e){

        e.preventDefault();

        var email = $("#email").val();

        var password = $("#password").val();

        $.ajax({

            type:'POST',

            url:" /home/login ",

            data:{email:email, password:password},

            success:function(result){
                  window.location.reload();
            }  ,
            error: function(response) {
                $('#loginemail').hide();  $('#loginemail').hide();
                if(response.responseJSON.errors.email != ''){

                    $('#loginemail').text(response.responseJSON.errors.email);
                    $('#loginemail').show();
                }
                if(response.responseJSON.errors.password != ''){

                    $('#loginpassword').text(response.responseJSON.errors.password);
                    $('#loginpassword').show();
                }

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
                window.location.reload();
            }  ,
            error: function(response) {

                $('#signupname').hide();  $('#signupphone').hide();
                $('#signupemail').hide();  $('#signuppass').hide();

                if(response.responseJSON.errors.name != ''){

                    $('#signupname').text(response.responseJSON.errors.name);
                    $('#signupname').show();
                }

                if(response.responseJSON.errors.phone != ''){

                    $('#signupphone').text(response.responseJSON.errors.phone);
                    $('#signupphone').show();
                }


                if(response.responseJSON.errors.email != ''){

                    $('#signupemail').text(response.responseJSON.errors.email);
                    $('#signupemail').show();
                }
                if(response.responseJSON.errors.password != ''){

                    $('#signuppass').text(response.responseJSON.errors.password);
                    $('#signuppass').show();
                }

            },



        });

    });


});


