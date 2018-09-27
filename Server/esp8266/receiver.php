<?php
$var1 = $_GET{'temp'};
$var2 = $_GET{'humidity'};

$fileContent =$var1." ".$var2."\n";
file_put_contents('myFile.txt',$fileContent,FILE_APPEND);



echo "SUCCESS";

?>