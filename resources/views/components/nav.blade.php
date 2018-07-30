<nav>
    <i id="navOpenButton" class="fa fa-bars" aria-hidden="true"></i>
    <span id="navBackColor"></span>
    <ul itemscope itemtype="http://www.schema.org/SiteNavigationElement" id="navigation_menu">
        <i id="navCloseButton" class="fa fa-times" aria-hidden="true"></i>
        <li itemprop="name"><a itemprop="url" href="{{url('/')}}">Home</a></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/gamescom-2018')}}">Gamescom 2018</a>
        <ul>
            <li itemprop="name"><a itemprop="url" href="{{url('/tickets')}}">Tickets</a></li>
        </ul></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/publishers')}}">Publishers</a></li>
        <li itemprop="name"><a itemprop="url" href="{{url('/news')}}">News</a></li>
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
