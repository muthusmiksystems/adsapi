<?php
session_start();
if(!isset($_SESSION['status'])){
    header('Location:index.php');
}

include_once('includes/view/head-html.php');
include_once('includes/view/left-panel-html.php');
include_once('includes/view/header-html.php');
include_once('modules/create-ad/view/create-ad-html.php');
include_once('includes/view/footer-html.php');
include_once('script/ajax/create-ad/create-ad-ajax.php');