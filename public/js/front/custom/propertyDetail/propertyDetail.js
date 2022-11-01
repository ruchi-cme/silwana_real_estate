$(document).ready(function() {


    $("#bookingForm").validate({
        first_name : 'required',
        last_name  : 'required',
        phone     : 'required',
        email: {
            required: true,
            email: true,//add an email rule that will ensure the value entered is valid email id.
            maxlength: 255,
        },
    });
    $(".bookNow").click(function(){
        var user_id =  $(this).attr('user_id');


        if(user_id != '')
        {
            $(this).attr('data-bs-toggle', 'modal');
            $(this).attr('data-bs-target', '#myModal');

        }else{
            //if not logged in
            $(this).attr('data-bs-toggle', 'modal');
            $(this).attr('data-bs-target', '#login-modal');
        }

    });

    $('#block_name').change(function ()  {
        var block = this.value;
        $("#floor").html('');
        $.ajax({
            url:   '/getFloor' ,
            type: "GET",
            data: {
                block: block,
            },
            dataType: 'json',
            success: function (result) {

                $('#floor').html('<option value="">Select Floor</option>');
                $.each(result.floors, function (key, value) {
                    $("#floor").append('<option value="' + value.floor_detail_id
                          + '">' + value.floor_no + '</option>');
                });

            }
        });
    })

    $('#floor').change(function ()  {
        var floor_id = this.value;
        $("#unit").html('');

        $.ajax({
            url:   '/getUnit' ,
            type: "GET",
            data: {
                floor_id: floor_id,
            },
            dataType: 'json',
            success: function (result) {

                $('#unit').html('<option value="">Select Unit</option>');
                $.each(result.units, function (key, value) {
                    $("#unit").append('<option value="' + value.floor_unit_id
                        + '">' + value.unit_name + '</option>');
                });

            }
        });
    })

    $('#unit').change(function ()  {
        var unit_id = this.value;
        $('#totalPrice').text('');
        $('#bookingPrice').text('');
        $('#sqft').text('');
        $.ajax({
            url:   '/getUnitData' ,
            type: "GET",
            data: {
                unit_id: unit_id,
            },
            dataType: 'json',
            success: function (result) {
                $('#totalPrice').text(result.unitData.total_price);
                $('#bookingPrice').text(result.unitData.booking_price);
                $('#sqft').text(result.unitData.area_in_sq_feet);

            }
        });
    });

    $('#downloadBrochure').on('click', function () {

        var url = $('#downloadUrl').val();
        var proName = $(this).attr('proName');

        $.ajax({
            url:url,
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function (data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = proName+'Brochure.pdf';
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            }
        });
    });


});
