<?php

$keyId = 'rzp_live_kDNWWBX4fcS8In';
$keySecret = 'DNGRbS4zv0ah2RmM0MSJtZ2Q';
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(0);
ini_set('display_errors', 1);

//Database connaction
 
// $servername = "localhost";
// $username = "selfieera_ads";
// $password = "Selfieera_ads@123";
// $dbname = "selfieera_ads";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "selfieera_ads";

$db = new mysqli($servername, $username, $password, $dbname);
if($db->connect_error){
    echo 'fail';
}

include_once('../../../classes/global.class.php');
