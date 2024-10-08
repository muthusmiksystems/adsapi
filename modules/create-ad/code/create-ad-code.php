<?php
include_once('../../../config/config.php');
session_start();
extract($_POST);

$object = new global_class();

if (!empty($action) && $action == 'create-ad-form') {
    $target_dir = '../../../uploads/';
    $image_ext_allowed = array('png', 'jpg', 'jpeg');
    $video_ext_allowed = array('mp4', 'avi', 'mov', 'wmv');

    // Extract and convert the file extension to lowercase
    $file_name = $_FILES['project_graphic']['name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $new_file_name = uniqid() . '.' . $file_ext;


    // Check if the uploaded file is an image or video
    if (in_array($file_ext, array_merge($image_ext_allowed, $video_ext_allowed))) {
        if ($_FILES['project_graphic']['size'] < 50000000) { // Allow up to 50MB
            if (move_uploaded_file($_FILES['project_graphic']['tmp_name'], $target_dir . $new_file_name)) {
                $_POST['project-graphic-path'] = 'uploads/'.$new_file_name;
                $_POST['date'] = date('Y-m-d');
                $_POST['time'] = date('H:i:s');
                echo $object->saveAdData($_POST);
            } else {
                echo 'Please try again';
            }
        } else {
            echo 'File size too large!';
        }
    } else {
        echo 'File format not allowed!';
    }
    exit;
}


