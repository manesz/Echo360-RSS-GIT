<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/account.class.php"); ?>

<?php
    $accountClass = new accountClass();
?>

<div style="clear: both;"></div>
<div class="container-fluid" style="margin-bottom: 50px;">
    <div class="row">
        <?php include_once("sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!--        <div class="col-lg-12 main">-->
            <h1 class="page-header">
                Daily Portfolio :
            </h1>

            <div class="panel-group" id="accordion">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                Account Status: <i class="indicator glyphicon glyphicon-chevron-up pull-right"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php include_once('daily_portfolio_status.php'); ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Age: <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php include_once("daily_portfolio_age.php"); ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Gender: <i class="indicator glyphicon glyphicon-chevron-up  pull-right"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php include_once("daily_portfolio_gender.php"); ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Income: <i class="indicator glyphicon glyphicon-chevron-up pull-right"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php include_once("daily_portfolio_income.php"); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
            function toggleChevron(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find("i.indicator")
                    .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
            }
//        $('#accordion').on('hidden.bs.collapse', toggleChevron);
//        $('#accordion').on('shown.bs.collapse', toggleChevron);

            $('#collapse1').collapse("hide");
            $('#collapse2').collapse("hide");
            $('#collapse3').collapse("hide");
            $('#collapse4').collapse("hide");
        });

    </script>
<?php include_once("footer.php"); ?>