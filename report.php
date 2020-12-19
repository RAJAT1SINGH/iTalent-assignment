<?php
session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['user_name'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>REPORT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<h1>Sales Report Of, <?php echo $_SESSION['user_name']; ?></h1>
	<div>
	<a href="logout.php"><button>LOGOUT</button>
	
	<a href="pie.php"><button>Prodcut Quantity Sales Pie Chart</button></a>
	<a href="line.php"><button>Daily Sales</button></a>
	<a href="bar.php"><button>Total Sales Of Product Bar</button></a>
	<a href="home.php"><button>Back</button></a>
	</div>
</body>
</html>
<?php
}else{
	header("Location: index.php");
	exit();
}
?>