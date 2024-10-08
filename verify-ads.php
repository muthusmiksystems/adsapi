<?php
include_once('config/config.php');
$ad_id = base64_decode($_GET['ad_id']);
$sql = "SELECT user_id, project_budget, project_click, project_url, project_type, clicks FROM ads WHERE uuid = '$ad_id'";
$result = $db->query($sql);
$row = mysqli_fetch_assoc($result);
$sql1 = "SELECT account_balance, spand_amount FROM ads_user WHERE id = ". $row['user_id'] ."";
$results = $db->query($sql1);
$rows = mysqli_fetch_assoc($results);

if($row['project_type'] == 'Mobile App'){
    $budget = $row['project_budget'] - 0.5;
    $acc_bal = $rows['account_balance'] - 0.5;
    $spand = $rows['spand_amount'] + 0.5;
}
if($row['project_type'] == 'Website'){
    $budget = $row['project_budget'] - 0.75;
    $acc_bal = $rows['account_balance'] - 0.75;
    $spand = $rows['spand_amount'] + 0.75;
}

if($row['project_type'] == 'Youtube Views'){
    $budget = $row['project_budget'] - 0.5;
    $acc_bal = $rows['account_balance'] - 0.5;
    $spand = $rows['spand_amount'] + 0.5;
}

$project_click = $row['project_click'] - 1;

$clicks = $row['clicks'] + 1;
echo 'redirecting...';
$sql = "UPDATE ads SET project_budget = '$budget', project_click = '$project_click', clicks = ". $clicks ." WHERE uuid = '$ad_id'";

if($db->query($sql) === TRUE){
    $sqlu = "UPDATE ads_user SET account_balance = ". $acc_bal .", spand_amount = ". $spand ." WHERE id = ". $row['user_id'] ."";
    if($db->query($sqlu) === TRUE){
         header("Location:".$row['project_url']);
    }
}else{
    echo $db->error;
}