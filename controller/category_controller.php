<?php
include('../api/config/app_config.php');

$response_array['return_message'] = 'Invalid Action!';
$response_array['return_code'] = 0;

$request_method = $_SERVER["REQUEST_METHOD"];
$table_name = 'category';

if($request_method == 'POST')
{
    $action_data = $_POST['action'];

    switch ($action_data) {
        case "add_category" :
        {
            $response_array['return_message'] = 'Adding a Category is failed!';

            $insert_column_array = array();


            $category_id = $_POST['category_id'];
            $category_name = $_POST['category_name'];
            
            $insert_column_array = array(
                'category_name' => $category_name
                );

            if(empty($category_id))
            {
                $insert_column_array = array(
                    'category_name' => $category_name,
                    );

                $response_array = $db->insert($table_name, $insert_column_array);
            }
            else {
                $where_condition = 'category_id= '.$category_id;
                $response_array = $db->update($table_name, $insert_column_array, $where_condition);
                $response_array['return_message'] = 'Sucessfully updated the category!';
            }
            break;
        }
        case "delete_category":
        {
            $response_array['return_message'] = 'Failed to delete category!';

            // retieve merchant based on category_id
            $category_id = $_GET['category_id'];
            $where_condition = null;
            if($category_id)
            {
                $where_condition = 'category_id= '.$category_id;
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
        case "delete_category":
        {
            $response_array['return_message'] = 'Failed to delete category!';

            // retieve merchant based on category_id
            $category_id = $_GET['category_id'];
            $where_condition = null;
            if($category_id)
            {
                $where_condition = 'category_id= '.$category_id;
                $response_array = $db->delete($table_name, $where_condition);
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
