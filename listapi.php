<?php
session_start();
require('config/config.php');
 
// Get the video identifier from the query parameter
if (isset($_POST['user_id'])) {
    //$videoId = $_GET['video'];
    // Path to your video file (you might fetch this from a database based on the ID)
    //$filePath = $videoId;  // Adjust path as required
    //echo "iam here".$videoId;exit;
    // Call the function to stream the video
    //$param = $_GET['user_id'];
    header('Content-Type: application/json');
    //global global_class();
    global $db;
        $sql = "SELECT a.*, au.account_balance FROM ads a LEFT JOIN ads_user au ON a.user_id = au.id WHERE user_id = ".$_POST['user_id']." ORDER BY date DESC";
        $result = $db->query($sql);
        //echo $sql;
        $json_data = array();
        foreach($result as $keys => $rows){
            if($rows['project_type'] == 'Mobile App'){
                if($rows['app_type'] == 'android'){
                    $doc = new DOMDocument();
                    $doc->loadHTMLFile($rows['project_url']);
                    $tags = $doc->getElementsByTagName('img');
                    $i = 0;
                    foreach ($tags as $tag) {
                        $i++;
                        if($i == 1){
                            $rows['project_image'] = substr_replace($tag->getAttribute('srcset'), "", -3);
                        }
       
                    }
                }else if($rows['app_type'] == 'ios'){
                    $doc = new DOMDocument();
                    $doc->loadHTMLFile($rows['project_url']);
                    $tags = $doc->getElementsByTagName('source');
                    $i = 0;
                    foreach ($tags as $tag) {
                        $i++;
                        if($i == 1){
                            $link = explode(',',$tag->getAttribute('srcset'));
                            $rows['project_image'] = substr_replace($link[0], "", -3);
                        }
       
                    }
                }
            }else if($rows['project_type'] == 'Youtube Views'){
                $rows['project_image'] = 'https://www.logo.wine/a/logo/YouTube/YouTube-Icon-Full-Color-Logo.wine.svg';
            }else{
                $rows['project_image'] = 'https://e7.pngegg.com/pngimages/357/433/png-clipart-computer-icons-website-web-design-logo.png';
            }
            $rows['project_desc'] = '';
            $json_data[] = $rows;
        }
        //print_r($json_data);
        echo json_encode($json_data);
    //}
    //echo $data;
} else {
    header("HTTP/1.1 400 Bad Request");
    echo 'Error: invlaid paramaneter';
}

?>