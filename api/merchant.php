<?php
    include('dbconfig.php');
    include('database.php');
    include('token.php');
    $response_array = array(
                        'return_code' => 0,
                        'return_message' => 'Invalid Request!'
                      ); 
    $request_method = $_SERVER["REQUEST_METHOD"];
    
    /*$table_column_array['merchant'] = array(
                                       'id' => 'merchant_id',
                                       'mer_name' => 'merchant_name',
                                       'mer_email' => 'merchant_email',
                                       'mer_phone' => 'phone_number',
                                       'mer_country' => 'country',
                                       'mer_password' => 'encrypted_password'
                                      );
    */
    $table_name = 'merchant_info';
    $req_field_array = array('mer_name', 'mer_email', 'mer_country', 'mer_password', 'token');
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
            $req_field_array = array('mer_password', 'token');
            $password = trim($post_data['mer_password']);
            $new_enc_password = base64_encode(base64_encode($password).'=');
            /* Check required fields */
            if(array_keys_exists($req_field_array, $post_data))
            {
                $update_column_array = array('encrypted_password' => $new_enc_password);
                   
            }
        }
        /* Update merchant information */
        elseif(count($post_data) == 5)
        {
            $req_field_array = array('mer_name', 'mer_email', 'mer_country', 'mer_phone', 'token');
            /* Check required fields */
            if(array_keys_exists($req_field_array, $post_data))
            {
                extract($post_data);
                $update_column_array = array(
                                        'merchant_name' => $mer_name,
                                        'merchant_email' => $mer_email,
                                        'phone_number' => $mer_phone,
                                        'country' => $mer_country
                                       );
            }
        }
        /* New merchant information */
        elseif(count($post_data) == 6)
        {
                
                $req_field_array = array('mer_name', 'mer_email', 'mer_country', 'mer_phone', 'mer_password', 'token');
                /* Check required fields */
                if(array_keys_exists($req_field_array, $post_data))
                {
                    extract($post_data);
                    $password = trim($mer_password);
                    $new_enc_password = base64_encode(base64_encode($password).'=');
                    $insert_column_array = array(
                                        'merchant_name' => $mer_name,
                                        'merchant_email' => $mer_email,
                                        'phone_number' => $mer_phone,
                                        'country' => $mer_country,
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

