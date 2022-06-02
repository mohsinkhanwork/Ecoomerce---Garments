(function ($)
     { "use strict"
  
/* 1. sticky And Scroll UP */
    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 400) {
        $(".header-sticky").removeClass("sticky-bar");
        $("#back_btn_page").removeClass("sticky-btn-page");
        $('#back-top').fadeOut(500);
      } else {
        $(".header-sticky").addClass("sticky-bar");
        $("#header_search_form").addClass("d-none");
        $("#back_btn_page").addClass("sticky-btn-page");
        $('#back-top').fadeIn(500);
      }
    });

  // Scroll Up
    $('#back-top a').on("click", function () {
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
  

/* 2. slick Nav */
// mobile_menu
    // var menu = $('ul#navigation');
    // if(menu.length){
    //   menu.slicknav({
    //     prependTo: ".mobile_menu",
    //     closedSymbol: '+',
    //     openedSymbol:'-'
    //   });
    // };

//3 Single Img slider
  $('.category-slider-home').slick({
    dots: false,
    infinite: true,
    autoplay: true,
    speed: 400,
    arrows: true,
    prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-arrow-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i class="fas fa-arrow-right"></i></i></button>',
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
          arrows: true
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: true
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: true
        }
      },
    ]
  });

/* 6. Nice Selectorp  */
  var nice_Select = $('select.nice-select');
    if(nice_Select.length){
      nice_Select.niceSelect();
    }

/* 7. data-background */
    $("[data-background]").each(function () {
      $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
      });


/* 8. WOW active */
    new WOW().init();

// 9. ---- Mailchimp js --------//  
    function mailChimp() {
      $('#mc_embed_signup').find('form').ajaxChimp();
    }
    mailChimp();


// 10 Pop Up Img
    var popUp = $('.single_gallery_part, .img-pop-up');
      if(popUp.length){
        popUp.magnificPopup({
          type: 'image',
          gallery:{
            enabled:true
          }
        });
      }

// 12 Pop Up Video
    var popUp = $('.popup-video');
    if(popUp.length){
      popUp.magnificPopup({
        type: 'iframe'
      });
    }


//11. Search box
    $('.header').on('click', '.search-toggle', function(e) {
      var selector = $(this).data('selector');
    
      $(selector).toggleClass('show').find('.search-input').focus();
      $(this).toggleClass('active');
      e.preventDefault();
    });
  
  $('#header_search_btn').click(function () {
    var value = $('#search_input').val();
    if (value) {
      $("#header_search_form").submit();
    }
    
    });
  $('#header_search_btn_mobile').click(function () {
    var value = $('#search_input_mobile').val();
    if (value) {
      $("#header_search_form_nobile").submit();
    }
    
    });
  $('.navbar-toggler').click(function () {
    $(this).toggleClass('open-menu');
    $('#navbarContent').toggleClass('d-none');
    $('#header_search_form').addClass('d-none');
  });
  $('.mobile_search').click(function () {
    $('#navbarContent').addClass('d-none');
    $('#header_search_form').toggleClass('d-none');
    $('.navbar-toggler').removeClass('open-menu');
  });
  $('ul.pagination li a.page-link').click(function (event) {
    event.preventDefault();
    var loc = window.location;
    var href = $(this).attr('href');
    var url = new URL(href);
    var key = 'page';
    var value = url.searchParams.get("page");
    var params = addParamToURL(key, value, loc.search);
    if (loc.port == '') {
      window.location = loc.protocol + '//' + loc.hostname + loc.pathname + params;
    } else {
      window.location = loc.protocol + '//' + loc.hostname + ':' +loc.port + loc.pathname + params
    }
    
  });
  function addParamToURL(key, value, urlQueryString) {
    var newParam = key + '=' + value,
      params = '?' + newParam;
    if (urlQueryString) {
      var keyRegex = new RegExp('([\?&])' + key + '[^&]*');


      if (urlQueryString.match(keyRegex) !== null) {
        params = urlQueryString.replace(keyRegex, "$1" + newParam);
      } else {
        params = urlQueryString + '&' + newParam;
      }
    }
    return params;
  }
})(jQuery);
