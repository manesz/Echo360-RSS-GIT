<?php
include_once("header.php");
include_once("navigator.php");
?>

    <style>
        input[type=text],input[type=email],input[type=password],section {
            background: #fafafa !important;
        }
    </style>

    <div style="clear: both;"></div>
    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Update Offer Limit: </h1>

                <form id="updateOfferLimit" name="updateOfferLimit">
                    <div class="form-group">
                        <label for="offerCode">Offer Code</label>
                        <input type="text" class="form-control" id="offerCode" name="offerCode" value="">
                    </div>
                    <div class="form-group">
                        <label for="offerLimit">Offer Limit</label>
                        <input type="text" class="form-control" id="offerLimit" name="offerLimit"  value="">
                    </div>

                    <hr/>
                    <input type="hidden" name="action" value="update_offer_limit"/>
                    <button type="button" id="submitUpdateOfferLimit" name="submitUpdateOfferLimit" class="btn btn-success btn-lg col-lg-4" data-toggle="modal" data-target="#loading-image" style="float: right;">Submit</button>
                    <button type="reset" class="" style="color: #333; float: right; border: none; background: none; padding: 15px 30px;">reset</button>
                </form>

                <div class="clearfix"></div>
                <div class="resultReloading" style=""></div>

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
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div><!-- END: #loading-image .modal -->

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

            $('.modal-footer').hide();
            $('#imgSuccess').hide();
            $('#imgError').hide();

            $('#submitUpdateOfferLimit').click(function(){
                $('#loading-image').show();

                var url = 'functions.php';
                var frm = $("#updateOfferLimit");
                var data = frm.serializeArray();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "html",
                    error: function(data){ $('#imgLoad').hide(); $('#imgError').show(); },
                    success: function(data){ $('.resultReloading').html(data); $('.modal-footer').show();}
//                   , complete: function(){ $('#loading-image').hide(); $('.modal-backdrop').hide(); } // location.reload();
                });

            });//END: $('#submitUpdateOfferLimit').click()
        });
    </script>

<?php include_once("footer.php"); ?>