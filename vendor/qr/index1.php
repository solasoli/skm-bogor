<?php 
    
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;   

    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    $errorCorrectionLevel = 'H';

    $matrixPointSize = 10;

    $isidata = $_GET['data'];


    $filename = $PNG_TEMP_DIR.'test'.md5($isidata.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        

    QRcode::png($isidata, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
   
        
    //echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';  
$im = imagecreatefrompng($PNG_WEB_DIR.basename($filename));

header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);
?>