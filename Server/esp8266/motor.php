<?php
if(isset($_GET{'motor'}))
{
    echo $_GET{'motor'};
    file_put_contents('motor.txt',$_GET{'motor'});
}
?>