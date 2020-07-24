<?php


if(isset($_GET['temp']) &&  isset($_GET['humidity']) && isset($_GET['moisture']) && isset($_GET['waterLevel']) && isset($_GET['sunlight']) ){
$var1 = $_GET['temp'];
$var2 = $_GET['humidity'];
$var3 = $_GET['moisture'];
$var4 = $_GET['waterLevel'];
$var5 = $_GET['sunlight'];

$t=gmdate('Y-m-d h:i:s', time());
echo $var1;
}

{
    $motor = file("motor.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    echo "motor:".$motor[0];
   
   
}



if(isset($var1) && isset($var2) &&  isset($var3) &&  isset($var4) &&  isset($var5)){


$fileContent =$t." ".$var1." ".$var2." ".$var3." ".$var4." ".$var5."\n";
file_put_contents('myFile.txt',$fileContent,FILE_APPEND);
echo $var1;
if($var1 > 45 ){
   
    
    $response = sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode($return);
    
    $data = json_decode($response, true);
    //print_r($data);
    $id = $data['id'];
   // print_r($id);

    //print("\n\nJSON received:\n");
    //print($return);
    //print("\n");
}
}


 function sendMessage() {
        $content      = array(
            "en" => 'High Temperature!'
        );
        $hashes_array = array();
       
       
        $fields = array(
            'app_id' => "f2fb301c-f6dc-416a-beb9-3d79f43074b8",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'web_buttons' => $hashes_array
        );
        
        $fields = json_encode($fields);
        //print("\nJSON sent:\n");
        //print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic YjI0ZWU2NzctYjFkNy00MmFkLTkyNjYtZmUzOTU2NTZmNjRi'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }


?>