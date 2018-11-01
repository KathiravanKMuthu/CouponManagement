<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include('config/app_config.php');
$table_name = 'category';
$request_method = $_SERVER["REQUEST_METHOD"];

$response_array['return_code'] = '0';
$response_array['return_message'] = 'Invalid Request';

if($request_method == 'GET')
{
    $response_array = $db->get($table_name);
}
/*Print the JSON Output*/
echo json_encode($response_array);
?>
