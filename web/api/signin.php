<?php
    include('config/app_config.php');
	session_start();
	
    $request_method = $_SERVER["REQUEST_METHOD"];
    if($request_method == 'POST')
    {
		
		$dats=json_encode($_POST);
		$post_dt = json_decode($dats);		
		//$post_data1 = json_decode(file_get_contents('php://input'), true);
        $response_array['return_message'] = 'Invalid Role!';
		
		$post_data=(array)$post_dt;
    
        $user_role = trim_input($post_data['role']);
        $table_name = in_array($user_role, $role_array) ? $table_array[$user_role] : '';
        $response_array['return_message'] = 'Invalid Role!';
        /* Validate the Table Name  */
        if($table_name)
        {
            if($user_role == 'member' || $user_role == 'merchant')
            {
                $req_field_array = array('mem_email', 'mem_password');
                if($user_role == 'member')
                {
                    $email = trim_input($post_data['mem_email']);
                    $password = trim_input($post_data['mem_password']);
                }
                else
                {
                    $req_field_array = array('mer_email', 'mer_password');
                    $email = trim_input($post_data['mer_email']);
                    $password = trim_input($post_data['mer_password']);
                }
                /*Validate the Required Fields */
                $response_array = form_validation($req_field_array, $post_data);
                if($response_array['return_code'] > 0)
                {
                    $enc_password = base64_encode(base64_encode($password).'=');
                    $where_condition = $table_column_array['merchant']['mer_email']." = '".$email."'";
                    $where_condition .= ' AND '.$table_column_array['merchant']['mer_password']." = '".$enc_password."'";
                    if($user_role != 'merchant')
                    {
                        $where_condition = $table_column_array['member']['mem_email']." = '".$email."'";
                        $where_condition .= ' AND '.$table_column_array['member']['mem_password']." = '".$enc_password."'";
                    }
                }
            }
            elseif($user_role == 'moderator')
            {
                $req_field_array = array('mod_username', 'mod_password');
                $response_array = form_validation($req_field_array, $post_data);
                /*Validate the Required Fields */
                if($response_array['return_code'] > 0)
                {
                    $username = trim_input($post_data['mod_username']);
                    $password = trim_input($post_data['mod_password']);
                    $enc_password = base64_encode(base64_encode($password).'=');
                    $where_condition = $table_column_array[$role]['mod_username']." = '".$email."'";
                    $where_condition .= ' AND '.$table_column_array[$role]['mod_password']." = '".$enc_password."'";
                }
            }
            /* Get the user information */
            if($response_array['return_code'] > 0)
            {
                $response_array = $db->get($table_name, $where_condition);

                /* Update the user last login information */
                if($response_array['return_code'] > 0)
                {
                    $id = $table_column_array[$user_role]['id'];
                    $user_id = $response_array['return_message'][0][$id];
                    $update_column_array = array('last_login_time' => time(), 'admin_login_status' => 1);
                    if($table_name != 'admin_info')
                    {
                        $update_column_array = array('last_login_time' => time(), 'login_status' => 1);
                    }
                    $where_condition = $id.'= '.$user_id;
                    $response_array = $db->update($table_name, $update_column_array, $where_condition);
                    if($response_array['return_code'] > 0)
                    {
                        $tkn = $token->create_token($user_id, $user_role);
                        $response_array['token'] = $tkn;
						$_SESSION['user_token']=$response_array['token'];
                    }
                }
                else {
                  $response_array['return_message'] = 'Invalid Username or Password!';
                }
				
            }

        }		
		
		//echo $response_array['token'];
		if($response_array['return_message']=="The Record Updated Successfully."){
		//echo "rediect\n";		
		$where_condition = $table_column_array['member']['mem_email']." = '".$email."'";
        $where_condition .= ' AND '.$table_column_array['member']['mem_password']." = '".$enc_password."'";
		$response_array = $db->get($table_name, $where_condition);
				
		$dts=json_encode($response_array['return_message']);
		//echo $dts."\n";
			
		if(preg_match('.first_name.',$dts)){ 
		$sd=preg_split('/"/',$dts);
		//echo $sd[7];
		
		$_SESSION['user_id']=$sd[3];
		$_SESSION['first_name']=$sd[7];
		$_SESSION['last_name']=$sd[11];		
		$_SESSION['mailid']=$sd[15];		
		$_SESSION['country']=$sd[69];		
		$_SESSION['city']=$sd[62];		
		$_SESSION['phone']=$sd[19];		
		$_SESSION['pcode']=$sd[72];		
		$_SESSION['addiress']=$sd[64];		
		$_SESSION['location']=$sd[14];		
		$_SESSION['role']=$user_role;
		//echo $_SESSION['first_name']." ".$_SESSION['last_name']." ".$_SESSION['user_id']." ".$_SESSION['role']." ".$_SESSION['phone']." ".$_SESSION['city']." ".$_SESSION['addiress'];	
		//echo " ".$_SESSION['country']." ".$_SESSION['pcode']." ".$_SESSION['mailid'];
		header("location:../index.php");
		}	
		}elseif($response_array['return_message']=="Invalid Username or Password!"){
			header("location:../index.php?page=signin&signinmsg=".$response_array['return_message']);
		}else{}
		/*Print the JSON Output*/
//		$token->json_response($response_array);
	}
 
?>
