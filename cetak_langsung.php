<?php
/* contoh text */  
// $text = 'Eh, ini adalah testing aplikasi cetak teks langsung ke printer dengan PHP lhoo....';     
// $text = "1234567890";     
// /* tulis dan buka koneksi ke printer */    
// $printer = printer_open("Smart Label Printer 650");
// // Printer Mode 
// printer_set_option($printer, PRINTER_ORIENTATION_LANDSCAPE, "RAW");  
// /* write the text to the print job */  
// printer_write($printer, $text);   
// /* close the connection */ 
// printer_close($printer);

echo dirname(__FILE__)."<br>";
$path = dirname(__FILE__)."\print\\test.bmp";
echo $path;

// $im = imagecreatefrompng('C:\xampp\htdocs\direct-print\print\\test.png');
// $randomName = uniqid() . '.bmp';
// imagewbmp($im, $randomName);

$handle = printer_open("HP LaserJet 1020");
printer_start_doc($handle, "My Document");
printer_start_page($handle);

printer_draw_bmp($handle, $path, 0, 0);

printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);
?>