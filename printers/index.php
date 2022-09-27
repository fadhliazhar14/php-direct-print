<?php

if(function_exists($_GET['function'])) {
    $_GET['function']();
 } 

 function get_printers() {

    $getprt = printer_list(PRINTER_ENUM_LOCAL);
    $printers = serialize($getprt);
    $printers = unserialize($printers);
    $id = 1;

    foreach ($printers as $printer) {
        $data[] = array(
            "id" => $id,
            "printer" => $printer["NAME"]
        );

    $id++;
    }

    if (count($data) <= 0) {
        $response = array(
            "status" => 200,
            "message" => "No printer installed on this machine"
        );
    } else {
        $response = array(
            "status" => 200,
            "message" => "OK",
            "printer" => $data
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
 }