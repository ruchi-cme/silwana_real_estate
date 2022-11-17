$(document).ready(function() {

    $("#bookingForm").validate({
        ignore: '',
        rules: {
            email: {
                required: true,
                email: true,//add an email rule that will ensure the value entered is valid email id.
                maxlength: 255,
            },
            first_name: {
                required: true,
            },
            phone: {
                required: true,
                digits: true
            },
            last_name: {
                required: true,
            },
            block_id: {
                required: true,
            },
            floor_id: {
                required: true,
            },
            unit_id: {
                required: true,
            },
            booking_details : {
                required: true,
            }
        }
    })

    $(".bookNow").click(function(){
        var user_id =  $(this).attr('user_id');

        if(user_id != '')
        {
            $('#myModal').modal('show');
           // $(this).attr('data-bs-toggle', 'modal');
          //  $(this).attr('data-bs-target', '#myModal');

        }else{
            //if not logged in
            $('#login-modal').modal('show');
           // $(this).attr('data-bs-toggle', 'modal');
          //  $(this).attr('data-bs-target', '#login-modal');
        }

    });

    $('#create_button').on('click', function(event) {

        // adding rules for inputs with class 'comment'

        // prevent default submit action
        event.preventDefault();

        // test if form is valid
        if($('#bookingForm').valid()  ) { console.log(2);
            $( '#bookingForm' ).submit();
        } else { console.log(3);
            console.log("does not validate");
            return false;
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

    $('#downloadBrochure12').on('click', function () {

        if ($(this).attr('href').length < 1 || $(this).attr('href') == 'javascript:void(0)'){
             $(this).attr('href','javascript:void(0)');
            $('#noPDFModal').modal('show');

           // alert('No Pdf of this project!');
        }
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
    $('#downloadBrochure1').on('click', function () {

        var pdfFiles =  $('#files').val();
        console.log(pdfFiles);
        var proName = $(this).attr('proName');
        var zip = new JSZip();
        zip.file(pdfFiles);

        zip.generateAsync({type:"blob"})
            .then(function(content) {
                // see FileSaver.js
                saveAs(content, proName+".zip");
            });

    });
});
