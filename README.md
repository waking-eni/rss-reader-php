# rss-reader-php

RSS reader
***
SimpleXML used to parse XML with feed data\
AJAX and jQuery used to send request to reader.php\
cURL used to retrieve data from URL
***
There are 2 functions in curl.php, because one returns an object, and other one returns a serialized object. Serialized object is necessary for simplexml_load_string to function properly.
Location of RSS feed page on my computer is: http://localhost/phpprojects/rss-reader-php/feed.php \
cURL takes absolute paths, and with real feed pages it works just fine. I'm worrking on localhost, so my absolute path to feed.php may differ from someone else's path, depending on where the project is located. Path should then be changed in index.php and reader.php \
Feed page is presented as xhtml, because I have an xml styleheet for feed.xml. XML DOM is used for presentation. 
