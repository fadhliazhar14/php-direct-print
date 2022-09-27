<?php

// $data = array("printer" => "Canon iP2700 series", "content" => "12345");                                                                    
// $data_string = json_encode($data);                                                                                   
                                                                                                                     
// $ch = curl_init('http://ppuwebdev-40872.portmap.host:40872/direct-print/print/test.php');                                                                      
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);                                                                      
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
//     'Content-Type: application/json',                                                                                
//     'Content-Length: ' . strlen($data_string))                                                                       
// );                                                                                                                   
                                                                                                                     
// $result = curl_exec($ch);
chmod("c:/xampp/htdocs/direct-print/print/test.png", 0777);

echo "print /d:\\HP LaserJet 1020 c:\\xampp\\htdocs\\direct-print\\print\\test.png";
shell_exec("print /d:\\192.168.1.14\print-direct c:\\xampp\\htdocs\\direct-print\\print\\test.png");