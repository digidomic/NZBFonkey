<html>
<head>
<title>
NZBFonkey
</title>
<meta>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</meta>
</head>

<style>

body {
    background: linear-gradient(-45deg, #23d5ab, #23a6d5);
    font-family: arial;
    top:0;
    left:0;
    right:0;
    bottom:0;
    overflow: hidden;
}

.title {
    color: white;

}

.centerdiv {
    text-align: center;
    position: absolute; /* or absolute */
    padding: 10px;
    width: 85%;
}

.box {
    border: 2px solid white;
    padding: 10px;
    color: white;
    width: 100%;
}

.urlinput {
    background: transparent;
    border: 2px solid white;
    border-radius: 7px;
    height: 30px;
    width: 100%;
}

.urlinput:focus {
    border: 2px solid #a82222;
    outline: none;
}

.sendurl {
    background-color: white;
    color: black;
    padding: 5px;
    padding-right: 20px;
    padding-left: 20px;
    border: 1px solid gray;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>

<body onLoad="document.f1.url.focus()";>


<div class=centerdiv>
<h1 class=title>NZBFonkey</h1>

<div class=box>
<form action="" method="post" name=f1>
<input class=urlinput name=url type=text >

<p>
<input class=sendurl type=submit name=sendurl value="Push to sabNZBd">
</p>

</form>





<?php

if(isset($_POST['sendurl'])){
    if(isset($_POST['url'])){

$nzblink = $_POST['url'];

$substring = explode("=", $nzblink);



// nzbindex.nl Link

$linkanfang = "https://nzbindex.com/search/rss?q=";
$linkende = "&hidespam=1&sort=agedesc&complete=1";
$nzbheader = substr($substring[2], 0, -2);
$nzbpassword = $substring[3];
$nzbtext = substr($substring[1], 0, -2);

$nzbsearchurl = $linkanfang.$nzbheader.$linkende;

//create download-url for nzb file
$xml=simplexml_load_file($nzbsearchurl) or die("Error: Cannot create object");
$nzbdlurl = $xml->channel->item->link;


//push to sabnzbd

$sabhost = " ";
$sabport = "8080";
$sabapi = " ";

$saburl = "http://".$sabhost.":".$sabport."/sabnzbd/api?mode=addurl&apikey=".$sabapi."&name=".$nzbdlurl."&nzbname=".$nzbtext."&password=".$nzbpassword;

$callapiurl = file_get_contents($saburl);

echo "Anfrage bearbeitet.";
unset($saburl);
header("refresh: 1;");

}
}

?>

</div>
</div>

</body>

</html>