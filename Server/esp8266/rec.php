<?php 

    $lines = file("myFile.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $data = array_map(function($v){
        list($temp, $humidity) = explode(" ", $v);
        return ["Temp" => $temp, "Humidity" => $humidity];
    }, $lines);

   
?>

<table width="200" border="1">
    <tr>
        <td width="85">Temperature</td>
        <td width="99">Humidity</td>
    </tr>
<?php foreach($data as $user){ ?>
    <tr>
        <td height="119"><?php echo $user["Temp"]; ?></td>
        <td><?php echo $user["Humidity"]; ?></td>
    </tr>
<?php } ?>
</table>