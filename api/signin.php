<?php
    include('dbconfig.php');
    include('database.php');
    include('token.php');
    $response_array = array(
                        'return_code' => 0,
                        'return_message' => 'Invalid Request!'
                      ); 
    $request_method = $_SERVER["REQUEST_METHOD"];
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $user_role = $post_data['role'];
        $response_array['return_message'] = 'Invalid Role!';

        $table_name = in_array($user_role, $role_array) ? $table_array[$user_role] : '';
        if($user_role == 'member')
        {
            $email = trim($post_data['mem_email']);
            $password = trim($post_data['mem_password']);
            if($email != '' && $password != '')
            {

                $enc_password = base64_encode(base64_encode($password).'=');
                $where_condition = ' WHERE '.$table_column_array[$role]['mem_email']." = '".$email."'";
                $where_condition = ' AND '.$table_column_array[$role]['mem_password']." = '".$enc_password."'";
            }
        }
        elseif($user_role == 'merchant')
        {
            $email = trim($post_data['mer_email']);
            $password = trim($post_data['mer_password']);
            if($email != '' && $password != '')
            {

                $enc_password = base64_encode(base64_encode($password).'=');
                $where_condition = ' WHERE '.$table_column_array[$role]['mer_email']." = '".$email."'";
                $where_condition = ' AND '.$table_column_array[$role]['mer_password']." = '".$enc_password."'";
            }

        }
        elseif($user_role == 'moderator')
        {
            $username = trim($post_data['mod_username']);
            $password = trim($post_data['mod_password']);
            if($username != '' && $password != '')
            {

                $enc_password = base64_encode(base64_encode($password).'=');
                $where_condition = ' WHERE '.$table_column_array[$role]['mod_username']." = '".$email."'";
                $where_condition = ' AND '.$table_column_array[$role]['mod_password']." = '".$enc_password."'";
            }
        }
        
        if($table_name)
        {
            /*Get the user information */
            $response_array = $db->get($table_name, $where_condition);
        }
 
        if($response_array['return_code'] > 0)
        {
            $id = $table_column_array[$user_role]['id'];
            $user_id = $response_array['return_message'][0][$id];
            $update_column_array = array('last_login_time' => time(), 'admin_login_status' => 1);
            if($table_name != 'admin_info')
            {
                $update_column_array = array('last_login_time' => time(), 'last_login_status' => 1);
            }
            $where_condition = $id.'= '.$user_id;
            /*Update the user last login information */
            $response_array = $db->update($table_name, $update_column_array, $where_condition);
            if($response_array['return_code'] > 0)
            {
                $tkn = $token->create_token($user_id, $user_role);
                $response_array['token'] = $tkn;
            }
        }
    }
    
    $token->json_response($response_array);
 
