<?php
    include('config/app_config.php');
    $request_method = $_SERVER["REQUEST_METHOD"];
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
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
                    }
                }
                else {
                  $response_array['return_message'] = 'Invalid Username or Password!';
                }
            }

        }
    }
    /*Print the JSON Output*/
    $token->json_response($response_array);
 ?>
