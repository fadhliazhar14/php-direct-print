<?php

error_reporting(0); 
ini_set('display_errors', 0);

if($_SERVER["REQUEST_METHOD"] == "POST") {

$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    
if (stripos($content_type, 'application/json') === false) {
    throw new Exception('Content-Type must be application/json');
}

// Read the input stream
$body = file_get_contents("php://input");
 
// Decode the JSON object
$object = json_decode($body, true);

// Throw an exception if decoding failed
if (!is_array($object)) {
    // throw new Exception('Failed to decode JSON object');
    $response = array(
        "status" => 404,
        "message" => "Failed to decode JSON object"
     );

    } else {
        // Printer Open
        $printing = printer_open($object["printer"]);
        // Printer Mode
        printer_set_option($printing, PRINTER_TITLE, "RAW");
        
        $content = base64_decode($object["content"]);
        
        base64ToImage($object["content"], "test.bmp");
        // Printer Do Print
        printer_write($printing, "test.png");
        // Printer Close
        printer_close($printing);

        $image = base64_decode($object["content"]);
        $image_name = md5(uniqid(rand(), true));
	    $filename = $image_name . '.' . 'png';
        $path = '/';
	    file_put_contents($path . $filename, $image);

        $cmd_cetak="print /d:\\".$object["printer"]." c:\\xampp\\htdocs\\direct-print\\print\\test.png";
        shell_exec($cmd_cetak);

        $response = array(
            "status" => 200,
            "message" => "Printing success"
        ); 
    }
}

header('Content-Type: application/json');
echo json_encode($response);

// Display the object
// print_r($object);       
// echo $object['printer'];
    
//     $count_req_body = count(array_intersect_key($_POST, $req_body));
//     global $err_msg;

//     if ($count_req_body == count($req_body)) {

//         // Printer Open
//         $printing = printer_open($_POST["printer"]);
//         // Printer Mode
//         // printer_set_option($printing, PRINTER_MODE, "RAW");
//         // Printer Do Print
//         $content = base64_decode($_POST["content"]);

//         printer_write($printing, $content);
//         // Printer Close
//         printer_close($printing);

//         $image_name = md5(uniqid(rand(), true));
// 	    $filename = $image_name . '.' . 'png';
//         $path = '/';
// 	    file_put_contents($path . $filename, $image);

//         $response = array(
//             "status" => 200,
//             "message" => "Printing success"
//         );   
//     } else {
//         $response = array(
//             "status" => 404,
//             "message" => "Parameter Do Not Match"
//          );
//     }
// } else {
//     $response = array(
//         "status" => 404,
//         "message" => "Request Failed"
//     );
// }

// header('Content-Type: application/json');
// echo json_encode($response);

function base64ToImage($base64String, $outputFile) {
    $file = fopen($outputFile, "w");
    $data = explode(',', $base64String);
    fwrite($file, base64_decode($data[1]));
    fclose($file);

    return $outputFile;
}