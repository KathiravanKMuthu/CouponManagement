<?php
    include('config/app_config.php');
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
    $user_role = 'member';    
    $user_id = '';
    $request_method = $_SERVER["REQUEST_METHOD"];
    $req_field_array = array('mem_firstname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'mem_password', 'token');
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $response_array['return_message'] = 'Invalid Role!';
        $post_data_count = count($post_data);
        if($post_data_count >= 2)
        {
            /* New user information */
            if($post_data_count == 7)
            {
                $req_field_array = array('mem_firsname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'mem_password', 'token');
                /* Check required fields */
                $response_array = form_validation($req_field_array, $post_data);
                if($response_array['return_code'] > 0)
                {
                    extract($post_data);
                    $password = trim($mem_password);
                    $email = trim($mem_email);
                    $new_enc_password = base64_encode(base64_encode($password).'=');
                    $insert_column_array = array(
                                        'first_name' => trim($mem_firstname),
                                        'last_name' => trim($mem_lastname),
                                        'email' => $email,
                                        'phone_number' => trim($mem_phone),
                                        'country' => trim($mem_country),
                                        'encrypted_password' => $new_enc_password
                                       );
                    $email_column = $table_column_array[$user_role]['mem_email'];
                    $dup_where_condition = $email_column." = '".$email."'";
                    $response_array = $db->get($table_name, $dup_where_condition);
                    $response_array['return_message'] = 'Duplicate Email Address!';
                    if($response_array['return_code'] == 0 )
                    {
                        $response_array = $db->insert($table_name, $insert_column_array);
                    }
                }
            }
            /* Update user information */
            else
            {
                $tkn = trim($post_data['token']);
                $response_array = $token->validate_token($tkn);
                /* Validate the Token  */
                if($response_array['return_code'] > 0)
                {
                    $update_column_array = array();
                    $tkn_array = $token->parse_token($tkn);
                    $user_id = $tkn_array['user_id'];
                    $user_role = $tkn_array['user_role'];
                    $id = $table_column_array[$user_role]['id'];
                    $where_condition = $id.'= '.$user_id;            
                    /* Update Password */        
                    if($post_data_count == 2)
                    {
                        $req_field_array = array('mem_password', 'token');
                        $password = trim($post_data['mem_password']);
                        $new_enc_password = base64_encode(base64_encode($password).'=');
                        /* Check required fields */
                        $response_array = form_validation($req_field_array, $post_data);
                        if($response_array['return_code'] > 0)
                        {
                            $update_column_array = array('encrypted_password' => $new_enc_password);
                            $response_array = $db->update($table_name, $update_column_array, $where_condition);
                        }
                    }
                    /* Update user personal information */                   
                    elseif($post_data_count == 6)
                    {
                        $req_field_array = array('mem_firsname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'token');
                        /* Check required fields */
                        $response_array = form_validation($req_field_array, $post_data);
                        if($response_array['return_code'] > 0)
                        {
                            extract($post_data);
                            $email = trim($mem_email);
                            $update_column_array = array(
                                                    'first_name' => trim($mem_firstname),
                                                    'last_name' => trim($mem_lastname),
                                                    'email' => trim($mem_email),
                                                    'phone_number' => trim($mem_phone),
                                                    'country' => trim($mem_country)
                                                   );
                            
                            $email_column = $table_column_array[$user_role]['mem_email'];
                            $dup_where_condition = $id.'!= '.$user_id.' AND '.$email_column." = '".$email."'";
                            $response_array = $db->get($table_name, $dup_where_condition);
                            $response_array['return_message'] = 'Duplicate Email Address!';
                            if($response_array['return_code'] == 0)
                            {
                                $response_array = $db->update($table_name, $update_column_array, $where_condition);
                            }
                        }
                    }
                }
            }
        }
    }
    elseif($request_method == 'GET')
    {
        $user_id = $_GET['id'];
        $id = $table_column_array[$user_role]['id'];
        $where_condition = null;
        $tkn = trim($_GET['token']);
        if($tkn)
        {
            $response_array = $token->validate_token($tkn);
            if($response_array['return_code'] > 0)
            {
                if($user_id)
                {
                    $where_condition = $id.'= '.$user_id;
                }   
                $response_array = $db->get($table_name, $where_condition);
            }
        }
    }
    if($user_id)
    {
        $tkn = $token->create_token($user_id, $user_role);
        $response_array['token'] = $tkn;
    }
    /*Print the JSON Output*/
    $token->json_response($response_array);
?>
