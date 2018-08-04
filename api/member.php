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
    $user_id = '';

    $request_method = $_SERVER["REQUEST_METHOD"];
    $req_field_array = array('mem_firstname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'mem_password', 'token');
    
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $response_array['return_message'] = 'Invalid Role!';
        $post_data_count = count($post_data);
        $tkn = sanitize_input($post_data['token']);
        if($tkn)
        {
            $response_array = $token->validate_token($tkn);
            /* Validate the Token  */
            if($response_array['return_code'] > 0)
            {
                $tkn_array = $token->parse_token($tkn);
                $user_id = $tkn_array['user_id'];
                $user_role = $tkn_array['user_role'];
                $id = $table_column_array[$user_role]['id'];
                $where_condition = $id.'= '.$user_id;             
                $db_action = 'update';
                $insert_column_array = $update_column_array = array();
                /* Password Reset */        
                if($post_data_count == 2)
                {
                    $password = sanitize_input($post_data['mem_password']);
                    $response_array['return_message'] = 'Invalid Password!';
                    if($password != '')
                    {
                        $new_enc_password = base64_encode(base64_encode($password).'=');
                        $update_column_array = array('encrypted_password' => $new_enc_password);
                    }   
                }
                /* Update memchant information */
                elseif($post_data_count == 6)
                {
                    $req_field_array = array('mem_firsname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'token');
                    /* Check required fields */
                    if(array_keys_exists($req_field_array, $post_data))
                    {
                        extract($post_data);
                        $mem_firstname = sanitize_input($mem_firstname);
                        $mem_lastname = sanitize_input($mem_lastname);
                        $mem_email = sanitize_input($mem_email);
                        $mem_phone = sanitize_input($mem_phone);
                        $mem_country = sanitize_input($mem_country);
                        $is_valid_email = validate_input($mem_email, 'email');
                        $response_array['return_message'] = 'Invalid Email Address!';
                        if($is_valid_email)
                        {
                            
                            
                                $update_column_array = array(
                                                    'first_name' => $mem_firstname,
                                                    'last_name' => $mem_lastname,
                                                    'email' => $mem_email,
                                                    'phone_number' => $mem_phone,
                                                    'country' => $mem_country
                                                   );
                        }
                    }
                }
                /* New memchant information */
                elseif($post_data_count == 7)
                {
                        $req_field_array = array('mem_firsname', 'mem_lastname', 'mem_email', 'mem_country', 'mem_phone', 'mem_password', 'token');
                        /* Check required fields */
                        if(array_keys_exists($req_field_array, $post_data))
                        {
                            extract($post_data);
                            $mem_firstname = sanitize_input($mem_firstname);
                            $mem_lastname = sanitize_input($mem_lastname);
                            $mem_email = sanitize_input($mem_email);
                            $mem_phone = sanitize_input($mem_phone);
                            $mem_country = sanitize_input($mem_country);
                            $password = sanitize_input($mem_password);
                            $new_enc_password = base64_encode(base64_encode($password).'=');
                            $insert_column_array = array(
                                                    'first_name' => sanitize_input($mem_firstname),
                                                    'last_name' => sanitize_input($mem_lastname),
                                                    'email' => sanitize_input($mem_email),
                                                    'phone_number' => sanitize_input($mem_phone),
                                                    'country' => sanitize_input($mem_country),
                                                    'encrypted_password' => $new_enc_password)
                                                   );
                            $db_action = 'insert';
                        }
                }
            
                /* Duplicate Record Validation */
                if($post_data_count > 5)
                {
                    $email = sanitize_input($post_data['mem_email']);                    
                    $email_column = $table_column_array[$user_role]['mem_email'];    
                    $dup_where_condition = $id.'!= '.$user_id.' AND '.$email_column." = '".$email."'";
                }
                

                if($db_action != 'insert')
                {
                    if(count($update_column_array))
                    {
                        if($post_data_count > 5 )
                        {
                            $response_array = $db->get($table_name, $dup_where_condition);
                            $response_array['return_message'] = 'Duplicate Email Address!';
                            if($response_array['return_code'] == 0 )
                            {
                                $response_array = $db->update($table_name, $update_column_array, $where_condition);
                            }
                        }
                        else
                        {
                            $response_array = $db->update($table_name, $update_column_array, $where_condition);
                        }
                    }
                }
                else
                {
                    if(count($insert_column_array))
                    {
                        $dup_where_condition = $email_column." = '".$email."'";
                        $response_array = $db->get($table_name, $dup_where_condition);
                        $response_array['return_message'] = 'Duplicate Email Address!';
                        if($response_array['return_code'] == 0 )
                        {
                            $response_array = $db->insert($table_name, $insert_column_array);
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

    $token->json_response($response_array);

?>
