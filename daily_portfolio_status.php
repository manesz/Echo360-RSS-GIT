<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/account.class.php"); ?>
<?php
    $accountClass = new accountClass();
    $getAccountStatusAll = $accountClass->getAccountStatusAll();

    $getAccountWithStatusAC = $accountClass->getAccountWithStatus(2, 'AC');
    $getAccountWithStatusACD = $accountClass->getAccountWithStatus(2, 'ACD');
    $getAccountWithStatusAP = $accountClass->getAccountWithStatus(2, 'AP');
    $getAccountWithStatusHS = $accountClass->getAccountWithStatus(2, 'HS');
    $getAccountWithStatusIA = $accountClass->getAccountWithStatus(2, 'IA');
    $getAccountWithStatusPTUU = $accountClass->getAccountWithStatus(2, 'PTUU');

    foreach($getAccountStatusAll as $key=>$value):

        $arrDate[] = explode("-", $value[0]);

        $arrAccountStatus[] = array(
            $arrDate[$key][0] //year
            , $arrDate[$key][1] //month
            , $arrDate[$key][2] //date
            , $value[1] //status title
            , $value[2] //status value
        );

    endforeach;
?>

    <div style="clear: both;"></div>
<div class="container-fluid" style="margin-bottom: 50px;">
    <div class="row">
        <?php include_once("sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">
                Daily Portfolio :
            </h1>

            <div id="accountStatusGraph" class="col-md-12" style=""></div>
            <table id="accountStatus" class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($getAccountStatusAll as $key=>$value):?>
                    <tr>
                        <td><?php echo $value[0]; ?></td>
                        <td><?php echo $value[1]; ?></td>
                        <td><?php echo number_format($value[2]); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- END: container -->
    </div>
</div>

<script>

$(document).ready(function(){

    $('#accountStatus').dataTable( {
        "order": [[ 0, "desc" ], [1, "asc"]]
    } );

    $(function () {
        $('#accountStatusGraph').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Account Status',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: ',
                x: -20
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'date'
                }
            },
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Account Status',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                labels: {
                    //format: '{value}°C',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            }],
            tooltip: {
//                    valueSuffix: ''
                shared: true
            },
            series: [{
                name: 'AC',
                color: '#F1975A',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusAC as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'ACD',
                color: '#C1C1C1',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusACD as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'AP',
                color: '#FFD34C',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusAP as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'HS',
                color: '#6698CA',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusHS as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'IA',
                color: '#2F528F',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusIA as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'PTUU',
                color: '#8DBD6C',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusPTUU as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }]

        });
    });
});

</script>

<!--$getAccountWithStatusAC = $accountClass->getAccountWithStatus(2, 'AC');-->
<!--$getAccountWithStatusACD = $accountClass->getAccountWithStatus(2, 'ACD');-->
<!--$getAccountWithStatusAP = $accountClass->getAccountWithStatus(2, 'AP');-->
<!--$getAccountWithStatusHS = $accountClass->getAccountWithStatus(2, 'HS');-->
<!--$getAccountWithStatusIA = $accountClass->getAccountWithStatus(2, 'IA');-->
<!--$getAccountWithStatusPTUU = $accountClass->getAccountWithStatus(2, 'PTUU');-->
<?php include_once("footer.php"); ?>