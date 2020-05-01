<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else{
    if(isset($_POST['submit']))
    {
        $department=$_POST['department'];
        $sql="INSERT INTO tbl_department(department)VALUES('$department')";
        $query=mysqli_query($con,$sql);
        if ($query) {
            $_SESSION['msg']="Department Created Successfully!!";
        }else{
            $_SESSION['msg']="Error::Something Wrong!!";
        }
    }
     if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $delsql="DELETE FROM tbl_department WHERE id='$id'";
        $delquery=mysqli_query($con,$delsql);
        if ($delquery) {
            $_SESSION['delmsg']="Department deleted !!";
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
        <title>Admin | department</title>
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
                        <h1 class="page-head-line">Department  </h1>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Department
                            </div>
                            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                            <div class="panel-body">
                                <form name="dept" method="post">
                                    <div class="form-group">
                                        <label for="department">Add Department  </label>
                                        <input type="text" class="form-control" id="department" name="department" placeholder="department" required />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Session
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>department</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                        $sql1="SELECT * FROM tbl_department";
                                        $query1=mysqli_query($con,$sql1);
                                        $num=mysqli_num_rows($query1);
                                        if ($num>0) {
                                            $cont=1;
                                            while($result=mysqli_fetch_array($query1)){

                                                ?>

                                            <tr>
                                                <td><?php echo $cont;?></td>
                                                <td><?php echo htmlentities($result['department']);?></td>
                                                <td><?php echo htmlentities($result['createdate']);?></td>
                                                <td>
                                                    <a href="department.php?id=<?php echo $result['id']?>" onClick="return confirm('Are you sure you want to delete?')">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $cont++;
                                        }} ?>

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