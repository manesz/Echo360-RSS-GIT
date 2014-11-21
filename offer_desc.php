<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/connection.class.php"); ?>
<?php include_once("libs/class/offer.class.php"); ?>
<h1>Offer Description</h1>
<?php
$offerCode = @$_GET['id'];
$startDatePicker = @$_POST['startDatePicker'];
$currentDate = @$_GET['date'];
$last7Day = date('Y-m-d',strtotime("-7 day"));

if( !empty($startDatePicker) ): $date = $startDatePicker; else: $date = $currentDate; endif;

$dbConnection = new connectionClass();
$offerClass = new offerClass();

$getOfferImpToDay = $offerClass->getOfferHoursImp($offerCode, $date);

foreach( $getOfferImpToDay as $key=>$value ): $arrXaxisCategories[] = $value['Times']; endforeach;
foreach( $getOfferImpToDay as $key=>$value ): $arrXaxisImp[] = $value['Imp']; endforeach;
foreach( $getOfferImpToDay as $key=>$value ): $arrXaxisTotalImp[] = $value['Total']; endforeach;

//var_dump($getOfferImpToDay);
?>

    <div style="clear: both;"></div>
    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">
                    Impression of Offer : <?php echo $offerCode; ?>
                    <span style="float: right ;font-size: 12px; padding-top: 10px;">
                        <form action="offer_desc.php?id=<?php echo $offerCode; ?>&date=<?php echo $date; ?>" method="post">
                            Date : <input type="text" id="startDatePicker" name="startDatePicker" placeholder="click to show datepicker" style="padding: 7px;" value="<?php echo $date; ?>">
                            <input type="submit" class="btn btn-primary" value="choose"/>
                        </form>
    <!--                    END Date : <input type="text" placeholder="click to show datepicker" id="endDatePicker" style="padding: 5px;" value="--><?php //echo date('Y-m-d'); ?><!--">-->
                    </span>
                </h1>
                <?php if(!empty($getOfferImpToDay)):?>
                <div id="offerImpToDay" class="col-lg-12" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Hours</th>
                            <th>Imp</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($getOfferImpToDay as $key=>$value){ ?>
                            <tr>
                                <td><?php if(intval($value["Times"]) < 10){ echo '0'.$value["Times"].':00'; } else {echo $value["Times"].':00';}?></td>
                                <td><?php echo number_format($value["Imp"], 0, '.', ',');?></td>
                                <td><?php echo number_format($value["Total"], 0, '.', ',');?></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                    <p>No data.</p>
                <?php endif;?>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#offerImpToDay').highcharts({
                title: {
                    text: 'Hours Impression',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Source: <?php echo $date; ?>',
                    x: -20
                },
                xAxis: {
                    categories: [<?php echo join($arrXaxisCategories, ',')?>]
                },
                yAxis: [{ // Primary yAxis
                    title: {
                        text: 'hours impression',
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
                        text: 'cumulative impression',
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
                    name: 'Total Imp',
                    type: 'column',
                    yAxis: 1,
                    data: [<?php echo join($arrXaxisTotalImp, ',')?>]
                }, {
                    name: 'Imp',
//                    type: 'spline',
                    data: [<?php echo join($arrXaxisImp, ',')?>]
                }]
            });
        });
    </script>

<?php include_once("footer.php"); ?>