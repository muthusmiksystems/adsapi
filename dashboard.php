<?php
session_start();
if(!isset($_SESSION['status'])){
    header('Location:index.php');
}

include_once('includes/view/head-html.php');
include_once('includes/view/left-panel-html.php');
include_once('includes/view/header-html.php');
include_once('modules/dashboard/view/dashboard-html.php');
include_once('includes/view/footer-html.php');
include_once('script/ajax/dashboard/dashboard-ajax.php');
