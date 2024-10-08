<?php
include_once('../../config/config.php');
$doc = new DOMDocument();
$sql = "SELECT a.project_name, a.project_type, a.app_type, project_url, a.project_day, a.project_click, a.project_budget, a.project_desc, a.uuid, au.account_balance, project_graphic_path FROM ads a LEFT JOIN ads_user au ON a.user_id = au.id WHERE a.verify_status = 0 AND a.project_budget != 0 AND au.account_balance > 10 ORDER BY RAND() LIMIT 3";
$result = $db->query($sql);
while ($rows = mysqli_fetch_assoc($result)) {
    $row['ad_id'] = base64_encode($rows['uuid']);
    $row['project_name'] = $rows['project_name'];
    $row['project_type'] = $rows['project_type'];
    $row['app_type'] = $rows['app_type'];
    $row['project_url'] = $rows['project_url'];
    $row['project_desc'] = $rows['project_desc'];
    $row['project_graphic'] = $rows['project_graphic_path'];
    if ($rows['project_type'] == 'Mobile App') {
        if ($rows['app_type'] == 'android') {
            $doc->loadHTMLFile($rows['project_url']);
            $tags = $doc->getElementsByTagName('img');
            $i = 0;
            foreach ($tags as $tag) {
                $i++;
                if ($i == 1) {
                    $row['project_image'] = substr_replace($tag->getAttribute('srcset'), "", -3);
                }

            }
        } else {
            $doc->loadHTMLFile($rows['project_url']);
            $tags = $doc->getElementsByTagName('source');
            $i = 0;
            foreach ($tags as $tag) {
                $i++;
                if ($i == 1) {
                    $link = explode(',', $tag->getAttribute('srcset'));
                    $row['project_image'] = substr_replace($link[0], "", -3);
                }

            }
        }
    } else {
        $row['project_image'] = 'https://e7.pngegg.com/pngimages/357/433/png-clipart-computer-icons-website-web-design-logo.png';
    }
    $json_data[] = $row;

}
// echo "<pre>";
// print_r($json_data);
// die;
echo json_encode($json_data);
