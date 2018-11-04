<?php
include('../api/config/app_config.php');

$response_array['return_message'] = 'Invalid Action!';
$response_array['return_code'] = 0;

$request_method = $_SERVER["REQUEST_METHOD"];
$table_name = 'user_info';

if($request_method == 'POST')
{
    $action_data = $_GET['action'];

    switch ($action_data) {
        case "toggle_status":
        {
            $response_array['return_message'] = 'Failed to toggle status of the user!';

            $column_array = array();
            $column_array = array(
                'is_active' => ($_GET['is_active'] == "1") ? "0" : "1",
            );
            // retieve merchant based on user_id
            $user_id = $_GET['user_id'];
            $where_condition = null;
            if($user_id)
            {
                $where_condition = 'user_id= '.$user_id;
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
        case "all_users" :
        {
            $response_array['return_message'] = 'Failed to retrieve users!';
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
        case "load_user_accepted_deals":
        {
            // retieve merchant based on user_id
            $user_id = $_GET['user_id'];
            $where_condition = null;
            if($user_id)
            {
                $query = "SELECT a.*, b.user_id, m.business_name, u.first_name, u.last_name, b.qrcode_string, b.is_redeemed, b.is_wished";
                $query .= " FROM deal_info a, user_deals b, merchant_info m, user_info u WHERE b.deal_id = a.deal_id ";
                $query .= " AND (b.is_redeemed <> 1 or is_redeemed is null) AND b.user_id = u.user_id and a.merchant_id = m.merchant_id ";
                $query .= " AND (b.is_wished <> 1 or is_wished is null) AND b.user_id = ".$user_id;
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
            }
            break;
        }
        case "load_user_redeemed_deals":
        {
            // retieve merchant based on user_id
            $user_id = $_GET['user_id'];
            $where_condition = null;
            if($user_id)
            {
                $query = "SELECT a.*, m.business_name, u.first_name, u.last_name, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
                $query .= " FROM deal_info a, user_deals b, merchant_info m, user_info u WHERE b.deal_id = a.deal_id AND ";
                $query .= " b.is_redeemed = 1 AND b.user_id = u.user_id and a.merchant_id = m.merchant_id AND b.user_id = ".$user_id;
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
            }
            break;
        }
        case "load_user_wished_deals":
        {
            // retieve merchant based on user_id
            $user_id = $_GET['user_id'];
            $where_condition = null;
            if($user_id)
            {
                $query = "SELECT a.*, m.business_name, u.first_name, u.last_name, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
                $query .= " FROM deal_info a, user_deals b, merchant_info m, user_info u WHERE b.deal_id = a.deal_id AND ";
                $query .= " b.is_wished = 1 AND b.user_id = u.user_id and a.merchant_id = m.merchant_id AND b.user_id = ".$user_id;
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
            }
            break;
        }
        default:
        {
            $response_array['return_message'] = 'Failed to retrieve categories!';
            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get($table_name);

            // retieve merchant based on user_id                   
            $user_id = $_GET['user_id'];
            $where_condition = null;
            if($user_id)
            {
                $where_condition = 'user_id= '.$user_id;
                $response_array = $db->get($table_name, $where_condition);
            }
            break;
        }
    }

}
    
$token->json_response($response_array);
