<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>
<?php
    include_once("libs/class/connection.class.php");
    include_once("libs/class/user.class.php");
    $connClass = new connectionClass();
    $userClass = new userClass();
    $getAllUser = $userClass->getUserProfileAll();
//    var_dump($getAllUser);
?>


    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">User list<span style="float: right; font-size: 14px; top: 20px; position: relative; "><a href="user_insert.php">Add user</a></span></h1>

                <?php
                if(@$_GET['success']){
                    echo '<div class="alert alert-success" role="alert" style="text-align: center;">'.$_GET['success'].'</div>';
                } else if (@$_GET['alert']) {
                    echo '<div class="alert alert-danger" role="alert" style="text-align: center;">'.$_GET['alert'].'</div>';
                }//END: if
                ?>

                <div class="table-responsive">
                    <table id="example" class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Permission</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($getAllUser as $key=>$value){?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><a href="user_edit.php?id=<?php echo $value['id']; ?>"><?php echo $value['userFName'].' '.$value['userLName']; ?></a></td>
                            <td><?php echo $value['userDepartment']; ?></td>
                            <td><?php echo $value['userPosition']; ?></td>
                            <td><?php echo $value['userPermission']; ?></td>
                            <td></td>
                        </tr>
                        <?php }//END: foreach($getAllUser)?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include_once("footer.php"); ?>