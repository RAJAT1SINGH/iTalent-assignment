<?php
include 'db_onn.php';
session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['user_name'])){
	if(isset($_POST['confirm'])){
		$name = $_SESSION['user_name'];
		$item = $_POST['item'];
		$qty = $_POST['qty'];
		$price = $_POST['price'];
		$total = $_POST['total'];
	$query = "INSERT INTO `order_detail`(`order_id`, `emp_name`, `itemname`, `itemprice`, `quantity`, `total`) VALUES ('','$name','$item','$price','$qty','$total')";
	$result = mysqli_query($conn,$query);
	if($result){
		echo 'Order Confirmed';
	}else{
		echo 'Order Not Placed';
	}
	
	mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Order Food</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $.ajax({
      url : "load-item.php",
      type : "POST",
      dataType : "JSON",
      success : function(data){
        $.each(data, function(key, value){
          $("#item").append("<option value='" + value.itemname + "'>" + value.itemname + "</option>");
        });
      }
    });

    // Load Table Data
    $("#item").change(function(){
      var itemname = $(this).val();

      if(itemname == ""){
        $("#pri").html("");
      }else{
        $.ajax({
          url : "load-table.php",
          type : "POST",
          data : { itemname : itemname },
          success : function(data){
            $("#pri").html(data);
          }
        });
      }
    })
  });
</script>
<script type="text/javascript">
function mult(){
	price = parseInt(price.value);
	qty=parseInt(qty.value);
	mul = price*qty
	total.value = mul;
}

</script>
</head>
<body >
	<div class="container center">
		<div class="row justiy-content-center">
			<div class="col-lg-12 bg-light mt-5 p-4 rounded">
				<h4 class="text-center text-info">Order Your Food Here</h5><br>
				<h5>Employee Name:- <?php echo $_SESSION['user_name']; ?></h5><br>
				<form action="" method="POST">
					<div class="form-group">
						<label>Item Name</label>
						<select name="item" class="form-control form-control-lg" id="item">
							<option value="" disabled selected>-Select Food-</option>
							
						</select>
					</div>
					<div class="form-group">
						<label>Price/Piece</label>
						<table id="main" border="0" cellspacing="0">
						<tr >
						<td id="pri" name="pri"></td>
								</tr>
						</table>
					</div>
					<div class="form-group">
						<label>Enter Price</label>
						<input name="price" class="form-control form-control-lg cal" required id="price">
					</div>
					<div class="form-group">
						<label>Quantity</label><input name="qty" class="form-control form-control-lg cal" required id="qty">
					</div>
					
					<div class="form-group">
					<label>Total Amount</label>
					
					<input name="total" class="form-control form-control-lg" readonly id="total">'
					</div>
		
					<div class="form-group">
						<button type="button" class="btn btn-danger btn-block btn-lg"onclick="mult()">Genertae Bill</button>
					</div>
					<div class="form-group">
						<button type="submit" name="confirm" class="btn btn-danger btn-block btn-lg">Confirm Order</button>
					</div>
					<div class="form-group">
						<a href="home.php"><button type="submit" class="btn btn-danger btn-block btn-lg">Cancel</button></a>
					</div>
			</div>
		</div>
	</div>

</body>
</html>
}<?php
}else{
	header("Location: index.php");
	exit();
}
?>