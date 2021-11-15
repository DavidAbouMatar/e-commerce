<?php

include("../config/connection.php");

if(isset($_POST["store"]) && $_POST["store"] != ""){
    $store = $_POST["store"];


}else{
    die("you cant hack it email ;)");
}

if(isset($_POST["product_name"]) && $_POST["product_name"] != ""){
    $product_namme= $_POST["product_name"];

}else{
    die("you cant hack it lastname ;)");
}

if(isset($_POST["price"]) && $_POST["price"] != ""){

    $price= $_POST["price"];
}else{

    die("you cant hack it pass:)");
}

if(isset($_POST["description"]) && $_POST["description"] != ""){
    $description = $_POST["description"];

}else{
    die("you cant hack it email;)");
}

$targetDir = "../uploads/";
$temp = $_FILES["file"]["tmp_name"];
$image = basename($_FILES["file"]["name"]);
$img = $targetDir.$image;
move_uploaded_file($temp, $img);
// echo "$img";
$img2 = substr($img, 3);

$x = $connection->prepare("INSERT INTO products (product_name,image, price,product_description, store_id) VALUES (?, ?, ? , ?, ?)");
	
$x->bind_param("sssss", $product_namme, $img2, $price, $description, $store);

$x->execute();
$result = $x;

//if query is executed seccefully affected_rows = 1 else its -1
if($result->affected_rows > 0){
    $x->close();
    $connection->close();
    header("Location:../dashboard.php?success=image been uploadeds");
}else{
    print_r($result);
    $x->close();
    $connection->close();
    // header("Location:../dashboard.php?error=Email already exists!");
}

?>