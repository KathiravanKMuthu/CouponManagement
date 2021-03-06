<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include('config/app_config.php');
include('uploadImage.php');

$request_method = $_SERVER["REQUEST_METHOD"];
if($request_method == 'POST')
{
    $post_data = json_decode(file_get_contents('php://input'), true);
    $action = trim_input($post_data['action']);
    $user_role = trim_input($post_data['role']);
    $table_name = "user_info";

    switch ($action)
    {
        case "social_login": // Signup + Signin using social login id
        {
            $email = trim_input($post_data['mem_email']);
            $social_login_id = trim_input($post_data['social_login_id']);

            // Validate the input
            $req_field_array = array('mem_email', 'social_login_id');
            $response_array = form_validation($req_field_array, $post_data);
            if($response_array['return_code'] > 0)
            {
                // Where condition to check if user exists
                $where_condition = "email = '".$email."'";

                // Checking duplicate entries
                $response_array = $db->get($table_name, $where_condition);

                /* If user exists Update the user last login information */
                if($response_array['return_code'] > 0)
                {
                    $user_id = $response_array['return_message'][0]['user_id'];
                    $update_column_array = array(
                                        'first_name' => trim($post_data['first_name']),
                                        'email' => $email,
                                        'social_login_id' => trim_input($post_data['social_login_id']),
                                        'social_login_partner' => trim_input($post_data['social_login_partner']),
                                        'is_social_login' => 1,
                                        'image' => trim_input($post_data['image']),
                                        'last_login_time' => time(),
                                        'login_status' => 1
                                       );

                    $dup_where_condition = 'user_id= '.$user_id;
                    $response_array = $db->update($table_name, $update_column_array, $dup_where_condition);

                    if($response_array['return_code'] > 0)
                    {
                        $tkn = $token->create_token($user_id, $user_role);
                        $response_array['token'] = $tkn;
                    }
                }
                else { // if user doesn't exist create it
                    $insert_column_array = array(
                                        'first_name' => trim($post_data['first_name']),
                                        'email' => $email,
                                        'social_login_id' => trim_input($post_data['social_login_id']),
                                        'social_login_partner' => trim_input($post_data['social_login_partner']),
                                        'is_social_login' => 1,
                                        'image' => trim_input($post_data['image']),
                                        'last_login_time' => time(),
                                        'login_status' => 1
                                       );

                    $response_array = $db->insert($table_name, $insert_column_array);

                    /*if($response_array['return_code'] > 0)
                    {
                        // Create token for newly created users
                        $where_condition = "email = '".$email."'";
                        $response_array = $db->get($table_name, $where_condition);
                        $response_array["GET"] = $response_array;

                        if($response_array['return_code'] > 0)
                        {
                            $user_id = $response_array['return_message'][0]['user_id'];
                            $tkn = $token->create_token($user_id, $user_role);
                            $response_array['token'] = $tkn;
                        }
                    }*/
                }
            }
            break;
        }
        case "get_token": // Signup + Signin using social login id
        {
            $email = trim_input($post_data['mem_email']);
            $social_login_id = trim_input($post_data['social_login_id']);

            // Validate the input
            $req_field_array = array('mem_email', 'social_login_id');
            $response_array = form_validation($req_field_array, $post_data);
            if($response_array['return_code'] > 0)
            {
                // Where condition to check if user exists
                $where_condition = "email = '".$email."' AND social_login_id = '" .$social_login_id. "'";

                // Checking duplicate entries
                $response_array = $db->get($table_name, $where_condition);

                /* If user exists Update the user last login information */
                if($response_array['return_code'] > 0)
                {
                    $user_id = $response_array['return_message'][0]['user_id'];
                    $update_column_array = array('last_login_time' => time(), 'login_status' => 1);

                    $dup_where_condition = 'user_id= '.$user_id;
                    $response_array = $db->update($table_name, $update_column_array, $dup_where_condition);

                    if($response_array['return_code'] > 0)
                    {
                        $tkn = $token->create_token($user_id, $user_role);
                        $response_array['token'] = $tkn;
                    }
                }
            }
            break;
        }
        case "upload_image": // Signup + Signin using social login id
        {
            $user_id = 0;
            $response_array['return_code'] = 0;
            $response_array['return_message'] = 'Invalid User!';
            $tkn = trim($post_data['token']);
            $response_array = $token->validate_token($tkn);
            /* Validate the Token  */
            if($response_array['return_code'] > 0)
            {
                $tkn_array = $token->parse_token($tkn);
                $user_id = $tkn_array['user_id'];
                // Validate the input
                $image_data = $post_data['image'];
                try {
                  $decoded_file = base64_decode($image_data);
                  //$mime_type = finfo_buffer(finfo_open(), $decoded_file, FILEINFO_MIME_TYPE);
                  $extension = 'png'; //mime2ext($mime_type);
                  $file = $user_id .'.'. $extension;
                  $file_dir = "../images/users/" . $file;
                  file_put_contents($file_dir, $decoded_file); // Save the file

                  // Where condition to check if user exists
                  $where_condition = "user_id = ".$user_id;
                  // Checking if user exists in the system
                  $response_array = $db->get($table_name, $where_condition);

                  /* If user exists Update the user last login information */
                  if($response_array['return_code'] > 0)
                  {
                      $update_column_array = array('image' => "images/users/". $file);
                      $response_array = $db->update($table_name, $update_column_array, $where_condition);
                      if($response_array['return_code'] > 0) {
                          $response_array['return_message'] = "images/users/". $file;
                      }
                  }
                } catch (Exception $e) {
                    $response_array['return_message'] = json_encode($e->getMessage());
                }
            }
            break;
        }
        default:
        {
            $response_array['return_code'] = 0;
            $response_array['return_message'] = 'Invalid Operation!';
            break;
        }
    }
}

/*Print the JSON Output*/
$token->json_response($response_array);

?>
