;(function($){
    $(window).on('load', function(){

        //Homepage Slider
        if( $('.homepage-urbanenigma-slider').length > 0 ) {
            $('.homepage-urbanenigma-slider').each(function(index, parent){
                var slider = $('.slider-inner', $(parent));
                var items_length = $('.f-item', slider).length - 1;
                var durationList = false;

                var durationList1 = $('.f-item', slider).map(function(index, item) {
                    return item.getAttribute('data-scroll1');
                });
                var durationList2 = $('.f-item', slider).map(function(index, item) {
                    return item.getAttribute('data-scroll2');
                });

                slider.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    slickGoTo: false,
                    dots: false,
                    autoplay: false,
                    adaptiveHeight: true,
                    speed: 1000
                });

                var slideIndex = currentSlide = inter = 0;
                var changeHomepageSlide = function(timing, durationList) {
                    setTimeout(function() {
                        if (timing !== 0) {
                            slider.slick('slickNext');

                            $('.urbanenigma-slider-indicator>li', $(parent)).each(function(idx, el){
                                if( $(el).hasClass('active') ){
                                    $(el).removeClass('active');
                                }
                            });
                            currentSlide = slider.slick('slickCurrentSlide');
                            $('.urbanenigma-slider-indicator>li:eq('+currentSlide+')', $(parent)).addClass('active');
                        }
                        if (slideIndex >= durationList.length){
                            slideIndex = 0;
                            if( !durationList || durationList == durationList2 ) {
                                durationList = durationList1
                            }
                            else {
                                durationList = durationList2;
                            }
                        }
                        changeHomepageSlide(durationList[slideIndex++], durationList);

                    }, parseInt(timing)*1000);
                }
                changeHomepageSlide(0, durationList1);
                
        
                //Color Dots click event. Change slide
                $('.urbanenigma-slider-indicator > li', $(parent)).each(function(idx, li){
                    var li = $(li);
                    li.click(function(event){
                        var slide_index = li.attr('data-slideindex');
                        var sliderid = '#'+li.attr('data-sliderid');
                        $(sliderid).slick( 'slickGoTo', parseInt(slide_index) );
        
                        $('.urbanenigma-slider-indicator>li').each(function(idx, el){
                            if( $(el).hasClass('active') ){
                                $(el).removeClass('active');
                            }
                        });
        
                        li.addClass('active');
                    });
                });
            });
        }

        //Description Page Slider
        if( $('.description-img').length ) {
            $('.description-img').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 1000,
                // adaptiveHeight: true,
                prevArrow: '<a href="javascript:;" class="slick-prev"><img src="'+location.origin+'/frontend/assets/images/desc-arrow-left.png" /></a>',
                nextArrow: '<a href="javascript:;" class="slick-next"><img src="'+location.origin+'/frontend/assets/images/desc-arrow-right.png" /></a>'
            });

            var durationListDesc = $('.description-img img.slide-image:not(.slick-cloned)').map(function(index, item) {
                return item.getAttribute('data-scroll1');
            });

            slideIndex = 0;
            var changeDescriptionSlide = function(timing) {
                setTimeout(function() {
                    if (timing !== 0) {
                        $('.description-img').slick('slickNext');
                    }
                    if (slideIndex >= durationListDesc.length){
                        slideIndex = 0;
                    }
                    changeDescriptionSlide(durationListDesc[slideIndex++]);

                }, parseInt(timing)*1000);
            }
        
            changeDescriptionSlide(0);
        }
    });// Window.onLoad
})(jQuery);