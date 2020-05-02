<?php
session_start();
include("includes/config.php");
$_SESSION['login']=="";
date_default_timezone_set('Asia/Dhaka');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE tbl_userlog  SET logout = '$ldate' WHERE studentreg = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="index.php";
</script>
