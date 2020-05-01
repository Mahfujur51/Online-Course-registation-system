<?php 
require_once("includes/config.php");
if(!empty($_POST["studentreg"])) {
	$studentreg= $_POST["studentreg"];
	
		$result =mysqli_query($con,"SELECT * FROM tbl_student WHERE studentreg='$studentreg'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Student with this Regno Already Registered.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	echo "<span style='color:green'>Registration no is available.</span>";
	echo "<script>$('#submit').prop('disabled',false);</script>";
	

}
}


?>
