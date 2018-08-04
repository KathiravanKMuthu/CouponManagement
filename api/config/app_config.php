<?php
/* Application configuration goes here */

    define('DIR_BASE',      dirname( dirname( __FILE__ ) ) . '/');
    define('DIR_CLASS',    DIR_BASE . 'class/');
    define('DIR_CONF',    DIR_BASE . 'config/');
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
    $label_array = array(
                    'mem_firstname' => 'First Name',
                    'mem_lastname' => 'Last Name',
                    'mem_email' => 'Email',
                    'mem_country' => 'Country',
                    'mem_password' => 'Password',
                    'mem_phone' => 'Phone Number',
                    'mer_name' => 'Business Name',
                    'mer_email' => 'Email',
                    'mer_phone' => 'Phone Number',
                    'mer_country' => 'Country',
                    'mer_password' => 'Password',
                    'mod_username' => 'Username',
                    'mod_password' => 'Password',
                    'token' => 'Token'
                   );

/*Default Response */
    $response_array = array(
                        'return_code' => 0,
                        'return_message' => 'Invalid Request!'
                      );     
 /* Common functions */
    function array_keys_exists(array $keys, array $arr) 
    {
        $res = true;
        $post_data_array = array_keys($arr);
        foreach($keys as $key)
        {
            if(!in_array($key, $post_data_array))
            {
                $res = false;
                break;
            }
        }        
        return $res;
    }

    function validate_input($var, $type)
    {
        $filter = false;
        switch($type)
        {
            case 'email':
                $var = substr($var, 0, 254);
                $var = filter_var($var, FILTER_SANITIZE_EMAIL);
                $filter = FILTER_VALIDATE_EMAIL; 
                break;
            case 'int':
                $filter = FILTER_VALIDATE_INT;
                break;
            case 'boolean':
                $filter = FILTER_VALIDATE_BOOLEAN;
                break;
            case 'ip':
                $filter = FILTER_VALIDATE_IP;
                break;
            case 'url':
                $filter = FILTER_VALIDATE_URL;
                $var = filter_var($var, FILTER_SANITIZE_URL);
                break;
            default:
                $filter = FILTER_VALIDATE_STRING;
                $var = filter_var($var, FILTER_SANITIZE_STRING);
        }
        return ($filter === false) ? false : filter_var($var, $filter) !== false ? true : false;
    }

    function form_validation($req_field_array, $post_data)
    {
        global $label_array;
        $result_array = array(
                        'return_code' => 1,
                        'return_message' => 'All inputs are valid'
                      ); 
        foreach($req_field_array as $req_field)
        {
            $req_val = trim_input($post_data[$req_field]);
            if($req_val == '')
            {
                $result_array['return_message'] = $label_array[$req_field].' is required!';
                $result_array['return_code'] = 0;
                break;
            }
            elseif($label_array[$req_field] == 'Email')
            {
                $is_valid_email = validate_input($req_val, '');
                if(!$is_valid_email)
                {
                    $result_array['return_message'] = 'Invalid Email Address!';
                    $result_array['return_code'] = 0;
                    break;
                }
            }
        }
        return $result_array;        
    }

    function trim_input($input)
    {
        $input = isset($input) ? trim($input) : '';
        return $input;
    }

    include( DIR_CONF. 'dbconfig.php' );
    include( DIR_CLASS . 'database.php' );
    include( DIR_CLASS . 'token.php' );

?>
