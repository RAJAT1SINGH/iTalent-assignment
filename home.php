<?php
session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['user_name'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Hello, <?php echo $_SESSION['user_name']; ?></h1>
	<div>
	<a href="logout.php"><button>LOGOUT</button>
	<a href="order.php"><button> Make Order</button></a>
	<a href="report.php"><button> Sale's Report</button></a>
	</div>
</body>
</html>
<?php
}else{
	header("Location: index.php");
	exit();
}
?>