<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
include_once("libs/class/connection.class.php");
include_once("libs/class/log.class.php");
$connClass = new connectionClass();
$logClass = new logClass();

$resultGetLogAll = $logClass->getLogAll();
?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Action Log: </h1>

                <div class="table-responsive">

                    <?php// var_dump($resultGetLogAll); ?>

                    <table id="tableLog" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Title</th>
                            <th style="width: 20%;">Description</th>
                            <th style="width: 10%;">Action</th>
                            <th style="width: 20%;">ActionValue</th>
                            <th style="width: 10%;">Datetime</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($resultGetLogAll as $key=>$value){?>
                            <tr>
                                <td><?php echo $key; //number?></td>
                                <td><?php echo $value[0]; //title?></td>
                                <td><?php echo $value[1]; //description?></td>
                                <td><?php echo $value[2]; //action?></td>
                                <td><?php echo $value[3]; //action_value?></td>
                                <td><?php echo date_format($value[4], 'Y M d H:i:s'); //datetime?></td>
                            </tr>
                        <?php $i++; }//END: foreach($getAllUser)?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include_once("footer.php"); ?>