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
<p class="Intro-p">Welcome <?php echo getfullname();?> </p>
    <p id="mode-admin">Mode: <?php echo getUserType();?></p>
    <ul class="menu">
    
        <li>
            
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
            <a href="view-admin-profile.php">Update Profile</a>
        </li>   

        <li>
        <img src="./graphics/icons/logoff.png" alt="icon" class="icon-img">
            <a href="logoff.php" id="logoff-btn">Logoff</a>
        </li>   
        
    </ul>
</aside>
         <div class="crud-div">
            <div >
            <a href="add-product.php" class="crud-div-links">   
            <img src="./graphics/icons/add.png" alt ="picure" class="icon3-img">
                <p class="crud-p">Add</p>
               </a>
            </div>
            <div>
            <a href="remove-products.php" class="crud-div-links">
            <img src="./graphics/icons/remove.png" alt ="picure" class="icon3-img">
            <p class="crud-p">Remove</p>
            </a>
            </div>  
                
          
            
            </div>
            <div class="crud-div">
            <div >
            <a href="show_products.php" class="crud-div-links">   
            <img src="./graphics/icons/show-product.png" alt ="picure" class="icon3-img">
                <p class="crud-p">Show Product</p>
               </a>
            </div>
           
                <div>
                <a href="edit-product.php" class="crud-div-links">
                <img src="./graphics/icons/update.png" alt ="picure" class="icon3-img">
                <p class="crud-p">update</p>
                    </a>
               
            </div>
            
            </div>
            
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