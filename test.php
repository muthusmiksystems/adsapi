<?php
//include('html_dom/simple_html_dom.php');

$doc = new DOMDocument();
$doc->loadHTMLFile("https://apps.apple.com/in/app/cryptobiz-exchange/id1497728209");
//echo $doc->saveHTML();

$tags = $doc->getElementsByTagName('source');
$i = 0;
foreach ($tags as $tag) {
    $i++;
    if($i == 1){
        //echo substr_replace($tag->getAttribute('srcset'), "", -3);
        $link = explode(',',$tag->getAttribute('srcset'));
        echo substr_replace($link[0], "", -3);
    }
       
}
//T75of

?>