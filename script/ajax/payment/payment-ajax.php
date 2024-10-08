<script>

<?php if(!empty($_POST['payment_amount'])){ ?>
    $(document).ready(function() {
        $('.razorpay-payment-button').click();
        $('.razorpay-payment-button').hide();
    });
<?php } ?>

<?php if(!empty($_POST['repay'])){ ?>
    $(document).ready(function() {
        $('.razorpay-payment-button').click();
        $('.razorpay-payment-button').hide();
    });
<?php } ?>

$('#payment-form').validate({
    rules: {
        user_name:{
            required: true
        },
        user_email:{
            required: true,
            email: true
        },
        user_phone:{
            required:true
        },
        payment_amount:{
            required: true
        },
        iagree:{
            required: true,
            maxlength: 1
        }
    },
    
    message:{
        // costum message here
    }
});


$('#payment-form').on('submit', function(){
    if($('#payment-form').valid()){
    
    }
});

</script>