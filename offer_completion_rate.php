<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
    include_once("libs/class/connection.class.php");
    include_once("libs/class/offer.class.php");
    $connClass = new connectionClass();
    $offerClass = new offerClass();

    $resultCompletionRate = $offerClass->getOfferCompletionLate();
?>

    <script>
        $(document).ready(function() {
            $('#CompleteationRate').dataTable( {
                "order": [[ 5, "desc" ], [6, "desc"]]
            } );
        } );
    </script>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Offer Completion Rate:</h1>

                <?php
                if(@$_GET['success']){
                    echo '<div class="alert alert-success" role="alert" style="text-align: center;">'.$_GET['success'].'</div>';
                } else if (@$_GET['alert']) {
                    echo '<div class="alert alert-danger" role="alert" style="text-align: center;">'.$_GET['alert'].'</div>';
                }//END: if
                ?>

                <div class="table-responsive">
                    <table id="CompleteationRate" class="table table-striped">
                        <thead>
                        <tr>
                            <th style="width: 10%;">Offer code</th>
                            <th style="width: 40%;">Name</th>
                            <th style="width: 10%;">Type</th>
                            <th style="width: 10%;">Limit</th>
                            <th style="width: 10%;">Used</th>
                            <th style="width: 5%;">Flag</th>
                            <th style="width: 5%;">Rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($resultCompletionRate as $key=>$value){?>
                            <tr>
                                <td><?php echo $value['offerCode']; ?></td>
                                <td><?php echo $value['Name']; ?></td>
                                <td><?php echo $value['Type']; ?></td>
                                <td><?php echo number_format($value['Limit']); ?></td>
                                <td><?php echo number_format($value['Used']); ?></td>
                                <td>
                                    <?php
                                        if($value['Rate'] == 0): echo "<span style='color: red;'>Close</span>";
                                        elseif($value['Rate'] == 1): echo "<span style='color: #008000;'>Open</span>"; endif;
                                    ?>
                                </td>
                                <td
                                    <?php
                                        if($value['Flag'] <= 50): echo "style='background: #FFF'";
                                        elseif($value['Flag'] <= 75): echo "style='background: #FFFF66'";
                                        elseif($value['Flag'] <= 90): echo "style='background: #FFCC00'";
                                        elseif($value['Flag'] <= 99): echo "style='background: #FF9900'";
                                        elseif($value['Flag'] > 99): echo "style='background: #E3493B'";
                                        endif;
                                    ?>
                                ><?php echo $value['Flag'].' %'; ?></td>
                            </tr>
                        <?php }//END: foreach($getAllUser)?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include_once("footer.php"); ?>