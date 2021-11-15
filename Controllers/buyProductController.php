<?php

	session_start();
	
	include("../config/connection.php");

	//check data posted if exists


	if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){
		$user_id= $_POST["user_id"];

	}else{
		die("you cant hack it user;)");
	}

	if(isset($_POST["product_id"]) && $_POST["product_id"] != ""){
		$product_id = $_POST["product_id"];
	

	}else{
		die("you cant hack it peoduct  ;)");
	}

    if(isset($_POST["quantity"]) && $_POST["quantity"] != ""){
		$quantity = $_POST["quantity"];
	

	}else{
        die("you cant hack it quantity ;)");
	}

	if(isset($_POST["price"]) && $_POST["price"] != ""){
		$price= $_POST["price"];
	

	}else{
        die("you cant hack it price  ;)");
	}


	$price2 =$price * $quantity; 
	$date = date("Y/m/d");


    $x = $connection->prepare("INSERT INTO payments (product_id,user_id, quantity,amount_paid, created_at) VALUES (?, ?, ?, ?, ?)");
	
    $x->bind_param("sssss", $product_id, $user_id, $quantity, $price2,$date);
    
    $x->execute();
    $result = $x;
    
 
    if($result->affected_rows > 0){
		// $_SESSION['email'] = $email;
		// $_SESSION['password'] = $password;
	
	
		$x->close();
		$connection->close();
		header("Location:../index.php?success=purchased succesfully");
		}else{
			
		$x->close();
		$connection->close();
		header("Location:.//index.php?error=something went wrong try again later");
	}
    


	
	

?>