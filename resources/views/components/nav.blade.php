        <nav>
            <i id="navOpenButton" class="fa fa-bars" aria-hidden="true"></i>
            <ul itemscope itemtype="http://www.schema.org/SiteNavigationElement" id="navigation_menu">
                <i id="navCloseButton" class="fa fa-times" aria-hidden="true"></i>
                <li itemprop="name"><a itemprop="url" href="{{url('/')}}">Home</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/gamescom-2019')}}">Gamescom 2019</a>
                    <ul>
                        <li itemprop="name"><a itemprop="url" href="{{url('/gamescom-2019/lineup')}}">Lineup</a></li>
                        <li itemprop="name"><a itemprop="url" href="{{url('/gamescom-2019/exhibitors')}}">Exhibitors</a></li>
                        <li itemprop="name"><a itemprop="url" href="{{url('/events-2019')}}">Events</a></li>
                        <li itemprop="name"><a itemprop="url" href="{{url('/cosplay')}}">Cosplay</a></li>
                    </ul>
                </li>
                <li itemprop="name"><a itemprop="url" href="{{url('/tickets')}}">Tickets</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/news')}}">News</a></li>
                @guest
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{url('/admin/dashboard')}}">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
                <li>
                    <div id="search-form">

                        {!! Form::open(['method'=>'POST','url'=>'search','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

                        <input  id="search-input" aria-label="Search input field" type="search" class="form-control" name="search" placeholder="Search..." autocomplete="off">
                        <button id="search-button" class="btn btn-default-sm" aria-label="Submit search input" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        {!! Form::close() !!}

                    </div>
                    <script type="application/ld+json">
                    {
                       "@context": "http://schema.org",
                       "@type": "WebSite",
                       "name" : "Gamescomevent.com",
                       "url": "https://www.gamescomevent.com/",
                       "potentialAction": {
                         "@type": "SearchAction",
                         "target": "https://www.gamescomevent.com/search/{search_term_string}",
                         "query-input": "required name=search_term_string"
                       }
                    }
                    </script>
                </li>
            </ul>
        </nav>
        <div id="navBackColor"></div>
        <script>
            /*
             * Menu Script
             * */
            var navOpenButton  	= document.getElementById("navOpenButton");
            var navCloseButton  = document.getElementById("navCloseButton");
            var navBackColor	= document.getElementById("navBackColor");
            var menu 			= document.getElementById("navigation_menu");
            var open = 0;
            navOpenButton.style.cursor 	= 'pointer';
            navCloseButton.style.cursor = 'pointer';

            navOpenButton.onclick = function(){
                if (open===0){
                    navBackColor.style.backgroundColor = "rgba(0, 0, 0, 0.05)";
                    navBackColor.style.display = "block";
                    menu.style.right = 0;
                    open++;
                }
                else{
                    closeMenu();
                }
            }
            navCloseButton.onclick = function(){
                if (open===0){
                    menu.style.right = 0;
                    open++;
                }
                else{
                    closeMenu();
                }
            }
            navBackColor.onclick = function(){
                if(open > 0){
                    closeMenu();
                }
            }

            function closeMenu() {
                menu.style.right = '-50vh';
                open=0;
                navBackColor.style.backgroundColor = "rgba(0, 0, 0, 0)";
                navBackColor.style.display = "none";
            }
        </script>
