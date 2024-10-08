<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    function explodePie(e) {
        if (typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();

    }

    $(document).ready(function () {
        var yValues = [];
        var totalClicks = 0;
        var Tbody = '';
        var user_id = <?php echo $_SESSION['user_id']; ?>;

        // Show the loader
        $('#loader').show();

        $.ajax({
            // url: 'modules/dashboard/code/dashboard-code.php',
            url: 'listapi.php',
            type: "POST",
            dataType: 'json',
            data: {
                user_id: user_id,
                action: 'fetch-ads-data'
            },
            success: function (res) {
                console.log('success res-',res)
                var i = 0;
                $.each(res, function (index, item) {
                    if (i == 0) {
                        $('.account_balance').text('₹ ' + item.account_balance);
                    }
                    yValues.push({
                        y: item.clicks,
                        name: item.project_name,
                    });
                    totalClicks += parseInt(item.clicks);
                    var date = moment(item.date).format('DD-MM-YYYY');
                    var status = getStatus(item.verify_status);
                    var total_download = item.project_type == 'Mobile App' ? item.clicks * 25 / 100 : 0;

                    Tbody += '<tr class="text-gray-700 dark:text-gray-400">' +
                        '<td class="px-4 py-3"><div class="flex items-center text-sm">' +
                        '<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">' +
                        '<img class="object-cover w-full h-full rounded-full" src="' + item.project_image + '" alt="" loading="lazy" />' +
                        '<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div>' +
                        '<div><p class="font-semibold">' + item.project_name + '</p>' +
                        '<p class="text-xs text-gray-600 dark:text-gray-400">' + item.project_type + '</p></div></div></td>' +
                        '<td class="px-4 py-3 text-sm">₹ ' + parseFloat(item.project_budget).toFixed(2) + '</td>' +
                        '<td class="px-4 py-3 text-sm">' + item.clicks + '</td>' +
                        '<td class="px-4 py-3 text-sm">' + parseInt(total_download) + '</td>' +
                        '<td class="px-4 py-3 text-xs">' + status + '</td>' +
                        '<td class="px-4 py-3 text-sm">' + date + '</td></tr>';
                });

                $('.project_body').append(Tbody);
                $('.clicks').text(totalClicks);

                // Render graph
                renderGraph(yValues);
            },
            complete: function () {
                // Hide the loader
                $('#loader').hide();
            },
            error: function (res) {
                console.log('error res',res)
                // Optionally handle the error here
                alert('An error occurred while fetching data.');
                $('#loader').hide(); // Hide the loader in case of error
            }
        });

        function getStatus(verify_status) {
            if (verify_status == 0) {
                return '<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Approved</span>';
            } else if (verify_status == 1) {
                return '<span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">Pending</span>';
            } else if (verify_status == 2) {
                return '<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Denied</span>';
            } else if (verify_status == 3) {
                return '<span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">Expired</span>';
            }
            return '';
        }

        function renderGraph(yValues) {
            if (yValues.length > 0) {
                $('.chart').append('<div id="chartContainer" style="height: 350px; width: 100%;"></div>');
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Revenue"
                    },
                    legend: {
                        cursor: "pointer",
                        itemclick: explodePie
                    },
                    data: [{
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{name}: <strong>{y}</strong>",
                        indexLabel: "{name} - {y}",
                        dataPoints: yValues
                    }]
                });
                chart.render();
            }
        }
    });


    <?php if (!empty($_SESSION['payment_status'])) { ?>

        $(document).ready(function () {
            $('.payment-verify-btn').click();
        });

        <?php unset($_SESSION['payment_status']);
    } ?>
</script>