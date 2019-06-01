<nav>
    <i id="navOpenButton" class="fa fa-bars" aria-hidden="true"></i>
    <ul itemscope itemtype="http://www.schema.org/SiteNavigationElement" id="navigation_menu">
        <i id="navCloseButton" class="fa fa-times" aria-hidden="true"></i>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/dashboard')}}">Dashboard</a></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/news')}}">News</a>
            <ul>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/news')}}">News articles</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/rsswebsites')}}">RSS websites</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/news/incoming')}}">RSS crawled articles</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/rssitems/find-keywords')}}">Find keywords</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/rssitems/suggest-game-title')}}">Suggest Game title</a></li>
            </ul>
        </li>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/games')}}">Games</a>
            <ul>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/games')}}">Games</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/platforms')}}">Platforms</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/genres')}}">Genres</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/developers')}}">Developers</a></li>
                <li itemprop="name"><a itemprop="url" href="{{url('/admin/publishers')}}">Publishers</a></li>
            </ul></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/exhibitions')}}">Exhibitions</a></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/pages')}}">Pages</a></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/admin/users')}}">Users</a></li>
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
