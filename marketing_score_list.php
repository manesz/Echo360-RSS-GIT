<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
set_time_limit(-1);
include_once("libs/class/connection.class.php");
include_once("libs/class/offer.class.php");
$offerCode = @$_GET['offerCode'];

$substrOfferCode = substr($offerCode, 5, 9);
if (substr($substrOfferCode, 0, 1) == 0): $substrOfferCode = substr($substrOfferCode, 1, 3);
else: $substrOfferCode = substr($offerCode, 5, 9);
endif;

$offerID = substr($offerCode, 5, 9);
if (substr($offerID, 0, 1) == 0): $offerID = substr($offerID, 1, 3);
    $offerID = $offerID + 1;
else: $offerID = substr($offerCode, 5, 9);
    $offerID = $offerID + 1;
endif;

$offerClass = new offerClass();
$getMarketingScoreList = $offerClass->getOfferMarketingScoreAll();
?>

    <div style="clear: both;"></div>
    <div class="container-fluid">
    <div class="row">
    <?php include_once("sidebar.php"); ?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <h1 class="page-header">  Marketing Score : </h1>

    <div id="offerAchievedPerDay" class="" style="width: 100%;"></div>
    <div class="clearfix"></div>

    <div class="table-responsive">

<!--        --><?php //var_dump($getMarketingScoreList); ?>

        <table id="OfferMarketingScore" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="">Offer Code</th>
                <th width="">Offer Name</th>
                <th width="">Marketing Score</th>
                <th width="">Disable Status</th>
                <th width=""></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!is_null($getMarketingScoreList)):
                $accumImp = 0;
                foreach ($getMarketingScoreList as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value[0]-1; ?></td>
                        <td><?php echo $value[1]; ?></td>
                        <td><?php echo $value[2]; ?></td>
                        <td><?php
                            if($value[3] == 0):
                                echo "<span style='color: green'>Open</span>";
                            elseif($value[3] == 1):
                                echo "<span style='color: red'>Close</span>";
                            else:
                                echo "<span style='color: #333'>N/A</span>";
                            endif;
                            ?></td>
                        <td>
                            <a href="offer_desc.php?id=<?php echo $resultOfferCode = sprintf("%09d", $value[0]-1); ?>&date=<?php echo date('Y-m-d');?>" target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-signal"></span>  </a>
                            <a href="offer_profile.php?offerCode=<?php echo $resultOfferCode = sprintf("%09d", $value[0]-1); ?>" target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-folder-open"></span>  </a>
                        </td>
                    </tr>
                <?php
                }
            //END: foreach
            else: echo "<td colspan='11'>No data.</td>";
            endif;
            ?>
            </tbody>
        </table>

        <div class="resultReloading"></div>

    </div>
    <!-- END: table-responsive -->

    <!-- Button trigger modal -->


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
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- END: #loading-image .modal -->
    </div>
    </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#imgLoad').hide();

            $('#OfferMarketingScore').dataTable( {
                "order": [[ 2, "desc" ]]
            } );

//            $('#submitInsertOfferReport').click(function(){
//                $('#loading-image').show();
//
//                var url = 'functions.php';
//                var frm = $("#insertOfferReport");
//                var data = frm.serializeArray();
//                $.ajax({
//                    type: "POST"
//                    , url: url
//                    , data: data
//                    , dataType: "html"
//                    , success: function(data){ $('.resultReloading').html(data); }
//                    , complete: function(){ location.reload(); $('#loading-image').hide(); $('.modal-backdrop').hide(); }
//                });
//            });
//
//            $('#submitEditMPP').click(function(){
//
//                $('#imgLoad').show();
//
//                var url = 'functions.php';
//                var frm = $("#editMPP");
//                var data = frm.serializeArray();
//                $.ajax({
//                    type: "POST"
//                    , url: url
//                    , data: data
//                    , dataType: "html"
//                    , success: function(data){ $('.resultReloading').html(data); }
//                    , complete: function(){ location.reload(); $('#editOfferReport').hide(); $('.modal-backdrop').hide();  }
//                });
//            });
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
    </script>
<?php include_once("footer.php"); ?>