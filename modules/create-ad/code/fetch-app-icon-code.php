<?php
extract($_POST);
$doc = new DOMDocument();
if(!empty($action) && $action == 'android'){
$doc->loadHTMLFile($app_link);
//echo $doc->saveHTML();

$tags = $doc->getElementsByTagName('img');
$i = 0;
foreach ($tags as $tag) {
    $i++;
    if($i == 1){
        echo substr_replace($tag->getAttribute('srcset'), "", -3);
    }
       
}
exit;
}

if(!empty($action) && $action == 'ios'){
$doc->loadHTMLFile($app_link);
//echo $doc->saveHTML();

$tags = $doc->getElementsByTagName('source');
$i = 0;
foreach ($tags as $tag) {
    $i++;
    if($i == 1){
        $link = explode(',',$tag->getAttribute('srcset'));
        echo substr_replace($link[0], "", -3);
    }
       
}
exit;
}

?>