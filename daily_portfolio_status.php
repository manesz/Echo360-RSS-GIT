<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/account.class.php"); ?>
<?php
    $accountClass = new accountClass();
    $getAccountStatusAll = $accountClass->getAccountStatusAll(1);
    $getAccountStatusByMonth = $accountClass->getAccountStatusAll(3);

    $getAccountWithStatusAC = $accountClass->getAccountWithStatus(2, 'AC');
    $getAccountWithStatusACD = $accountClass->getAccountWithStatus(2, 'ACD');
    $getAccountWithStatusAP = $accountClass->getAccountWithStatus(2, 'AP');
    $getAccountWithStatusHS = $accountClass->getAccountWithStatus(2, 'HS');
    $getAccountWithStatusIA = $accountClass->getAccountWithStatus(2, 'IA');
    $getAccountWithStatusPTUU = $accountClass->getAccountWithStatus(2, 'PTUU');

    $getAccountWithStatusByMonthAC = array_filter($getAccountStatusByMonth, function ($item) { return $item[1] == 'AC'; });
    $getAccountWithStatusByMonthACD = array_filter($getAccountStatusByMonth, function ($item) { return $item[1] == 'ACD'; });
    $getAccountWithStatusByMonthAP = array_filter($getAccountStatusByMonth, function ($item) { return $item[1] == 'AP'; });
    $getAccountWithStatusByMonthHS = array_filter($getAccountStatusByMonth, function ($item) { return $item[1] == 'HS'; });
    $getAccountWithStatusByMonthIA = array_filter($getAccountStatusByMonth, function ($item) { return $item[1] == 'IA'; });
    $getAccountWithStatusByMonthPTUU = array_filter($getAccountStatusByMonth, function ($item) { return $item[1] == 'PTUU'; });

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
    foreach($getAccountStatusByMonth as $key=>$value):

        $arrDate[] = explode("-", $value[0]);

        $arrAccountStatusByMonth[] = array(
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

            <div id="accountStatusByMonthGraph" class="col-md-12" style=""></div>
            <div class="clearfix"></div>
            <div class="panel-group" id="accordion">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Quota used description: <i class="indicator glyphicon glyphicon-chevron-up pull-right"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div id="accountStatusGraph" class="col-md-12" style=""></div>
                        </div>
                    </div>
                </div>
            </div>



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
                , width: 950
            },
            title: {
                text: 'Account Status',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: all date',
                x: -20
            },
            xAxis: {
                type: 'datetime',
                /*dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },*/
                title: {
                    text: 'date'
                },
                labels: {
                    overflow: 'justify'
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
            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        enabled: false
                    },
                    pointInterval: 3600000 // one hour
                    //,pointStart: Date.UTC(2009, 9, 6, 0, 0, 0)
                }
            },
            series: [{
                name: 'AC',
                color: '#8DBD6C',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusAC as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'ACD',
                color: '#F6B17F',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusACD as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'AP',
                color: '#82AFF9',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusAP as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'HS',
                color: '#BCBDC1',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusHS as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'IA',
                color: '#666666',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusIA as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'PTUU',
                color: '#555555',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusPTUU as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }]

        });
    });
    $(function () {
        $('#accountStatusByMonthGraph').highcharts({
            chart: {
                type: 'spline'
                , width: 950
            },
            title: {
                text: 'Account Status',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: current month',
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
                color: '#8DBD6C',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusByMonthAC as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'ACD',
                color: '#F6B17F',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusByMonthACD as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'AP',
                color: '#82AFF9',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusByMonthAP as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'HS',
                color: '#BCBDC1',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusByMonthHS as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'IA',
                color: '#666666',
                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusByMonthIA as $key=>$value): $arrDate = explode("-", $value[0]);?>
                    [Date.UTC(<?php echo $arrDate[0].','.($arrDate[1]-1).','.$arrDate[2]?>), <?php echo $value[2]; ?> ],
                    <?php endforeach; ?>
                ]
            }, {
                name: 'PTUU',
                color: '#555555',
//                dashStyle: 'ShortDash',
                data: [
                    <?php foreach($getAccountWithStatusByMonthPTUU as $key=>$value): $arrDate = explode("-", $value[0]);?>
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