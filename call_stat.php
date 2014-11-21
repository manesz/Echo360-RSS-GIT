<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
include_once("libs/class/connection.class.php");
include_once("libs/class/call.class.php");
$connClass = new connectionClass();
$callClass = new callClass();

$resultViewCallStat = $callClass->getCallStat(30);
?>
<?php foreach($resultViewCallStat as $key=>$value): ?>
<?php $dateStat[] = explode("-", $value[0]); ?>
<?php endforeach; ?>
<?php //var_dump($dateStat);exit(); ?>
<script>
    $(document).ready(function() {
        $('#tableCallStat').dataTable( {
            "order": [[ 0, "desc" ]]
        } );
    } );
</script>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Call Stat:</h1>
                <script>

                    $(function () {
                        $('#callStatImpBconnected').highcharts({
                            chart: {
                                type: 'spline'
                            },
                            title: {
                                text: 'Call Stat : imp to Bconnected',
                                x: -20 //center
                            },
                            subtitle: {
                                text: 'Source: percentage',
                                x: -20
                            },
                            xAxis: {
                                <!--                    type: 'datetime'-->
                                <!--                    categories: [-->
                                <!--                        --><?php
//                            echo join( $arrPercentCallStatCategory , ',');
//                        ?><!--]-->
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
                                    text: '% B connected',
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
                            }, { // Secondary yAxis
                                title: {
                                    text: '% impresstion',
                                    style: {
                                        color: Highcharts.getOptions().colors[0]
                                    }
                                },
                                labels: {
                                    //format: '{value} mm',
                                    style: {
                                        color: Highcharts.getOptions().colors[0]
                                    }
                                },
                                opposite: true
                            }],
                            tooltip: {
//                    valueSuffix: ''
                                shared: true
                            },
                            series: [{
                                name: '%Imp',
                                // Define the data points. All series have a dummy year
                                // of 1970/71 in order to be compared on the same x axis. Note
                                // that in JavaScript, months start at 0 for January, 1 for February etc.
//                    yAxis: 1,
                                data: [
                                    <?php foreach($resultViewCallStat as $key=>$value): ?>
                                    <?php $dateStat = explode("-", $value[0]); ?>
                                    [Date.UTC(
                                        <?php echo $dateStat[0]; ?>,
                                        <?php echo $dateStat[1]-1; ?>
                                        , <?php echo $dateStat[2]; ?>
                                    ), <?php echo ROUND($value[7], 2)*100; ?>   ],
                                    <?php endforeach; ?>
                                ]
                            }, {
                                name: '%Bconnected',
                                data: [
                                    <?php foreach($resultViewCallStat as $key=>$value): ?>
                                    <?php $dateStat = explode("-", $value[0]); ?>
                                    [Date.UTC(
                                        <?php echo $dateStat[0]; ?>,
                                        <?php echo $dateStat[1]-1; ?>
                                        , <?php echo $dateStat[2]; ?>
                                    ), <?php echo ROUND($value[8], 2)*100; ?>   ],
                                    <?php endforeach; ?>
                                ]
                            }]

                        });
                    });

                </script>
                <div id="callStatImpBconnected" class="col-lg-6" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


                <script>

                    $(function () {
                        $('#callStatAvgBehavior').highcharts({
                            chart: {
                                type: 'spline'
                            },
                            title: {
                                text: 'Call Stat : AVG airtime',
                                x: -20 //center
                            },
                            subtitle: {
                                text: 'Source: average',
                                x: -20
                            },
                            xAxis: {
                                <!--                    type: 'datetime'-->
                                <!--                    categories: [-->
                                <!--                        --><?php
//                            echo join( $arrPercentCallStatCategory , ',');
//                        ?><!--]-->
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
                                    text: 'secound',
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
                                name: 'avg call duration',
                                // Define the data points. All series have a dummy year
                                // of 1970/71 in order to be compared on the same x axis. Note
                                // that in JavaScript, months start at 0 for January, 1 for February etc.
//                    yAxis: 1,
                                data: [
                                    <?php foreach($resultViewCallStat as $key=>$value): ?>
                                    <?php $dateStat = $dateStat = explode("-", $value[0]); ?>
                                    [Date.UTC(
                                        <?php echo $dateStat[0]; ?>,
                                        <?php echo $dateStat[1]-1; ?>
                                        , <?php echo $dateStat[2]; ?>
                                    ), <?php echo ROUND($value[9], 2); ?>   ],
                                    <?php endforeach; ?>
                                ]
                            }, {
                                name: 'avg airtime',
                                data: [
                                    <?php foreach($resultViewCallStat as $key=>$value): ?>
                                    <?php $dateStat = $dateStat = explode("-", $value[0]); ?>
                                    [Date.UTC(
                                        <?php echo $dateStat[0]; ?>,
                                        <?php echo $dateStat[1]-1; ?>
                                        , <?php echo $dateStat[2]; ?>
                                    ), <?php echo ROUND($value[10], 2); ?>   ],
                                    <?php endforeach; ?>
                                ]
                            }, {
                                name: 'avg talk time',
                                data: [
                                    <?php foreach($resultViewCallStat as $key=>$value): ?>
                                    <?php $dateStat = $dateStat = explode("-", $value[0]); ?>
                                    [Date.UTC(
                                        <?php echo $dateStat[0]; ?>,
                                        <?php echo $dateStat[1]-1; ?>
                                        , <?php echo $dateStat[2]; ?>
                                    ), <?php echo ROUND($value[11], 2); ?>   ],
                                    <?php endforeach; ?>
                                ]
                            }]

                        });
                    });

                </script>
                <div id="callStatAvgBehavior" class="col-lg-6" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                <?php
                if(@$_GET['success']){
                    echo '<div class="alert alert-success" role="alert" style="text-align: center;">'.$_GET['success'].'</div>';
                } else if (@$_GET['alert']) {
                    echo '<div class="alert alert-danger" role="alert" style="text-align: center;">'.$_GET['alert'].'</div>';
                }//END: if
                ?>

                <div class="table-responsive">
                    <table id="tableCallStat" class="table table-striped">
                        <thead style="font-size: 13px;">
                        <tr>
                            <th style="width: 20%;">Date</th>
                            <th style="width: 5%;">CallIn</th>
                            <th style="width: 5%;">Imp</th>
                            <th style="width: 5%;">BConn.</th>
                            <th style="width: 5%;">CallDurt.</th>
                            <th style="width: 5%;">CallDurt. RoundUp</th>
                            <th style="width: 5%;">TaleTime</th>
                            <th style="width: 10%;">% Imp</th>
                            <th style="width: 5%;">% BConn.</th>
                            <th style="width: 5%;">Avg CallDurt.</th>
                            <th style="width: 5%;">Avg AirTime</th>
                            <th style="width: 5%;">Avg TalkTime</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($resultViewCallStat as $key=>$value){?>
                            <tr>
                                <td><?php echo date("Y M d", strtotime($value[0])); ?></td>
                                <td><?php echo $value[1]; ?></td>
                                <td><?php echo $value[2]; ?></td>
                                <td><?php echo $value[3]; ?></td>
                                <td><?php echo $value[4]; ?></td>
                                <td><?php echo $value[5]; ?></td>
                                <td><?php echo $value[6]; ?></td>
                                <td><?php echo (round($value[7],2)*100).' %'; ?></td>
                                <td><?php echo (round($value[8],2)*100).' %'; ?></td>
                                <td><?php echo round($value[9],2); ?></td>
                                <td><?php echo round($value[10],2); ?></td>
                                <td><?php echo round($value[11],2); ?></td>
                            </tr>
                        <?php }//END: foreach($getAllUser)?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include_once("footer.php"); ?>