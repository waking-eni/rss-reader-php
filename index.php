<?php

if(file_exists("feed/feed.xml")) {
    $rss_feed = simplexml_load_file("feed/feed.xml");
}

if(isset($_POST['feedoption'])) {
    $feedOption = $_POST['feedoption'];
} else {
    $feedOption = 0;
}

function getFeedContent($URL){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $URL);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$feedUrl = $rss_feed->channel->item[(int)$feedOption]->link;
$showContent = getFeedContent($feedUrl);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>RSS Feed</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
    <h2>RSS Feed</h2>
</div>

<div class="flex-container">

    <div class="form-feed">
        <form action="" method="post" name="feedform">
            <div class="custom-select">
                <select name="feedoption" onchange="feedform.submit();">
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
            </div>
        </form>
    </div>

    <div class="show-feed">
        <table>
            <tr>
                <?php
                    echo "<th><strong>".$rss_feed->channel->item[(int)$feedOption]->title.
                        "</strong></th>";
                ?>
            </tr>
            <tr><td>
                <a href="<?php echo $rss_feed->channel->item[(int)$feedOption]->link; ?>" target="_blank">
                    <?php echo $rss_feed->channel->item[(int)$feedOption]->link; ?></a>
            </td></tr>
            <tr><td>
                <?php echo $rss_feed->channel->item[(int)$feedOption]->description; ?>
            </td></tr>
        </table>
    </div>

    <div class="show-content">
        <?php echo $showContent; ?>
    </div>

</div>

</body>
</html>