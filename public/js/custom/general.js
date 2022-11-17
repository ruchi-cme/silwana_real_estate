
    function validateFileType()
    {
        var fileName = $("#image").val();
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        console.log(extFile);
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"  || extFile=="svg") {
        //TO DO
        } else {
            $("div.imageBgDiv").css('background-image','none');
            $("#image").val('');
            $("#fileErr").html('The image must be a file of type: png, jpeg, gif, svg.');
        }
    }

    function validateFileTypes(data)
    {
        var fileName = $("#"+data).val();
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        console.log(extFile);
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"  || extFile=="svg") {
            //TO DO
        } else {
            $("div."+data).css('background-image','none');
            $("#"+data).val('');
            $("#fileErr"+data).html('The image must be a file of type: png, jpeg, gif, svg.');
        }
    }

    function validateVideoFileType()
    {
        var fileName = $("#video_title").val();
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        console.log(extFile);
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"  || extFile=="svg") {
            //TO DO
        } else {
            $("#showVideo").attr('src','');
            $("#video_title").val('');
            $("#error3").html('The video must be a file of type: mp3, mp4.');
        }
    }
