<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("/libs/class/account.class.php"); ?>
<?php
    $userId = $_SESSION['user_id'];
    $accountClass = new accountClass();
    $accountId = @$_GET['accountId'];
    if(isset($accountId)): $accountInfo = $accountClass->getProfileInfo($accountId); endif;
?>

<div style="clear: both;"></div>
<div class="container-fluid" style="margin-bottom: 50px;">
    <div class="row">
        <?php include_once("sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <!--        <div class="col-lg-12 main">-->
            <h1 class="page-header">
                Update Profile:
            </h1>

            <?php
            if(@$_GET['success']){
                echo '<div class="alert alert-success" role="alert" style="text-align: center;">'.$_GET['success'].'</div>';
            } else if (@$_GET['alert']) {
                echo '<div class="alert alert-danger" role="alert" style="text-align: center;">'.$_GET['alert'].'</div>';
            }//END: if
            ?>

            <form action="functions.php" method="post">
                <div class="form-group">
                    <label for="userProfileId">Profile ID</label>
                    <input type="text" class="form-control" id="userProfileId" name="userProfileId" value="">
                </div>
<!--                <div class="radio">-->
<!--                    <label>-->
<!--                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>-->
<!--                        profile test-->
<!--                    </label>-->
<!--                </div>-->
<!--                <div class="radio">-->
<!--                    <label>-->
<!--                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">-->
<!--                        profile production-->
<!--                    </label>-->
<!--                </div>-->
                <hr/>
                <input type="hidden" name="userId" value="<?php echo $userId; ?>"/>
                <input type="hidden" name="action" value="profile_update"/>
                <button type="submit" class="btn btn-success btn-lg col-lg-4" style="float: right;">Submit</button>
                <button type="reset" class="" style="color: #333; float: right; border: none; background: none; padding: 15px 30px;">reset</button>
            </form>
            <?php if(isset($accountId)):?>
            <table class="table table-striped table-bordered " style="margin-top: 80px;">
                <thead>
                <tr>
                    <th>Personal information</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ID</td>
                    <td><?php echo $accountInfo[0]; ?></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><?php echo $accountInfo[1]; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $accountInfo[2]; ?></td>
                </tr>
                <tr>
                    <td>Income Range</td>
                    <td><?php echo $accountInfo[3]; ?></td>
                </tr>
                <tr>
                    <td>Personal Income</td>
                    <td><?php echo $accountInfo[27]; ?></td>
                </tr>
                <tr>
                    <td>Occupation</td>
                    <td><?php echo $accountInfo[4]; ?></td>
                </tr>
                <tr>
                    <td>Education</td>
                    <td><?php echo $accountInfo[5]; ?></td>
                </tr>
                <tr>
                    <td>Marital Status</td>
                    <td><?php echo $accountInfo[6]; ?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td><?php echo $accountInfo[28]; ?></td>
                </tr>
                <tr>
                    <td>Areacode</td>
                    <td><?php echo $accountInfo[29]; ?></td>
                </tr>
                <tr>
                    <td>DOB</td>
                    <td><?php echo $accountInfo[30].'/'.$accountInfo[31].'/'.$accountInfo[32]; ?></td>
                </tr>
                <tr>
                    <td>Status CD</td>
                    <td><?php echo $accountInfo[33]; ?></td>
                </tr>
                <tr>
                    <td>From Chanel</td>
                    <td><?php echo $accountInfo[34]; ?></td>
                </tr>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>