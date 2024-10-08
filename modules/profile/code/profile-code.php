<?php
session_start();
extract($_POST);
include_once('../../../config/config.php');
header('Content-Type: application/json');

$object = new global_class();

if(!empty($action) && $action == 'fetch-profile-data'){
    echo $object->fetch_profile_data($_POST);
    exit;
}

if(!empty($action) && $action == 'check-update-email'){
    echo $object->check_update_email($_POST);
    exit;
}


if(!empty($action) && $action == 'profile-update-form'){
    if($_FILES['profile_pic']['error'] == 0){
        $file_ext = explode('.', $_FILES['profile_pic']['name']);
        $fileName = date('d-m-Y-H-i-s'). '.' . $file_ext[1];
        $uploadPath = 'assets/profile-pic/'. $fileName;
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], '../../../'.$uploadPath);
        $_POST['profile_pic'] = $uploadPath;
    }
    echo $object->profile_update_form($_POST);
    exit;
}



if(!empty($action) && $action == 'change-password-form'){
    echo $object->change_password($_POST);
    exit;
}

if(!empty($action) && $action == 'fetch-image'){
    echo $object->fetch_profile_image();
    exit;
}