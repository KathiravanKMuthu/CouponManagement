<?php
    include('config/app_config.php');
    $request_method = $_SERVER["REQUEST_METHOD"];
    /* Validate Request Method  */
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $tkn = trim_input($post_data['token']);
        /* Validate Token  */
        if($tkn)
        {
            $tkn_array = $token->parse_token($tkn);
            $user_id = trim_input($tkn_array['user_id']);
            $user_role = trim_input($tkn_array['user_role']);
            $table_name = in_array($user_role, $role_array) ? $table_array[$user_role] : '';
            /* Validate Table Name  */
            $response_array['return_message'] = 'Invalid Role!';
            if($table_name)
            {
                $id = $table_column_array[$user_role]['id'];
                $update_column_array = array('admin_login_status' => 0);
                if($table_name != 'admin_info')
                {
                    $update_column_array = array('login_status' => 0);
                }
                $where_condition = $id.'= '.$user_id;
                /*Update the user information */
                $response_array = $db->update($table_name, $update_column_array, $where_condition);
                $response_array['token'] = 0;
            }
        }
    }
    /*Print the JSON Output*/
    $token->json_response($response_array);
?>
