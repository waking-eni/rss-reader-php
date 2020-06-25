<?php

if(file_exists("feed/feed.xml")) {
    $rss_feed = simplexml_load_file("feed/feed.xml");
}

//was an option in select input selected?
if(isset($_POST['feedoption'])) {
    $feedOption = $_POST['feedoption'];
} 

//get the URL from feed xml
if(isset($feedOption)) {
	$feedUrl = $rss_feed->channel->item[(int)$feedOption]->link;
	$showContent = getFeedContent($feedUrl);
}

//cURL function to retrieve page data from URL
function getFeedContent($URL){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $URL);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

echo $showContent;
