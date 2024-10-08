
<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location:index.php');
}

require('config/config.php');
require('razorpay-php/Razorpay.php');

// Create the Razorpay Order

use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);
//var_dump($api);
if (!empty($_POST['payment_amount'])) {
    
    $price = $_POST['payment_amount'];
    $_SESSION['amount'] = $price;
    $name = $_POST['user_name'];
    $_SESSION['name'] = $name;
    $mobile = $_POST['user_phone'];
    $_SESSION['phone'] = $mobile;
    $email = $_POST['user_email'];
    $_SESSION['email'] = $email;
    $orderData = [
        'amount'          => $price * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
    ];
    try {
        $razorpayOrder = $api->order->create($orderData);
    //    print_r($razorpayOrder); // To ensure it's created
    } catch (\Exception $e) {
        echo 'Razorpay Error: ' . $e->getMessage(); // Capture error details
    }

    $razorpayOrderId = $razorpayOrder['id'];

    $_SESSION['razorpay_order_id'] = $razorpayOrderId;

    $displayAmount = $amount = $orderData['amount'];

    if ($displayCurrency !== 'INR') {
        $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
        $exchange = json_decode(file_get_contents($url), true);

        $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
    }
    
    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => "Selfieera",
        "description"       => "Ads Payment",
        "image"             => "https://selfieera.com/img/selfieee.png",
        "prefill"           => [
            "name"              => $name,
            "email"             => $email,
            "contact"           => $mobile,
        ],
        "notes"             => [
            "address"           => "Hello World",
            "merchant_order_id" => "12312321",
        ],
        "theme"             => [
            "color"             => "#7632eb"
        ],
        "order_id"          => $razorpayOrderId,
    ];

    if ($displayCurrency !== 'INR') {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }

    $json = json_encode($data);

    $sql = "INSERT INTO payment (`user_id`, `name`, `email`, `phone`, `pending_amount`, `status`, `razorpay_order_id`, `create_date`)VALUES('" . $_SESSION['user_id'] . "', '" . $data['prefill']['name'] . "', '" . $data['prefill']['email'] . "', '" . $data['prefill']['contact'] . "', '" . $_POST['payment_amount'] . "', 'Pending', '" . $data['order_id'] . "', '" . date('Y-m-d H:i:s') . "')";
    $db->query($sql);
    $sql = "SELECT MAX(id) as lastId FROM payment";
    $lastId = $db->query($sql);
    $row = mysqli_fetch_assoc($lastId);
    $_SESSION['lastId'] = $row['lastId'];
    
?>
    <form action="verify.php" method="POST">
        <script 
        src="https://checkout.razorpay.com/v1/checkout.js" 
        data-key="<?php echo $data['key'] ?>" 
        data-amount="<?php echo $data['amount'] ?>" 
        data-currency="INR" 
        data-name="<?php echo $data['name'] ?>" 
        data-image="<?php echo $data['image'] ?>" 
        data-description="<?php echo $data['description'] ?>" 
        data-prefill.name="<?php echo $data['prefill']['name'] ?>" 
        data-prefill.email="<?php echo $data['prefill']['email'] ?>" 
        data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" 
        data-notes.shopping_order_id="<?php echo 'OID' . rand(111111, 999999); ?>" 
        data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> 
        data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> 
        data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>
        <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
        <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
        >
        </script>
        <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
        <input type="hidden" name="shopping_order_id" value="3456">
    </form>

<?php
}

if(!empty($_POST['repay'])){
    $price = $_POST['amount'];
    $_SESSION['amount'] = $price;
    $_SESSION['lastId'] = $_POST['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $mobile = $_SESSION['phone'];
    $orderData = [
        'amount'          => $price * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
    ];

    $razorpayOrder = $api->order->create($orderData);

    $razorpayOrderId = $razorpayOrder['id'];

    $_SESSION['razorpay_order_id'] = $razorpayOrderId;

    $displayAmount = $amount = $orderData['amount'];

    if ($displayCurrency !== 'INR') {
        $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
        $exchange = json_decode(file_get_contents($url), true);

        $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
    }

    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => "Selfieera",
        "description"       => "Ads Payment",
        "image"             => "https://selfieera.com/img/selfieee.png",
        "prefill"           => [
            "name"              => $name,
            "email"             => $email,
            "contact"           => $mobile,
        ],
        "notes"             => [
            "address"           => "Hello World",
            "merchant_order_id" => "12312321",
        ],
        "theme"             => [
            "color"             => "#7632eb"
        ],
        "order_id"          => $razorpayOrderId,
    ];

    if ($displayCurrency !== 'INR') {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }

    $json = json_encode($data);
    
?>
    <form action="verify.php" method="POST">
        <script 
        src="https://checkout.razorpay.com/v1/checkout.js" 
        data-key="<?php echo $data['key'] ?>" 
        data-amount="<?php echo $data['amount'] ?>" 
        data-currency="INR" 
        data-name="<?php echo $data['name'] ?>" 
        data-image="<?php echo $data['image'] ?>" 
        data-description="<?php echo $data['description'] ?>" 
        data-prefill.name="<?php echo $data['prefill']['name'] ?>" 
        data-prefill.email="<?php echo $data['prefill']['email'] ?>" 
        data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" 
        data-notes.shopping_order_id="<?php echo 'OID' . rand(111111, 999999); ?>" 
        data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> 
        data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> 
        data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>
        <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
        <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
        >
        </script>
        <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
        <input type="hidden" name="shopping_order_id" value="3456">
    </form>
<?php
}
include_once('includes/view/head-html.php');
include_once('includes/view/left-panel-html.php');
include_once('includes/view/header-html.php');
include_once('modules/payment/view/payment-html.php');
include_once('includes/view/footer-html.php');
include_once('script/ajax/payment/payment-ajax.php');
?>
