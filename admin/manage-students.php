<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else{
    if(isset($_GET['delid']))
    {
        $id=$_GET['delid'];
        $delsql="DELETE FROM tbl_student WHERE id='$id'";
        $delquery=mysqli_query($con,$delsql);
        if ($delquery) {
            $_SESSION['delmsg']="Student record deleted !!";
        }


    }
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $password="12345";
        $newpass=md5($password);
        $rsql="UPDATE tbl_student SET password='$newpass' WHERE id='$id'";
        $rquery=mysqli_query($con,$rsql);
        if ($rquery) {
            $_SESSION['delmsg']="Password Reset. New Password is 12345";
        }


        
    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | Course</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
    </head>
    <body>
        <?php include('includes/header.php');?>
        <!-- LOGO HEADER END-->
        <?php if($_SESSION['alogin']!="")
        {
            include('includes/menubar.php');
        }
        ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course  </h1>
                    </div>
                </div>
                <div class="row" >

                    <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                    <div class="col-md-12">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Manage Course
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reg No </th>
                                                <th>Student Name </th>
                                                <th> Pincode</th>
                                                <th>Reg Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql=mysqli_query($con,"SELECT * FROM tbl_student");
                                            $cont=1;
                                            while($row=mysqli_fetch_array($sql))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cont;?></td>
                                                    <td><?php echo htmlentities($row['studentreg']);?></td>
                                                    <td><?php echo htmlentities($row['studentname']);?></td>
                                                    <td><?php echo htmlentities($row['pincode']);?></td>
                                                    <td><?php echo htmlentities($row['createdate']);?></td>
                                                    <td>
                                                        <a href="edit-student-profile.php?eid=<?php echo $row['id']?>">
                                                            <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>
                                                            <a href="manage-students.php?delid=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                                <button class="btn btn-danger">Delete</button>
                                                            </a>
                                                            <a href="manage-students.php?id=<?php echo $row['id']?>" onClick="return confirm('Are you sure you want to reset password?')">
                                                                <button type="submit" name="submit" id="submit" class="btn btn-default">Reset Password</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $cont++;
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--  End  Bordered Table  -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTENT-WRAPPER SECTION END-->
            <?php include('includes/footer.php');?>
            <!-- FOOTER SECTION END-->
            <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
            <!-- CORE JQUERY SCRIPTS -->
            <script src="assets/js/jquery-1.11.1.js"></script>
            <!-- BOOTSTRAP SCRIPTS  -->
            <script src="assets/js/bootstrap.js"></script>
        </body>
        </html>
        <?php } ?>