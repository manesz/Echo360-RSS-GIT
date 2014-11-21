<?php
    header("Content-type:text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    include_once("libs/class/connection.class.php");
    include_once("libs/class/call.class.php");
    $connClass = new connectionClass();
    $callClass = new callClass();

    $resultViewCallStat = $callClass->getContactHistory();
?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead style="font-size: 13px;">
        <tr>
            <th style="width: 5%;">#</th>
            <th style="width: 5%;">Customer ID</th>
            <th style="width: 5%;">Offer Code</th>
            <th style="width: 5%;">Event Type</th>
            <th style="width: 5%;">Contact Date</th>
            <th style="width: 5%;">Offer Limit</th>
            <th style="width: 5%;">Subr Limit</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach($resultViewCallStat as $key=>$value){?>
            <tr <?php if($i > 2): echo "style='color: #999;'"; else: echo "style='font-weight: bold;'"; endif; ?>>
                <td><?php echo date($value[0]); ?></td>
                <td><?php echo $value[1]; ?></td>
                <td><?php echo $value[2]; ?></td>
                <td><?php echo $value[3]; ?></td>
                <td><?php echo $value[4]; ?></td>
                <td><?php echo $value[5]; ?></td>
                <td><?php echo $value[6]; ?></td>
            </tr>
        <?php $i++; }//END: foreach($getAllUser)?>
        </tbody>
    </table>
</div>