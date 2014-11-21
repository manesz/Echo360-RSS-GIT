<?php set_time_limit ( -1 ); ?>
<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/account.class.php"); ?>

<?php
$accountClass = new accountClass();
$arrAccountListAll = $accountClass->getAccountListAll();
?>

    <div style="clear: both;"></div>
    <div class="container-fluid" style="margin-bottom: 50px;">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <!--        <div class="col-lg-12 main">-->
                <h1 class="page-header">
                    Account List :
                </h1>

                <table id="tblAccountList" class="table table-bordered">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Account No</td>
                            <td>Name</td>
                            <td>Gender</td>
                            <td>Income</td>
                            <td>Occupation</td>
                            <td>Education</td>
                            <td>Marital Status</td>
                            <td>Age</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($arrAccountListAll as $key=>$value):
                    ?>
                        <tr>
                            <td><?php echo $value[0]; ?></td>
                            <td><?php echo $value[1]; ?></td>
                            <td><?php echo $value[4].' - '.$value[5]; ?></td>
                            <td><?php echo $value[9]; ?></td>
                            <td><?php echo $value[11]; ?></td>
                            <td><?php echo $value[12]; ?></td>
                            <td><?php echo $value[13]; ?></td>
                            <td><?php echo $value[14]; ?></td>
                            <td><?php echo date('Y')-$value[8]; ?></td>
                            <td>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
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

            $('#tblAccountList').dataTable();
        });

    </script>
<?php include_once("footer.php"); ?>