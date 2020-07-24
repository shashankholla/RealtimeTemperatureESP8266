<?php 

    $lines = file("myFile.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $data = array_map(function($v){
        list($date,$time,$temp,$humidity,$moisture,$waterLevel, $sunlight) = explode(" ", $v);
        return ["Date" => $date, "Time" => $time, "Temp" => $temp, "Humidity" => $humidity, "Moisture" => $moisture, "waterLevel" => $waterLevel, "sunlight" => $sunlight ];
    }, $lines);

    
     if(isset($_POST['request']) && !empty($_POST['request']))
    {
        echo json_encode($data);
      
    }
    
?>

