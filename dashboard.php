<?php
session_start();
include("config/connection.php");
    if(isset($_SESSION['admin'])){
        $query = "Select * from stores";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $query2 = "Select * from products";
        $stmt2 = $connection->prepare($query2);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
    }else{
        header("Location:login.php?");
    }

?>

<!DOCTYPE html>

<head>
<meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashi | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="./Controllers/logoutController.php">Logout</a>
  </nav>
</div>
<div class="container">
<a  href="./adminregister.php" class="btn btn-primary btn-lg btn-block">Register a seller</a>
<div class="row mt-5">
    <div class="col-md-6 ">
          
    <h3> Add Product</h3>
    <form action="Controllers/upload.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
    <label for="store">Stores</label>
    <select class="form-control select2" style="width: 100%;" name="store" required >
    <option selected="selected" value="user_id">Select One</option>
    <?php
    
        while($row = $result->fetch_assoc()){
        
    ?>
    <option value=<?= $row["id"]; ?>><?= $row["store_name"]; ?></option>
    <?php
        }
    ?>
</select>
</div>
        
    <div class="form-group">
    <label for="name">Product name</label>
    <input name="product_name" type="text" class="form-control" id="name" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input name="price" type="text" class="form-control" id="price" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input name="description" type="text" class="form-control" id="description" required>
    </div>
    <div class="form-group">
        <label for="file">upload image</label>
        <input name="file" type="file" class="form-control" id="file" required>
    </div>
    

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <div class="col-md-6 ">
        <h3> Delete Product</h3>
        <form action="Controllers/delete.php" method="POST">
        <div class="form-group">
        <label for="product">Delete</label>
        <select class="form-control" style="width: 100%;" name="product" required >
        <option selected="selected" value="user_id">Select One</option>
        <?php
        
         while($row2 = $result2->fetch_assoc()){
          
    
           
        ?>
        <option value=<?= $row2["id"]; ?>><?= $row2["product_name"]; ?></option>
        <?php
            }
        ?>
    </select>
    </div>
        


    <button type="submit" class="btn btn-primary" style="background-color:red;">Delete</button>
</form>
 

                </div>
            </div>
        </div>

</body>
</html>