<?php
session_start();
error_reporting(0);
include("includes/config.php");
if (isset($_POST['submit'])) {
    $status=1;
    $studentreg = $_POST['studentreg'];
    $password = md5($_POST['password']);
    $userip=$_SERVER['REMOTE_ADDR'];
    $sql = "SELECT * FROM tbl_student WHERE studentreg='$studentreg' AND password='$password'";
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        while ($result = mysqli_fetch_array($query)) {
            $_SESSION['login'] = $studentreg;
            $_SESSION['id'] = $result['studentreg'];
            $_SESSION['sname'] = $result['studentname'];
            $insql= "INSERT INTO tbl_userlog(studentreg,userip,status) VALUES('$studentreg','$userip','$status')";
            $insquery=mysqli_query($con,$insql);
            header("Location:change-password.php");
        }
    } else {
        $_SESSION['errmsg'] = "Invalid Reg no or Password";
        header("Location:index.php");
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
    <title>Student Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>
                </div>
            </div>
            <span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>
            <form name="admin" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label>Enter Reg no : </label>
                        <input type="text" name="studentreg" class="form-control" />
                        <label>Enter Password : </label>
                        <input type="password" name="password" class="form-control" />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                    </div>
                </form>
                <div class="col-md-6">
                    <div class="alert alert-info">
                        This is a free bootstrap admin template with basic pages you need to craft your project.
                        Use this template for free to use for personal and commercial use.
                        <br />
                        <strong> Some of its features are given below :</strong>
                        <ul>
                            <li>
                                Responsive Design Framework Used
                            </li>
                            <li>
                                Easy to use and customize
                            </li>
                            <li>
                                Font awesome icons included
                            </li>
                            <li>
                                Clean and light code used.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>