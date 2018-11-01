<?php
session_start();
//echo $_SESSION['email'].'<br>';
if(session_destroy()){
  session_unset();
   header("location:index.php");?>
<!-- <meta http-equiv="refresh" content="0;URL='index.php'"/>  -->
<?php
}
?>

<form action="api/signout.php" method="post" id="formp">
	<input name="user_role" value="<?php echo $_SESSION['role'];?>" style="display:none;">
	<input name="user_id" value="<?php echo $_SESSION['user_id'];?>" style="display:none;">
	<input name="token" value="<?php echo $_SESSION['user_token'];?>" style="display:none;">
<form>
<script type="text/javascript">
document.getElementById('formp').submit();
</script>
