<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enroll History</title>
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
                        <h1 class="page-head-line">Enroll History  </h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Enroll History
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                                 <th>Student Name </th>
                                                    <th>Student Reg no </th>
                                            <th>Course Name </th>
                                            <th>Session </th>
                                            
                                                <th>Semester</th>
                                             <th>Enrollment Date</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
 <?php
                                            //$studentreg=$_SESSION['login'];
                                            $sql="SELECT tbl_courseenrolls.course as cid, tbl_course.coursename as courname,tbl_session.session as session,tbl_department.department as dept,tbl_level.level as level,tbl_courseenrolls.enrolldate as edate ,tbl_semester.semester as sem from tbl_courseenrolls join tbl_course on tbl_course.id=tbl_courseenrolls.course join tbl_session on tbl_session.id=tbl_courseenrolls.session join tbl_department on tbl_department.id=tbl_courseenrolls.department join tbl_level on tbl_level.id=tbl_courseenrolls.level  join tbl_semester on tbl_semester.id=tbl_courseenrolls.semester";
                                            $query=mysqli_query($con,$sql);
                                            $num=mysqli_num_rows($query);
                                            if ($num>0) {
                                                $cont=1;
                                                while ($row=mysqli_fetch_array($query)) {
                                            # code...
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $cont;?></td>
                                                        <td><?php echo htmlentities($row['courname']);?></td>
                                                        <td><?php echo htmlentities($row['session']);?></td>
                                                        <td><?php echo htmlentities($row['dept']);?></td>
                                                        <td><?php echo htmlentities($row['level']);?></td>
                                                        <td><?php echo htmlentities($row['sem']);?></td>
                                                        <td><?php echo htmlentities($row['edate']);?></td>
                                                        <td>
                                                            <a href="print.php?id=<?php echo $row['cid']?>" target="_blank">
                                                                <button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $cont++;
                                                    } } ?>

                                        
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
