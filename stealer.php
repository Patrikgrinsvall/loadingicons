<?php
/**
 * Script for stealing all loading.io svgs icons. This might can come in handy some day :)
 */
$pages = 100; // how many we should take?
$cnt = 0;
for($page=5;$page<$pages;$page++) {
  $apiurl = "https://loading.io/d/icon/?limit=100&offset=".$page*100;
  $data = json_decode(file_get_contents($apiurl));
  if(count($data)<10) die("We didnt get any responses after $cnt downloads\r\n");
  foreach($data as $d) {    
    $svg = file_get_contents("https://loading.io/s/icon/" . $d->slug.".svg");
    $dir = __DIR__."/".$d->name;
    @mkdir($dir);
    file_put_contents($dir."/".$d->name."_".$d->state."_".$d->key.".svg", $svg);
    $cnt++;
    echo "[ $cnt ] " . $d->name . "_" . $d->state . "_" . $d->key . "\r\n";
  }
}
