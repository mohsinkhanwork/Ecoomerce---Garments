<div class="footer-background">
    <div style="min-height:400px;"></div>
    <div class="footer-inner home_footer_wrapper">
        <div class="home-footer-div p-3">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="ul">
                            <ul>
                                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                                <li><a href="{{url('terms-and-condition')}}">Terms and Condition</a></li>
                            </ul>
                        </div>
                        <div class="ul secondul">
                            <ul>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                                <li><a href="{{ url('/fashion-blog') }}">Blog</a></li>
                                <li><a href="{{ url('/collection') }}">Collection</a></li>
                                <li><a href="{{ url('/faqs') }}">FAQ</a></li>
                                <li><a href="{{ url('/about') }}">About</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 border-right">
                        <div class="ul">
                            <h1>Are <br/>you<br/> an<br/> Enigma?</h1>
                        </div>
                        <div class="ul"></div>
                    </div>

                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 align="center" class="whatwedo">What we do:</h3>
                                <p align="center" style="margin-top:10px"><img src="{{asset('img/what_we_do_icon.png')}}" style="max-height:70px"></p>

                            </div>
                            <div class="col-md-8">
                               <p style="font-size:12px">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam nostrum voluptate fugiat quos excepturi dolorum perspiciatis cum expedita ut! Totam nihil suscipit adipisci repudiandae necessitatibus velit nam illo obcaecati quas?
                                <br/>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur incidunt ea ratione neque nulla corporis iste necessitatibus consequatur quasi suscipit accusantium molestiae, assumenda dolore perferendis officia vero nam soluta tempore?
                               </p>
                               <br/>
                               <div class="row">
                                   <div class="col-md-4"></div>
                                   <div class="col-md-8">
                                        <div class="social">
                                            <a target="_blank" href="https://www.facebook.com/UrbanEnigma/"><i class="fa fa-facebook"></i></a>
                                        </div>
                                        <div class="social">
                                            <a target="_blank" href="https://www.instagram.com/urbanenigma_apparel/"><i class="fa fa-instagram"></i></a>
                                        </div>
                                        <div class="social">
                                           <a target="_blank" href="https://twitter.com/UrbanEnigmaTalk"><i class="fa fa-twitter"></i></a>
                                        </div>
                                        <div class="social">
                                            <a target="_blank" href="https://www.youtube.com/channel/UCe8KnRlO54DnvkKp-VxXAkA"><i class="fa fa-youtube"></i></a>
                                        </div>
                                        <div class="social">
                                           <a target="_blank" href="https://www.pinterest.com/urbanenigma_apparel/"><i class="fa fa-pinterest"></i></a>
                                        </div>

                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="inner-line">
            </div>
            <div class="final_content">
                <p align="center">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi quaerat sint nemo blanditiis saepe, beatae quibusdam molestias ipsum iure temporibus qui in, accusantium dolores ab numquam a hic labore voluptatum.
                </p>
            </div>
        </div>
    </div>
    <div style="background-color:gray;padding:30px">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="home_subscription">
                    <div class="home_sub_text" style="color:white">
                        Enjoy the latest Urban Enigma news &amp; discounts
                    </div>
                    <div class="home_sub_input">
                        <form id="home_sub_form" method="post" action="http://new-project.local/subscribe" class="search-box">
                            <input type="hidden" name="_token" value="KAPqJti2TzdX6Fk0qvXk1L3smxnQjwGnPI1THfw5">                                        <input autocomplete="off" required="" type="email" name="email" placeholder="Enter your mail">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<style>
    .border-right{
        border-right:0.5px solid #ccc;
        min-height:200px;
    }
    .home-footer-div{
        margin:0 100px;

    }
    .ul{
        width:48%;
        float:left;
    }


    .footer-inner.home_footer_wrapper {
        background-color: #404344;
        color:white;
        border-bottom:none;
        position:relative;

    }
    .home-footer-div .inner-line{

        border:0.5px solid #ccc;
        margin-top:10px;
    }

    .ul ul{
        list-style-type:none;
    }
    .secondul{
        padding-left:20%;
    }

    .ul ul li {
        display:block;

    }

    .ul h1{
        color:#d27a27;
    }

    .ul ul li a{
        font-size:14px;
        color:white;
        display:block;
    }

    .final_content{
        padding:10px;
    }
    .whatwedo{
        text-transform: uppercase;
        font-size:16px;
        color:#ce7826;
    }
    .social{
        width: 25px;
        height: 25px;
        line-height: 25px;
        border-radius: 50%;
        border: 1px solid #ccc;
        text-align: center;
        display:inline-block;
    }
    .social a{
        color:white;
    }
    .subscribe_pane{
        min-height:300px;
        background-color:gray;
    }
</style>
