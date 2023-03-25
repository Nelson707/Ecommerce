<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="/images/logo.png" alt="#" style="margin-left: 2%"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
{{--                    <li class="nav-item active">--}}
{{--                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('all_products') }}">Products</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_cart') }}" >Cart</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_order') }}" >Order</a>
                    </li>

                    <form class="form-inline my-2 my-lg-0" action="{{ url('product_search') }}" method="get">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    @if(Route::has('login'))
                        @auth()
                            <li class="nav-item">
                                <x-app-layout>

                                </x-app-layout>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-primary mr-2" href="{{ route('login') }}">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-success" id="logincss" href="{{ route('register') }}">Sign Up</a>
                            </li>
                        @endauth
                    @endif

                </ul>
            </div>
        </nav>
    </div>
</header>
