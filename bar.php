<?php 
//index.php
include 'db_onn.php';
session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['user_name'])){
$name = $_SESSION['user_name'];
$query = "SELECT *,SUM(total) AS total FROM order_detail WHERE emp_name='$name' GROUP BY itemname";
$result = mysqli_query($conn, $query) or die("SQL Query Failed.");
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ name:'".$row["itemname"]."', sales:".$row["total"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
}
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Graphs</title>
  
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 class="text-center"></h2>
   <h3 class="text-center">Total Sales Of Product</h3>   
   <h3 class="text-center">Employee Name: <?php echo $_SESSION['user_name']; ?></h3>
   <br /><br />
   <div id="chart"></div>
  </div>

  <div class = "container">
  <button class = "btn btn-warning btn-sm"><a href = "report.php" style = "text-decoration: none; color: #333;">Back </a></button>
</div>

 </body>
</html>

<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'name',
 ykeys:['sales'],
 labels:['sales Rs.'],
 hideHover:'auto',
 stacked:true
});
</script>