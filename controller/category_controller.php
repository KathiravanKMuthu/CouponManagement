<?php
include('../api/config/app_config.php');

$image_dir = "images/category/";
$response_array['return_message'] = 'Invalid Action!';
$response_array['return_code'] = 0;

$request_method = $_SERVER["REQUEST_METHOD"];
$table_name = 'category';

if($request_method == 'POST')
{
    $action_data = $_POST['action'];

    if(empty($_GET) && empty($_POST)){
        $post_data = json_decode(file_get_contents('php://input'), true);
        $action_data = $post_data['action'];
    }

    switch ($action_data) {
        case "add_category" :
        {
            $response_array['return_message'] = 'Adding a Category is failed!';

            $column_array = array();
            $category_id = $_POST['category_id'];
            $category_name = $_POST['category_name'];

            $column_array = array(
                'category_name' => $category_name
            );

            if(!empty($_FILES['image_dir']['name']))
            {
                $uploadedFile = '';
                if(!empty($_FILES["image_dir"]["type"]))
                {
                    $valid_extensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                    $temporary = explode(".", $_FILES["image_dir"]["name"]);
                    $file_extension = end($temporary);
                    $image_dir = $image_dir . $token->change_camel_case($_POST['category_name']) . '.' . $file_extension;

                    if((($_FILES["image_dir"]["type"] == "image/png") || ($_FILES["image_dir"]["type"] == "image/jpg") || ($_FILES["image_dir"]["type"] == "image/jpeg"))
                          && in_array($file_extension, $valid_extensions))
                    {
                        $sourcePath = $_FILES['image_dir']['tmp_name'];
                        $column_array['image_file'] = $image_dir; // DB value
                        $upload_dir = "../" . $image_dir;
                        if(move_uploaded_file($sourcePath, $upload_dir)){
                            $uploadedFile = $image_dir;
                        }
                    }
                }
            }

            if(empty($category_id))
            {
                $response_array = $db->insert($table_name, $column_array);
            }
            else {
                $where_condition = 'category_id= '.$category_id;
                $response_array = $db->update($table_name, $column_array, $where_condition);
                $response_array['return_message'] = 'Sucessfully updated the category!';
            }
            break;
        }
        case "delete_category":
        {
            $response_array['return_message'] = 'Failed to toggle the status!';

            // retieve merchant based on category_id
            $category_id = $post_data['category_id'];
            $where_condition = null;
            if($category_id)
            {
                $column_array = array(
                    'is_active' => ($post_data['is_active'] == "1") ? "0" : "1"
                );

                $where_condition = 'category_id= '.$category_id;
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
        case "all_categories" :
        {
            $response_array['return_message'] = 'Failed to retrieve categories!';
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
        case "all_categories_for_dropdown" :
        {
            $response_array['return_message'] = 'Failed to retrieve category details!';
            $where_condition = 'is_active= 1';

            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get($table_name, $where_condition);
            break;
        }
        case "delete_category":
        {
            $response_array['return_message'] = 'Failed to toggle status!';

            // retieve merchant based on category_id
            $category_id = $_GET['category_id'];
            $where_condition = null;
            if($category_id)
            {
              $column_array = array(
                  'is_active' => ($post_data['is_active'] == "1") ? "0" : "1"
              );

              $where_condition = 'category_id= '.$category_id;
              $response_array = $db->update($table_name, $column_array, $where_condition);
            }
            break;
        }
        default:
        {
            $response_array['return_message'] = 'Failed to retrieve categories!';
            // Retrieve all merchant details for web / mobile applicaitons
            $response_array = $db->get($table_name);

            // retieve merchant based on category_id
            $category_id = $_GET['category_id'];
            $where_condition = null;
            if($category_id)
            {
                $where_condition = 'category_id= '.$category_id;
                $response_array = $db->get($table_name, $where_condition);
            }
            break;
        }
    }

}

$token->json_response($response_array);
