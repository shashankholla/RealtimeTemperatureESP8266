<?php 

    $lines = file("myFile.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $data = array_map(function($v){
        list($temp, $humidity) = explode(" ", $v);
        return ["Temp" => $temp, "Humidity" => $humidity];
    }, $lines);


     if(isset($_POST['request']) && !empty($_POST['request']))
    {
        echo json_encode($data);
      
    }
    
?>

