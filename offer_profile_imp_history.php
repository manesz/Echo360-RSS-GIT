<?php
set_time_limit ( -1 );
include_once("libs/class/connection.class.php");
include_once("libs/class/offer.class.php");
$offerCode = @$_POST['offerCode'];

$substrOfferCode = substr($offerCode, 5,9);
if(substr($substrOfferCode,0,1) == 0): $substrOfferCode = substr($substrOfferCode, 1,3);
else: $substrOfferCode = substr($offerCode, 5,9);
endif;

$offerID = substr($offerCode, 5,9);
if(substr($offerID,0,1) == 0): $offerID = substr($offerID, 1,3); $offerID = $offerID+1;
else: $offerID = substr($offerCode, 5,9); $offerID = $offerID+1;
endif;

$offerClass = new offerClass();
$getOfferImpHistory = $offerClass->getOfferImpHistory($offerCode);
$getOfferUsubImpHistoryDate = $offerClass->getOfferImpUsubHistoryDate($substrOfferCode, 2);

$totalImp = 0;
$totalUsub = 0;
foreach($getOfferImpHistory as $key=>$value):
    $arrOfferImpHistory[] = array(
        $day = $value[0]->format('d')
        , $month = $value[0]->format('m')
        , $year = $value[0]->format('Y')
        , $date = $value[0]->format('Y M d')
        , $imp = $value[2]
        , $totalImp = $totalImp + $value[2]
        , $uSub = $getOfferUsubImpHistoryDate[$key][3]
        , $totalUsub = $totalUsub + $getOfferUsubImpHistoryDate[$key][3]
    );
endforeach;
?>
<div class="col-lg-12"><div id="offerImpHistoryGraph" style="width: 100%; max-width: 1000px; "></div></div>

<div class="col-md-6">
    <h4>Impression History</h4>
    <table id="offerImpHistory" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="200">Date</th>
            <th width="200">Imp</th>
            <th width="200">Total Imp</th>
        </tr>
        </thead>
        <tbody>
        <?php $totalImp = 0; foreach($arrOfferImpHistory as $key=>$value):?>
            <tr>
                <td><?php echo $value[3]; //Date?></td>
                <td><?php echo number_format($value[4]); //Imp?></td>
                <td><?php echo number_format($value[5]); //Total Imp?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-md-6">
    <h4>Unique Reach History</h4>
    <table id="offerImpHistory" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="200">Date</th>
            <th width="200">Imp</th>
            <th width="200">Total Imp</th>
        </tr>
        </thead>
        <tbody>
        <?php $totalImp = 0; foreach($arrOfferImpHistory as $key=>$value):?>
            <tr>
                <td><?php echo $value[3]; //Date?></td>
                <td><?php echo number_format($value[6]); //Imp?></td>
                <td><?php echo number_format($value[7]); //Total Imp?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){

        $('#offerImpHistory').dataTable( {
            'iDisplayLength': 50
            , "order": [[ 0, "desc" ]]
            , aLengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ]

        } );

        $('#offerImpHistoryGraph').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Impression History',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: imp',
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
                    text: 'total impression',
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
                    text: 'impression',
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
                name: 'total impression',
                type: 'column',
                yAxis: 1,
                data: [
                    <?php foreach($arrGetOfferImpHistory as $key => $value):?>
                    [Date.UTC(<?php echo $value[2].','.($value[1]-1).','.$value[0]; ?>), <?php echo $value[5]; ?> ],
                    <?php endforeach; ?>
                ]
            },{
                name: 'impression',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
//                    yAxis: 1,
                data: [
                    <?php foreach($arrGetOfferImpHistory as $key => $value):?>
                    [Date.UTC(<?php echo $value[2].','.($value[1]-1).','.$value[0]; ?>), <?php echo $value[4]; ?> ],
                    <?php endforeach; ?>
                ]
            }]

        });
    });
</script>