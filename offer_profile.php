<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
    set_time_limit ( -1 );
    include_once("libs/class/connection.class.php");
    include_once("libs/class/offer.class.php");
    $offerCode = @$_GET['offerCode'];

    $substrOfferCode = substr($offerCode, 5,9);
    if(substr($substrOfferCode,0,1) == 0): $substrOfferCode = substr($substrOfferCode, 1,3);
    else: $substrOfferCode = substr($offerCode, 5,9);
    endif;

    $offerID = substr($offerCode, 5,9);
    if(substr($offerID,0,1) == 0): $offerID = substr($offerID, 1,3); $offerID = $offerID+1;
    else: $offerID = substr($offerCode, 5,9); $offerID = $offerID+1;
    endif;

    $offerClass = new offerClass();
    $getOfferReach = $offerClass->getOfferReach($offerCode);
    $getOfferAttibute = $offerClass->getOfferAttibute($offerID);
    $getOfferImp = $offerClass->getOfferReportImp($substrOfferCode, 2);
    $getOfferSubrLimitMpp = $offerClass->getOfferSubrLimitMppAttibute($substrOfferCode);
    $getOfferLimit = $offerClass->getOfferLimitInfo($offerCode);
    $getOfferMarketingScore = $offerClass->getOfferMarketingScoreWithOfferId($offerID);
    $getOfferImpHistory = $offerClass->getOfferImpHistory($offerCode);
    $getOfferUsubImpHistoryDate = $offerClass->getOfferImpUsubHistoryDate($substrOfferCode, 2);

    if(!is_null($getOfferImp)):
        foreach($getOfferImp as $key =>$value):

            $year =  $value[2]->format('Y');
            $month =  $value[2]->format('m');
            $date =  $value[2]->format('d');

            $arrPercentAchievedPerDay[] = array(
                $value[9]*100
                , $value[13]
                , $year
                , $month
                , $date
                , $value[2]->format('Y-m-d')

            );

        endforeach;
    endif;
?>
<style>
    table#offerImp input[type=text]{ width: 80px; }
</style>

    <div style="clear: both;"></div>
    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

                <h1 class="page-header"> Offer Profile: <?php echo $offerCode; ?></h1>

                <div id="offerAchievedPerDay" class="" style="width: 100%;"></div><div class="clearfix"></div>

                <div class="table-responsive">

                    <div class="panel-group" id="accordion">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="offerReportSection" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        Offer Report : <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div id="resultOfferReportSection" class="text-center"><img src="libs/img/ajax-loading.gif"/></div>
                                    <?php //include_once("offer_profile_report_imp_feed.php"); ?>
                                </div>
                            </div>
                        </div><!-- END: collapse1 (Offer Report) -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="offerURImpHistorySection" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                        Offer UR & Imp History : <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse in">
                                <div class="panel-body">

                                    <div id="resultOfferURImpHistory" class="text-center"><img src="libs/img/ajax-loading.gif"/></div>
                                    <?php// include_once("offer_profile_imp_history.php"); ?>

                                </div>
                            </div>
                        </div><!-- END: collapse5 (Offer UR & Imp History)-->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="offerDailyImpSection" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                        Offer Daily Impression : <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse in">
                                <div class="panel-body">

                                    <form id="offerProfieDailyImpForm" class="pull-right">
                                        Date : <input type="text" id="startDatePicker" class="DatePicker" name="startDatePicker" placeholder="click to show datepicker" style="padding: 7px;"">
                                        <button id="submitOfferProfileDailyImpForm" type="button" class="btn btn-default" style="border: none;">Choose Date</button>
                                    </form>
                                    <div class="clearfix"></div>
                                    <div id="resultOfferProfieDailyImpForm" class="text-center"><img id="imgLoading" src="libs/img/ajax-loading.gif"/></div>
<!--                                    --><?php //include_once("offer_profile_limit_attibute.php"); ?>

                                </div>
                            </div>
                        </div><!-- END: collapse6 (Offer daily Impression)-->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="offerMPPSection" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        Offer MPP Attibute : <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse in">
                                <div class="panel-body">

<!--                                    <div id="resultOfferMPP"></div>-->
                                    <?php include_once('offer_profile_mpp_attibute.php'); ?>

                                </div>
                            </div>
                        </div><!-- END: collapse3 (Offer MPP Attibute)-->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="offerLimitSection" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                        Offer Limit Attibute : <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse in">
                                <div class="panel-body">

<!--                                    <div class="resultOfferLimit"></div>-->
                                    <?php include_once("offer_profile_limit_attibute.php"); ?>

                                </div>
                            </div>
                        </div><!-- END: collapse4 (Offer Limit Attibute)-->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="offerAttibuteSection" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        Offer Attibute : <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse in">
                                <div class="panel-body">

<!--                                    <div id="resultOfferAttibute"></div>-->
                                    <?php include_once('offer_profile_attibute.php'); ?>

                                </div>
                            </div>
                        </div><!-- END: collapse2 (Offer Attibute)-->

                    </div><!-- END: .panel-group -->

                </div><!-- END: table-responsive -->

                <!-- Button trigger modal -->


                <!-- Modal -->
                <div id="editOfferReport" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Mpp : <?php echo $offerCode; ?></h4>
                            </div>
                            <div class="modal-body">

                                <form id="editMPP" name="editMPP">
                                    <table id="offerImp" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="">Day</th>
                                            <th width="">Date</th>
                                            <th width="">Target</th>
                                            <th width="">MPP</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!is_null($getOfferImp)):
                                            $accumImp = 0;
                                            foreach($getOfferImp as $key=>$value){
                                                ?>
                                                <tr>
                                                    <td><?php echo $value[12];//Day?></td>
                                                    <td><?php echo date_format($value[2], 'Y M d'); //Date?></td>
                                                    <td><input type="text" name="target[]" value="<?php echo $value[3]; ?>" /></td>
                                                    <td>
                                                        <input type="text" name="mpp[]" value="<?php echo ROUND($value[10], 2); //AVG MPP?>"/>

                                                        <input type="hidden" name="date[]" value="<?php echo date_format($value[2], 'Y-m-d'); //Date?>"/>
                                                        <input type="hidden" name="offerID[]" value="<?php echo $value[0]; ?>"/>
                                                        <input type="hidden" name="offerCode[]" value="<?php echo $substrOfferCode; ?>"/>
                                                        <input type="hidden" name="offerCodeFullString" value="<?php echo $offerCode; ?>"/>
                                                        <input type="hidden" name="offerCodeSubString" value="<?php echo $substrOfferCode; ?>"/>
                                                        <input type="hidden" name="updateScorePerDay" value="<?php echo $getOfferImp[$key][12]; ?>"/>
                                                        <input type="hidden" name="action" value="updateMppOfferReport"/>
                                                    </td>

                                                </tr>
                                            <?php
                                            }//END: foreach
                                        else: echo "<td colspan='11'>No data.</td>";
                                        endif;
                                        ?>
                                        </tbody>
                                    </table>

                                </form>

                                <p style="text-align: center;"><img id="imgLoad" src="libs/img/ajax-loading.gif"/></p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" id="submitEditMPP" name="submitEditMPP" class="btn btn-success col-lg-4" style="float: right;">Submit</button>
                                </div>

                        </div>
                    </div>
                </div><!-- END: #editOfferReport -->

                <!-- Modal -->
                <div id="loading-image" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body" style="text-align: center;">
                                <p>
                                    <img id="imgLoad" src="libs/img/ajax-loading.gif"/>
                                    <img id="imgSuccess" src="libs/img/success.png"/>
                                    <img id="imgError" src="libs/img/error.png"/>
                                </p>
                                <div class="resultReloading"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default col-lg-12" data-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div><!-- END: #loading-image .modal -->
            </div>
        </div>
    </div>

    <?php if(!is_null($getOfferImp)):?>
    <script>

        $(function () {
            $('#offerAchievedPerDay').highcharts({
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
                        text: '% Achieved',
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
                        text: '% per day',
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
                    name: '% Achieved',
                    // Define the data points. All series have a dummy year
                    // of 1970/71 in order to be compared on the same x axis. Note
                    // that in JavaScript, months start at 0 for January, 1 for February etc.
//                    yAxis: 1,
                    data: [
                        <?php foreach($arrPercentAchievedPerDay as $key=>$value): ?>
                        [Date.UTC(<?php echo $value[2].','.$value[3].','.$value[4]; ?>), <?php echo $value[0]; ?> ],
                        <?php endforeach; ?>
                    ]
                }, {
                    name: '% per day',
                    data: [
                        <?php foreach($arrPercentAchievedPerDay as $key=>$value): ?>
                        [Date.UTC(<?php echo $value[2].','.$value[3].','.$value[4]; ?>), <?php echo $value[1]; ?> ],
                        <?php endforeach; ?>
                    ]
                }]

            });
        });

    </script>
    <?php endif; ?>
    <script type="text/javascript">

        $(document).ready(function(){
            $('.DatePicker').datepicker({
                format: "yyyy-mm-dd"
            });
        });

        function toggleChevron(e) {
            $(e.target)
                .prev('.panel-heading')
                .find("i.indicator")
                .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
        }
        $('#collapse1').collapse("hide");
        $('#collapse2').collapse("hide");
        $('#collapse3').collapse("hide");
        $('#collapse4').collapse("hide");
        $('#collapse5').collapse("hide");
        $('#collapse6').collapse("hide");

        $("#offerReportSection").click(function(){
            $("#resultOfferReportSection").load("offer_profile_report_imp_feed.php", { offerCode: '<?php echo @$_GET['offerCode']; ?>' } );
        });
        $("#offerURImpHistorySection").click(function(){
            $("#resultOfferURImpHistory").load("offer_profile_imp_history.php", { offerCode: '<?php echo @$_GET['offerCode']; ?>' });
        });
        $("#offerDailyImpSection").click(function(){
            $('#resultOfferProfieDailyImpForm').html('<img id="imgLoading" src="libs/img/ajax-loading.gif"/>');
            $("#resultOfferProfieDailyImpForm").load("offer_profile_daily_imp.php", { id: '<?php echo @$_GET['offerCode']; ?>', date: '<?php echo date("Y-m-d"); ?>' });
        });
        $('#submitOfferProfileDailyImpForm').click(function(){
            var date = $('#startDatePicker').val();
            $('#resultOfferProfieDailyImpForm').html('<img id="imgLoading" src="libs/img/ajax-loading.gif"/>');
            $("#resultOfferProfieDailyImpForm").load("offer_profile_daily_imp.php", { id: '<?php echo @$_GET['offerCode']; ?>', date: ''+date+'' });
            $('#tableOfferImpToDay').dataTable({
                "iDisplayLength": 24
            });
        });
    </script>

<?php include_once("footer.php"); ?>