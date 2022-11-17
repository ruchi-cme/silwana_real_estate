$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".cancelBooking").click(function(){
        $('#exampleModal').modal('show');
        var booking_id =  $(this).attr('booking_id');


         $('.cancelBookingModal').attr('booking_id',booking_id);

    });

    $(".cancelBookingModal").click(function(){
        $('#exampleModal').modal('hide');
            var booking_id =  $(this).attr('booking_id');

            $.ajax({
                url:   'booking/cancel' ,
                type: "Post",
                data: {    booking_id : booking_id   },
                success: function (result) {

                    $('#bookingCancel').show();

                    $('#cncldBtn'+booking_id).show();
                    $('#cncl_'+booking_id).hide();
                    //window.location = '/myBooking';
                    // $('#cncl_'+bookingId).replaceWith( '<a className="cmn-btn btn-2">CANCELLED </a>' );

                }
            });

    });
    $(".cancelBooking1").click(function(){

        if (confirm('Are you sure?')) {
            var booking_id =  $(this).attr('booking_id');
            var bookingId =  $(this).attr('bookingId');

            $.ajax({
                url:   'booking/cancel' ,
                type: "Post",
                data: {    booking_id : booking_id   },
                success: function (result) {

                    $('#bookingCancel').show();

                    $('#cncldBtn'+bookingId).show();
                    $('#cncl_'+bookingId).hide();
                    //window.location = '/myBooking';
                   // $('#cncl_'+bookingId).replaceWith( '<a className="cmn-btn btn-2">CANCELLED </a>' );

                }
            });
        }
    });







});
