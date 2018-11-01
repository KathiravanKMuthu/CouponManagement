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

    switch ($action_data) {
        case "add_merchant" :
        {
            $response_array['return_message'] = 'Merchant Add is failed!';

            $insert_column_array = array();
            $req_field_array = array('merchant_email', 'password', 'business_name', 'phone_number', 'address1', 'country', 'operating_time');
            /* Check required fields */
            //$response_array = form_validation($req_field_array, $_POST);
            //if($response_array['return_code'] > 0)
            if(!empty($_FILES['image_dir']['name'])){
                $uploadedFile = '';
                if(!empty($_FILES["image_dir"]["type"])){
                    $fileName = $_POST['business_name'].'_'.time().'_'.$_FILES['image_dir']['name'];
                    $valid_extensions = array("jpeg", "jpg", "png");
                    $temporary = explode(".", $_FILES["image_dir"]["name"]);
                    $file_extension = end($temporary);
                    if((($_FILES["image_dir"]["type"] == "image/png") || ($_FILES["image_dir"]["type"] == "image/jpg") || ($_FILES["image_dir"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
                        $sourcePath = $_FILES['image_dir']['tmp_name'];
                        $image_dir = "../" . $image_dir . $fileName;
                        if(move_uploaded_file($sourcePath, $image_dir)){
                            $uploadedFile = $fileName;
                        }
                    }
                }

                $password = $_POST['password'];
                $email = $_POST['merchant_email'];
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
                                    'image_dir' => $image_dir,
                                    'website' => $_POST['website'],
                                    'facebook' => $_POST['facebook'],
                                    'youtube' => $_POST['youtube'],
                                    'instagram' => $_POST['instagram'],
                                    'operating_time' => $_POST['operating_time'],
                                    'description' => $_POST['description']
                                    );

                $dup_where_condition = "merchant_email = '".$email."'";
                $response_array = $db->get($table_name, $dup_where_condition);
                if($response_array['return_code'] == 0 )
                {
                    $response_array = $db->insert($table_name, $insert_column_array);
                }
                else {
                    $response_array['return_message'] = 'Duplicate Email Address!';
                    $response_array['return_code'] = 0;
                }
            }
            break;
        }
        case "delete_merchant":
        {
            $response_array['return_message'] = 'Failed to delete merchant details!';

            // retieve merchant based on merchant_id
            $merchant_id = $_GET['merchant_id'];
            $where_condition = null;
            if($merchant_id)
            {
                $where_condition = 'merchant_id= '.$merchant_id;
                $response_array = $db->delete($table_name, $where_condition);
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
        case "delete_merchant":
        {
            $response_array['return_message'] = 'Failed to delete merchant details!';

            // retieve merchant based on merchant_id
            $merchant_id = $_GET['merchant_id'];
            $where_condition = null;
            $response_array['merchant_id'] = $merchant_id;

            if($merchant_id > 0)
            {
                $where_condition = 'merchant_id= '.$merchant_id;
                $response_array['where_condition'] = $where_condition;
                $response_array = $db->delete($table_name, $where_condition);
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
