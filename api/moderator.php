<?php
    include('dbconfig.php');
    include('database.php');
    include('token.php');
    $response_array = array(
                        'return_code' => 0,
                        'return_message' => 'Invalid Request!'
                      ); 
    $request_method = $_SERVER["REQUEST_METHOD"];
    $req_field_array = array('mod_password', 'token');
    $table_name = 'admin_info';
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        /* Check required fields */
        if(array_keys_exists($req_field_array, $post_data))
        {
            $password = trim($post_data['mod_password']);
            $tkn = trim($post_data['token']);
            $tkn_array = $token->parse_token($tkn);
            $user_id = $tkn_array['user_id'];
            $user_role = $tkn_array['user_role'];
            $response_array['return_message'] = 'Invalid Role!';
            if($user_role == 'moderator')
            {
                $new_enc_password = base64_encode(base64_encode($password).'=');
                $update_column_array = array('encrypted_password' => $new_enc_password);
                $id = $table_column_array[$user_role]['id'];
                $where_condition = $id.'= '.$user_id;
                $response_array = $db->update($table_name, $update_column_array, $where_condition);
                $tkn = $token->create_token($user_id, $user_role);
                $response_array['token'] = $tkn;
            }
        }
    }

    $token->json_response($response_array);

