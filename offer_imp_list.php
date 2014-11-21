<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/offer.class.php"); ?>

<?php
    $startDatePicker = @$_POST['startDatePicker'];
    $currntDate = date('Y-m-d');
    $last7Day = date('Y-m-d',strtotime("-7 day"));

    if( !empty($startDatePicker) ): $date = $startDatePicker; else: $date = $currntDate; endif;

    $offerClass = new offerClass();
    $getAllOfferHoursImp = $offerClass->getOfferHoursImpAll($date);
    $getOfferImpToDay = $offerClass->getOfferDayImpAll($date);

    foreach( $getAllOfferHoursImp as $key=>$value ): $arrXaxisCategories[] = $value['Times']; endforeach;
    foreach( $getAllOfferHoursImp as $key=>$value ): $arrXaxisImp[] = $value['Imp']; endforeach;
    foreach( $getAllOfferHoursImp as $key=>$value ): $arrXaxisTotalImp[] = $value['Total']; endforeach;
?>


<div style="clear: both;"></div>
<div class="container-fluid">
    <div class="row">
        <?php include_once("sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">
                Impression of Offer
                <span style="float: right ;font-size: 12px; padding-top: 10px;">
                    <form action="offer_imp_list.php" method="post">
                        Date : <input type="text" id="startDatePicker" name="startDatePicker" placeholder="click to show datepicker" style="padding: 7px;" value="<?php echo $date; ?>">
                        <input type="submit" class="btn btn-primary" value="choose"/>
                    </form>
<!--                    END Date : <input type="text" placeholder="click to show datepicker" id="endDatePicker" style="padding: 5px;" value="--><?php //echo date('Y-m-d'); ?><!--">-->
                </span>
            </h1>

            <div id="offerImpToDay" class="col-lg-12" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

            <div class="table-responsive">
                <table id="example" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="20%">Offercode</th>
                        <th width="40%">Name</th>
                        <th width="10%">Imp</th>
                        <th width="20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                       foreach($getOfferImpToDay as $key=>$value){
                    ?>
                    <tr>
                        <td><?php echo $value["id"]?></td>
                        <td><?php echo $value["OfferCode"]?></td>
                        <td><?php echo $value["Name"]?></td>
                        <td><?php echo number_format($value["Imp"], 0, '.', ',');?></td>
                        <td>
                            <a href="offer_desc.php?id=<?php echo $value["OfferCode"]?>&date=<?php echo $date;?>" target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-signal"></span>  </a>
                            <a href="offer_profile.php?offerCode=<?php echo $value["OfferCode"]?>" target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-folder-open"></span>  </a>
                        </td>
                    </tr>
                    <?php }//END: foreach ?>

                    </tbody>
                </table>
            </div>
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