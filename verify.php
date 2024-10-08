<?php

require('config/config.php');
session_start();


require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";


if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    $payment = $api->payment->fetch($_REQUEST['razorpay_payment_id']) ;

    //print_r($payment->contact);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id']; 

    $sql = "UPDATE payment SET amount = ". $_SESSION['amount'] .", pending_amount = 0, status = 'Success', razorpay_payment_id = '$razorpay_payment_id', update_date = '". date('Y-m-d H:i:s') ."' WHERE id = '". $_SESSION['lastId'] ."'";

    if ($db->query($sql) === TRUE){
       $sql = "SELECT account_balance FROM ads_user WHERE id = ". $_SESSION['user_id'] ."";
       $result = $db->query($sql);
       $row = mysqli_fetch_assoc($result);
       $amount = $row['account_balance']+$_SESSION['amount'];
       $sql = "UPDATE ads_user SET account_balance = $amount WHERE id = ". $_SESSION['user_id'] ."";
       $db->query($sql);
    }else {
        echo "Error: " . $sql . "<br>" . $db->error;
      }
      

    $email_from = 'support@selfieera.com';//<== update the email address
    $email_subject = "Payment Success";
    $email_body = " Your payment was successfully added to your account.\n".
     "enjoy our services".

    $to = $_SESSION['email'];//<== update the email address
    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $email_from \r\n";

    mail($to,$email_subject,$email_body,$headers);
    $_SESSION['payment_status'] = 'Your payment was successfully added to your account';
    header('Location:dashboard.php');


    //$html = include 'success.php';
}
else
{
    $_SESSION['payment_status'] = 'Payment Failed';
    header('Location:dashboard.php');
    //$html = "<p>Your payment failed</p><p>{$error}</p>";
}

//echo $html;
