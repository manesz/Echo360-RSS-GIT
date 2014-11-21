<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
?>

    <div style="clear: both;"></div>
    <div class="container-fluid">
    <div class="row">
    <?php include_once("sidebar.php"); ?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <h1 class="page-header"> Sponsor Call Free Data:</h1>

    <div id="offerAchievedPerDay" class="" style="width: 100%;"></div><div class="clearfix"></div>

    <div class="table-responsive">

        <div class="resultReloading" style="margin-bottom: 30px; ">...</div>

        <form id="" name="" action="https://203.170.230.170/smsgw/freebie/freebie_forward.php" method="get">
            <div class="form-group">
                <label for="inputMobileNumber">Mobile Number</label>
                <input type="text" class="form-control" id="MSISDN" name="MSISDN" value="66846727423">
            </div>

            <input type="hidden" name="action" value="sponsor"/>
            <input type="hidden" name="CMD" value="CREATEPACK"/>
<!--            <input type="hidden" name="MSISDN" value="66846727423"/>-->
            <input type="hidden" name="BEARER" value="WEB"/>
            <input type="hidden" name="ACCESS_NUM" value="*ECHO"/>
            <input type="hidden" name="PACK_ID" value="1"/>
            <button type="submit" id="" name="" class="btn btn-success btn-lg col-lg-4" data-toggle="modal" data-target="#loading-image" style="float: right;">Submit</button>
            <button type="reset" class="" style="color: #333; float: right; border: none; background: none; padding: 15px 30px;">reset</button>
        </form>
        <div class="clearfix" style="margin-bottom: 20px;"></div>

        <div class="panel-group" id="accordion">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            Input Mobile Number : <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <form id="sponsorFreeData" name="sponsorFreeData">
                            <div class="form-group">
                                <label for="inputMobileNumber">Mobile Number</label>
<!--                                <input type="text" class="form-control" id="inputMobileNumber" name="inputMobileNumber" value="">-->
                            </div>

<!--                            <input type="hidden" name="action" value="sponsor"/>-->
                            <input type="hidden" name="CMD" value="CREATEPACK"/>
                            <input type="hidden" name="MSISDN" value="66846727423"/>
                            <input type="hidden" name="BEARER" value="WEB"/>
                            <input type="hidden" name="ACCESS_NUM" value="*ECHO"/>
                            <input type="hidden" name="PACK_ID" value="1"/>
                            <button type="button" id="submitSponsorFreeData" name="submitSponsorFreeData" class="btn btn-success btn-lg col-lg-4" data-toggle="modal" data-target="#loading-image" style="float: right;">Submit</button>
                            <button type="reset" class="" style="color: #333; float: right; border: none; background: none; padding: 15px 30px;">reset</button>
                        </form>

                    </div>
                </div>
            </div><!-- END: collapse1 -->

        </div><!-- END: .panel-group -->

    </div><!-- END: table-responsive -->

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
                    <div class="resultReloading">...</div>
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

            $('#imgLoad').hide();
            $('#imgSuccess').hide();
            $('#imgError').hide();
            $('#loading-image').hide();

            $('#submitSponsorFreeData').click(function(){
//                $('#loading-image').show();

//                var url = 'https://203.170.230.170/smsgw/freebie/freebie_forward.php?CMD=CREATEPACK&MSISDN=660846727423&BEARER=WEB&ACCESS_NUM=*ECHO&PACK_ID=1';
//                var url = 'https://203.170.230.170/smsgw/freebie/freebie_forward.php';
                var url = 'functions.php';
                var frm = $("#sponsorFreeData");
                var data = frm.serializeArray();

                $.ajax({
                    type: "GET"
                    , url: url
                    , data: data
                    , dataType: "text"
                    , success: function(data){
                        $('.resultReloading').html(data);
                        alert('Success');
                    }
                    ,error: function(ts) { alert(ts.responseText) }
                    , complete: function(){
                        alert('Complete');
                        //location.reload(); $('#loading-image').hide(); $('.modal-backdrop').hide();
                    }
                });
            });
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

            $(function(){
                setInterval(function(){ // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
                    // 1 วินาที่ เท่า 1000
                    // คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 3 วินาที
                    var getData=$.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
                        url:"offer_profile_report_imp_feed.php"
                        , data:"rev=1"
                        , async:false
                        , success:function(getData){
                            $("div#showData").html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง
                        }
                    }).responseText;
                },1000);
            });
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