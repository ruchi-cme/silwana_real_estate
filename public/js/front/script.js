$('.sale-property-slider').owlCarousel({
    loop:true,
    margin:20,
    dots: false,
    nav : false,
    autoplay:false,
    autoplayTimeout:5000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:2
        },
        1200: {
            items:3
        }
    }
});


$('.top-properties-slider').owlCarousel({
    loop:true,
    margin:20,
    dots: true,
    nav : false,
    autoplay:false,
    autoplayTimeout:5000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        1200: {
            items:1
        }
    }
});

$('.read-blogs-slider').owlCarousel({
    loop:true,
    margin:20,
    dots: true,
    nav : false,
    autoplay:false,
    autoplayTimeout:5000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        1200: {
            items:1
        }
    }
});



$('.project-feature').owlCarousel({
    loop:true,
    margin:20,
    dots: false,
    nav : true,
    autoplay:false,
    autoplayTimeout:5000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    },
    navText: ['<img src="/images/front/home/arrow.svg">','<img src="/images/front/home/arrow2.svg">']
});


$('.about-slider').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});



// edit image

$(document).ready(function() {

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});




// video play pause

$(document).ready(function() {
    var video_element = $("#videotest")[0];

    $("#play-button").click(function() {
      video_element.play();
      $(".video-wrapper").addClass("playing");
    });

    $("#pause-button").click(function() {
      video_element.pause();
      $(".video-wrapper").removeClass("playing");
    });

    // $("#volup-button").click(function() {
    //   video_element.volume = video_element.volume * 1.25;
    // });
    // $("#voldown-button").click(function() {
    //   video_element.volume = video_element.volume * 0.75;
    // });
    $("#switch-button").click(function() {
      if (
        $("#mp4-source")[0].src == "https://imelgrat.me/demo/videos/starbust.mp4"
      ) {
        $("#mp4-source")[0].src = "https://imelgrat.me/demo/videos/bigbuckbunny.mp4";
        $("#webm-source")[0].src =
          "https://imelgrat.me/demo/videos/bigbuckbunny.webm";
      } else {
        $("#mp4-source")[0].src = "https://imelgrat.me/demo/videos/starbust.mp4";
        $("#webm-source")[0].src = "https://imelgrat.me/demo/videos/starbust.webm";
      }

      video_element.load();
      video_element.play();
    });
});

$('.media-image-slider').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{

        0:{
            items:1
        },
        600:{

            items:1
        },
        1000:{

            items:1
        }
    }
});




