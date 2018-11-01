<?php
/*
to take encoded files as a parameter,decoded,save as a file,and return json message
*/

function upload_file($encoded_string, $target_dir, $image_name) {
    $response_array = array(
                      'return_code' => 0,
                      'return_message' => 'No Record Found!'
                    );
    try {
        $decoded_file = base64_decode($encoded_string); // decode the file
        //$mime_type = finfo_buffer(finfo_open(), $decoded_file, FILEINFO_MIME_TYPE); // extract mime type
        $extension = 'png';//mime2ext($mime_type); // extract extension from mime type
        $file = $image_name .'.'. $extension; // rename file as a unique name
        $file_dir = $target_dir . $file;

        file_put_contents($file_dir, $decoded_file); // save
        $response_array['return_code'] = 1;
        $response_array['return_message'] = $file;
    } catch (Exception $e) {
        $response_array['return_message'] = json_encode($e->getMessage());
    }
    return $response_array;
}

function mime2ext($mime) {
    $all_mimes = '{"png":["image\/png","image\/x-png"],"bmp":["image\/bmp","image\/x-bmp",
    "image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp",
    "image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp",
    "application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg",
    "image\/pjpeg"]';
    $all_mimes = json_decode($all_mimes,true);
    foreach ($all_mimes as $key => $value) {
        if(array_search($mime,$value) !== false) return $key;
    }
    return false;
}

?>
