<?php
set_time_limit ( -1 );
session_start();
include_once("libs/class/connection.class.php");
include_once("libs/class/offer.class.php");
include_once("libs/class/user.class.php");
include_once("libs/class/session.class.php");
include_once("libs/class/quota.class.php");
include_once("libs/class/log.class.php");

$dbConnection = new connectionClass();
$userClass = new userClass();
$sessionClass = new sessionClass();
$offerClass = new offerClass();
$logClass = new logClass();

if(@$_POST['action']){
    $action = @$_POST['action'];
} else {
    $action = @$_GET['action'];
}

switch($action){
    case 'signin':
        $username = @$_POST['username'];
        $password = @$_POST['password'];

        if(isset($username) && isset($password)){

            $getRowUserProfile = $userClass->getRowUserProfile($username, $password);

            if(!is_null($getRowUserProfile)):
            $insertUserSession = $sessionClass->insertUserSession(
                $getRowUserProfile[0]
                , $getRowUserProfile[1].'-'.$getRowUserProfile[2]
                ,array($getRowUserProfile[5], $getRowUserProfile[8])
                ,array($getRowUserProfile[6],$getRowUserProfile[9])
                ,array($getRowUserProfile[7],$getRowUserProfile[10])
            );

            if($getRowUserProfile[5] == 1){

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name']
                    , 'Success : sign in RSS'
                    , 'sign in'
                    , 'Management'
                );

                header('Location: dashboard.php?text=Management');
                exit;
            } elseif($getRowUserProfile[5] == 2) {

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name']
                    , 'Success : Sign In'
                    , 'sign in'
                    , 'MIS'
                );

                header('Location: dashboard.php?text=MIS');
                exit;
            } elseif($getRowUserProfile[5] == 3) {

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name']
                    , 'Success : Sign In'
                    , 'sign in'
                    , 'Operation'
                );

                header('Location: dashboard.php?text=Operation');
                exit;
            } elseif($getRowUserProfile[5] == 4) {

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name']
                    , 'Success : Sign In'
                    , 'sign in'
                    , 'Sale'
                );

                header('Location: dashboard.php?text=Sale');
                exit;
            } elseif($getRowUserProfile[5] == 5) {

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name']
                    , 'Success : Sign In'
                    , 'sign in'
                    , 'Administrator'
                );

                header('Location: dashboard.php?text=Administrator');
                exit;
            } else {

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name']
                    , 'Error : username or password invalid.'
                    , 'sign in'
                    , ''
                );

                header('Location: signin.php?alert=ERROR : invalid username or password.');

//                echo $getRowUserProfile[5]."<br/>";
//                echo "error";
            }
            else:
                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name']
                    , 'Error : username or password invalid to signin RSS'
                    , 'sign in'
                    , ''
                );
            endif;
        }//END: if check is value
        break;
    case 'signout':

        $insertLog = $logClass->insertLog(
            @$_SESSION['user_name']
            , 'Success : Sign out'
            , 'sign out'
            , ''
        );

        $signout = $sessionClass->destroySession();

        break;
    case 'user_insert':
        $arrUser = array(
            'userFName'=>@$_POST['userFName'],//userFName
            'userLName'=>@$_POST['userLName'],//userLName
            'userEmail'=>@$_POST['userEmail'],//userEmail
            'userMobile'=>@$_POST['userMobile'],//userMobile
            'userDepartment'=>@$_POST['userDepartment'],//userDepartment
            'userPosition'=>@$_POST['userPosition'],//userPosition
            'userPermission'=>@$_POST['userPermission'],//userPermission
            'userPasswordMd5'=>MD5(@$_POST['userPassword']),//userPasswordMd5
            'userPasswordFull'=>@$_POST['userPassword'],//userPasswordFull
        );
        $result = $userClass->insertUserProfile($arrUser);
        if($result == TRUE){

            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name'] //title
                , 'Success : Insert user' // description
                , 'insert user' //action
                , $arrUser['userFName']
                    .'|'.$arrUser['userLName']
                    .'|'.$arrUser['userEmail']
                    .'|'.$arrUser['userMobile']
                    .'|'.$arrUser['userDepartment']
                    .'|'.$arrUser['userPosition']
                    .'|'.$arrUser['userPermission']
                    .'|'.$arrUser['userPasswordFull']
                //action value
            );

            header('Location: user_list.php?success=SUCCESS : insert new user success');
            exit();
        } else {

            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name'] //title
                , 'Error : Insert user' // description
                , 'insert user' //action
                , $arrUser['userFName']
                .'|'.$arrUser['userLName']
                .'|'.$arrUser['userEmail']
                .'|'.$arrUser['userMobile']
                .'|'.$arrUser['userDepartment']
                .'|'.$arrUser['userPosition']
                .'|'.$arrUser['userPermission']
                .'|'.$arrUser['userPasswordFull']
            //action value
            );

            header('Location: user_list.php?alert=ERROR : can not insert user.');
        }
        break;
    case 'user_update':
        $arrUser = array(
            'userId'=>@$_POST['userId'],//userFName
            'userFName'=>@$_POST['userFName'],//userFName
            'userLName'=>@$_POST['userLName'],//userLName
            'userEmail'=>@$_POST['userEmail'],//userEmail
            'userMobile'=>@$_POST['userMobile'],//userMobile
            'userDepartment'=>@$_POST['userDepartment'],//userDepartment
            'userPosition'=>@$_POST['userPosition'],//userPosition
            'userPermission'=>@$_POST['userPermission'],//userPermission
            'userPasswordMd5'=>MD5(@$_POST['userPassword']),//userPasswordMd5
            'userPasswordFull'=>@$_POST['userPassword'],//userPasswordFull
        );
        $result = $userClass->updateUserProfile($arrUser);
        if(!empty($result)){

            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name'] //title
                , 'Success : Update user' // description
                , 'update user' //action
                , $arrUser['userFName']
                .'|'.$arrUser['userLName']
                .'|'.$arrUser['userEmail']
                .'|'.$arrUser['userMobile']
                .'|'.$arrUser['userDepartment']
                .'|'.$arrUser['userPosition']
                .'|'.$arrUser['userPermission']
                .'|'.$arrUser['userPasswordFull']
            //action value
            );

            header('Location: user_edit.php?id='.@$_POST['userId'].'&success=Update data success.'); exit();
        } else {

            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name'] //title
                , 'Error : Update user' // description
                , 'update user' //action
                , $arrUser['userFName']
                .'|'.$arrUser['userLName']
                .'|'.$arrUser['userEmail']
                .'|'.$arrUser['userMobile']
                .'|'.$arrUser['userDepartment']
                .'|'.$arrUser['userPosition']
                .'|'.$arrUser['userPermission']
                .'|'.$arrUser['userPasswordFull']
            //action value
            );

            header('Location: user_edit.php?id='.@$_POST['userId'].'&alert=Can not update date.'); exit();
        }
        break;
    case 'offer_clear_blacklist':
        $offerCode = @$_POST['offerCode'];
        if(empty($offerCode)):

            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name'] //title
                , 'Error : empty input offer number' // description
                , 'clear blacklist' //action
                , 'Offer code : '.$offerCode//action value
            );

            header('Location: offer_clear_blacklist.php?alert=Please input offer number.');
        else:
            $resultOfferCode = sprintf("%09d", $offerCode);

    //        echo $resultOfferCode;exit();

            if(@$_POST['offerType'] == 'test'):
                $result = $offerClass->getUAOfferTest(''.$resultOfferCode.'');

                if( COUNT($result) > 0 ):

                    $resultDeleteOfferLimit = $offerClass->deleteOfferLimitTest(''.$resultOfferCode.'');
                    $resultDeleteOfferSubrLimit = $offerClass->deleteOfferSubrLimitTest(''.$resultOfferCode.'');
                    $resultDeleteUACIBlackList = $offerClass->deleteUACIBlackListTest(''.$resultOfferCode.'');
                    $resultDeleteUACIDefaultOffers = $offerClass->deleteUACIDefaultOffersTest(''.$resultOfferCode.'');

                endif;

                $resultArray = array($resultDeleteOfferLimit, $resultDeleteOfferSubrLimit, $resultDeleteUACIBlackList, $resultDeleteUACIDefaultOffers);

            elseif(@$_POST['offerType'] == 'prod'):
                $result = $offerClass->getUAOfferProc(''.$resultOfferCode.'');

                if( COUNT($result) > 0 ):

                    $resultDeleteOfferLimit = $offerClass->deleteOfferLimitProc(''.$resultOfferCode.'');
                    $resultDeleteOfferSubrLimit = $offerClass->deleteOfferSubrLimitProc(''.$resultOfferCode.'');
                    $resultDeleteUACIBlackList = $offerClass->deleteUACIBlackListProc(''.$resultOfferCode.'');
                    $resultDeleteUACIDefaultOffers = $offerClass->deleteUACIDefaultOffersProc(''.$resultOfferCode.'');

                endif;

                $resultArray = array($resultDeleteOfferLimit, $resultDeleteOfferSubrLimit, $resultDeleteUACIBlackList, $resultDeleteUACIDefaultOffers);
            endif;

//            var_dump($resultArray);exit();

            if($resultArray[0] == false && $resultArray[1] == false && $resultArray[2] == false && $resultArray[3] == false):

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name'] //title
                    , 'Error : Clear '.@$_POST['offerType'].' Blacklist ' // description
                    , 'clear blacklist' //action
                    , 'Offer code : '.$offerCode //action value
                );

                $resultNotification = "ERROR : Offer (".$resultOfferCode.") can't clear blacklist";
                header('Location: offer_clear_blacklist.php?alert='.$resultNotification
                    .'&deleteOfferLimit='.$resultDeleteOfferLimit
                    .'&deleteOfferSubrLimit='.$resultDeleteOfferSubrLimit
                    .'&deleteUACIBlackList='.$resultDeleteUACIBlackList
                    .'&deleteUACIDefaultOffers='.$resultDeleteUACIDefaultOffers
                );
            else:

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name'] //title
                    , 'Success : Clear '.@$_POST['offerType'].' Blacklist ' // description
                    , 'clear blacklist' //action
                    , 'Offer code : '.$offerCode //action value
                );

                $resultNotification = "SUCCESS : Offer (".$resultOfferCode.") blacklist is cleared";
                header('Location: offer_clear_blacklist.php?success='.$resultNotification
                        .'&deleteOfferLimit='.$resultDeleteOfferLimit
                        .'&deleteOfferSubrLimit='.$resultDeleteOfferSubrLimit
                        .'&deleteUACIBlackList='.$resultDeleteUACIBlackList
                        .'&deleteUACIDefaultOffers='.$resultDeleteUACIDefaultOffers
                    );
            endif;

        endif;
//        var_dump($resultArray);exit();

//        if(COUNT($result) > 0){
//            header('Location: offer_clear_blacklist.php?success='.$resultNotification); exit();
//        } else {
//            header('Location: offer_clear_blacklist.php?alert='.$resultNotification); exit();
//        }
//        $url = 'offer_clear_blacklist.php';
//        $value = '&result=' . $result;
//
//        $ch = curl_init( $url );
//        curl_setopt( $ch, CURLOPT_POST, 1);
//        curl_setopt( $ch, CURLOPT_POSTFIELDS, $value);
//        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt( $ch, CURLOPT_HEADER, 0);
//        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $response = curl_exec( $ch );

        break;
    case 'update_offer_limit':

        $offerCode = @$_POST['offerCode'];
        $offerLimit = @$_POST['offerLimit'];

        $resultUpdateOfferLimit = $offerClass->updateOfferLimit($offerCode, $offerLimit, 1);
        $resultGetOfferLimit = $offerClass->getOfferLimitInfo($offerCode);

        if($resultUpdateOfferLimit == -1):

            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name'] //title
                , 'Error : Can not update data.' // description
                , 'update offer limit' //action
                , 'offer Code : '.$offerCode.' | '.'Limit : '.$offerLimit //action value
            );
            echo "
                <script>
                    $(document).ready(function(){
                        $('#imgLoad').hide();
                        $('#imgSuccess').hide();
                        $('#imgError').show();
                    });
                </script>
            ";
            echo "<div class='alert alert-danger' role='alert'>Update Offer Limit : Can't update data.</div>";
            echo "<table id='offerProfile' class='table table-striped table-bordered'>
                <thead>
                <tr>
                    <th width=''>OfferCode</th>
                    <th width=''>Limit Setup</th>
                    <th width=''>Limit Used</th>
                    <th width=''>Flag</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>".$resultGetOfferLimit[0]."</td>
                    <td>".$resultGetOfferLimit[1]."</td>
                    <td>".$resultGetOfferLimit[2]."</td>
                    <td>".$resultGetOfferLimit[3]."</td>
                </tr>
                </tbody>
            </table>";
        else:
            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name'] //title
                , 'Success : Update data success.' // description
                , 'update offer limit' //action
                , 'offer Code : '.$offerCode.' | '.'Limit : '.$offerLimit //action value
            );
            echo "
                <script>
                    $(document).ready(function(){
                        $('#imgLoad').hide();
                        $('#imgError').hide();
                        $('#imgSuccess').show();
                    });
                </script>
            ";
            echo "<div class='alert alert-success' role='alert'>Update Offer Limit : Success .</div>";
            echo "<table id='offerProfile' class='table table-striped table-bordered'>
                <thead>
                <tr>
                    <th width=''>OfferCode</th>
                    <th width=''>Limit Setup</th>
                    <th width=''>Limit Used</th>
                    <th width=''>Flag</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>".$resultGetOfferLimit[0]."</td>
                    <td>".$resultGetOfferLimit[1]."</td>
                    <td>".$resultGetOfferLimit[2]."</td>
                    <td>".$resultGetOfferLimit[3]."</td>
                </tr>
                </tbody>
            </table>";
        endif;

        break;
    case 'profile_update':
        $profileId = @$_POST['userProfileId'];

        if(empty($profileId)):
            $insertLog = $logClass->insertLog(
                @$_SESSION['user_name']
                , 'Error : empty input profile ID'
                , 'update profile'
                , 'Profile ID : '.$profileId
            );

            header('Location: customer_update_profile.php?alert=Please input account number.');
        else:
            $result = $userClass->updateInterActProfile($profileId);
            if(!empty($result)){

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name'] //title
                    , 'Success : update profile' // description
                    , 'update profile' //action
                    , 'Profile ID : '.$profileId //action value
                );

                header('Location: customer_update_profile.php?accountId='.$profileId.'&success=Update Profile ('.$profileId.') data success.'); exit();
            } else {

                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name'] //title
                    , 'Error : update profile' // description
                    , 'update profile' //action
                    , 'Profile ID : '.$profileId //action value
                );

                header('Location: customer_update_profile.php?accountId='.$profileId.'&alert=Can not update ('.$profileId.') date.'); exit();
            }
        endif;
        break;
    case 'insertOfferReport':

        echo "<h1>Insert Offer Report</h1>";
        $unpublishOffer = @$_POST['offerID'];

        $getScorePerDay = @$_POST['insertScorePerDay'];
        $getofferCodeFullString = @$_POST['offerCodeFullString'];
        $getofferCodeSubString = @$_POST['offerCodeSubString'];
        $getdate = @$_POST['date'];
        $getDateTime = @$_POST['datetime'];
        $offerReportTarget = @$_POST['offerReportTarget'];

        $substrOfferCode = substr($getofferCodeFullString, 5,9);
        if(substr($substrOfferCode,0,1) == 0): $substrOfferCode = substr($substrOfferCode, 1,3);
        else: $substrOfferCode = substr($getofferCodeFullString, 5,9);
        endif;

        $offerID = substr($getofferCodeFullString, 5,9);
        if(substr($offerID,0,1) == 0): $offerID = substr($offerID, 1,3); $offerID = $offerID+1;
        else: $offerID = substr($getofferCodeFullString, 5,9); $offerID = $offerID+1;
        endif;

        $getOfferReach = $offerClass->getOfferReach($getofferCodeFullString);
        $getOfferAttibute = $offerClass->getOfferAttibute($offerID);
        $getOfferImp = $offerClass->getOfferReportImp($substrOfferCode, 1);

        $accumImp = 0;
        $totalAccumUR = 0;
        $totalAccumBlackList = 0;

        foreach($getOfferImp as $key=>$value){

            $accumImp = $accumImp + $value[1];
            $dateTime = date_format($value[0], 'Y-m-d').' 23:59:59';
            $accumUR = $offerClass->getOfferAccumUR($substrOfferCode, $dateTime);
            $resultAchieved = $accumImp/$getOfferAttibute[12][4];
            $resultAvgMpp = $accumImp/$accumUR[0];
            $resultPerCentPerDay = $getScorePerDay*($key+1);

            /*
             * $accumBlacklist : value
             * 0 => object(DateTime)
             * 1 => string(offerCode)
             * 2 => int(impression)
             */
            $accumBlacklist = $offerClass->getOfferAccumBlacklist(date_format($value[0], 'Y-m-d'), $substrOfferCode, ceil($resultAvgMpp));
            $totalAccumUR = $totalAccumUR + $value[2];
            $totalAccumBlackList = $totalAccumBlackList + $accumBlacklist[2];
//
            $arrayReport = array(
                $substrOfferCode // offerCode (0)
                , date_format($value[0], 'Y-m-d') // Date (1)
//                , $getOfferAttibute[12][4] // Target (2)
                , $offerReportTarget[$key] // Target (2)
                , $value[1] // Imp (3)
                , $accumImp // Accum Imp (4)
                , $value[2] // UR (5)
                , $totalAccumUR // Accum UR (6)
//                , $accumUR[0] // Accum UR (6)
                , $totalAccumBlackList // Accum Blacklist (7)
//                , $accumBlacklist['Impression'] // Accum Blacklist (7)
                , $resultAchieved // % Achieved (8)
                , ROUND($resultAvgMpp) // Current MPP (9)
                , $resultAvgMpp // AVG MPP (10)
                , $key+1 // Day (11)
                , $resultPerCentPerDay // % per Day (12)
            );

            $offerClass->insertOfferReportImp($arrayReport, 1);

        }//END: foreach
//-----------------------------------------------  update unpublish offer by offer code to table: [rss_offer_report_imp]
        if(!is_null($unpublishOffer)):
            foreach($unpublishOffer as $key=>$value):
                $offerClass->unpublishOfferReport($value);
//                if(!empty($resultUnPublishOfferReport)):
//                    $insertLog = $logClass->insertLog(
//                        @$_SESSION['user_name'] //title
//                        , 'Success : unpublish offer report by offer code' // description
//                        , 'update mpp offer report' //action
//                        , 'Offer code : '.$loopArray[$key][0].' , ID : '.$value//action values
//                    );
//                endif;
            endforeach;
        endif;

//        $insertLog = $logClass->insertLog(
//            @$_SESSION['user_name'] //title
//            , 'Success : Insert data to offer report' // description
//            , 'insert offer report' //action
//            , $substrOfferCode //offerCode
//            .' | '. date_format($value[0], 'Y-m-d') //Date
//            .' | '. $getOfferAttibute[12][4] //Target
//            .' | '. $value[1] //Imp
//            .' | '. $accumImp //Accum Imp
//            .' | '. $value[2] //UR
//            .' | '. $accumUR[0] //Accum UR
//            .' | '. $accumBlacklist['Impression'] //Accum Blacklist
//            .' | '. $resultAchieved //% Achieved
//            .' | '. $resultAvgMpp //AVG MPP
//            .' | '. $key+1 //Day
//            .' | '. $resultPerCentPerDay //% per Day
//            //action value
//        );

        break;
    case 'updateMppOfferReport':
        echo "<h1>updateMppOfferReport</h1>";

        $getOfferID = $_POST['offerID']; echo '<br/>';
        $getNewTarget = $_POST['target']; echo '<br/>';
        $getNewMppScore = $_POST['mpp']; echo '<br/>';
        $getdate = $_POST['date']; echo '<br/>';
        $getOfferCode = $_POST['offerCode']; echo '<br/>';
        $getofferCodeFullString = @$_POST['offerCodeFullString']; echo '<br/>';
        $getofferCodeSubString = @$_POST['offerCodeSubString']; echo '<br/>';
        $getScorePerDay = @$_POST['updateScorePerDay']; echo '<br/>';

        $totalAccumBlackList = 0;

        foreach(@$_POST['mpp'] as $key=>$value){
            $loopArray[] = array(@$_POST['offerCode'][$key], @$_POST['date'][$key], @$_POST['mpp'][$key], @$_POST['target'][$key]);
        }

        //-----------------------------------------------------  insert new offer record to table: [rss_offer_report_imp]

        $substrOfferCode = substr($getofferCodeFullString, 5,9);


        if(substr($substrOfferCode,0,1) == 0): $substrOfferCode = substr($substrOfferCode, 1,3);
        else: $substrOfferCode = substr($getofferCodeFullString, 5,9);
        endif;

        $getOfferImp = $offerClass->getOfferReportImp($substrOfferCode, 2);
        foreach($getOfferImp as $key=>$value):

            /*
             * $accumBlacklist : value
             * 0 => object(DateTime)
             * 1 => string(offerCode)
             * 2 => int(impression)
             */
            $accumBlacklist = $offerClass->getOfferAccumBlacklist(
                $loopArray[$key][1] // date_format( , 'Y-m-d')
                , $loopArray[$key][0]
                , ceil($loopArray[$key][2])
            );

            $totalAccumBlackList = $totalAccumBlackList + $accumBlacklist[2];
            $avgMpp = $value[5] / $value[7];

//            if(is_null($accumBlacklist[$key])): $resultAccumBlacklist[$key] = 0;
//            else: $resultAccumBlacklist = $accumBlacklist[$key];
//            // else: $resultAccumBlacklist = $accumBlacklist['Impression'];
//            endif;

            $arrInsertOfferReport = array(
                $loopArray[$key][0] //offer code (0)
                , $loopArray[$key][1] //date (1)
                , $loopArray[$key][3] //target (2)
                , $value[4] //imp (3)
                , $value[5] //accum imp (4)
                , $value[6] //ur (5)
                , $value[7] //accum ur (6)
//                , $accumBlacklist[2] //accum blacklist (7)
                , $totalAccumBlackList //accum blacklist (7)
                , $value[9] // % achieved (8)
                , $getNewMppScore[$key] // current mpp (9)
                , $value[5] / $value[7] // avg mpp (10)
                , $key+1 // day (11)
                , $value[13] //% per day (12)
                , $loopArray[$key][2]*$value[11] //% per day (12)
            );

            var_dump($arrInsertOfferReport);
            $offerClass->insertOfferReportImp($arrInsertOfferReport, 1);

//            $insertLog = $logClass->insertLog(
//
//                @$_SESSION['user_name'] //title
//                , 'Success : Insert data to offer report' // description
//                , 'insert offer report' //action
//                ,  'offer code:'.$loopArray[$key][0] //offer code
//                .', date:'. $loopArray[$key][1] //date
//                .', target:'. $value[3] //target
//                .', imp:'. $value[4] //imp
//                .', accum imp:'. $value[5] //accum imp
//                .', ur:'. $value[6] //ur
//                .', accum ur:'. $value[7] //accum ur
//                .', accum blacklist:'. $resultAccumBlacklist //accum blacklist
//                .', % achieved:'. $value[9] // % achieved
//                .', avg mpp:'. $loopArray[$key][2] // avg mpp
//                .', day:'. $value[11] // day
//                .'% per day:'. $loopArray[$key][2]*$value[11] //% per day
//                //action value
//            );
        endforeach;

//-----------------------------------------------  update unpublish offer by offer code to table: [rss_offer_report_imp]
        foreach($getOfferID as $key=>$value):
            $offerClass->unpublishOfferReport($value);
            if(!empty($resultUnPublishOfferReport)):
                $insertLog = $logClass->insertLog(
                    @$_SESSION['user_name'] //title
                    , 'Success : unpublish offer report by offer code' // description
                    , 'update mpp offer report' //action
                    , 'Offer code : '.$loopArray[$key][0].' , ID : '.$value//action values
            );
            endif;
        endforeach;

        break;
    case 'query_quota_with_profile':
//        var_dump($_POST);
        @$getLog = $_POST['getLog'];
        @$getStatus = $_POST['getStatus'];
        @$getStartDate = $_POST['getStartDate'];
        @$getEndDate = $_POST['getEndDate'];

        $arrStatus = '';
        $countStatus = 0;

        if(!is_null($getStatus)):
            foreach($getStatus as $key=>$value):
                $strPass = ',';
                 if($countStatus == 0){$arrStatus .= '|'.$value.'|';} else {$arrStatus .= ',|'.$value.'|';};
                $countStatus++;
            endforeach;
        endif;

        $classQuota = new quotaClass();

        if(is_null($getLog) and is_null($getStatus) and $getStartDate == '' and $getEndDate == ''):
            $getQuotaWithProfile = $classQuota->getQuotaWithProfile('TOP 1000',1, '|AC|' );
        elseif(is_null($getLog) and !is_null($getStatus)):
            $getQuotaWithProfile = $classQuota->getQuotaWithProfile('TOP 1000',1, $arrStatus );
        elseif(!is_null($getLog) and !is_null($getStatus) and !is_null($getStartDate) and !is_null($getEndDate)):
            $getQuotaWithProfile = $classQuota->getQuotaWithProfile('TOP 1000',2, $arrStatus, $getStartDate, $getEndDate );
        else:
            echo "<h1>ERROR: please check input data.</h1>";
        endif;

?>
        <table id="tblQuotaOpportunityByDate" class="table table-striped table-bordered ">
            <thead>
            <tr>
                <th>Date</th>
                <th>Accound ID</th>
                <th>Status</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Location</th>
                <th>Income</th>
                <th>Education</th>
                <th>Freq</th>
                <th>Dur</th>
                <th>Used</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($getQuotaWithProfile as $key=>$value):?>
            <tr>
                <td><?php echo $value[0]->format('Y-m-d'); ?></td>
                <td><?php echo $value[1]; ?></td>
                <td><?php echo $value[2]; ?></td>
                <td><?php echo $value[3]; ?></td>
                <td><?php echo $value[4]; ?></td>
                <td><?php echo $value[5]; ?></td>
                <td><?php echo $value[6]; ?></td>
                <td><?php echo $value[7]; ?></td>
                <td><?php echo $value[8]; ?></td>
                <td><?php echo $value[9]; ?></td>
                <td><?php echo $value[10]; ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function(){

                // DataTable script
                $('#tblQuotaOpportunityByDate').dataTable( {
                    "order": [[ 0, "desc" ], [1, "asc"]]
                });
            });
        </script>
<?php
        break;
    case 'sponsor':
//        echo '<h1>SPONSOR</h1>';
//        echo $action;
        var_dump($_GET);
        break;
    default:

        $insertLog = $logClass->insertLog(
            @$_SESSION['user_name'] //title
            , 'Error : no action' // description
            , 'No Action' //action
            , '' //action value
        );

        $result = "<h1>No, action in use.</h1>";
}


?>