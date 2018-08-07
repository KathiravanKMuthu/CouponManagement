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
