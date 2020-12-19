<?php
session_start();
include "db_onn.php";
	if(isset($_POST["name"]) && isset($_POST["password"])){
		function validate($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$name =  validate($_POST["name"]);
		$pwd =  validate($_POST["password"]);
		if(empty($name)){
			header("Location: index.php?error=User Name is required");
			exit();
		}else if(empty($pwd)){
			header("Location: index.php?error=Password is required");
			exit();
		}else{
			$sql = "SELECT * FROM employee WHERE user_name='$name' AND password='$pwd'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)===1){
				$row = mysqli_fetch_assoc($result);
				if($row['user_name']===$name && $row['password']===$pwd){
					$_SESSION['user_name']=$row['user_name'];
					$_SESSION['ID']=$row['ID'];
					header("Location: home.php");
					exit();
				}else{
					header("Location: index.php?error=Incorrect User name or password");
					exit();
				}
			}else{
					header("Location: index.php?error=Incorrect User name or password");
					exit();
				}
		}
	}else{
		header("Location: index.php");
		exit();
	}
?>