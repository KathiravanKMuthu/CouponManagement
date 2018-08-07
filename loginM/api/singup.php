<?php
    include('../config/dbconfig.php');
    include('database.php');
    include('token.php');
    $response_array = array(
                        'return_code' => 0,
                        'return_message' => 'Invalid Request!'
                      ); 
    $request_method = $_SERVER["REQUEST_METHOD"];
    if($request_method == 'POST')
    { 
			
        $fname=mysqli_real_escape_string($mysqli_connection,filter_input(INPUT_POST,'name'));
		$lname=mysqli_real_escape_string($mysqli_connection,filter_input(INPUT_POST,'last_name'));
		$email=mysqli_real_escape_string($mysqli_connection,filter_input(INPUT_POST,'email'));
		$country=mysqli_real_escape_string($mysqli_connection,filter_input(INPUT_POST,'country'));
		$mobile=mysqli_real_escape_string($mysqli_connection,filter_input(INPUT_POST,'mobile'));	
		$passw=mysqli_real_escape_string($mysqli_connection,filter_input(INPUT_POST,'password'));	
		$cpassw=mysqli_real_escape_string($mysqli_connection,filter_input(INPUT_POST,'cpassword'));	
		$sqlchk="SELECT user_id FROM user_info WHERE first_name!='$fname' AND last_name!='$lname' AND email!='$email' AND phone_number!='$mobile'";	
		$sqlinsert="INSERT INTO user_info(first_name, last_name, email, phone_number, encrypted_password) VALUES ('$fname','$lname','$email','$mobile','$passw')";
		$resly=mysqli_query($mysqli_connection,$sqlinsert); 
        if(!$resly ) {   $msg=mysqli_error($mysqli_connection); }
        else { $msg="Entered Data Successfully"; }
		
		
		
    }else{
		
	}
        

   $token->json_response($response_array);
?>
<form action="../signin.php" method="post" id="formp">
	<input name="role" value="member" style="display:none;">
	<input name="mem_email" value="<?php echo $email;?>" style="display:none;">
	<input name="mem_password" value="<?php echo $passw;?>" style="display:none;">
<form>
<script type="text/javascript">
document.getElementById('formp').submit();
</script>
