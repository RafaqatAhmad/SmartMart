<?php 
session_start();
include("includes/config.php"); 
include("includes/common-function.php");
if((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) && 
(isset($_SESSION["type"])) && ($_SESSION["type"]== "A"))
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SmartMart</title>
    <?php include("includes/meta-tags-css.php"); ?>
</head>
<body>  
 
    <?php
    include("includes/header.php");
   
    ?>
   
   
<main>
    
<aside class="sidebar">
    <ul class="menu">
        <li>
        <p class="Intro-p">Welcome <?php echo getfullname();?> </p>
         <p id="mode-admin">Mode:<?php echo getUserType();?></p>
            <img src="./graphics/icons/dashbord.png" alt="icon" class="icon-img">
            <a href="admin.php">Dashboard</a>
            
        </li>
        <li>
        <img src="./graphics/icons/product.png" alt="icon" class="icon-img">
            <a href="products.php">Products</a>
        </li>
        <li>
        <img src="./graphics/icons/peoples.png" alt="icon" class="icon-img">
            <a href="customers.php">Users</a>
        </li>
        
        <li>
        <img src="./graphics/icons/update-admin-profile-icon.png" alt="icon" class="icon-img">
            <a href="admin-update-profile.php">Update Profile</a>
        </li>   

        <li>
        <img src="./graphics/icons/logoff.png" alt="icon" class="icon-img">
            <a href="logoff.php" id="logoff-btn">Logoff</a>
        </li>   
    </ul>
</aside>

    <form method="POST" enctype="multipart/form-data" action="add-product-action.php" id="add-product-form">
        <label>Name:</label>
        <input type="text" id="name" name="name"  placeholder="Enter Name" required >
        <label>Price:</label>
        <input type="number" id="price" name="price" placeholder="Enter Price" required >
        <label>Quantity:</label>
        <input type="number" id="quantity" name="quantity" placeholder="Enter Quantity" required>
        <label>Brand:</label>
        <input type="text" id="brand" name="brand" placeholder="Enter Brand Name" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Description" required></textarea>
        <label>Image:</label>
        <input type="file" id="image" name="image" accept="image/*"  required>
        <?php
        
                if(isset($_GET["message"])){
                    $message=sanitizeInput($_GET["message"]);
                    if($message=="?="){
                        echo"<p><strong>Product added successfully </strong>.</p>";
                    }

                }
                    ?>
        <button type="submit">Add Product</button>
    </form>

    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
</main>
</body>
</html>
<?php
}
else{
    header("Location: login.php?msg=UUAA");
    exit;
}
?>