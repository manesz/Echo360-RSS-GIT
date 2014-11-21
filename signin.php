<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="libs/img/favicon.ico">

    <title>Signin ECHO360 | Reporting Self Service</title>

    <!-- Bootstrap core CSS -->
    <link href="libs/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="libs/css/signin.css" rel="stylesheet">

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
</head>

<body>
<?php include_once("libs/class/connection.class.php"); ?>

<div class="container">

    <form class="form-signin" role="form" action="functions.php" method="post">

        <img src="libs/img/echo-360-logo.jpg" style="max-width: 300px; margin-bottom: 20px; "/>


<!--        <input type="email" class="form-control" placeholder="Email address" required autofocus>-->
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" value="password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <input type="hidden" name="action" value="signin"/>
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">

    </form>

    <?php
    if(@$_GET['alert']){echo '<div class="alert alert-danger" role="alert" style="text-align: center;">'.$_GET['alert'].'</div>';}
    ?>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
