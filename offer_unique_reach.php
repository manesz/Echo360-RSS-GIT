<?php include_once("header.php"); ?>
<?php
include_once("libs/class/connection.class.php");
include_once("libs/class/offer.class.php");

$offerClass = new offerClass();
$getOfferReach = $offerClass->getOfferReach(2220);

?>
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
                        <a href="offer_desc.php?id=<?php echo $value["OfferCode"]?>&date=<?php echo $date;?>" target="_blank"  class="btn btn-sm btn-default"><span class="glyphicon glyphicon-signal"></span>  </a>
                        <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-folder-open"></span>  </a>
                    </td>
                </tr>
            <?php }//END: foreach ?>

            </tbody>
        </table>
    </div>
<?php var_dump($getOfferReach); ?>
<?php include_once("footer.php"); ?>