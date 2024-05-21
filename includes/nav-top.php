<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("includes/config.php");
$hideMenu = false;

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    $hideMenu = false;
} else {
    $currentPage = basename($_SERVER["PHP_SELF"]);
    if ($currentPage === "login.php" || $currentPage === "signup.php") {
        $hideMenu = true;
    } else {
        $hideMenu = false; 
    }
}
?>
<section class="sidebar">
    <ul class="menu">
    
    <p class="Intro-p">Welcome <?php echo getfullname();?> </p>
   
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
        <p id="mode-admin">Mode: <?php echo getUserType();?></p>
    </ul>
</section>