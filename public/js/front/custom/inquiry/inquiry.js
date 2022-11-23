$(document).ready(function() {

    var showChar = 100;
    var ellipsestext = "...";
    var moretext = "less";
    var lesstext = "Read more";
    $('.more').each(function() {
        var content = $(this).html();
        var showChar = $(this).attr('showChar');
        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar-1, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });



    $("#inquiryForm").validate({
        ignore: '',
        rules: {
            "first_name": "required",
            "last_name": "required",
            email_id: {
                required: true,
                email: true
            },
            "phone_no" : {
                required: true,
                digits: true
            },
            "message": "required",
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*
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

        });
    });

*/
    $('.submitInquiry').on('click', function(event) {
        // prevent default submit action
        event.preventDefault();

        // test if form is valid
            if($('#inquiryForm').valid()  ) { console.log(2);

                $.ajax({
                    url: "/home/submitInquiry",
                    type:"POST",
                    data:   $('#inquiryForm').serialize() ,
                    success:function(response){
                        $('#successInqMsg').show();
                        $('.inquiryText').val('');
                    },

                });
            } else { console.log(3);
                console.log("does not validate");
                return false;
            }
     });


    $("#inquiryFormFooter").validate({
        ignore: '',
        rules: {
            "first_name": "required",
            "last_name": "required",
            email_id: {
                required: true,
                email: true,
            },
            "phone_no" : {
                required: true,
                digits: true
            },
            "message": "required",
        }
    });

    $('#submitInquiryBtn').on('click', function(event) {

        // prevent default submit action
        event.preventDefault();

        // test if form is valid
        if($('#inquiryFormFooter').valid()  ) { console.log(2);

            $.ajax({
                url: "/home/submitInquiry",
                type:"POST",
                data:   $('#inquiryFormFooter').serialize() ,
                success:function(response){
                    $('#successInqMsg').show();
                    $('.inquiryText').val('');
                },

            });
        } else { console.log(3);
            console.log("does not validate");
            return false;
        }
    });


});
