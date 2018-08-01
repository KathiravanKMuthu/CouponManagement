<?php
/* Application configuration goes here */
    define('CLIENT_NAME', 'DealDio');
    define('CLIENT_DISP_NAME', 'Deal Dio');
    define('SECRET_KEY', 'UkdWaGJDQkVhVzg9PQ==');
    define('VALIDITY_TIME', 1200);  //20 mins
    $role_array = array('member', 'merchant', 'moderator');
    $table_array = array('member' => 'user_info', 'merchant' => 'merchant_info', 'moderator' => 'admin_info');
    $table_column_array['member'] = array(
                                      'id' => 'user_id', 
                                      'mem_firstname' => 'first_name',
                                      'mem_lastname' => 'last_name',
                                      'mem_email' => 'email',
                                      'mem_country' => 'country',
                                      'mem_password' => 'encrypted_password',
                                      'mem_phone' => 'phone_number'
                                    );

    $table_column_array['merchant'] = array(
                                       'id' => 'merchant_id',
                                       'mer_name' => 'merchant_name',
                                       'mer_email' => 'merchant_email',
                                       'mer_phone' => 'phone_number',
                                       'mer_country' => 'country',
                                       'mer_password' => 'encrypted_password'
                                      );

    $table_column_array['moderator'] = array(
                                        'id' => 'admin_id',
                                        'mod_username' => 'admin_login_name',
                                        'mod_password' => 'encrypted_password'  
                                       );


 /* Common functions */
    function array_keys_exists(array $keys, array $arr) 
    {
        $res = true;
        $post_data_array = array_keys($arr);
        foreach($keys as $key)
        {
            if(!in_array($key, $post_data_array) || empty($arr[$key]))
            {
                $res = false;
                break;
            }
        }        
        return $res;
    }

