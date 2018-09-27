
<?php
    include 'data.php';
   

?>


<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!DOCTYPE html>
<html lang="en">
<head>

</head>

<body>
    
   <table>
      <thead>
        <tr>
          <th>Temperature</th>
          <th>Humidity</th>
         
        </tr>
      <thead>
      <tbody> 
          <?php $i = count($data)-1;?>
               <?php   for(; $i > 0; $i--){ ?>
                <?php $row = $data[$i]; ?>
                                 <tr class="row100 body">
                                    <td  class="cell100 column1"><?php echo $row["Temp"]; ?></td>
                                    <td class="cell100 column2"><?php echo $row["Humidity"]; ?></td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </thead>
                    </table>
</body>
</html>