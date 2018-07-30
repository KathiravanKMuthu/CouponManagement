<?php
    include('dbconfig.php');
    include('database.php');
    include('token.php');
    $response_array = array(
                        'return_code' => 0,
                        'return_message' => 'Invalid Request!'
                      ); 
/*
   $table_column_array['member'] = array(
                                      'id' => 'user_id', 
                                      'mem_firstname' => 'first_name',
                                      'mem_lastname' => 'last_name',
                                      'mem_email' => 'email',
                                      'mem_country' => 'country',
                                      'mem_password' => 'encrypted_password',
                                      'mem_phone' => 'phone_number'
                                    );
*/
    $table_name = 'user_info';
    $request_method = $_SERVER["REQUEST_METHOD"];
    $req_field_array = array('mem_firstname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'mem_password', 'token');

    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $response_array['return_message'] = 'Invalid Role!';
        
        if(trim($post_data['token']))
        {
            $tkn = trim($post_data['token']);
            $tkn_array = $token->parse_token($tkn);
            $user_id = $tkn_array['user_id'];
            $user_role = $tkn_array['user_role'];
            $id = $table_column_array[$user_role]['id'];
            $where_condition = $id.'= '.$user_id;             
        }

        $db_action = 'update';
        $insert_column_array = $update_column_array = array();
        /* Password Reset */        
        if(count($post_data) == 2)
        {
            $req_field_array = array('mem_password', 'token');
            $password = trim($post_data['mem_password']);
            $new_enc_password = base64_encode(base64_encode($password).'=');
            /* Check required fields */
            if(array_keys_exists($req_field_array, $post_data))
            {
                $update_column_array = array('encrypted_password' => $new_enc_password);
                   
            }
        }
        /* Update memchant information */
        elseif(count($post_data) == 6)
        {
            $req_field_array = array('mem_firsname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'token');
            /* Check required fields */
            if(array_keys_exists($req_field_array, $post_data))
            {
                extract($post_data);
                $update_column_array = array(
                                        'first_name' => $mem_firstname,
                                        'last_name' => $mem_lastname,
                                        'email' => $mem_email,
                                        'phone_number' => $mem_phone,
                                        'country' => $mem_country
                                       );
            }
        }
        /* New memchant information */
        elseif(count($post_data) == 6)
        {
                $req_field_array = array('mem_firsname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'mem_password', 'token');
                /* Check required fields */
                if(array_keys_exists($req_field_array, $post_data))
                {
                    extract($post_data);
                    $password = trim($mem_password);
                    $new_enc_password = base64_encode(base64_encode($password).'=');
                    $insert_column_array = array(
                                            'first_name' => $mem_firstname,
                                            'last_name' => $mem_lastname,
                                            'email' => $mem_email,
                                            'phone_number' => $mem_phone,
                                            'country' => $mem_country,
                                            'encrypted_password' => $new_enc_password
                                           );
                    $db_action = 'insert';
                }
        }

        if($db_action != 'insert')
        {
            if(count($update_column_array))
            {
                $response_array = $db->update($table_name, $update_column_array, $where_condition);
            }
        }
        else
        {
            if(count($insert_column_array))
            {
                $response_array = $db->insert($table_name, $insert_column_array);
            }
        }

        $tkn = $token->create_token($user_id, $user_role);
        $response_array['token'] = $tkn;
    }
    elseif($request_method == 'GET')
    {
        $get_id = $_GET['id'];
        $id = $table_column_array[$user_role]['id'];
        $where_condition = null;
        if($get_id)
        {
            $where_condition = $id.'= '.$get_id;
        }   
        $response_array = $db->get($table_name, $where_condition);
        $tkn = $token->create_token($user_id, $user_role);
        $response_array['token'] = $tkn;
    }

    $token->json_response($response_array);
