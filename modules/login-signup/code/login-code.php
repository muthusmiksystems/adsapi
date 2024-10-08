<?php
include_once('../../../config/config.php');

extract($_POST);
extract($_GET);
session_start();


if(!empty($action) && $action == 'Check Email'){
    $value = mysqli_real_escape_string($db, $value);
    $sql = "SELECT email FROM ads_user where email = '$value'";
    $result = $db->query($sql);
    if($result->num_rows <= 0){
        echo 'Email not registered';
    }
    exit;
}

if(!empty($action) && $action == 'login-form'){
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);
    $sql = "SELECT * FROM ads_user where email = '$email' AND password = '".MD5($password)."'";
    $result = $db->query($sql);
    if($result->num_rows > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION['status'] = 'login success';
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['phone'] = $row['phone'];
        echo 'success';
    }else{
        echo 'fail';
    }
    exit;
}

?>