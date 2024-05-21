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
<body id="admin-bdy">  
 
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

<?php
                $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
                $userCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS totalUsers FROM users");
                $userCount = mysqli_fetch_assoc($userCountQuery)['totalUsers'];    
                $productCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS totalProducts FROM products");
                $productCount = mysqli_fetch_assoc($productCountQuery)['totalProducts'];
                mysqli_close($conn);
                ?>    
         <div class="admin-crud-div">
            <div class="total-users">
                <div>
                <img src="./graphics/icons/total-users.png" alt ="picure" class="icon2-img">
                <p class="users-product-count-p">User Count: <?php echo $userCount; ?></p>
                </div>
            </div>
            <div id="total-product">
                <div>
             <img src="./graphics/icons/total-products.png" alt ="picure" class="icon2-img">
             <p class="users-product-count-p">Product Count: <?php echo $productCount; ?></p>
             </div>
            </div>  
            </div>



            <div id="table-calss">
    <h2 id="user-section-h2">User Section</h2>
            <table class="admin-tables-scetions">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Details</th>
        </tr>
        <?php
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $usersQuery = mysqli_query($conn, "SELECT * FROM users LIMIT 5");

        while ($user = mysqli_fetch_assoc($usersQuery)) {
            echo '<tr>';
            echo '<td>' . $user['id'] . '</td>';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            echo '<td><a class="details-link" href="user-details.php?id=' . $user['id'] . '">Details</a></td>';
            echo '</tr>';
        }

        mysqli_close($conn);
        ?>
    </table>

            </div>
 <h2 id="product-section-h2">Product Section</h2>
    <table class="admin-tables-scetions">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Details</th>
        </tr>
        <?php
        
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $productsQuery = mysqli_query($conn, "SELECT * FROM products LIMIT 5");
        while ($product = mysqli_fetch_assoc($productsQuery)) {
            echo '<tr>';
            echo '<td>' . $product['id'] . '</td>';
            echo '<td>' . $product['name'] . '</td>';
            echo '<td>' . $product['price'] . '</td>';
            echo '<td><a class="details-link" href="product-details.php?id=' . $product['id'] . '">Details</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    

</main>
</body>
</html>
<?php
}
else{
    header("Location: login.php?msg=UUAA");
    exit;
}


