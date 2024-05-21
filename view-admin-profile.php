<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
 (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")) {
    $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);

    $adminQuery = mysqli_query($conn, "SELECT * FROM users WHERE type = 'A'");
    $admins = mysqli_fetch_all($adminQuery, MYSQLI_ASSOC);

    mysqli_close($conn);
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admins</title>
    <?php include("includes/meta-tags-css.php"); ?>
</head>
<body>
    <?php include("includes/header.php"); ?>
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

    <h2 id="Admin-profile">Admin</h2>

    <?php if (isset($admins)) { ?>
        <table id="Admin-table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php foreach ($admins as $admin) { ?>
                <tr>
                    <td><?php echo $admin["name"]; ?></td>
                    <td><?php echo $admin["email"]; ?></td>
                    <td><?php echo $admin["phone"]; ?></td>
                    <td><?php echo $admin["address"]; ?></td>
                    <td id="btn-admin"><a href="edit-admin-profile.php?id=<?php echo $admin['id']; ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

    
</body>
</html>
