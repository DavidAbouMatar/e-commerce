<?php

include("../config/connection.php");

if(isset($_POST["product"]) && $_POST["product"] != ""){
    $product = $_POST["product"];


}else{
    die("you cant hack it email ;)");
}




$x = $connection->prepare("delete from products where id=?");
	
$x->bind_param("i", $product);

$x->execute();
$result = $x;

//if query is executed seccefully affected_rows = 1 else its -1
if($result->affected_rows > 0){
    $x->close();
    $connection->close();
    header("Location:../dashboard.php?success=row deleted");
}else{
    print_r($result);
    $x->close();
    $connection->close();
    // header("Location:../dashboard.php?error=Email already exists!");
}

?>