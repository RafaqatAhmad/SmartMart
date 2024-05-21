    <?php 
    session_start();
    include("includes/config.php"); 
    include("includes/common-function.php");
    if((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) && 
    (isset($_SESSION["type"])) && ($_SESSION["type"]== "U"))
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
        <div class="main-user-side-intro-paragraphs">
        <p> <strong>Welcome:</strong> <?php echo getfullname();?></p>
        <p><strong> Mode:</strong><?php echo getUserType();?></p>
        </div>
            <div class="crud-div">
                <div >
                <a href="user-show-products.php" class="crud-div-links">   
                <img src="./graphics/icons/user-product.png" alt="icon" class="icon3-img">
            
                    <p class="crud-p">Products</p>
                </a>
                </div>
                <div>
                <a href="user-cart.php" class="crud-div-links">
                <img src="./graphics/icons/cart-icon.png" alt ="picure" class="icon3-img">
                <p class="crud-p">Cart</p>
                </a>
                </div>  
                    
            
                
                </div>
                <div class="crud-div">
                <div >
                <a href="user-profile.php" class="crud-div-links">   
                <img src="./graphics/icons/view-user-profile-icon.png" alt ="picure" class="icon3-img">
                    <p class="crud-p">Profile</p>
                </a>
                </div>
            
                    <div>
                    <a href="logoff.php" class="crud-div-links">
                    <img src="./graphics/icons/logoff.png" alt ="picure" class="icon3-img">
                    <p class="crud-p">Logoff</p>
                        </a>
                
                </div>
                
                </div>
                
    </main>
    <?php 
                include("includes/footer.php");
                ?>
    </body>
   
    </html>
    <?php
    }
    else{
        header("Location: login.php?msg=UUAA");
        exit;
    }
    ?>