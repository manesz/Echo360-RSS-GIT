<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php

    $data = array(
        "target" => array(
            "gender" => array("target : M"),
            "genderAmount" => array(4318),
            "Age" => array("Target : 15+40", "Non-target"),
            "AgeAmount" => array(2749,1569),
            "Income" => array("target : C+D","Non-target : A+B+E+Null","target : C+D","Non-target : A+B+E+Null"),
            "IncomeAmount" => array(1550,1199,1200,369),
            "Location" => array("BKK+","Suburban","UPC","Null"),
            "LocationAmount" => array(400,240,680,230,23,420,504,252,23,420,505,252,32,42,250,45),
            "Active" => array(1,2,3,4,5,6,7,8,9,0,11,12,13,14,15,99),
            "LowActive" => array(1,2,3,4,5,6,7,8,9,0,11,12,13,14,15,98),
            "NonActive" => array(1,2,3,4,5,6,7,8,9,0,11,12,13,14,15,97),
            "ActivationPending" => array(1,2,3,4,5,6,7,8,9,0,11,12,13,14,15,96),
        )/* target */,
        "Non-target" => array(
            "gender" => array("Non-target : F"),
            "genderAmount" => array(4318),
            "Age" => array("Target", "Non-target"),
            "AgeAmount" => array(2749),
            "Income" => array(1569),
            "IncomeAmount" => array(),
            "Location" => array(),
            "LocationAmount" => array(),
            "Active" => array(),
            "LowActive" => array(),
            "NonActive" => array(),
            "ActivationPending" => array(),
        )/* Non-target */,
        "rowSpan" => array(16,16,8,8,4,4,1,1,1,1,1,1)
    );

?>
<style>
    div.checkbox{ margin-left: 20px; }
    .tdActive{
        background: #f1f1f1;
    }
    .table tbody tr td{
        /*vertical-align: middle;*/
    }
    table.gridtable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }
    table.gridtable th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }
    table.gridtable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
    }
</style>

    <div style="clear: both;"></div>
    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">
                    Portfolio target group :
                </h1>

                <form class="searchTargetForm" role="form" action="functions.php" method="post">
                    <div class="form-group col-lg-3">
                        <h4>Gender Target:</h4>
                        <div class="checkbox"><input type="checkbox" name="targetGender[]" > ชาย</div>
                        <div class="checkbox"><input type="checkbox" name="targetGender[]" > หญิง</div>
                    </div>
                    <div class="form-group col-lg-3">
                        <h4>Age Target:</h4>
                        <input class="form-control" type="text" name="targetMinAge" placeholder="เริ่มต้น : 18ปี" style="max-width: 45%; float: left; margin-right: 10px;">
                        <input class="form-control" type="text" name="targetMaxAge" placeholder="สิ้นสุด : 35ปี" style="max-width: 45%; float: left;">
                    </div>
                    <div class="form-group col-lg-3">
                        <h4>Income Target:</h4>
                        <div class="checkbox"><input type="checkbox" name="targetIncome[]" > A : </div>
                        <div class="checkbox"><input type="checkbox" name="targetIncome[]" > B : </div>
                        <div class="checkbox"><input type="checkbox" name="targetIncome[]" > C : </div>
                        <div class="checkbox"><input type="checkbox" name="targetIncome[]" > D : </div>
                        <div class="checkbox"><input type="checkbox" name="targetIncome[]" > E : </div>
                        <div class="checkbox"><input type="checkbox" name="targetIncome[]" > Null : </div>
                    </div>
                    <div class="form-group col-lg-3">
                        <h4>Location Target:</h4>
                        <div class="checkbox"><input type="checkbox" name="targetLocation[]" > BKK+ : </div>
                        <div class="checkbox"><input type="checkbox" name="targetLocation[]" > Suburban : </div>
                        <div class="checkbox"><input type="checkbox" name="targetLocation[]" > UPC : </div>
                        <div class="checkbox"><input type="checkbox" name="targetLocation[]" > Null : </div>
                    </div>
                    <div style="clear: both;"></div>
                    <hr/>
                </form><!-- END: form -->


                <div style="clear: both;"></div>
                <div class="table-responsive">
                    <h4>Portfolio target group</h4>

                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <td>Gender</td>
                                <td>จำนวน</td>
                                <td>Age</td>
                                <td>จำนวน</td>
                                <td>Income</td>
                                <td>จำนวน</td>
                                <td>Location</td>
                                <td>จำนวน</td>
                                <td>No use</td>
                                <td>AC : Low Active</td>
                                <td>AC : Normal</td>
                                <td>AC : High</td>
                                <td>AC : Unusual High</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="16" class="tdActive">M</td>
                                <td rowspan="16" class="tdActive">4,318</td>
                                <td rowspan="8" class="tdActive">15-40</td>
                                <td rowspan="8" class="tdActive">2,749</td>
                                <td rowspan="4" class="tdActive">C+D</td>
                                <td rowspan="4" class="tdActive">1,550</td>
                                <td class="tdActive">BKK+</td>
                                <td class="tdActive">400</td>
                                <td class="tdActive">80</td>
                                <td class="tdActive">56</td>
                                <td class="tdActive">92</td>
                                <td class="tdActive">92</td>
                                <td class="tdActive">172</td>
                            </tr>
                            <tr>
                                <td class="tdActive">Suburban</td>
                                <td class="tdActive">240</td>
                                <td class="tdActive">48</td>
                                <td class="tdActive">34</td>
                                <td class="tdActive">56</td>
                                <td class="tdActive">56</td>
                                <td class="tdActive">102</td>
                            </tr>
                            <tr>
                                <td class="tdActive">UPC</td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive">291</td>
                            </tr>
                            <tr>
                                <td class="tdActive">Null</td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive"></td>
                                <td class="tdActive">98</td>
                            </tr>
                            <tr>
                                <td rowspan="4">Non-target</td>
                                <td rowspan="4">1,199</td>
                                <td>BKK+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>Suburban</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>180</td>
                            </tr>
                            <tr>
                                <td>UPC</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>216</td>
                            </tr>
                            <tr>
                                <td>Null</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>107</td>
                            </tr>
                            <tr>
                                <td rowspan="8">Non-target</td>
                                <td rowspan="8">1,569</td>
                                <td rowspan="4">Target : C+D</td>
                                <td rowspan="4">1,200</td>
                                <td>BKK+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>172</td>
                            </tr>
                            <tr>
                                <td>Suburban</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>102</td>
                            </tr>
                            <tr>
                                <td>UPC</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>291</td>
                            </tr>
                            <tr>
                                <td>Null</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>98</td>
                            </tr>
                            <tr>
                                <td rowspan="4">None-target</td>
                                <td rowspan="4">369</td>
                                <td>BKK+</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>Suburban</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>180</td>
                            </tr>
                            <tr>
                                <td>UPC</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>216</td>
                            </tr>
                            <tr>
                                <td>Null</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>107</td>
                            </tr>
                        </tbody>
                    </table>

<!--                    <table class="table table-bordered table-responsive" style="margin-bottom: 20px;">-->
<!--                        <thead>-->
<!--                            <tr>-->
<!--                                --><?php //foreach($data['target'] as $key=>$Datavalue): ?>
<!--                                <td style="font-size: 12px; ">--><?php //echo $key; ?><!--</td>-->
<!--                                --><?php //; endforeach; ?>
<!--                            </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        --><?php //$x = 0; $y = 0; $ticket = 0; ?>
<!--                        --><?php //for($i=0;$i<=15;$i++):?>
<!--                        <tr>-->
<!--                            --><?php //foreach($data['target'] as $key=>$value): ;?>
<!--                            <td rowspan="--><?php //switch ($x){
//                                        case 0:
//                                            if( $y == 0 || $y == 1 ): echo 16; $ticket = 1; endif;
//                                            break;
//                                        case 1:
//                                            if( $y == 2 ): echo 8; $ticket = 1;  endif;
//                                    }//END: switch case ?>
<!--                            ">-->
<!--                                --><?php
//                                    if(empty($value[$i])):
//                                        $result = $x;echo $x."|".$y;
//                                    else:
//                                        $result = $value[$i];echo $result;echo " - ".$x."|".$y;
//                                    endif;
//                                ?>
<!--                            </td>-->
<!--                            --><?php //$y++;  endforeach;?>
<!--                        </tr>-->
<!--                        --><?php //$x++; endfor;?>
<!---->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                    --><?php //var_dump($data); ?>
                </div>
            </div>
        </div>
    </div>

<?php include_once("footer.php"); ?>