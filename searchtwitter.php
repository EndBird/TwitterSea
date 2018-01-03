<?php
require_once('TwitterAPIExchange.php');
$settings = array(
    'oauth_access_token' => "2540446980-uXIwY0lkENPIp6da6Qq1vzF3Geu9xuw2ckWh4TP",
    'oauth_access_token_secret' => "IqVPxKHLU4i9zhpqARJoNgEGPjzowqwEn4tstqOy5iSFk",
    'consumer_key' => "HvNyfq7I76QPeT4w1S379y3L3",
    'consumer_secret' => "168oPQgtn4kkHw31wUqCBegLXg0F0Yepck3IMd1zQqMreUsVYD"
);
if ($_GET['search'][0] =='@') {
	
	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
	$user=$_GET['search'];
	$getfield = "?screen_name=$user&count=20";}
else {
	$url = "https://api.twitter.com/1.1/search/tweets.json";
	$queryend = urlencode($_GET['search']);
	$getfield = "?q=$queryend";

}

$requestMethod = "GET";

$twitter = new TwitterAPIExchange($settings);
$string=json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(), $assoc=TRUE);
if (isset($string["error"]))
 
	{echo "account does not exist or error";
	exit();}
//echo "<pre>";
$word_list=[];

if ($_GET['search'][0] =='@') {
	foreach($string as $items)
    {	//echo $items['text'];
    	$keywords = preg_split("/[\s,]+/",$items['text']);
    	foreach ($keywords as $word) {
    		if (array_key_exists($word, $word_list)) {
    			$word_list[$word] = $word_list[$word] + 1;
    		}
    		else {
    			$word_list[$word] = 1;
    		}
    	}

    }

}
else {
	foreach($string['statuses'] as $items)
    {
    	$keywords = preg_split("/[\s,]+/",$items['text']);
    	foreach ($keywords as $word) {
    		if (array_key_exists($word, $word_list)) {
    			$word_list[$word] = $word_list[$word] + 1;
    		}
    		else {
    			$word_list[$word] = 1;
    		}
    	}

    }
}
echo json_encode($word_list);
//echo "</pre>";
//echo "<h2>Simple Twitter API test</h2>";

?>