<?php 
//index.php
include 'db_onn.php';
session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['user_name'])){
$name = $_SESSION['user_name'];
$query = "SELECT *,SUM(total) AS total FROM order_detail WHERE emp_name='$name' GROUP BY date";
$result = mysqli_query($conn,$query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ date:'".$row["date"]."', sales:".$row["total"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
}
?>


<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | How to use Morris.js chart with PHP & Mysql</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h3 align="center">Daily Total Sales</h3>   
   <h3  align="center">Employee Name:  <?php echo $_SESSION['user_name']; ?></h3>
   <div id="chart"></div>
   <center>
   <a href="report.php"><button type="button" class="btn btn-danger k btn-lg">Back</button></a>
   </center>
  </div>
 </body>
</html>

<script>
Morris.Line({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'date',
 ykeys:[ 'sales'],
 labels:[ 'Sales Rs.'],
 hideHover:'auto',
 stacked:true
});
</script>