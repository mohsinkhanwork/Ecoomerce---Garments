<nav>
    <ul>
        <li class="hidden-xs desktop-home-link">
            <a href="{{ url('/') }}">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
        </li>
        <li class="mobile-only home-button">
            <a href="{{ url('/') }}">
                <span>Home</span>
                <img src="{{ asset('frontend/assets/images/nav-bg-home-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                <img src="{{ asset('frontend/assets/images/nav-bg-home-720.png') }}" class="nav-for-320" alt="#" />
            </a>
        </li>
        <li>
            <a href="{{ url('/collection') }}">
                <span>Collection</span>
                <img src="{{ asset('frontend/assets/images/nav-bg-category-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                <img src="{{ asset('frontend/assets/images/nav-bg-category-720.png') }}" class="nav-for-320" alt="#"/>
            </a>
        </li>
        <li>
            <a href="{{ url('/about') }}">
                <span>About</span>
                <img src="{{ asset('frontend/assets/images/nav-bg-about-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                <img src="{{ asset('frontend/assets/images/nav-bg-about-720.png') }}" class="nav-for-320" alt="#" />
            </a>
        </li>
        <li>
            <a href="{{ url('/faqs') }}">
                <span>Faqs</span>
                <img src="{{ asset('frontend/assets/images/nav-bg-faqs-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                <img src="{{ asset('frontend/assets/images/nav-bg-faqs-720.png') }}" class="nav-for-320" alt="#"/>
            </a>
        </li>
        <li>
            <a href="{{ url('/contact') }}">
                <span>Contact</span>
                <img src="{{ asset('frontend/assets/images/nav-bg-contact-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                <img src="{{ asset('frontend/assets/images/nav-bg-contact-720.png') }}" class="nav-for-320" alt="#"/>
            </a>
        </li>

        <li>
            <a href="{{ url('fashion-blog') }}" >
                <span>Blog</span>
                <img src="{{ asset('frontend/assets/images/nav-bg-blog-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                <img src="{{ asset('frontend/assets/images/nav-bg-blog-720.png') }}" class="nav-for-320" alt="#"/>
            </a>
        </li>
        <li class="mobile-only">
            <a href="javascript:;" data-toggle="tooltip" title="Coming Soon!">
                <span>Gallery</span>
                <img src="{{ asset('frontend/assets/images/nav-bg-gallery-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                <img src="{{ asset('frontend/assets/images/nav-bg-gallery-720.png') }}" class="nav-for-320" alt="#"/>
            </a>
        </li>
        <li>
            @if(Auth::check())
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    <span>Logout</span>
                    <img src="{{ asset('frontend/assets/images/nav-bg-reg-log-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                    <img src="{{ asset('frontend/assets/images/nav-bg-reg-log-720.png') }}" class="nav-for-320" alt="#"/>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            @else
                <a href="javascript:;" class="click-register">
                    <span>Register/Login</span>
                    <img src="{{ asset('frontend/assets/images/nav-bg-reg-log-720.png') }}" class="nav-for-720 hvr-bounce-out" alt="#"/>
                    <img src="{{ asset('frontend/assets/images/nav-bg-reg-log-720.png') }}" class="nav-for-320" alt="#"/>
                </a>
            @endif
        </li>
    </ul>
</nav>
