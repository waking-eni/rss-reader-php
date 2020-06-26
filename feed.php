<?php
header('Content-Type: text/xhtml');

if(file_exists("feed/feed.xml")) {
    $rss_feed = new DomDocument();
	$rss_feed->load("feed/feed.xml");
	print $rss_feed->saveXML();
}

?>