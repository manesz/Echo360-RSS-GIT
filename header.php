<?php
    session_start();
    set_time_limit ( -1 );
    include_once('libs/class/session.class.php');
    $sessionClass = new sessionClass();
    $sessionClass->isSignin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="libs/img/favicon.ico">

    <title>ECHO360 | Reporting Self Service</title>

    <!-- Bootstrap core CSS -->
    <link href="libs/css/bootstrap.min.css" rel="stylesheet">
    <link href="libs/css/style.css" rel="stylesheet">

    <!-- Bootstrap Validation -->
    <link href="libs/css/bootstrapValidator.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="libs/css/dashboard.css" rel="stylesheet">
    <link href="libs/css/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="libs/css/datepicker.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="libs/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="libs/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="libs/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="libs/js/html5shiv.min.js"></script>
    <script src="libs/js/respond.min.js"></script>
    <![endif]-->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="libs/js/jquery-2.1.1.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/js/bootstrap-datepicker.js"></script>
    <script src="libs/js/bootstrap-modal.js"></script>
    <script src="libs/js/docs.min.js"></script>
    <script src="libs/js/jquery.dataTables.min.js"></script>
    <script src="libs/js/dataTables.bootstrap.js"></script>
    <script src="libs/js/highcharts.js"></script>
    <script src="libs/js/modules/exporting.js"></script>
    <!--    <script src="libs/js/bootstrap-datetimepicker.min.js"></script>-->
    <script src="libs/js/bootstrapValidator.js"></script>

</head>

<body>