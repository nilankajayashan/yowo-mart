<h1>My Account</h1>
<div class="row mt-3 mb-3">
    <div class="col-lg-6">
        <h6>Orders</h6>
        <canvas id="orderStatusChart" width="400" height="400"></canvas>
    </div>
    <div class="col-lg-6">
        <h6>Payments</h6>
        <canvas id="paymentStatusChart" width="400" height="400"></canvas>
    </div>
</div>
        <canvas id="yearOrderChart" class="bg-success mt-0" width="1000" height="0"></canvas>

<?php
function getColor($class){
    switch ($class){
        case 'btn-primary':
            return '#1266F1';
            break;
        case 'btn-secondary':
            return '#B23CFD';
            break;
        case 'btn-danger':
            return '#F93154';
            break;
        case 'btn-warning':
            return '#FFA900';
            break;
        case 'btn-info':
            return '#39C0ED';
            break;
        case 'btn-success':
            return '#00B74A';
            break;
        case 'btn-light':
            return '#FBFBFB';
            break;
        case 'btn-dark':
            return '#262626';
            break;
        default:
            return '#FFA900';
            break;
    }
    return '#FFA900';
}
?>
<?php
$pending = 0;
$processing = 0;
$processed = 0;
$shipped = 0;
$completed = 0;
$failed = 0;
?>
@foreach($orders as $order)
    @switch(lcfirst($order->order_status))
        @case('pending')
        <?php $pending++; ?>
        @break
        @case('processing')
        <?php $processing++; ?>
        @break
        @case('processed')
        <?php $processed++; ?>
        @break
        @case('shipped')
        <?php $shipped++; ?>
        @break
        @case('completed')
        <?php $completed++; ?>
        @break
        @case('failed')
        <?php $failed++; ?>
        @break
    @endswitch
@endforeach

<script>
    const ctx1 = document.getElementById('orderStatusChart');
    const orderStatusChart = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Pending','Processing','Processed','Shipped','Completed','Failed'],
            datasets: [{
                label: 'Orders',
                data: [
                    <?php echo $pending; ?>,
                    <?php echo $processing; ?>,
                    <?php echo $processed; ?>,
                    <?php echo $shipped; ?>,
                    <?php echo $completed; ?>,
                    <?php echo $failed; ?>,
                ],
                backgroundColor: [
                    <?php  echo isset($pending_status_color)?"'".getColor($pending_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($processing_status_color)?"'".getColor($processing_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($processed_status_color)?"'".getColor($processed_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($shipped_status_color)?"'".getColor($shipped_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($completed_status_color)?"'".getColor($completed_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($failed_status_color)?"'".getColor($failed_status_color)."'":'#FFA900' ?>,
                ],
                hoverOffset: 4
            }]
        }
    });
</script>

<?php
$pending = 0;
$success = 0;
$failed = 0;
?>
@foreach($orders as $order)
    @switch(lcfirst($order->payment_status))
        @case('success')
        <?php $success++; ?>
        @break
        @case('pending')
        <?php $pending++; ?>
        @break
        @case('failed')
        <?php $failed++; ?>
        @break
    @endswitch
@endforeach
<script>
    const ctx2 = document.getElementById('paymentStatusChart');
    const paymentStatusChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: [
                'Pending',
                'Success',
                'Failed',
            ],
            datasets: [{
                label: 'Payments',
                data: [
                    <?php echo $pending; ?>,
                    <?php echo $success; ?>,
                    <?php echo $failed; ?>,
                ],
                backgroundColor: [
                    <?php  echo isset($pending_status_color)?"'".getColor($pending_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($success_status_color)?"'".getColor($success_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($failed_status_color)?"'".getColor($failed_status_color)."'":'#FFA900' ?>,
                ],
                hoverOffset: 4
            }]
        }
    });
</script>



<?php
$january = 0;
$february = 0;
$march = 0;
$april = 0;
$may = 0;
$june = 0;
$july = 0;
$august = 0;
$september = 0;
$october = 0;
$november = 0;
$december = 0;
?>
@foreach($orders as $order)
    @switch(lcfirst(date_format($order->created_at, 'm')))
        @case('01')
        <?php $january++; ?>
        @break
        @case('02')
        <?php $february++; ?>
        @break
        @case('03')
        <?php $march++; ?>
        @break
        @case('04')
        <?php $april++; ?>
        @break
        @case('05')
        <?php $may++; ?>
        @break
        @case('06')
        <?php $june++; ?>
        @break
        @case('07')
        <?php $july++; ?>
        @break
        @case('08')
        <?php $august++; ?>
        @break
        @case('09')
        <?php $september++; ?>
        @break
        @case('10')
        <?php $october++; ?>
        @break
        @case('11')
        <?php $november++; ?>
        @break
        @case('12')
        <?php $december++; ?>
        @break
    @endswitch
@endforeach
<div class="d-flex justify-content-center">
    <div class="w-100 p-5 text-center">
        <h5>{{  date("Y") }}&nbsp;Orders</h5>
        <canvas id="orderYearChart" width="1000" height="500"></canvas>
    </div>
</div>
<script>
    const ctx3 = document.getElementById('orderYearChart').getContext('2d');
    const myChart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ],
            datasets: [{
                label: 'Year Orders',
                data: [
                    <?php echo $january; ?>,
                    <?php echo $february; ?>,
                    <?php echo $march; ?>,
                    <?php echo $april; ?>,
                    <?php echo $may; ?>,
                    <?php echo $june; ?>,
                    <?php echo $july; ?>,
                    <?php echo $august; ?>,
                    <?php echo $september; ?>,
                    <?php echo $october; ?>,
                    <?php echo $november; ?>,
                    <?php echo $december; ?>,
                ],
                fill: false,
                borderColor: '#ffc107',
                tension: 0.1
            }]
        },
        options: {
            transitions: {
                show: {
                    animations: {
                        x: {
                            from: 0
                        },
                        y: {
                            from: 0
                        }
                    }
                },
                hide: {
                    animations: {
                        x: {
                            to: 0
                        },
                        y: {
                            to: 0
                        }
                    }
                }
            }
        }

    });
</script>

