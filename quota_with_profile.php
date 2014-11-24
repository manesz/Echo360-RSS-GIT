<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/quota.class.php"); ?>

<?php
$classQuota = new quotaClass();

//$getQuotaWithProfile = $classQuota->getQuotaWithProfile();

?>

    <div style="clear: both;"></div>
    <div class="container-fluid" style="margin-bottom: 50px;">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header"> Quota with profile : </h1>
                <form id="frmProfile" name="frmProfile">
                    <div class="col-md-4">
                        <label for="getLog">Get Log</label><br/>
                        <input id="getLog" name="getLog" type="checkbox"/> choose history data
                        <div id="sectionDate" style="margin-top: 20px;">
                            <label>choose date</label><br/>
                            <input type="text" id="getEndDate" name="getEndDate" class="form-control datePicker pull-right alpha omega" placeholder="end date" style="width: 45%;"/>
                            <input type="text" id="getStartDate" name="getStartDate" class="form-control datePicker pull-right alpha omega" placeholder="start date" style="width: 45%; margin-right: 10px;"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="getStatus">choose status</label><br/>
                        <input id="statusAC" name="getStatus[]" type="checkbox" value="AC"/> AC
                        <input id="statusACD" name="getStatus[]" type="checkbox" value="ACD"/> ACD
                        <input id="statusAP" name="getStatus[]" type="checkbox" value="AP"/> AP
                        <input id="statusIA" name="getStatus[]" type="checkbox" value="IA"/>IA
                        <input id="statusHS" name="getStatus[]" type="checkbox" value="HS"/> HS
                        <input id="statusPTUU" name="getStatus[]" type="checkbox" value="PTUU"/> PTUU
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" name="action" value="query_quota_with_profile"/>
                        <button type="button" id="btnSubmitProfile" name="btnSubmitProfile" class="btn btn-success col-lg-6 pull-right" style="">Submit</button>
                        <button type="reset" class="col-lg-6 btn btn-default pull-right" style="color: #333; border: none; background: none;">reset</button>
                    </div>
                </form>
                <div class="clearfix"></div><hr/>
                <div class="resultReloading"></div>
                <div class="clearfix"></div>

                <?php// var_dump($getQuotaWithProfile); ?>

                <div id="quotaByDateGraph" class="col-md-12" style=""></div>



            </div><!-- END: container -->
        </div>
    </div>

    <style></style>

    <script>

        $(document).ready(function(){

            // DataTable script
            $('#tblQuotaOpportunityByDate').dataTable( {
                "order": [[ 0, "desc" ], [1, "asc"]]
            } );

            // Accordion script
            function toggleChevron(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find("i.indicator")
                    .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
            }

            $('#sectionDate').hide();

            $("#getLog").change(function() {
                if(this.checked) {
                    $('#sectionDate').slideDown(200);//.show();
                    //alert('show');
                }else{
                    $('#sectionDate').slideUp(300);//.hide();
                    //alert('hide');
                }
            });

            // send form
            $('#btnSubmitProfile').click(function(){
                $('.resultReloading').html('<img src="libs/img/loading.gif" style="text-align: center; position: absolute; top: 150%; left: 50%; width: 32px;"/>');
                var url = 'functions.php';
                var frm = $("#frmProfile");
                var data = frm.serializeArray();
                $.ajax({
                    type: "POST"
                    , url: url
                    , data: data
                    , dataType: "html"
                    , success: function(data){ $('.resultReloading').html(data); }
//                    , complete: function(){ /*location.reload();*/ $('#loading-image').modal('hide'); $('.modal-backdrop').hide(); }
                });
            });
        });

    </script>
<?php include_once("footer.php"); ?>