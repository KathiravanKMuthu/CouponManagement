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
    $where_condition = " end_date > DATE(NOW()) AND"; // this is required for all queries.

    switch ($action_data) {
        case "user" : // load all child deals for a given parent deal id
        {
            $user_id = $_GET['user_id'];

            $query = "SELECT a.*, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
            $query .= " FROM deal_info a, user_deals b WHERE b.deal_id = a.deal_id AND b.user_id = ".$user_id;
            $response_array = $db->get_by_query($query);

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
                $image_arr[] = substr_replace($image, $root . $parts[1] . "/", 0, strpos($image, "../")+3);
            }

            $response_array["return_code"] = "1";
            $response_array["return_message"] = $image_arr;
            break;
        }
        case "expire":
        {
            $where_condition = ' end_date > NOW() AND end_date <= DATE_ADD(NOW(), INTERVAL 5 DAY) AND parent_deal_id = 0';
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
elseif($request_method == 'POST')
{
    $table_name = "user_deals";
    $post_data = json_decode(file_get_contents('php://input'), true);
    $post_data_count = count($post_data);
    $req_field_array = array('user_id', 'deal_id', 'qrcode_string');
    $response_array = form_validation($req_field_array, $post_data);
    if($response_array['return_code'] > 0)
    {
        extract($post_data);
        $insert_column_array = array(
                            'user_id' => trim($user_id),
                            'deal_id' => trim($deal_id),
                            'qrcode_string' => trim($qrcode_string)
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
}

/*Print the JSON Output*/
echo json_encode($response_array);
?>
