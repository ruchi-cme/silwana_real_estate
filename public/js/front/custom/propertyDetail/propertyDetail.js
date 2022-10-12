$(document).ready(function() {

    $(".bookNow").click(function(){
        var user_id =  $(this).attr('user_id');
        var unit_id =  $(this).attr('unit_id');

        if(user_id != '')
        {
            var route = "/booking";
            var url = route+'/'+ unit_id ;
            window.location.href = url;

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
                    $("#floor").append('<option value="' + value.proj_block_floor_id
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
                console.log(result);
                $('#unit').html('<option value="">Select Unit</option>');
                $.each(result.units, function (key, value) {
                    $("#unit").append('<option value="' + value.proj_floor_unit_id
                        + '">' + value.unit_name + '</option>');
                });

            }
        });
    })





});
