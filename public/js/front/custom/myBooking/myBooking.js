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

    $(".book_now").click(function(){
        var user_id =  $(this).attr('user_id');
        var unit_id =  $(this).attr('unit_id');

        if(user_id != '')
        {
            var route = "{{ URL('/booking/' )   }}";
            var url = route+'/'+ unit_id ;
            window.location.href = url;

            /*    $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
        $.ajax({
                 url: " ",
                 type: "Post",
                 data: {
                     user_id : user_id, unit_id : unit_id
                 },
                 dataType: 'json',
                 success: function (result) {

                 }
             }); */

        }else{
            //if not logged in
            $(this).attr('data-bs-toggle', 'modal');
            $(this).attr('data-bs-target', '#login-modal');
        }

    });

});
