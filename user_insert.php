<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php include_once("libs/class/department.class.php"); ?>
<?php include_once("libs/class/position.class.php"); ?>
<?php include_once("libs/class/permission.class.php"); ?>
<?php
    $departmentClass = new departmentClass();
    $positionClass = new positionClass();
    $permissionClass = new permissionClass();
    $departmentList = $departmentClass->getAllDepartment();
    $positionList = $positionClass->getAllPosition();
    $permissionList = $permissionClass->getAllPermission();
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
                <h1 class="page-header">Create New User: </h1>

                <form role="form" action="functions.php" method="post">
                    <div class="form-group">
                        <label for="userFName">First name</label>
                        <input type="text" class="form-control" id="userFName" name="userFName">
                    </div>
                    <div class="form-group">
                        <label for="userLName">Surname</label>
                        <input type="text" class="form-control" id="userLName" name="userLName" >
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email address</label>
                        <input type="email" class="form-control" id="userEmail"name="userEmail"  >
                    </div>
                    <div class="form-group">
                        <label for="userMobile">Mobile number</label>
                        <input type="text" class="form-control" id="userMobile" name="userMobile" >
                    </div>
                    <div class="form-group">
                        <label for="userDepartment">Department</label>
                        <select id="userDepartment" name="userDepartment" class="form-control">
                            <option>Select ...............</option>
                            <?php foreach($departmentList as $key=>$value){?>
                            <option value="<?php echo $value['id']?>">
                                <?php echo $value['title']?></span>
                            </option>
                            <?php }//END: foreach($departmentList) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userPosition">Position</label>
                        <select id="userPosition" name="userPosition" class="form-control">
                            <option>Select ...............</option>
                            <?php foreach($positionList as $key=>$value){?>
                                <option value="<?php echo $value['id']?>">
                                    <?php echo $value['title']?></span>
                                </option>
                            <?php }//END: foreach($departmentList) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userPermission">Permission<span style="color: red;">*</span></label>
                        <select id="userPermission" name="userPermission" class="form-control">
                            <option>Select ...............</option>
                            <?php foreach($permissionList as $key=>$value){?>
                                <option value="<?php echo $value['id']?>">
                                    <?php echo $value['title']?></span>
                                </option>
                            <?php }//END: foreach($departmentList) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">Password</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" value="password">
                    </div>
                    <div class="form-group">
                        <label for="userPasswordConfm">Password confirm</label>
                        <input type="password" class="form-control" id="userPasswordConfm" name="userPasswordConfm" >
                    </div>
                    <hr/>
                    <input type="hidden" name="action" value="user_insert"/>
                    <button type="submit" class="btn btn-success btn-lg col-lg-4" style="float: right;">Submit</button>
                    <button type="reset" class="" style="color: #333; float: right; border: none; background: none; padding: 15px 30px;">reset</button>
                </form>

            </div>
        </div>
    </div>

<?php include_once("footer.php"); ?>