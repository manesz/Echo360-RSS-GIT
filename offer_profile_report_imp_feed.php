<?php
set_time_limit ( -1 );
include_once("libs/class/connection.class.php");
include_once("libs/class/offer.class.php");
$offerCode = @$_REQUEST['offerCode'];

$substrOfferCode = substr($offerCode, 5,9);
if(substr($substrOfferCode,0,1) == 0): $substrOfferCode = substr($substrOfferCode, 1,3);
else: $substrOfferCode = substr($offerCode, 5,9);
endif;

$offerID = substr($offerCode, 5,9);
if(substr($offerID,0,1) == 0): $offerID = substr($offerID, 1,3); $offerID = $offerID+1;
else: $offerID = substr($offerCode, 5,9); $offerID = $offerID+1;
endif;

$offerClass = new offerClass();
//$getOfferReach = $offerClass->getOfferReach($offerCode);
//$getOfferAttibute = $offerClass->getOfferAttibute($offerID);
$getOfferImp = $offerClass->getOfferReportImp($substrOfferCode, 2);
//$getOfferSubrLimitMpp = $offerClass->getOfferSubrLimitMppAttibute($substrOfferCode);
//$getOfferLimit = $offerClass->getOfferLimitInfo($offerCode);
//$getOfferMarketingScore = $offerClass->getOfferMarketingScoreWithOfferId($offerID);
//$getOfferImpHistory = $offerClass->getOfferImpHistory($offerCode);
$getOfferUsubImpHistoryDate = $offerClass->getOfferImpUsubHistoryDate($substrOfferCode, 2);

if(!is_null($getOfferImp)):
    foreach($getOfferImp as $key =>$value):

        $year =  $value[2]->format('Y');
        $month =  $value[2]->format('m');
        $date =  $value[2]->format('d');

        $arrPercentAchievedPerDay[] = array(
            $value[9]*100
        , $value[13]
        , $year
        , $month
        , $date
        , $value[2]->format('Y-m-d')

        );

    endforeach;
endif;

    $reportTotalImp = 0;
    $reportTotalUr = 0;

    $totalUR = 0;
    $totalImp = 0;

    foreach($getOfferUsubImpHistoryDate as $key=>$value):
        $date = $value[0]->format('Y-m-d');

        $arrGetOfferUsubImpHistory[] = array(
            $date // Date
            , $value[3] // Imp
            , $totalImp = $totalImp + $value[3] // Total Imp
            , $value[4] // UR
            , $totalUR = $totalUR + $value[4] // Total UR
        );
    endforeach;

//    foreach($getOfferImpHistory as $key=>$value):
//        $date = $value[0]->format('Y-m-d');
//        $dateTime = $date.' 23:59:59';
//        $accumUR = $offerClass->getOfferAccumUR($substrOfferCode, $dateTime);
//
//        $arrGetOfferImpHistory[] = array(
//            $date
//            , $value[2] // imp
//            , $reportTotalImp = $reportTotalImp + $value[2] // total imp
//            , $accumUR[0] // ur
//            , $reportTotalUr = $reportTotalUr + $accumUR[0] // total ur
////            , $accumBlacklist[2]
//        );
//
//    endforeach;
?>
<div class="row" style="margin-bottom: 20px;">

<input type="button" class="btn btn-sm btn-default col-lg-1 pull-right" value="Delete Row" onclick="deleteRow('offerImp')" style="margin-right: 10px;"/>
<input type="button" class="btn btn-sm btn-primary col-lg-1 pull-right" value="Add Row" onclick="addRow('offerImp')" style="margin-right: 10px;"/>
</div>

<!--<input type="text" class="datePicker"/>-->
<form id="insertFirstOfferReportImp" name="insertFirstOfferReportImp">

    <div class="form-group">
        <label for="scorePerDay">score / day</label>
        <input type="text" class="form-control" id="insertScorePerDay" name="insertScorePerDay" value="4">
    </div>

    <table id="offerImp" name="offerImp" class="table table-striped table-bordered" style="margin-top: 20px;">
        <thead>
            <tr>
                <th width="">#</th>
                <th width="">Date</th>
                <th width="">Target</th>
                <th width="">Imp</th>
                <th width="">Accum Imp</th>
                <th width="">UR</th>
                <th width="">Accum UR</th>
                <th width="">Accum Blacklist</th>
                <th width="">% Achieved</th>
                <th width="">MPP</th>
                <th width="">AVG MPP</th>
                <th width="">Day</th>
                <th width="">% per Day</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!is_null($getOfferImp) && false):
            $accumImp = 0;
            foreach($getOfferImp as $key=>$value){
        ?>
            <tr>
                <td><input type="checkbox" name="chkbox[]"/> </td>
                <td><?php echo date_format($value[2], 'Y M d'); //Date?></td>
                <td><?php echo number_format($value[3]); //Target?></td>
                <td><?php echo number_format($value[4]); //Imp?></td>
                <td><?php echo number_format($value[5]); //Accum Imp?></td>
                <td><?php echo number_format($value[6]); //UR?></td>
                <td><?php echo number_format($value[7]); //Accum UR ?> </td>
                <td><?php echo number_format($value[8]); //Accum Blacklist?> </td>
<!--                    <td>--><?php //echo ROUND($value[9]*100, 2); //% Achieved?><!-- </td>-->
                <td><?php echo ROUND($value[5]/$value[3]*100, 0)." %"; //% Achieved?> </td>
                <td><?php echo ROUND($value[10], 2); //MPP ?> </td>
                <td><?php echo $value[11]; //AVG MPP?> </td>
                <td><?php echo $value[12];//Day?></td>
                <td><?php echo ROUND($value[13], 1);   //% per Day?></td>
            </tr>
        <?php
            }//END: foreach
        elseif (!is_null($getOfferImp) && !is_null($getOfferUsubImpHistoryDate)):
            foreach($arrGetOfferUsubImpHistory as $key=>$value):

                if(isset($getOfferImp[$key][0])): $resultOfferID = $getOfferImp[$key][0]; else: $resultOfferID = NULL; endif;
                if(isset($getOfferImp[$key][3])): $resultTarget = $getOfferImp[$key][3]; else: $resultTarget = 0; endif;
                if(isset($getOfferImp[$key][4])): $resultImp = $getOfferImp[$key][4]; else: $resultImp = 0; endif;
                if(isset($getOfferImp[$key][5])): $resultAccumImp = $getOfferImp[$key][5]; else: $resultAccumImp = 0; endif;
                if(isset($getOfferImp[$key][6])): $resultUR = $getOfferImp[$key][6]; else: $resultUR = 0; endif;
                if(isset($getOfferImp[$key][7])): $resultAccumUR = $getOfferImp[$key][7]; else: $resultAccumUR = 0; endif;
                if(isset($getOfferImp[$key][8])): $resultBlacklist = $getOfferImp[$key][8]; else: $resultBlacklist = 0; endif;
                if(isset($getOfferImp[$key][5]) && isset($getOfferImp[$key][3])): $resultAchieved = ROUND($getOfferImp[$key][5]/$getOfferImp[$key][3]*100, 0)." %"; else: $resultAchieved = 0; endif;
                if(isset($getOfferImp[$key][10])): $resultMPP = ROUND($getOfferImp[$key][10], 2); else: $resultMPP = 0; endif;
                if(isset($getOfferImp[$key][11])): $resultAVGMPP = $getOfferImp[$key][11]; else: $resultAVGMPP = 0; endif;
                if(isset($getOfferImp[$key][12])): $resultDay = $getOfferImp[$key][12]; else: $resultDay = 0; endif;
                if(isset($getOfferImp[$key][13])): $resultPerDay = ROUND($getOfferImp[$key][13], 1); else: $resultPerDay = 0; endif;
        ?>
            <tr>
                <td><input type="checkbox" name="chkbox[]"/> </td>
                <td><input type="text" name="offerReportDate[]" class="datePicker" value="<?php echo $value[0] //Date?>"/></td>
                <td><input type="text" name="offerReportTarget[]" value="<?php echo $resultTarget//Target?>"/></td>
                <td><?php if($resultImp == 0 ): echo number_format($value[1]); else: echo $resultImp; endif; //Imp?></td>
                <td><?php if($resultAccumImp == 0 ): echo number_format($value[2]); else: echo $resultAccumImp; endif; //Accum Imp?></td>
                <td><?php if($resultUR == 0 ): echo number_format($value[3]); else: echo $resultUR; endif; //UR?></td>
                <td><?php if($resultAccumUR == 0 ): echo number_format($value[4]); else: echo $resultAccumUR; endif; //Accum UR ?> </td>
                <td><?php echo $resultAccumUR; //Accum Blacklist?> </td>
                <td><?php echo $resultAchieved; //% Achieved?> </td>
                <td><input type="text" name="offerReportMpp[]" value="<?php echo $resultMPP; //MPP?>"/> </td>
                <td><?php echo $resultAVGMPP; //AVG MPP?> </td>
                <td><?php if($resultDay == 0): echo $key+1; else: echo $resultDay; endif; //Day?></td>
                <td><input type="text" name="offerReportPertPerDay[]" value="<?php if($resultPerDay == 0): echo ($key+1)*4; else: echo $resultPerDay; endif; //% per Day?>"/></td>
            </tr>
                <input type="hidden" name="offerID[]" value="<?php echo $resultOfferID; ?>"/>
        <?php
             endforeach;

        elseif(!is_null($getOfferUsubImpHistoryDate)):
            $totalImp = 0;
//            foreach($arrGetOfferImpHistory as $key=>$value):
            foreach($arrGetOfferUsubImpHistory as $key=>$value):
        ?>
            <tr>
                <td><input type="checkbox" name="chkbox[]"/> </td>
                <td><input type="text" name="offerReportDate[]" class="datePicker" value="<?php echo $value[0] //Date?>"/></td>
                <td><input type="text" name="offerReportTarget[]" value="10000<?php //Target?>"/></td>
                <td><?php echo number_format($value[1]); //Imp?></td>
                <td><?php echo number_format($value[2]); //Accum Imp?></td>
                <td><?php echo number_format($value[3]); //UR?></td>
                <td><?php echo number_format($value[4]); //Accum UR ?> </td>
                <td><?php /*echo number_format($value[5])*/ //Accum Blacklist?> </td>
                <td><?php //% Achieved?> </td>
                <td><input type="text" name="offerReportMpp[]" value="1<?php //MPP?>"/> </td>
                <td><?php //AVG MPP?> </td>
                <td><?php echo $key+1; //Day?></td>
                <td><input type="text" name="offerReportPertPerDay[]" value="<?php echo ($key+1)*4//% per Day?>"/></td>
            </tr>
        <?php
            endforeach;
        else:
        ?>
            <td id='noData' colspan='12' onload="addRow('offerImp')">No data.</td>
        <?php
        endif;
        ?>
        </tbody>
    </table>

    <input type="hidden" name="offerCodeFullString" value="<?php echo $offerCode; ?>"/>
    <input type="hidden" name="offerCodeSubString" value="<?php echo $substrOfferCode; ?>"/>
<!--    --><?php //if(is_null($getOfferImp)): ?>
    <input type="hidden" name="action" value="insertOfferReport"/>
<div class="btn-toolbar" role="toolbar">
<!--    --><?php //if(!is_null($getOfferImp)):?>
<!--        <button class="btn btn-primary col-lg-4 pull-right" data-toggle="modal" data-target="#editOfferReport" style="">-->
<!--            Edit MPP-->
<!--        </button>-->
<!--    --><?php //endif; ?>
    <button type="button" id="submitFirstInsertOfferReport" name="submitFirstInsertOfferReport" class="btn btn-success col-lg-4 pull-right" data-toggle="modal" data-target="#loading-image" style="">Submit</button>
    <button type="reset" class="col-lg-3 btn btn-default pull-right" style="color: #333; border: none; background: none;">reset</button>
<!--    --><?php //endif;?>

</div>
</form>



<div class="resultReloading"></div>

<script language="javascript">

    $(document).ready(function(){
        $('#imgLoad').hide();
        $('#imgSuccess').hide();
        $('#imgError').hide();

        $('#submitFirstInsertOfferReport').click(function(){

            var url = 'functions.php';
            var frm = $("#insertFirstOfferReportImp");
            var data = frm.serializeArray();
            $.ajax({
                type: "POST"
                , url: url
                , data: data
                , dataType: "html"
                , success: function(data){ $('.resultReloading').html(data); }
//                , complete: function(){ /*location.reload();*/ $('#loading-image').modal('hide'); $('.modal-backdrop').hide(); }
            });
        });

        $('#submitInsertOfferReport').click(function(){

            $('#loading-image').show();

            var url = 'functions.php';
            var frm = $("#insertOfferReport");
            var data = frm.serializeArray();
            $.ajax({
                type: "POST"
                , url: url
                , data: data
                , dataType: "html"
                , success: function(data){ $('.resultReloading').html(data); }
//                , complete: function(){ location.reload(); $('#loading-image').hide(); $('.modal-backdrop').hide(); }
            });
        });

        $('#submitEditMPP').click(function(){

            $('#imgLoad').show();

            var url = 'functions.php';
            var frm = $("#editMPP");
            var data = frm.serializeArray();
            $.ajax({
                type: "POST"
                , url: url
                , data: data
                , dataType: "html"
                , success: function(data){ alert('Success'); $('#imgSuccess').show(); $('.resultReloading').html(data); }
                , error: function(){ alert('Error'); $('#imgError').show(); $('.resultReloading').html(data); }
//                , complete: function(){ location.reload(); $('#editOfferReport').hide(); $('.modal-backdrop').hide();  }
            });
        });
    });

    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0); //#
        var elementChkBox = document.createElement("input");
        elementChkBox.type = "checkbox";
        elementChkBox.name="chkbox[]";
        cell1.appendChild(elementChkBox);

        var cell2 = row.insertCell(1); //Date
        var elementTextBoxDatePicker = document.createElement("input");
        elementTextBoxDatePicker.type = "text";
        elementTextBoxDatePicker.name = "offerReportDate[]"
        elementTextBoxDatePicker.className  = "datePicker"
        cell2.appendChild(elementTextBoxDatePicker);
//            cell2.innerHTML = rowCount + 1;

        var cell3 = row.insertCell(2); //Target
        var element2 = document.createElement("input");
        element2.type = "text";
        element2.name = "offerReportTarget[]";
        cell3.appendChild(element2);

        var cell4 = row.insertCell(3); //Imp

        var cell5 = row.insertCell(4); //Accum Imp

        var cell6 = row.insertCell(5); //UR

        var cell7 = row.insertCell(6); //Accum UR

        var cell8 = row.insertCell(7); // Accum Blacklist

        var cell9 = row.insertCell(8); // % Achieved

        var cell10 = row.insertCell(9); //MPP MPP

        var cell11 = row.insertCell(10); //AVG MPP
        var elementTextBoxMpp = document.createElement("input");
        elementTextBoxMpp.type = "text";
        elementTextBoxMpp.name = "offerReportMpp[]"
        elementTextBoxMpp.className  = ""
        cell11.appendChild(elementTextBoxMpp);

        var cell12 = row.insertCell(11); // Day

        var cell13 = row.insertCell(12); // % per Day
        var elementTextBoxPertPerDay = document.createElement("input");
        elementTextBoxPertPerDay.type = "text";
        elementTextBoxPertPerDay.name = "offerReportPertPerDay[]"
        elementTextBoxPertPerDay.className  = ""
        elementTextBoxPertPerDay.value = $('#insertScorePerDay').val()*(rowCount);
        cell13.appendChild(elementTextBoxPertPerDay);

        $('.datePicker').datepicker({
            format: "yyyy-mm-dd"
        });
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
        }catch(e) {
            alert(e);
        }
    }

</script>