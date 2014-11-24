<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/quota.class.php"); ?>

<?php
$classQuota = new quotaClass();

$quotaOpportunityListAll = $classQuota->getQuotaListAll();
$quotaOpportunityByDate = $classQuota->getQuotaByDate();
$quotaOpportunityGroupByDate = $classQuota->getQuotaGroupByDate();
$quotaOpportunityListWithDate = $classQuota->getQuotaListAll(null, date("Y-m-d",strtotime("yesterday")), date("Y-m-d"));

$quotaOpportunityAC = array_filter($quotaOpportunityListWithDate, function ($item) { return $item[0] == 'AC'; });
$quotaOpportunityACD = array_filter($quotaOpportunityListWithDate, function ($item) { return $item[0] == 'ACD'; });
$quotaOpportunityIA = array_filter($quotaOpportunityListWithDate, function ($item) { return $item[0] == 'IA'; });

$totalQuotaAC = array_sum(array_map(function($item) { return $item[2]; }, $quotaOpportunityAC));
$totalQuotaACD = array_sum(array_map(function($item) { return $item[2]; }, $quotaOpportunityACD));
$totalQuotaIA = array_sum(array_map(function($item) { return $item[2]; }, $quotaOpportunityIA));

$arrTotalQuotaAC = array_filter($quotaOpportunityByDate, function ($item) { return $item[1] == 'AC'; });
$arrTotalQuotaACD = array_filter($quotaOpportunityByDate, function ($item) { return $item[1] == 'ACD'; });
$arrTotalQuotaIA = array_filter($quotaOpportunityByDate, function ($item) { return $item[1] == 'IA'; });

?>

    <div style="clear: both;"></div>
    <div class="container-fluid" style="margin-bottom: 50px;">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header"> Quota Used Opportunity : </h1>

                <div id="quotaByDateGraph" class="col-md-12" style=""></div>

                <table id="tblQuotaOpportunityByDate" class="table table-striped table-bordered ">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>AC</th>
                        <th>ACD</th>
                        <th>IA</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($quotaOpportunityGroupByDate as $key=>$value):?>
                        <tr>
                            <td><?php echo $value[0]->format('Y-m-d'); ?></td>
                            <td><?php echo number_format($value[1]); ?></td>
                            <td><?php echo number_format($value[2]); ?></td>
                            <td><?php echo number_format($value[3]); ?></td>
                            <td><?php echo number_format($value[1]+$value[2]+$value[3]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

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
                                <table id="tblQuotaOpportunity" class="table table-striped table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Quota</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($quotaOpportunityListAll as $key=>$value):?>
                                        <tr>
                                            <td><?php echo $value[3]->format('Y-m-d'); ?></td>
                                            <td><?php echo $value[0]; ?></td>
                                            <td><?php echo $value[1]; ?></td>
                                            <td><?php echo number_format($value[2]); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div><!-- END: accordion -->

            </div><!-- END: container -->
        </div>
    </div>

    <style></style>

    <script>

        $(document).ready(function(){

            // DataTable script
            $('#tblQuotaOpportunityByDate').dataTable( {
                "order": [[ 0, "desc" ], [1, "asc"]]
            } );
            $('#tblQuotaOpportunity').dataTable( {
                "order": [[ 0, "desc" ], [1, "asc"]]
            } );

            // Accordion script
            function toggleChevron(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find("i.indicator")
                    .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
            }

            // Highchart script
            $('#quotaByDateGraph').highcharts({
                chart: {
                    type: 'spline'
//                    , width: 950
                },

                plotOptions: {
                    columnrange: {
                        grouping: false,
                        pointPadding: -0.35
                    }
                },
                title: {
                    text: 'Daily Quota Used'
                },
                subtitle: {
                    text: 'log of quota by daily'
                },
                xAxis: {
                    type: 'datetime',
                    dateTimeLabelFormats: { // don't display the dummy year
                        month: '%e. %b',
                        year: '%b'
                    },
                    title: {
                        text: 'Date'
                    }
                },
                yAxis: {
                    title: {
                        text: 'total quota'
                    },
                    min: 0
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
                },
                tooltip: {
                    shared: true
                },
                series: [{
                    name: 'Status: AC',
                    data: [
                        <?php foreach($arrTotalQuotaAC as $key=>$value):?>
                        [Date.UTC(<?php echo $value[0]->format('Y'); ?>,  <?php echo $value[0]->format('m'); ?>, <?php echo $value[0]->format('d'); ?>), <?php echo $value[2]; ?>   ],
                        <?php endforeach; ?>
                    ]
                }, {
                    name: 'Status: ACD',
                    data: [
                        <?php foreach($arrTotalQuotaACD as $key=>$value):?>
                        [Date.UTC(<?php echo $value[0]->format('Y'); ?>,  <?php echo $value[0]->format('m'); ?>, <?php echo $value[0]->format('d'); ?>), <?php echo $value[2]; ?>   ],
                        <?php endforeach; ?>
                    ]
                }, {
                    name: 'Status: IA',
                    data: [
                        <?php foreach($arrTotalQuotaIA as $key=>$value):?>
                        [Date.UTC(<?php echo $value[0]->format('Y'); ?>,  <?php echo $value[0]->format('m'); ?>, <?php echo $value[0]->format('d'); ?>), <?php echo $value[2]; ?>   ],
                        <?php endforeach; ?>
                    ]
                }]
            });



        });

    </script>
<?php include_once("footer.php"); ?>