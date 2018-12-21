<?php
include('../api/config/app_config.php');

$image_dir = "images/"; //TODO: Append Merchant's name and id here
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
            $allow_types = array('jpg','png','jpeg','JPG','PNG','JPEG');
            $image_dir = $image_dir . $token->change_camel_case($_POST['business_name']);

            if(!empty($_FILES['image_dir']['name'])) {
                $merchant_id = $_POST['merchant_id'];
                $insert_column_array = array(
                                    'merchant_id' => $merchant_id,
                                    'parent_deal_id' => 0,
                                    'title' => $_POST['title'],
                                    'deal_amount' => $_POST['deal_amount'],
                                    'currency' => $_POST['currency'],
                                    'actual_amount' => $_POST['actual_amount'],
                                    'start_date' => date('Y-m-d H:i', strtotime($_POST['start_date'])),
                                    'end_date' => date('Y-m-d H:i', strtotime($_POST['end_date'])),
                                    //'image_dir' => $image_dir . "/" . $_FILES['image_dir']['name'][0],
                                    'is_active' => $_POST['is_active'],
                                    'percentage' => $_POST['percentage'],
                                    'redemption_count' => 0,
                                    'description' => $_POST['description']
                                    );

                $response_array = $db->insert($table_name, $insert_column_array);

                if($response_array['return_code'] == 0) {
                    $response_array['return_message'] = 'Failed to add a deal!';
                    $response_array['return_code'] = 0;
                }
                else {
                    //$dup_where_condition = "merchant_id = '".$merchant_id."'";
                    //$response_array = $db->get($table_name, $dup_where_condition);

                    $deal_id = $response_array["inserted_id"];

                    if($deal_id > 0) {
                        $image_dir = $image_dir . '_' . $deal_id;
                        $updated_image_dir = "";

                        if (!file_exists("../" . $image_dir)) {
                            $response_array['image_dir'] = $image_dir;
                            mkdir("../" . $image_dir, 0777, true);
                        }

                        $images_arr = array();
                        foreach($_FILES['image_dir']['name'] as $key=>$val) {
                            $image_name = $_FILES['image_dir']['name'][$key];
                            $tmp_name   = $_FILES['image_dir']['tmp_name'][$key];
                            $type       = $_FILES['image_dir']['type'][$key];

                            $file_name = basename($image_name);
                            if($key == 0)
                                $updated_image_dir = $image_dir . "/" . $key . "_" . $file_name;
                            $targetFilePath = "../" . $image_dir . "/" . $key . "_" . $file_name;

                            $file_type = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                            if(in_array($file_type, $allow_types)){    
                                if(move_uploaded_file($tmp_name, $targetFilePath)){
                                    $images_arr[] = $targetFilePath;
                                }
                            }
                        }

                        $column_array = array(
                            'image_dir' => $updated_image_dir
                        );
                        $where_condition = 'deal_id= '. $deal_id;
                        $response_array = $db->update($table_name, $column_array, $where_condition);
                    } // deal_id is not empty
    
                }
            }
            break;
        }
        case "delete_deal":
        {
            $response_array['return_message'] = 'Failed to delete deal details!';

            // retieve deal based on deal_id
            $deal_id = $post_data['deal_id'];
            $where_condition = null;
            if($deal_id)
            {
                $column_array = array(
                    'is_active' => ($post_data['is_active'] == "1") ? "0" : "1"
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
            $query = "SELECT a.merchant_id, a.merchant_email, a.business_name, b.* FROM merchant_info a, deal_info b WHERE a.merchant_id = b.merchant_id AND b.parent_deal_id = 0";
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
