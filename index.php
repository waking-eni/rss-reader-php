<?php

if(file_exists("feed/feed.xml")) {
    $rss_feed = simplexml_load_file("feed/feed.xml");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>RSS Feed</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="selection-container">

<h4>RSS Feed</h4>

	<!-- form with select input that is getting filled with feeds -->
    <div>
        <form action="" method="post" name="feedform">
            <select name="feedoption" id="feedoption">
                <option selected disabled>Please select one option</option>
                <?php
                    if(!empty($rss_feed)) {
                        $i=0;
                        foreach ($rss_feed->channel->item as $feed_item) {
                            echo "<option value='".$i."'>".$feed_item->title."</option>";
                            $i += 1;
                        }
                    }
                ?>
            </select>
        </form>
    </div>

<!-- feed page content -->
<div id="show"></div>

<script>
//AJAX function 
$('#feedoption').on('change', function (e) {

    e.preventDefault();
        $.ajax({
        type: 'post',
		url: 'reader.php',
        data: $('#feedoption').serialize(),
		success : function(returnData) {
			var show = returnData;
			$('#show').html(show);
		}
    });

});
</script>

</body>
</html>
