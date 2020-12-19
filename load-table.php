<?php

include 'db_onn.php';

$sql = "SELECT * FROM items WHERE itemname = '{$_POST['itemname']}'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

$output = "";

if(mysqli_num_rows($result) > 0 ){
  $output .= '<table border="0" width="100%"  cellpadding="10px">
             ';
  while($row = mysqli_fetch_assoc($result)){
    $output .= "
    
                  <td align='center'>{$row["itemprice"]}</td>
                  
                </tr>";
  }    
   $output .= "</table>";

   echo $output;
}else{
    echo "No Record Found.";
}
?>
