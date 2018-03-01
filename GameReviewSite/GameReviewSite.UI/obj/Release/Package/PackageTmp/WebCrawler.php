<?php
function get_review($url){
    $c = array();
	$input = file_get_contents($url);
	$regexp = "<p[^>]*>.*?<\/p>";
	preg_match_all("/$regexp/", $input, $matches);

	$c = $matches[0];

    $fullPage = "";
    foreach($c as $page){
        $fullPage .= $page;
    }

    return $fullPage;
}

//get_review("http://www.ign.com/articles/2016/05/16/doom-review-2");
?>