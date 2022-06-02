<style>
    @font-face {
        font-family: 'arial_mtbold';
        src: url('/frontend/assets/fonts/arial-boldmt-webfont.woff2') format('woff2'),
        url('/frontend/assets/fonts/arial-boldmt-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;

    }
    .container-inner{height: auto;min-height: 60vh;}
    /*Start Home Page New Arrivals Section*/
    .position-relative{position: relative !important;}
    .product_title{color: #b5b5b5;font-family: 'arial_mtbold',Arial, sans-serif; font-weight: 700;}
    .product-inner-price-col-4,.product-inner-price-col-6,.product-inner-price-col-12{font-family: 'arial_mtbold',Arial, sans-serif; font-weight: 700;}
    .product-price-col-4{margin-right: 0 !important;}
    .product-price-col-6{margin-right: 0 !important; }
    .product-price-col-12{margin-right: 0 !important;}
    .product_description_box{/*padding: 15px 0; display: none;*/

    }
    .product_description_box h2{color: #FFFFFF;font-family: 'arial_mtbold',Arial, sans-serif; font-size:20px; font-weight: 700;
    margin-bottom: 7px;}
    .product_description_box h3{color: #B2B2B2;}
    .expand-in{transform: rotate(90deg);}
    .expand-off{transform: rotate(-90deg);}

    .overlay-text{position: absolute; cursor: pointer; font-weight: bold; border: 2.012px solid #ffffff; color: #d8720e;
        z-index: 2; padding: 10px; text-align: center; width: 310px;height: 100px; box-sizing:border-box }
    .overlay-text-inner{ border: 3.2732px solid #d8720e; padding: 5px; height: 100%; display: flex; align-items: center; }
    .overlay-text-inner-txt{ display: block; margin: auto; font-family: 'arial_mtbold',Arial, sans-serif;
        font-weight: 700; font-size: 23px; text-transform: uppercase}
    .overlay-box{position: absolute; z-index: 1; top: 0; left: 15px; width: 100%; height: 100%; opacity: 54%; background-color: #000; cursor: pointer;}
    .slider-box-layered{opacity: 0.30; cursor: pointer;}
    .overlay-text-before{position: absolute; top:50%; left: -60px; width: 50px; border-top: 3.2732px solid #d8720e;}
    .overlay-text-after{ position: absolute; top:50%; right: -60px; width: 50px; border-top: 3.2732px solid #d8720e;}

    .hidden.overlay-text{
        -webkit-transform: scale(0.7);
        -ms-transform: scale(0.7);
        transform: scale(0.7);
        -webkit-transition: all 0.4s ease-out;
        transition: all 0.4s ease-out;
    }
    .hovereffect.overlay-text {
        opacity: 0;
        filter:alpha(opacity=0);
        -webkit-transition:all .3s ease-in-out;
        transition:all .3s ease-in-out;
        -ms-transform:scale(0.8);
        -webkit-transform:scale(0.8);
        transform:scale(0.8);
    }

    .hidden.overlay-box{
        -webkit-transform: scale(0.8);
        -ms-transform: scale(0.8);
        transform: scale(0.8);
        -webkit-transition: all 0.4s ease-out;
        transition: all 0.4s ease-out;
    }
    .hovereffect.overlay-box {
        opacity:0;
        filter:alpha(opacity=0);
        -webkit-transition:all .3s ease-in-out;
        transition:all .3s ease-in-out;
    }

    .codCleanTopBox-4{padding-left: 4px; padding-right: 10px;}
    .codCleanTopBox-6{padding-left: 5px; padding-right: 13px;}
    .codCleanTopBox-12{padding-left: 5px; padding-right: 13px;}

    .circleBox{float: left;margin-top:5px; width: 80%}
    .carousel-indicators li{width: 24px; height: 24px;}
    .carousel-indicators li.active{width: 24px; height: 24px;}
    .carousel-indicators-col-4 li{ width: 22px; height: 22px; padding: 3px;}
    .carousel-indicators-col-4 li.active{width: 22px; height: 22px; padding: 3px;}

    .titleBox{position: absolute; z-index: -1; text-align: center;}
    .dropDownBox{ float: right; width: 30px;}
    .priceBox{float: right; text-align: right; margin-top: 8px; width: 60px}

    /*.circleBox-4{width: 48px;}
    .circleBox-4.img-col-4,.circleBox-4.img-col-3,.circleBox-4.wide-col{width: 103px;}
    .titleBox-4{}
    .dropDownBox-4{width: 27px;}*/
    .priceBox-4{width: 20px;}

    /*.circleBox-6{width: 103px;}
    .circleBox-6.wide-col { width: 115px}
    .titleBox-6{}
    .dropDownBox-6{width: 65px;}
    .priceBox-6{width: 30px}

    .circleBox-12{width: 103px;}
    .circleBox-12.wide-col { width: 115px}
    .titleBox-12{}
    .dropDownBox-12{width: 65px;}
    .priceBox-12{width: 30px;}*/


    .carousel-items{float: none; position: static; left: auto; top:auto}
    .carousel-indicators{width:100%;}

    .color{display: block; padding:0px 0 0;}
    .color span.color-price{float: none !important;}
    .color-container { height:auto; min-height: 40px; padding:0; border-top: 2.8px solid #ffffff; border-bottom: 2.8px solid #ffffff;
        margin-top: 5px;}
    .color-col-4{margin-top: 2px;}
    .homepage-pagination-links {margin: 25px 0 55px}
    .small-screen-only{display:none;}
    .wide-screen-only{display:block;}
    .color span {float:none !important;}
    .color span.color-price{float:none !important;}
    .color .color-price, .color span{float:none !important;}
    .expand-in-col-4{height:29px;}
    .expand-in-col-6{height:36px;}
    .expand-in-col-12{height:36px;}
    .product-title-col-4{font-size:18px !important;}
    .product-title-col-6{font-size:21px !important;}
    .product-title-col-12{font-size:21px !important;}
    .product-inner-price-col-4{font-size:14px !important; }
    .product-inner-price-col-6{font-size:15px !important; }
    .product-inner-price-col-12{font-size:15px !important; }
    .collapsible-content{
        transition:opacity 0.3s cubic-bezier(.25,.46,.45,.94),height 0.3s cubic-bezier(.25,.46,.45,.94)
    }

    .collapsible-content.is-open{
        padding: 15px 0;
        visibility:visible;
        opacity:1;
        transition:opacity 1s cubic-bezier(.25,.46,.45,.94),height 0.35s cubic-bezier(.25,.46,.45,.94);
    }

    .collapsible-content--all{
        visibility:hidden;
        overflow:hidden;
        -webkit-backface-visibility:hidden;
        backface-visibility:hidden;
        opacity:0;
        height:0
    }

    .collapsible-content--all .collapsible-content__inner{
        transform:translateY(40px);
    }
    .is-open .collapsible-content__inner{
        transform:translateY(0);
        transition:transform 0.5s cubic-bezier(.25,.46,.45,.94)
    }
    section.urban-enigma-section{}
    .product-row{margin-bottom: 40px;}
    @media screen and (max-width:1660px) {
        .color-container { height:auto; min-height: 25px;}
        .color-col-4{margin-top: 0;}
        .homepage-pagination-links {margin: 25px 0 55px}
        .carousel-indicators li{width: 15px; height: 15px; padding: 5px;}
        .carousel-indicators li.active{width: 15px; height: 15px; padding: 5px;}
        .carousel-indicators-col-4 li{ width: 10px; height: 10px; padding: 2px;}
        .carousel-indicators-col-4 li.active{ width: 10px; height: 10px; padding: 2px;}
        .circleBox{margin: 0;}
        .circleBox-4{width: 62px;}
        .titleBox-4{}
        .dropDownBox-4{}
        .priceBox-4{}

        .circleBox-6{width: 73px;margin-top: 4px;}
        .circleBox-6.wide-col { width: 95px}
        .titleBox-6{}
        .dropDownBox-6{width: 45px;}
        .priceBox-6{width: 20px}

        .circleBox-12{width: 73px;margin-top: 4px;}
        .circleBox-6.wide-col { width: 95px}
        .titleBox-12{}
        .dropDownBox-12{width: 45px;}
        .priceBox-12{width: 20px;}
        .expand-in-col-4{height:24px;}
        .expand-in-col-6{height:28px;}
        .expand-in-col-12{height:28px;}
        .product-title-col-4{font-size:12px !important;}
        .product-title-col-6{font-size:18px !important;}
        .product-title-col-12{font-size:18px !important;}
        .product-inner-price-col-4{font-size:13px !important; }
        .product-inner-price-col-6{font-size:13px !important; }
        .product-inner-price-col-12{font-size:13px !important; }
    }
    @media only screen and (min-width: 768px) {
        /*.product_description_box{ background: red;}*/
    }
    @media only screen and (max-width: 767px){
        /* .product_description_box{ background: green;}*/
    }
    @media only screen and (max-width: 700px){
        .color-container {border-top: 2px solid #ffffff;
            border-bottom: 2px solid #ffffff}
        .small-screen-only{display:block;}
        .wide-screen-only{display:none;}
        .codCleanTopBox-4,.codCleanTopBox-6,.codCleanTopBox-12{padding-left: 0; padding-right:7px;}

        .carousel-indicators{width: 100%;}
        .circleBox{ margin-top:0;}
        .titleBox{margin-top: 0;}
        .dropDownBox{}
        .priceBox{ margin-top: 4px;}
        .circleBox-4,.circleBox-6,.circleBox-12{width:57px;}
        .circleBox.wide-col,.circleBox.img-col-4{width: 105px}
        .dropDownBox-4,.dropDownBox-6,.dropDownBox-12{width:30px;}
        .priceBox-4,.priceBox-6,.priceBox-12{width:20px;}
        .product-title-col-4,.product-title-col-6,.product-title-col-12 {font-size: 14px !important; margin-top: 6px;}
        .expand-in-col-4,.expand-in-col-6,.expand-in-col-12  {height: 28px;}

        .product-inner-price-col-4,.product-inner-price-col-6,.product-inner-price-col-12{
            font-size:15px !important;}

        .product-price-col-6{}
        .product-price-col-12{}
        .homepage-pagination-links {margin:0;}

        .carousel-indicators li,.carousel-indicators li.active,.carousel-indicators-col-4 li,
        .carousel-indicators-col-4 li.active{
            width: 22px; height: 22px; padding: 5px;
        }
        .phone-margine { margin-bottom: 25px;}
        section .row {padding-bottom: 0;}
        .product_description_box h2{color: #FFFFFF;font-size:18px;}
        .overlay-text { width: 190px; height: 75px; padding: 5px;}
        .overlay-text-inner-txt{ font-size: 22px;}
        .overlay-text-inner{padding: 0;}
        .product-row{margin-bottom:0;}
        }
    @media screen and (max-width: 384px){
        .phone-margine {
            margin-bottom: 25px;
        }
    }
    /*End Home Page New Arrivals Section*/

</style>
