<?php
include('../api/config/app_config.php');

$image_dir = "images/Merchant/"; //TODO: Append Merchant's name and id here
$response_array['return_message'] = 'Invalid Action!';
$response_array['return_code'] = 0;

$request_method = $_SERVER["REQUEST_METHOD"];
$table_name = 'merchant_info';

if($request_method == 'POST')
{
    $action_data = $_POST['action'];

    if(empty($_GET) && empty($_POST)){
        $post_data = json_decode(file_get_contents('php://input'), true);
        $action_data = $post_data['action'];
    }

    switch ($action_data) {
        case "add_merchant" :
        {
            $response_array['return_message'] = 'Adding a Merchant is failed!';

            $insert_column_array = array();
            if(!empty($_FILES['image_dir']['name'])) {
                $uploadedFile = '';
                if(!empty($_FILES["image_dir"]["type"])){
                    $image_dir = $image_dir . $_POST['business_name'].'_'.time().'_'.$_FILES['image_dir']['name'];
                    $valid_extensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                    $temporary = explode(".", $_FILES["image_dir"]["name"]);
                    $file_extension = end($temporary);
                    if((($_FILES["image_dir"]["type"] == "image/png") || ($_FILES["image_dir"]["type"] == "image/jpg") || ($_FILES["image_dir"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
                        $sourcePath = $_FILES['image_dir']['tmp_name'];
                        $upload_dir = "../" . $image_dir;
                        if(move_uploaded_file($sourcePath, $upload_dir)){
                            $uploadedFile = $image_dir;
                        }
                    }
                }

                $password = $_POST['password'];
                $email = $_POST['merchant_email'];
                $map_position = '{"latitude":' . $_POST['latitude'] . ', "longitude":' . $_POST['longitude'] . '}';
                $new_enc_password = base64_encode(base64_encode($password).'=');
                $insert_column_array = array(
                                    'merchant_email' => $email,
                                    'encrypted_password' => $new_enc_password,
                                    'business_name' => $_POST['business_name'],
                                    'phone_number' => $_POST['phone_number'],
                                    'address1' => $_POST['address1'],
                                    'address2' => $_POST['address2'],
                                    'state' => $_POST['state'],
                                    'country' => $_POST['country'],
                                    'postal_code' => $_POST['postal_code'],
                                    'image_dir' => $image_dir,
                                    'website' => $_POST['website'],
                                    'facebook' => $_POST['facebook'],
                                    'youtube' => $_POST['youtube'],
                                    'instagram' => $_POST['instagram'],
                                    'operating_time' => $_POST['operating_time'],
                                    'description' => $_POST['description'],
                                    'is_active' => $_POST['is_active'],
                                    'map_position' => $map_position,
                                    );

                $dup_where_condition = "merchant_email = '".$email."'";
                $response_array = $db->get($table_name, $dup_where_condition);
                if($response_array['return_code'] == 0 )
                {
                    $response_array = $db->insert($table_name, $insert_column_array);
                }
                else {
                    $response_array['return_message'] = 'Merchant Email already exists!';
                    $response_array['return_code'] = 0;
                }
            }
            break;
        }
        case "update_merchant" :
        {
            $response_array['return_message'] = 'Updating a Merchant is failed!';

            $insert_column_array = array();

            $password = $_POST['password'];
            $email = $_POST['merchant_email'];
            $map_position = '{"latitude":' . $_POST['latitude'] . ', "longitude":' . $_POST['longitude'] . '}';
            $new_enc_password = base64_encode(base64_encode($password).'=');
            $insert_column_array = array(
                                'encrypted_password' => $new_enc_password,
                                'business_name' => $_POST['business_name'],
                                'phone_number' => $_POST['phone_number'],
                                'address1' => $_POST['address1'],
                                'address2' => $_POST['address2'],
                                'state' => $_POST['state'],
                                'country' => $_POST['country'],
                                'postal_code' => $_POST['postal_code'],
                                'website' => $_POST['website'],
                                'facebook' => $_POST['facebook'],
                                'youtube' => $_POST['youtube'],
                                'instagram' => $_POST['instagram'],
                                'operating_time' => $_POST['operating_time'],
                                'description' => $_POST['description'],
                                'is_active' => $_POST['is_active'],
                                'map_position' => $map_position,
                    );

            if(!empty($_FILES['image_dir']['name'])) {
                $uploadedFile = '';
                if(!empty($_FILES["image_dir"]["type"])){
                    $image_dir = $image_dir . $_POST['business_name'].'_'.time().'_'.$_FILES['image_dir']['name'];
                    $valid_extensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                    $temporary = explode(".", $_FILES["image_dir"]["name"]);
                    $file_extension = end($temporary);

                    if((($_FILES["image_dir"]["type"] == "image/png") || ($_FILES["image_dir"]["type"] == "image/jpg") || ($_FILES["image_dir"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
                        $sourcePath = $_FILES['image_dir']['tmp_name'];
                        $insert_column_array['image_dir'] = $image_dir;
                        $upload_dir = "../" . $image_dir;
                        if(move_uploaded_file($sourcePath, $upload_dir)){
                            $uploadedFile = $image_dir;
                        }                    }
                }
            }

            $where_condition = "merchant_email = '".$email."'";
            $response_array = $db->get($table_name, $where_condition);
            if($response_array['return_code'] == 1)
            {
                $response_array = $db->update($table_name, $insert_column_array, $where_condition);
            }
            else {
                $response_array['return_message'] = "Merchant email doesn't exist!";
                $response_array['return_code'] = 0;
            }
            break;
        }
        case "delete_merchant":
        {
            $post_data = json_decode(file_get_contents('php://input'), true);

            $response_array['return_message'] = 'Failed to toggle status!';

            // retieve merchant based on merchant_id
            $merchant_id = $post_data['merchant_id'];
            $where_condition = null;
            if($merchant_id)
            {
                $column_array = array(
                    'is_active' => ($post_data['is_active'] == "1") ? "0" : "1",
                );
                $where_condition = 'merchant_id= '.$merchant_id;
                $response_array = $db->update($table_name, $column_array, $where_condition);
            }           
            break;
        }
        default:
        {
            break;
        }
    }
}
elseif($request_method == 'GET')
{
    $action_data = $_GET['action'];

    switch ($action_data) {
        case "all_merchants" :
        {
            $response_array['return_message'] = 'Failed to retrieve merchant details!';

            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get($table_name);

            $data = $response_array["return_message"];
            $response_array = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData"=>$data);
            break;
        }
        case "all_merchants_for_dropdown" :
        {
            $response_array['return_message'] = 'Failed to retrieve merchant details!';

            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get($table_name);
            break;
        }
        case "load_merchant":
        {
            $response_array['return_message'] = 'Failed to load merchant details!';

            // retieve merchant based on merchant_id
            $merchant_id = $_GET['merchant_id'];
            $where_condition = null;
            $response_array['merchant_id'] = $merchant_id;

            if($merchant_id > 0)
            {
                $where_condition = 'merchant_id= '.$merchant_id;
                $response_array['where_condition'] = $where_condition;
                $response_array = $db->get($table_name, $where_condition);

                if($response_array['return_code'] == 1) {
                    $record = $response_array['return_message'][0];
                    $password_str = base64_decode(base64_decode(rtrim($record["encrypted_password"],'=')));
                    $response_array['return_message'][0]["encrypted_password"] = $password_str;
                }
            }           
            break;
        }
        default:
        {
            // retieve merchant based on merchant_id
            $merchant_id = $_GET['merchant_id'];
            $where_condition = null;
            if($merchant_id)
            {
                $where_condition = 'merchant_id= '.$merchant_id;
                $response_array = $db->get($table_name, $where_condition);
            }
            break;
        }
    }

}
    
$token->json_response($response_array);
