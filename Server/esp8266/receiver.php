<?php
$var1 = $_GET{'apples'};
$var2 = $_GET{'oranges'};

$fileContent =$var1." ".$var2."\n";
file_put_contents('myFile.txt',$fileContent,FILE_APPEND);



echo "SUCCESS";

?>