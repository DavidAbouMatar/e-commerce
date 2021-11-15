<?php

	session_start();
	
	include("../config/connection.php");

	//check data posted if exists
	if(isset($_POST["product_id"]) && $_POST["product_id"] != ""){
		$product_id = $_POST["product_id"];
	

	}else{
		die("you cant hack it email ;)");
	}

	if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){
		$user_id= $_POST["user_id"];

	}else{
		die("you cant hack it lastname ;)");
	}
    if(isset($_POST["likes"]) && $_POST["likes"] != ""){
		$likes = $_POST["likes"];
	

	}else{
		$likes = NULL;
	}

	if(isset($_POST["number"]) && $_POST["number"] != ""){
		$number= $_POST["number"];
	

	}else{
		$number=NULL;
	}
    if(isset($_POST["cart_id"]) && $_POST["cart_id"] != ""){
		$cart_id= $_POST["cart_id"];
	

	}else{
		$cart_id=NULL;
	}

	
	



	$check = $connection->prepare("select * from add_to_cart where product_id = ? and user_id =? ");
	
	$check->bind_param("ss", $product_id, $user_id);
    $check->execute();
    $result= $check->get_result(); 
	$row = $result->fetch_assoc();
    
 
    if(!$row){
    
		$x = $connection->prepare("INSERT INTO add_to_cart (product_id,user_id, likes,number) VALUES (?, ?, ?, ?)");
		$x->bind_param("ssss", $product_id, $user_id, $likes,$number);
		$x->execute();
		$result = $x;
	
		if($result->affected_rows > 0){
			echo json_encode($row);
	}
	}else{
            
        $x = $connection->prepare("update add_to_cart set likes=?,number=? where cart_id=?");
        $x->bind_param("sss", $likes, $number, $cart_id);
        $x->execute();
        $result = $x;
		echo json_encode($row);

        //if query is executed seccefully affected_rows = 1 else its -1
  
	
}

	
	

?>