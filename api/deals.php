<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include('config/app_config.php');
$table_name = 'deal_info';
$request_method = $_SERVER["REQUEST_METHOD"];

$response_array['return_code'] = '0';
$response_array['return_message'] = 'Invalid Request';

if($request_method == 'GET')
{
    $order_by = " end_date ASC";
    $action_data = $_GET['action'];
    $where_condition = " end_date > NOW() AND"; // this is required for all queries.

    switch ($action_data) {
        case "user" : // load all child deals for a given parent deal id
        {
            $response_array['return_code'] = 0;
            $response_array['return_message'] = 'Invalid User!';
            $tkn = trim($_GET['token']);
            $response_array = $token->validate_token($tkn);
            /* Validate the Token  */
            if($response_array['return_code'] > 0)
            {
                $tkn_array = $token->parse_token($tkn);
                $user_id = $tkn_array['user_id'];

                $query = "SELECT a.*, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
                $query .= " FROM deal_info a, user_deals b WHERE b.deal_id = a.deal_id AND b.user_id = ".$user_id;
                $response_array = $db->get_by_query($query);
            }
            break;
        }
        case "images":
        {
            $parent_deal_id = $_GET['parent_deal_id'];
            $where_condition = " deal_id = " . $parent_deal_id;
            $parent_row = $db->get($table_name, $where_condition);
            $record = json_encode($parent_row["return_message"][0]["image_dir"], false);

            $path_parts = pathinfo(json_decode($record));
            $dirname = $path_parts["dirname"];
            $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

            $images = glob(__DIR__ . "/../" . $dirname . "/*.*");
            $url = $_SERVER['REQUEST_URI']; //returns the current URL
            $parts = explode('/',$url);

            foreach($images as $image) {
                #$image_arr[] = substr_replace($image, $root . $parts[1] . "/", 0, strpos($image, "../")+3);
                $image_arr[] = substr_replace($image, $root . $parts[1] . "/" . $parts[2] . "/", 0, strpos($image, "../")+3); // for live
            }

            $response_array["return_code"] = "1";
            $response_array["return_message"] = $image_arr;
            break;
        }
        case "expire":
        {
            $where_condition = ' end_date > NOW() AND end_date <= DATE_ADD(NOW(), INTERVAL 7 DAY) AND parent_deal_id = 0';
            $response_array = $db->get($table_name, $where_condition, $order_by);
            break;
        }
        case "merchant" : // load all deals for a given Merchants
        {
            $response_array['return_code'] = 0;
            $response_array['return_message'] = 'Invalid Merchant!';
            $merchant_id = trim($_GET['merchant_id']);
            $query = "SELECT a.*, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
            $query .= " FROM deal_info a, user_deals b WHERE b.deal_id = a.deal_id AND a.merchant_id = ".$merchant_id;
            $response_array = $db->get_by_query($query);
            break;
        }
        case "all_and_expire":
        {
            $where_condition = ' 1=1';
            $response_array = $db->get($table_name, $where_condition, $order_by);
            break;
        }
        case "all":
        default:
        {
            $where_condition .= ' 1=1';
            $response_array = $db->get($table_name, $where_condition, $order_by);
            break;
        }
    }
}
elseif($request_method == 'POST') // Update user accepted deal info
{
    //$action_data = $_POST['action'];
    $table_name = "user_deals";
    $post_data = json_decode(file_get_contents('php://input'), true);
    $action_data = $post_data['action'];

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
    }

    switch ($action_data) {
        case "set_user_deal" : // load all child deals for a given parent deal id
        {
            if($user_id > 0) {

                $insert_column_array = array(
                                'user_id' => trim($user_id),
                                'deal_id' => trim($post_data['deal_id']),
                                'qrcode_string' => trim($post_data['qrcode_string']),
                                'is_wished' => $is_wished
                               );
                // Check if it is a duplicate entry
                $dup_where_condition = " user_id = ".$user_id." and deal_id = ".$deal_id;
                $response_array = $db->get($table_name, $dup_where_condition);

                $response_array['return_message'] = 'Already Accepted this deal!';
                if($response_array['return_code'] == 0 )
                {
                    $response_array = $db->insert($table_name, $insert_column_array);
                }
            }
            break;
        }
        case "set_wish_deal" :
        {
            $is_wished = $post_data['is_wished'] ? trim($post_data['is_wished']) : 0;
            $deal_id = trim($post_data['deal_id']);
            if($user_id > 0) {
                $update_column_array = array(
                                'user_id' => trim($user_id),
                                'deal_id' => $deal_id,
                                'is_wished' => $is_wished
                               );
                // Check if it is a duplicate entry
                $where_condition = " user_id = ".$user_id." and deal_id = ".$deal_id;
                $response_array = $db->get($table_name, $where_condition);

                if($response_array['return_code'] > 0) {
                    $response_array = $db->update($table_name, $update_column_array, $where_condition);
                }
                else {
                    $response_array = $db->insert($table_name, $update_column_array);
                }
            }
            break;
        }
        case "redeem_deal" :
        {
            $user_id = $post_data['user_id'] ? trim($post_data['user_id']) : 0;
            if($user_id > 0) {
                $update_column_array = array(
                                'user_id' => trim($user_id),
                                'deal_id' => trim($post_data['deal_id']),
                                'is_redeemed' => trim($post_data['is_redeemed'])
                               );
                // Check if it is a duplicate entry
                $where_condition = " user_id = ".$user_id." and deal_id = ".$deal_id;
                $response_array = $db->get($table_name, $where_condition);

                if($response_array['return_code'] > 0)
                {
                    $response_array = $db->update($table_name, $update_column_array, $where_condition);

                    //TODO: Increase the redeem count ????????????????????
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
echo json_encode($response_array);
?>
