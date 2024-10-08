<?php
error_reporting(0);
class global_class{
    
    function fetch_ads_data($data){
        global $db;
        $sql = "SELECT a.*, au.account_balance FROM ads a LEFT JOIN ads_user au ON a.user_id = au.id WHERE user_id = ".$data['user_id']." ORDER BY date DESC";
        $result = $db->query($sql);
        echo $sql;
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
        return $json_data;
    }
    
    function saveAdData($data){
        global $db;
        $UuidSql = "SELECT UUID() as uuid";
        $UuidResult = $db->query($UuidSql);
        $Uuid = mysqli_fetch_assoc($UuidResult);
        $budget = ltrim($data['project_budget'], '₹');
        $desc =  mysqli_real_escape_string($db, $data['project_desc']);
        $sql = "INSERT INTO `ads` (`user_id`, `project_name`, `project_type`, `app_type`, `project_url`, `project_day`, `project_click`, `project_budget`, `project_desc`, uuid, `iagree`, color_code, project_graphic_path, `verify_status`, `date`, `time`) VALUES ( ".$_SESSION['user_id'].", '". $data['project_name'] ."', '". $data['project_type'] ."', '". $data['app-type'] ."', '". $data['project_url'] ."', ". $data['project_day'] .", ". $data['project_click'] .", '$budget', '".$desc."', '". $Uuid['uuid'] ."', '". $data['iagree'] ."', '". $data['color-code'] ."', '".$data['project-graphic-path']."', 1, '". $data['date'] ."', '". $data['time'] ."')";
        if($db->query($sql) === TRUE){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    
    
    function fetch_payment_history($data){
        global $db;
        $sql = "SELECT * FROM payment WHERE user_id = ".$data['id'] ." ORDER BY create_date DESC";
        $result = $db->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            $row['total'] = $result->num_rows;
            $json_data[] = $row;
        }
        return json_encode($json_data);
    }
    
    
    function fetch_total_amount($data){
        global $db;
        $sql = "SELECT SUM(p.amount) as total_deposit, au.account_balance as balance, SUM(pending_amount) as pending_balance, au.spand_amount FROM payment p LEFT JOIN ads_user au ON p.user_id = au.id WHERE p.user_id = ". $data['id'] ."";
        $result = $db->query($sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    }
    
    function fetch_profile_data($data){
        global $db;
        $sql = "SELECT name, email, phone, profile_pic FROM ads_user WHERE id = ".$_SESSION['user_id']."";
        $result = $db->query($sql);
        $row = mysqli_fetch_assoc($result);
        return json_encode($row);
    }
    
    
    function check_update_email($data){
        global $db;
        $sql = "SELECT email FROM ads_user WHERE email = '". $data['value'] ."' AND id != ".$_SESSION['user_id']."";
        $result = $db->query($sql);
        
        if($result->num_rows > 0){
            return json_encode(['success'=>'success']);
        }else{
            return json_encode(['fail'=>'fail']);
        }
    }
    
    function profile_update_form($data){
        global $db;
        if(isset($data['profile_pic'])){
            $query = ", profile_pic = '". $data['profile_pic'] ."'";
        }else{
            $query = '';
        }
        $sql = "UPDATE ads_user SET name = '".$data['name']."', email = '".$data['email']."', phone = '".$data['phone']."' $query WHERE id = ".$_SESSION['user_id']."";
        if($db->query($sql) === TRUE){
            $_SESSION['name'] = $data['name'];
            return json_encode(['success'=>'success']);
        }else{
            return json_encode(['error'=>'Somthing went wrong please retry.']);
        }
    }
    
    
    function change_password($data){
        global $db;
        $sql = "SELECT id, password FROM ads_user WHERE password = '". MD5($data['old_pass']) ."' AND id = ". $_SESSION['user_id'] ."";
        $result = $db->query($sql);
        if($result->num_rows > 0){
            $sql = "UPDATE ads_user SET password = '". MD5($data['new_pass']) ."' WHERE id = ". $_SESSION['user_id'] ."";
            if($db->query($sql) === TRUE){
                return json_encode(['success'=>'success']);
            }else{
                return json_encode(['error'=>'Somthing went wrong please retry.']);
            }
        }else{
            return json_encode(['error'=>'Old password not match.']);
        }
    }
    
    function fetch_profile_image(){
        global $db;
        $sql = "SELECT profile_pic FROM ads_user WHERE id = ". $_SESSION['user_id'];
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return json_encode($row);
    }
}