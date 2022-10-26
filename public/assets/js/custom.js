/*global $,*/

$(function () {
    
    "use strict";
    
    var nav = $(".vertical-nav"),
        progressCheck = false,
        factsCheck = false;
	

		
    /*========== Loading  ==========*/
    $('.preloader').delay(200).fadeOut(700, function () {
        $(this).remove();
    });
	
    /*========== Active Menu  ==========*/
    $(".mobile-menu .toggle-menu").on("click", function () {
        nav.toggleClass("menu-active");
		$(".mobile-menu").toggleClass('push');
		$(".main-content").toggleClass('push');
		$(".project-content").toggleClass('push');
    });
	
	$(".vertical-nav .close-nav").on("click", function () {
        $(".mobile-menu .toggle-menu").click();
    });
    
    /*========== initializing page transition  ==========*/
	
	var ptPage = $('.subpages');
    if (ptPage[0]) {
        PageTransitions.init({
            menu: '.mini-menu ul',
        });
    }
	
    /*========== Skills Progress  ==========*/
    function skillsPogress() {
        $(".progress-container").each(function () {
            var progressBar = $(this).find(".progress-bar");
            progressBar.css("width", progressBar.attr("aria-valuenow") + "%");
        });
    }
    
    if (!progressCheck && $('.resume').scrollTop() >= $(".skills").offset().top + 150) {
        skillsPogress();
        progressCheck = true; 
    }
    
    $('.resume').on("scroll", function () {
        
        if (!progressCheck && $('.resume').scrollTop() >= $(".skills").offset().top + 150) {
            skillsPogress();
            progressCheck = true;
        }
        
    });
	
	var circleSkills = $('.circle-skills .skill');
    var myVal = $(this).attr('data-value');

    $(".circle-skills .skill").each(function () {

        circleSkills.circleProgress({
            startAngle: -Math.PI / 2 * 1,
            value: myVal,
            thickness: 5,
            size: 93
		});

    });
	
    /*========== Facts Counter  ==========*/
    if (!factsCheck && $('.about').scrollTop() >= $(".facts").offset().top + 200) {
        $(".facts .fact-number").countTo();
        factsCheck = true;
    }
    
    $('.about').on("scroll", function () {
        if (!factsCheck && $('.about').scrollTop() >= $(".facts").offset().top + 200) {
            $(".facts .fact-number").countTo();
            factsCheck = true;
        }
    });
	
    /*========== Slick Js  ==========*/
    $('.testimonials-slider').on('init', function (slick, slider) {
        var totalSlides  = slider.$slides.length,
            secondSlide   = slider.$slides[1],
            lastSlide    = slider.$slides[totalSlides - 1],
            nextSlideImg = $(secondSlide).find('img').attr('src'),
            prevSlideImg = $(lastSlide).find('img').attr('src');
        $("#testimonials-nextArrow .testimonials-client-img").css('background-image', 'url(' + nextSlideImg + ')');
        $("#testimonials-prevArrow .testimonials-client-img").css('background-image', 'url(' + prevSlideImg + ')');
    });
    $('.testimonials-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var totalSlides = slick.$slides.length;
        if (nextSlide + 1 === totalSlides) {
            var nextSlideNum = 0;
        } else  {
            nextSlideNum = nextSlide + 1;
        }
        if (nextSlide === 0) {
            var prevSlideNum = totalSlides - 1;
        } else  {
            prevSlideNum = nextSlide - 1;
        }
        var nextSlideImg = $(slick.$slides[nextSlideNum]).find('img').attr('src'),
            prevSlideImg = $(slick.$slides[prevSlideNum]).find('img').attr('src');
        $("#testimonials-nextArrow .testimonials-client-img").css('background-image', 'url(' + nextSlideImg + ')');
        $("#testimonials-prevArrow .testimonials-client-img").css('background-image', 'url(' + prevSlideImg + ')');
    });
    $('.testimonials-slider').slick({
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 1,
		autoplay: true,
        autoplaySpeed: 8000,
        arrows: true,
        nextArrow: $('#testimonials-nextArrow'),
        prevArrow: $('#testimonials-prevArrow'),
        appendDots: "#testimonial-paging",
        customPaging: function (slider, i) {
            var thumb = $(slider.$slides[i]).find('img').attr('src'),
                name = $(slider.$slides[i]).find('.testimonials-info h3').text();
            return '<i class="dot"><img src="' + thumb + '" class="img-fluid" data-toggle="tooltip" data-placement="top" title="' + name + '"></i>';
        },
        dots: true
    });
	
    /*========== Popup Js ==========*/
    $('.portfolio-content .item > a').on("click", function () {
		var dataType = $(this).attr('data-type');
		$('.' + dataType).addClass('active').siblings().removeClass('active');
    });
	
	$('.project-content .close').on("click", function () {
		$('.project-content').removeClass('active');
    });
	
    /*========== Ajax Contact Form  ==========*/
    $('.contact-form').on("submit", function () {
		
        var myForm = $(this),
	        data = {};
		
        myForm.find('[name]').each(function () {
			
            var that = $(this),
	            name = that.attr('name'),
	            value = that.val();
			
            data[name] = value;
			
        });
		
        $.ajax({
			
            url: myForm.attr('action'),
            type: myForm.attr('method'),
            data: data,
            success: function (response) {
				
		        if (response === 'success') {
								
			        $(".contact-form").find(".form-message").addClass("success");
			        $(".form-message span").text("Message Sent!");
					
		        } else {
					
			        $(".contact-form").find(".form-message").addClass("error");
			        $(".form-message span").text("Error Sending!");
					
		        }
	        }
			
        });
		
        return false;
		
	});

	
	 jQuery('.style-1-Box .dt-sc-icon-box.type1').on("mouseenter", function () {
		 jQuery('.style-1-Box .dt-sc-icon-box.type1 .icon-wrapper img').attr('src', 'http://www.colchiquevoyages.com/wp-content/uploads/2020/10/icon-1-light.png');
		 jQuery('.style-1-Box .dt-sc-icon-box.type1 .icon-wrapper img').attr('srcset', '');
		 
     });
	 jQuery('.style-1-Box .dt-sc-icon-box.type1').on("mouseleave", function () {
		 jQuery('.style-1-Box .dt-sc-icon-box.type1 .icon-wrapper img').attr('src', 'http://www.colchiquevoyages.com/wp-content/uploads/2020/11/01-1.png');
		 jQuery('.style-1-Box .dt-sc-icon-box.type1 .icon-wrapper img').attr('srcset', '');
     });
	
	
	document.querySelectorAll('.content-full-width .nosProduits')[0].classList.add("comp-alim");
	document.querySelectorAll('.custom-img-title ul.dt-sc-tabs-horizontal .scroll_tab_inner .scroll_tab_first a')[0].onclick = function () { 
	    document.querySelectorAll('.content-full-width .nosProduits')[0].classList.remove("medicam");
		document.querySelectorAll('.content-full-width .nosProduits')[0].classList.add("comp-alim");
	};
	document.querySelectorAll('.custom-img-title ul.dt-sc-tabs-horizontal .scroll_tab_inner .scroll_tab_last a')[0].onclick = function () { 
	    document.querySelectorAll('.content-full-width .nosProduits')[0].classList.remove("comp-alim");
		document.querySelectorAll('.content-full-width .nosProduits')[0].classList.add("medicam");
	};
	
	
	jQuery('.content-full-width .nosProduits').addClass("comp-alim");
	
	jQuery('.custom-img-title ul.dt-sc-tabs-horizontal .scroll_tab_inner .scroll_tab_first a').on("click", function () {
		 jQuery('.content-full-width .nosProduits').addClass("comp-alim").removeClass("medicam");
    });
	
	jQuery('.custom-img-title ul.dt-sc-tabs-horizontal .scroll_tab_inner .scroll_tab_last a').on("click", function () {
		 jQuery('.content-full-width .nosProduits').addClass("medicam").removeClass("comp-alim");
    });
	
	
	jQuery('.room-amount li i').hide();
	jQuery('.room-amount li').eq(0).prepend("<img src='http://www.colchiquevoyages.com/wp-content/uploads/2020/10/icon-1-light.png' alt >");
	jQuery('.room-amount li').eq(1).prepend("<img src='http://www.colchiquevoyages.com/wp-content/uploads/2020/11/01-1.png' alt >");
	jQuery('.room-amount li').eq(2).prepend("<img src='http://www.colchiquevoyages.com/wp-content/uploads/2020/10/icon-1-light.png' alt >");
	jQuery('.room-amount li').eq(3).prepend("<img src='http://www.colchiquevoyages.com/wp-content/uploads/2020/11/01-1.png' alt >");
	
	
});