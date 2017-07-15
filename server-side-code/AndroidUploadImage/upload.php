<?php
/*!!! IMPORTANT !!!
Put your own <CLARIFAI_API_KEY> correctly*/


// Path to move uploaded files
$target_path = dirname(__FILE__).'/uploads/';
  
if (isset($_FILES['image']['name'])) {
    // $target_path = $target_path . basename($_FILES['image']['name']);
    $target_path = $target_path . 'image.jpg';
 
    try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // make error flag true
            echo json_encode(array('status'=>'fail', 'message'=>'could not move file'));
        } else {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://api.clarifai.com/v2/models/aaa03c23b3724a16a56b629203edc62c/outputs");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Key <CLARIFAI_API_KEY>',
            'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                        '{"inputs": [{"data": {"image": {"url": "http://54.149.29.68/AndroidUploadImage/uploads/image.jpg"}}}]}');

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec ($ch);
            $server_output = json_decode($server_output, true);

            $response = $server_output['outputs'][0]['data']['concepts'];

            curl_close ($ch);
            echo json_encode(array('status'=>'success', 'values' => $response));
            
        }
 
    } catch (Exception $e) {
        // Exception occurred. Make error flag true
        echo json_encode(array('status'=>'fail', 'message'=>$e->getMessage()));
    }
} else {
    // File parameter is missing
    echo json_encode(array('status'=>'fail', 'message'=>'Not received any file'));
}

?>
