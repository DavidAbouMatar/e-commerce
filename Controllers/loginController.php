<?php
	session_start();
	
	include("../config/connection.php");

	// check if sessions exist sent from signup page if exists use session
	if(isset($_SESSION['email']) && isset($_SESSION['password'])){
	
		$password = $_SESSION['password'];
		$email = $_SESSION['email'];

	}else{

		// if sessions doesnt exists use $_POST values
		if(isset($_POST["password"]) && $_POST["password"] != ""){
			
			$password = hash('sha256', $_POST['password']);

		}else{
			
			die("you cant hack it password ;)");
		}

		if(isset($_POST["email"]) && $_POST["email"] != ""){
			$email = $_POST["email"];

		}else{
			die("you cant hack it email;)");
		}
	}




	$x = $connection->prepare("SELECT * FROM  users WHERE email = ? AND  password = ?");
	
	$x->bind_param("ss", $email, $password);
	
	$x->execute();
	$result= $x->get_result(); 
	$row = $result->fetch_assoc();
	print_r($row);
;
	// 0 for users 1 for sellers 
	//in the database email is unique if ro is empty then email exists
	if($row){
		if($row['role'] == 0){
			$_SESSION['id'] = $row['id'];
			$x->close();
		$connection->close();
			
			header("Location:../index.php");
		}else{
			$_SESSION['admin'] =  $row['id'];
			$x->close();
			$connection->close();
			
			header("Location:../dashboard.php");}

	}else{
		$x->close();
		$connection->close();
		header("Location:../login.php?error=Wrong email or password");

	}
	
	



	
	

?>