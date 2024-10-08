<script>
$(document).ready(function(){
   $.ajax({
       url: 'modules/payment/code/payment-code.php',
       type: 'POST',
       data: {action: 'fetch_payment_history', id: <?php echo $_SESSION['user_id']; ?>},
       dataType: 'json',
       success: function(res){
           $.each(res, function(index, item){
               if(item.total > 0){
                    if(item.status == 'Success'){
                        var amount = item.amount;
                        var badge = '<td class="px-4 py-3 text-sm"><button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 borderborder-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit"><img src="https://img.icons8.com/external-becris-lineal-becris/16/ffffff/external-check-mintab-for-ios-becris-lineal-becris-1.png"/></button></td>';
                        var status = '<td class="px-4 py-3 text-xs"><span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Success</span></td>';
                        var razorpay_id = item.razorpay_payment_id;
                    }else{
                        var amount = item.pending_amount;
                        var badge = '<td class="px-4 py-3 text-sm"><button re-id="'+item.id+'" amount="'+item.pending_amount+'" orderId="'+item.razorpay_order_id+'" class="repay-btn flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 borderborder-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit"><img src="https://img.icons8.com/external-tal-revivo-bold-tal-revivo/16/ffffff/external-redo-loop-clockwise-round-arrow-isolated-on-white-background-text-bold-tal-revivo.png"/></button></td>';
                        var status = '<td class="px-4 py-3 text-xs"><span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">Pending</span></td>';
                        var razorpay_id = item.razorpay_order_id;
                    }
                    var Tbody = '<tr class="text-gray-700 dark:text-gray-400"><td class="px-4 py-3"><div class="flex items-center text-sm"><div class="relative hidden w-8 h-8 mr-3 rounded-full md:block"><img src="https://img.icons8.com/external-kiranshastry-lineal-color-kiranshastry/64/000000/external-wallet-business-kiranshastry-lineal-color-kiranshastry.png"/><div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div><div><p class="font-semibold">Payment Added</p><p class="text-xs text-gray-600 dark:text-gray-400">'+razorpay_id+'</p></div></div></td><td class="px-4 py-3 text-sm">₹ '+amount+'</td>'+status+'<td class="px-4 py-3 text-sm">'+item.create_date+'</td>'+badge+'</tr>';
                    $('.payment-histroy').append(Tbody);
               }else{
                   var Tbody = 'No data found';
                   $('.payment-histroy').append(Tbody);
               }
           });
       }
   });
});


$(document).ready(function(){
    $.ajax({
        url: 'modules/payment/code/payment-code.php',
        type: 'POST',
        data:{action: 'fetch_total_amount', id: <?php echo $_SESSION['user_id']; ?>},
        dataType: 'json',
        success:function(res){
            $('.total-deposit').text('₹ '+res.total_deposit);
            $('.available-balance').text('₹ '+res.balance);
            $('.pending-balance').text('₹ '+res.pending_balance);
            $('.spand-amount').text('₹ '+res.spand_amount)
        }
    });
});


$(document).on('click', '.repay-btn', function(){
    //alert($(this).attr('amount'));
    $('#repay-amount').attr('value',$(this).attr('amount'));
    $('#repay-id').attr('value',$(this).attr('re-id'));
    $('#orderId').attr('value',$(this).attr('orderId'));
    $('#submit').click();
});

</script>