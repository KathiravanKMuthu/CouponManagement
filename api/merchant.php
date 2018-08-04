<?php
    include('config/app_config.php');
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
    $user_role = 'merchant';
    $user_id = '';
    $req_field_array = array('mer_name', 'mer_email', 'mer_country', 'mer_password', 'token');
    if($request_method == 'POST')
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $response_array['return_message'] = 'Invalid Role!';
        $post_data_count = count($post_data);
        if($post_data_count >= 2)
        {
            /* New merchant information */
            if($post_data_count == 6)
            {
                $insert_column_array = array();
                $req_field_array = array('mer_name', 'mer_email', 'mer_country', 'mer_phone', 'mer_password', 'token');
                /* Check required fields */
                $response_array = form_validation($req_field_array, $post_data);
                if($response_array['return_code'] > 0)
                {
                    extract($post_data);
                    $password = trim($mer_password);
                    $email = trim($mer_email);
                    $new_enc_password = base64_encode(base64_encode($password).'=');
                    $insert_column_array = array(
                                        'merchant_name' => trim($mer_name),
                                        'merchant_email' => $email,
                                        'phone_number' => trim($mer_phone),
                                        'country' => trim($mer_country),
                                        'encrypted_password' => $new_enc_password
                                       );
                    $email_column = $table_column_array[$user_role]['mer_email'];
                    $dup_where_condition = $email_column." = '".$email."'";
                    $response_array = $db->get($table_name, $dup_where_condition);
                    $response_array['return_message'] = 'Duplicate Email Address!';
                    if($response_array['return_code'] == 0 )
                    {
                        $response_array = $db->insert($table_name, $insert_column_array);
                    }
                }
            }
            /* Update merchant information */
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
                        $req_field_array = array('mer_password', 'token');
                        $password = trim($post_data['mer_password']);
                        $new_enc_password = base64_encode(base64_encode($password).'=');
                        /* Check required fields */
                        $response_array = form_validation($req_field_array, $post_data);
                        if($response_array['return_code'] > 0)
                        {
                            $update_column_array = array('encrypted_password' => $new_enc_password);
                            $response_array = $db->update($table_name, $update_column_array, $where_condition);
                        }
                    }
                    /* Update merchant personal information */
                    elseif($post_data_count == 5)
                    {
                        $req_field_array = array('mer_name', 'mer_email', 'mer_country', 'mer_phone', 'token');
                        /* Check required fields */
                        $response_array = form_validation($req_field_array, $post_data);
                        if($response_array['return_code'] > 0)
                        {
                            extract($post_data);
                            $update_column_array = array(
                                                'merchant_name' => trim($mer_name),
                                                'merchant_email' => trim($mer_email),
                                                'phone_number' => trim($mer_phone),
                                                'country' => trim($mer_country)
                                               );
                            $email = trim($post_data['mer_email']);
                            $email_column = $table_column_array[$user_role]['mer_email'];
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
