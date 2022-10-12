$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#block_name').change(function ()  {
        var block = this.value;
        $("#floor").html('');
        $.ajax({
            url:   'getFloor' ,
            type: "GET",
            data: {
                block: block,
            },
            dataType: 'json',
            success: function (result) {
                $('#floor').html('<option value="">Select Floor</option>');
                $.each(result.floors, function (key, value) {
                    $("#floor").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
                $('#floor').select2('open');
            }
        });
    })


    $(".cancelBooking").click(function(){
        if (confirm('Are you sure?')) {
            var booking_id =  $(this).attr('booking_id');

            $.ajax({
                url:   'booking/cancel' ,
                type: "Post",
                data: {

                     booking_id : booking_id
                },
                success: function (result) {
                    alert(result.success);
                    $('.cancelBooking').replaceWith( '<a className="cmn-btn btn-2 ">CANCELLED </a>' );
                }
            });
        }
    });


    $(".bookNow").click(function(){
        var user_id =  $(this).attr('user_id');
        var unit_id =  $(this).attr('unit_id');

        if(user_id != '')
        {
            var route = "{{ URL('/booking/' )   }}";
            var url = route+'/'+ unit_id ;
            window.location.href = url;

        }else{
            //if not logged in
            $(this).attr('data-bs-toggle', 'modal');
            $(this).attr('data-bs-target', '#login-modal');
        }

    });




});
