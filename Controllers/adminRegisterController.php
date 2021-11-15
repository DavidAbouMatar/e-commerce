<?php
	session_start();
	
	include("../config/connection.php");

	
	//check data posted if exists
	if(isset($_POST["name"]) && $_POST["name"] != ""){
		$name = $_POST["name"];
	

	}else{
		die("you cant hack it email ;)");
	}

	if(isset($_POST["family_name"]) && $_POST["family_name"] != ""){
		$last_name= $_POST["family_name"];

	}else{
		die("you cant hack it lastname ;)");
	}

	if(isset($_POST["password"]) && $_POST["password"] != ""){

		$password = hash('sha256', $_POST['password']);
		$password1 =$_POST["password"];
	}else{
	
		die("you cant hack it pass:)");
	}

	if(isset($_POST["email"]) && $_POST["email"] != ""){
		$email = $_POST["email"];

	}else{
		die("you cant hack it email;)");
	}
	if(isset($_POST["birth_date"]) && $_POST["birth_date"] != ""){
		$birthdate = $_POST["birth_date"];

	}else{
		die("Dyou cant hack it birthday;)");
	}
	
	//role 1 as admin
	$role = 1;



	
	$x = $connection->prepare("INSERT INTO users (name,last_name, email,date_of_birth, role, password) VALUES (?, ?, ? , ?, ?, ?)");
	
	$x->bind_param("ssssss", $name, $last_name, $email, $birthdate, $role, $password);
	
	$x->execute();
	$result = $x;
	print_r($result);
	//if query is executed seccefully affected_rows = 1 else its -1
	if($result->affected_rows > 0){
	
		$x->close();
		$connection->close();
		header("Location:../adminregister.php?succes=new seller added");
		}else{
			
		$x->close();
		$connection->close();
		header("Location:../adminregister.php?error=Email already exists!");
	}

	
	

?>