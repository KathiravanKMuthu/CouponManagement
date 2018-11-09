<?php
include('../api/config/app_config.php');

$image_dir = "images/Merchant/"; //TODO: Append Merchant's name and id here
$response_array['return_message'] = 'Invalid Action!';
$response_array['return_code'] = 0;

$request_method = $_SERVER["REQUEST_METHOD"];
$table_name = 'deal_info';

if($request_method == 'POST')
{
    $action_data = $_POST['action'];

    if(empty($_GET) && empty($_POST)){
        $post_data = json_decode(file_get_contents('php://input'), true);
        $action_data = $post_data['action'];
    }

    switch ($action_data) {
        case "add_parent_deal" :
        {
            $response_array['return_message'] = 'Adding a Deal is failed!';

            $insert_column_array = array();
            /* Check required fields */
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
                    $response_array['return_message'] = 'Duplicate Deal Details!';
                    $response_array['return_code'] = 0;
                }
            }
            break;
        }
        case "delete_deal":
        {
            $response_array['return_message'] = 'Failed to delete merchant details!';

            // retieve merchant based on deal_id
            $deal_id = $post_data['deal_id'];
            $where_condition = null;
            if($deal_id)
            {
                $column_array = array(
                    'is_active' => ($post_data['is_active'] == "1") ? "0" : "1",
                );
                $where_condition = 'deal_id= '.$deal_id;
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
        case "all_deals" :
        {
            $response_array['return_message'] = 'Failed to retrieve deal details!';
            $query = "SELECT a.merchant_email, a.business_name, b.* FROM merchant_info a, deal_info b WHERE a.merchant_id = b.merchant_id";
            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get_by_query($query);

            $data = [];
            
            if($response_array["return_code"] == 1) {
                $data = $response_array["return_message"];
            }

            $response_array = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData"=>$data);
            break;
        }
        case "load_parent_deals" :
        {
            $response_array['return_message'] = 'Failed to retrieve deal details!';
            $query = "SELECT a.merchant_email, a.business_name, b.* FROM merchant_info a, deal_info b WHERE a.merchant_id = b.merchant_id AND b.parent_deal_id = 0";
            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get_by_query($query);

            $data = [];
            
            if($response_array["return_code"] == 1) {
                $data = $response_array["return_message"];
            }

            $response_array = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData"=>$data);
            break;
        }
        case "load_child_deals" :
        {
            $response_array['return_message'] = 'Failed to retrieve deal details!';
            $parent_deal_id = $_GET["deal_id"];

            $query = "SELECT a.merchant_email, a.business_name, b.* FROM merchant_info a, deal_info b ";
            $query .= "WHERE a.merchant_id = b.merchant_id AND b.parent_deal_id = " . $parent_deal_id;
            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get_by_query($query);

            $data = [];
            
            if($response_array["return_code"] == 1) {
                $data = $response_array["return_message"];
            }

            $response_array = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData"=>$data);
            break;
        }
       /* case "delete_deal":
        {
            $response_array['return_message'] = 'Failed to delete deal details!';

            // retieve merchant based on merchant_id
            $deal_id = $_GET['deal_id'];
            $where_condition = null;
            $response_array['deal_id'] = $deal_id;

            if($deal_id > 0)
            {
                $where_condition = 'deal_id= '.$deal_id;
                $response_array['where_condition'] = $where_condition;
                $response_array = $db->delete($table_name, $where_condition);
            }           
            break;
        }*/
        case "load_user_accepted_deals":
        {
            $response_array['return_message'] = 'Failed to delete deal details!';

            $query = "SELECT a.*, m.business_name, u.first_name, u.last_name, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
            $query .= " FROM deal_info a, user_deals b, merchant_info m, user_info u WHERE b.deal_id = a.deal_id ";
            $query .= " AND (b.is_redeemed <> 1 or is_redeemed is null)";
            $query .= " AND (b.is_wished <> 1 or is_wished is null) AND b.user_id = u.user_id and a.merchant_id = m.merchant_id";
            $response_array = $db->get_by_query($query);

            $data = [];

            if($response_array["return_code"] == 1) {
                $data = $response_array["return_message"];
            }

            $response_array = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData"=>$data);

            break;
        }
        case "load_user_redeemed_deals":
        {
            $response_array['return_message'] = 'Failed to delete deal details!';

            // retieve merchant based on user_id
            $query = "SELECT a.*, m.business_name, u.first_name, u.last_name, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
            $query .= " FROM deal_info a, user_deals b, merchant_info m, user_info u WHERE b.deal_id = a.deal_id AND ";
            $query .= " b.is_redeemed = 1 AND b.user_id = u.user_id and a.merchant_id = m.merchant_id ";
            $response_array = $db->get_by_query($query);

            $data = [];
            if($response_array["return_code"] == 1) {
                $data = $response_array["return_message"];
            }
            $response_array = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData"=>$data);

            break;
        }
        default:
        {
            // retieve deal based on deal_id
            $deal_id = $_GET['deal_id'];
            $where_condition = null;
            if($deal_id)
            {
                $where_condition = 'deal_id= '.$deal_id;
                $response_array = $db->get($table_name, $where_condition);
            }
            break;
        }
    }

}
    
$token->json_response($response_array);
