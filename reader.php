<?php

require_once __DIR__.'/curl/curl.php';
$curl = new MyCurl();

//use curl function with object serialization
if(file_exists("feed.php")) {
	$rss = $curl->getWithDecode("http://localhost/phpprojects/rss-reader-php/feed.php");
    $rss_feed = simplexml_load_string($rss);
}

//was an option in select input selected?
if(isset($_POST['feedoption'])) {
    $feedOption = $_POST['feedoption'];
} 

//get the URL from feed xml
if(isset($feedOption)) {
	$feedUrl = $rss_feed->channel->item[(int)$feedOption]->link;
	$showContent = $curl->getFeedContent($feedUrl);
}


echo $showContent;
