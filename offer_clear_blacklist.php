<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
    $userId = $_SESSION['user_id'];
    $clearOfferLimit = @$_GET['deleteOfferLimit'];
    $clearOfferSubrLimit = @$_GET['deleteOfferSubrLimit'];
    $clearUACIBlackList = @$_GET['deleteUACIBlackList'];
    $clearUACIDefaultOffers = @$_GET['deleteUACIDefaultOffers'];
?>
<style>
    .has-error .form-control{
        border-color: #a94442;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    }
</style>
    <div style="clear: both;"></div>
    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header"> Clear Blacklist : </h1>

                <?php
                    if(@$_GET['success']){
                        echo '<div class="alert alert-success" role="alert" style="text-align: center;">'.$_GET['success'].'</div>';
                    } else if (@$_GET['alert']) {
                        echo '<div class="alert alert-danger" role="alert" style="text-align: center;">'.$_GET['alert'].'</div>';
                    }//END: if
                ?>

                <form id="defaultForm" action="functions.php" method="post">
                    <div class="form-group">
                        <label for="offerCode">Offer ID</label>
                        <input type="text" class="form-control" id="offerCode" name="offerCode" value="">
                        <span style="color: red; font-size: 10px;">* 000002526</span>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="offerType" id="offerTypeTest" value="test" checked>
                            offer test
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="offerType" id="offerTypeprod" value="prod">
                            offer production
                        </label>
                    </div>
                    <hr/>
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>"/>
                    <input type="hidden" name="action" value="offer_clear_blacklist"/>
                    <button type="submit" class="btn btn-success btn-lg col-lg-4" style="float: right;">Submit</button>
                    <button type="reset" class="" style="color: #333; float: right; border: none; background: none; padding: 15px 30px;">reset</button>
                </form>
                <?php
                    $clearOfferLimit = @$_GET['deleteOfferLimit'];
                    $clearOfferSubrLimit = @$_GET['deleteOfferSubrLimit'];
                    $clearUACIBlackList = @$_GET['deleteUACIBlackList'];
                    $clearUACIDefaultOffers = @$_GET['deleteUACIDefaultOffers'];
                ?>
                <?php if($clearOfferLimit > 0 || $clearOfferSubrLimit > 0 || $clearUACIBlackList > 0 || $clearUACIDefaultOffers > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Clear blacklist</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Amount of Clear Offer Limit:</td>
                                <td><?php echo $clearOfferLimit; ?></td>
                            </tr>
                            <tr>
                                <td>Amount of Clear Subr Offer Limit:</td>
                                <td><?php echo $clearOfferSubrLimit; ?></td>
                            </tr>
                            <tr>
                                <td>Amount of Clear UACI Blacklist:</td>
                                <td><?php echo $clearUACIBlackList; ?></td>
                            </tr>
                            <tr>
                                <td>Amount of Clear UACI DefaultOffer:</td>
                                <td><?php echo $clearUACIDefaultOffers; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>



<?php include_once("footer.php"); ?>