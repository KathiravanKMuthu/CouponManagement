<?php
    class Token
    {
        function __construct() {}

        function create_token($user_id, $user_role)
        {
            $user_data = base64_encode("$user_id $user_role ".time());
            return base64_encode(SECRET_KEY.' '.$user_data.'=');
        }

        function parse_token($token)
        {
            $token_junk_array = array('key' => '', 'user_id' => '', 'user_role' => '', 'old_time' => 0);
            //list($key, $user_data) = explode(base64_decode($token), ' ');
            //list($user_id, $user_role, $old_time) = explode(base64_decode(rtrim($user_data, '='), ' ');
            list($token_junk_array['key'] , $user_data) = explode(" ", base64_decode($token));
            list($token_junk_array['user_id'], $token_junk_array['user_role'], $token_junk_array['old_time']) = explode(" ", base64_decode(rtrim($user_data, '=')));
            return $token_junk_array;
        }

        function validate_token($token)
        {
            global $role_array;
            $toke_junk_array = array();
            $token_array = $this->parse_token($token);
            $response_array = array(
                                'return_code' => 0,
                                'return_message' => 'Invalid Token!'
                              );
            if($token_array['key'] == SECRET_KEY && in_array($token_array['user_role'], $role_array))
            {
                //if ((time() - $token_array['old_time']) <= VALIDITY_TIME)
                {
                    $response_array['return_code'] = 1;
                    $response_array['return_message'] = 'Token is valid';
                }
            }
            return $response_array;
        }

        // Return JSON response
        function json_response($response_array)
        {
            header('Content-Type: application/json');
            echo json_encode($response_array);
            exit();
        }

        function __destruct() {}

    }

    $token = new Token();
