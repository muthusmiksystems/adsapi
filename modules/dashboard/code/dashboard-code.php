<?php
session_start();
extract($_POST);
include_once('../../../config/config.php');
header('Content-Type: application/json');

$object = new global_class();

if(!empty($action) && $action == 'fetch-ads-data'){
    echo json_encode($object->fetch_ads_data($_POST));
}