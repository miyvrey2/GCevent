<nav>
    <i id="navOpenButton" class="fa fa-bars" aria-hidden="true"></i>
    <span id="navBackColor"></span>
    <ul itemscope itemtype="http://www.schema.org/SiteNavigationElement" id="navigation_menu">
        <i id="navCloseButton" class="fa fa-times" aria-hidden="true"></i>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/dashboard')}}">Dashboard</a></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/news')}}">News</a></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/games')}}">Games</a></li>
        @guest
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                    <i class="fa fa-user"></i>
                    {{ Auth::user()->username }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{url('')}}">Website</a>
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
    </ul>
</nav>
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
            navBackColor.style.backgroundColor = "rgba(0, 0, 0, 0.3)";
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
    }
</script>
