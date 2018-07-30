<?php
$host     =	"localhost";
$username =	"admin_gamesc";
$password =	"79mUsRsW";
$db_name  =	"admin_gamesc"; 
$tbl_name =	"visitors";

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();



function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'The pear-shaped pineapple browser';
    $platform = 'Unknown';
    $version= "";
//echo '<div style="background:white;z-index:999999999999999;position:fixed;width:100%;height:80px;color:red;">'. $u_agent . '</div>';
    //First get the platform? 
    if (preg_match('/linux; u; android/i', $u_agent)) {
        $platform = 'android';
    }    
	elseif (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
	
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 


function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Davy Jones' Locker";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}


// now try it
$ua=getBrowser();
$yourbrowser= $ua['name'] . " " . $ua['version'];
$yourplatform= $ua['platform'];
$yourdate = date('Y-m-d H:i:s');
$yourcountry = visitor_country(); 
$segments = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$result = mysql_query("SELECT * FROM visitors WHERE (`ip` = '$user_ip' AND `browser` = '$yourbrowser')");
$count  = mysql_num_rows($result);

if($count==1){
	mysql_query("UPDATE visitors SET `datetime_last` = '$yourdate',`country` = '$yourcountry', `segments` = '$segments' WHERE `ip` = '$user_ip' AND `browser` = '$yourbrowser'");
}
elseif($count==0){
	
	mysql_query("INSERT INTO visitors (`ip`, `browser`, `platform`, `datetime_first`, `datetime_last` , `country`, `segments`) 
VALUES ('$user_ip', '$yourbrowser', '$yourplatform', '$yourdate', '$yourdate', '$yourcountry', '$segments')");
} 
else{
}

// Count
$result = mysql_query("SELECT * FROM page_views WHERE (`ip` = '$user_ip' AND `segments` = '$segments')");
$count  = mysql_num_rows($result);

if($count==1){
	mysql_query("UPDATE page_views SET `datetime_last` = '$yourdate' WHERE `ip` = '$user_ip' AND `segments` = '$segments'");
}
elseif($count==0){
	
	mysql_query("INSERT INTO page_views (`ip`, `segments`, `datetime_first`, `datetime_last` ) 
VALUES ('$user_ip', '$segments', '$yourdate', '$yourdate')");
} 
else{
}


if (strstr($_SERVER['REQUEST_URI'],'index.php')) {
    header('HTTP/1.0 404 Not Found');
}

?>
	