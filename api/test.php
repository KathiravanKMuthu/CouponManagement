<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include('config/app_config.php');

$request_method = $_SERVER["REQUEST_METHOD"];
$response_array['return_message'] = 'Success';
$response_array['return_code'] = '200';
if($request_method == 'POST')
{
    $post_data = json_decode(file_get_contents('php://input'), true);
    $Data = trim_input($post_data['ans']);
    $Name = trim_input($post_data['name']);
    $Id = trim_input($post_data['id']);

$File = "techexpo.txt";
$Handle = fopen($File, 'a');
fwrite($Handle, 'Name : ' . $Name .'; Id: ' . $Id . '; Ans: ' . $Data. PHP_EOL);
print "Data Written";
fclose($Handle);

}

/*Print the JSON Output*/
$token->json_response($response_array);

