<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/quota.class.php"); ?>
<div></div>
<?php
$classQuota = new quotaClass();

$quotaOpportunityListAll = $classQuota->getQuotaListAll();
$quotaOpportunityListWithDate = $classQuota->getQuotaListAll(null, date("Y-m-d",strtotime("yesterday")), date("Y-m-d"));

$quotaOpportunityAC = array_filter($quotaOpportunityListWithDate, function ($item) { return $item[0] == 'AC'; });
$quotaOpportunityACD = array_filter($quotaOpportunityListWithDate, function ($item) { return $item[0] == 'ACD'; });
$quotaOpportunityIA = array_filter($quotaOpportunityListWithDate, function ($item) { return $item[0] == 'IA'; });

$totalQuotaAC = array_sum(array_map(function($item) { return $item[2]; }, $quotaOpportunityAC));
$totalQuotaACD = array_sum(array_map(function($item) { return $item[2]; }, $quotaOpportunityACD));
$totalQuotaIA = array_sum(array_map(function($item) { return $item[2]; }, $quotaOpportunityIA));

?>

    <div style="clear: both;"></div>
    <div class="container-fluid" style="margin-bottom: 50px;">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header"> Used Opportunity : </h1>

                <div class="col-md-3 text-center" style="min-height: 200px;">
                    <span>Quota of AC today<br/></span>
                    <h2><?php echo number_format($totalQuotaAC); ?></h2>
                </div>
                <div class="col-md-3 text-center" style="min-height: 200px;">
                    <span>Quota of ACD today<br/></span>
                    <h2><?php echo number_format($totalQuotaACD); ?></h2>
                </div>
                <div class="col-md-3 text-center" style="min-height: 200px;">
                    <span>Quota of IA today<br/></span>
                    <h2><?php echo number_format($totalQuotaIA); ?></h2>
                </div>
                <div class="col-md-3 text-center" style="min-height: 200px;">
                    <span style="text-decoration: underline;"><strong>Total quota today</strong><br/></span>
                    <h2><?php echo number_format($totalQuotaAC+$totalQuotaACD+$totalQuotaIA); ?></h2>
                </div>

                <?php// var_dump($quotaOpportunityListAll); ?>

                <div id="accountStatusGraph" class="col-md-12" style=""></div>
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
            </div><!-- END: container -->
        </div>
    </div>

    <script>

        $(document).ready(function(){

            $('#tblQuotaOpportunity').dataTable( {
                "order": [[ 0, "desc" ], [1, "asc"]]
            } );

        });

    </script>

    <!--$getAccountWithStatusAC = $accountClass->getAccountWithStatus(2, 'AC');-->
    <!--$getAccountWithStatusACD = $accountClass->getAccountWithStatus(2, 'ACD');-->
    <!--$getAccountWithStatusAP = $accountClass->getAccountWithStatus(2, 'AP');-->
    <!--$getAccountWithStatusHS = $accountClass->getAccountWithStatus(2, 'HS');-->
    <!--$getAccountWithStatusIA = $accountClass->getAccountWithStatus(2, 'IA');-->
    <!--$getAccountWithStatusPTUU = $accountClass->getAccountWithStatus(2, 'PTUU');-->
<?php include_once("footer.php"); ?>