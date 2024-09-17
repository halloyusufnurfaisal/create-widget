<?php
$datas = file_get_contents("https://maritim.bmkg.go.id/area/pelabuhan?id=371");
function getContent($data, $attr, $vAttr) {
    // $data = file_get_contents($url);
    $pattern = '{<div\s+'.$attr.'="'.$vAttr.'"\s*>((?:(?:(?!<div[^>]*>|</div>).)++|<div[^>]*>(?1)</div>)*)</div>}si';
    $matchcount = preg_match_all($pattern, $data, $matches);
    if ($matchcount > 0) {
        for($i = 0; $i < $matchcount; $i++) {
            echo($matches[1][$i]);
        }
    } else {
        echo('No matches');
    }
}

function getScript($data) {

    $pattern = "/\<script(.*?)?\>*.?<\/script\>/si";
    $matchcount = preg_match_all($pattern, $data, $matches);
    if ($matchcount > 0) {
        for($i = 0; $i < $matchcount; $i++) {
            echo "<script".$matches[1][$i]."></script>\n";
        }
    } else {
        echo('No matches');
    }
    // styling
    $pattern = "/\<link(.*?)?\>/si";
    $matchcount = preg_match_all($pattern, $data, $matches);
    if ($matchcount > 0) {
        for($i = 0; $i < $matchcount; $i++) {
            echo "<link".preg_replace("/--/i", "", $matches[1][$i]).">\n";
        }
    } else {
        echo('No matches');
    }
}

getScript($datas);
getContent($datas, "class", "blog-view");

?>
