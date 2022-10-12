$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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







});
