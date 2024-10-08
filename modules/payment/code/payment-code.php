<?php
include_once('../../../config/config.php');
extract($_POST);
$object = new global_class();

if(!empty($action) && $action == 'create-payment'){
    echo $object->create_payment($_POST);
    exit;
}

if(!empty($action) && $action == 'fetch_payment_history'){
    echo $object->fetch_payment_history($_POST);
    exit;
}

if(!empty($action) && $action == 'fetch_total_amount'){
    echo $object->fetch_total_amount($_POST);
    exit;
}