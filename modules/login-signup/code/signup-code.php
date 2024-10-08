<?php
include_once('../../../config/config.php');

extract($_POST);
extract($_GET);
session_start();

if(!empty($action) && $action == 'signup-form'){
    $name = mysqli_real_escape_string($db, $name);
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, MD5($password));
    $phone = mysqli_real_escape_string($db, $phone);
    $sql = "INSERT INTO `ads_user` (`name`, `email`, phone, `password`, `date`, `time`) VALUES ('$name', '$email', '$phone', '$password', '".date('Y-m-d')."', '".date('H:i:s')."')";
    if($db->query($sql) === TRUE){
        echo 'success';
    }else{
        echo 'fail'.$db->error;
    }
    exit;
}


if(!empty($action) && $action == 'Check Email'){
    $sql = "SELECT email FROM ads_user where email = '$value'";
    $result = $db->query($sql);
    if($result->num_rows > 0){
        echo 'Email already registered';
    }
}

?>