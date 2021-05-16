// navbar fixed on scroll
window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar_top");
var sticky = navbar.offsetTop;
function myFunction() {
    if(window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
};
var btn = $("back-top");
btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });
  

$(document).ready(() => {
    $('#hamburger-menu').click(() => {
        $('#hamburger-menu').toggleClass('active');
        $('#nav-menu').toggleClass('active');
    })
    //setting owl carousel
    let navText = ["<i class = 'bx bx-chevron-left'></i>",
"<i class = 'bx bx-chevron-right'></i>"]
    $('#food-carousel').owlCarousel({
        items: 1,
        dots: false,
        loop: true,
        nav: true,
        navText: navText,
        autoplay: true,
        autoplayHoverPause: true
    })
    $('#service-slider').owlCarousel ({
        items: 1,
        dots: false,
        loop: true,
        nav: true,
        autoplay: true,
        //navText: navText,
        autoplayHoverPause: true,
        responsive: {
            500: {
                items: 1
            },
            575: {
                items: 2
            },
            1280: {
                items: 2
            },
            1536: {
                items: 2
            }
        }
    })
    $('#chef').owlCarousel ({
        items: 1,
        dots: false,
        loop: true,
        nav: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            500: {
                items: 1
            },
            575: {
                items: 2
            },
            1280: {
                items: 3
            },
            1536: {
                items: 3
            }
        }
    })
    $('#top-food-slide').owlCarousel ({
        items: 2,
        dots: false,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            500: {
                items: 2
            },
            1280: {
                items: 3
            },
            1536: {
                items: 4
            }
        }
    })
    
});
 //Window Loaded Handler

$(window).on('load',function() {'use strict';
$(".loader").fadeOut("slow");
});

jQuery(function($) {'use strict';
    //Facts Counters Home Page
    $(".number-counters").appear(function () {
    $(".number-counters [data-to]").each(function () {
        var e = $(this).attr("data-to");
        $(this).delay(6e3).countTo({
            from: 50,
            to: e,
            speed: 3e3,
            refreshInterval: 50
            })
        })
    });
    $('.info_section').paralax("50%", 0.2);
    $('.paralax').paralax("50%", 0.2);      
})

