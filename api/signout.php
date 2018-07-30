<?php
    include('dbconfig.php');
    include('database.php');
    include('token.php');
    $response_array = array(
                        'return_code' => 0,
                        'return_message' => 'Invalid Request!'
                      ); 
    $request_method = $_SERVER["REQUEST_METHOD"];
    $update_column_array = array('admin_login_status' => 0);
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $tkn = trim($post_data['token']);
        $tkn_array = $token->parse_token($tkn);
        $user_id = $tkn_array['user_id'];
        $user_role = $tkn_array['user_role'];
        $table_name = in_array($user_role, $role_array) ? $table_array[$user_role] : '';
        $id = $table_column_array[$user_role]['id'];

        if($table_name)
        {
            if($table_name != 'admin_info')
            {
                $update_column_array = array('last_login_status' => 0);
            }
            $where_condition = $id.'= '.$user_id;
            /*Update the user last login information */
            $response_array = $db->update($table_name, $update_column_array, $where_condition);
        }
    }
    
    $token->json_response($response_array);
 
