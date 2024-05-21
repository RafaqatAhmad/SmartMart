<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
 (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")) {
    if (isset($_GET["id"])) {
        $adminId = $_GET["id"];
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $adminQuery = mysqli_query($conn, "SELECT * FROM users WHERE id = '$adminId' AND type = 'A'");
        $admin = mysqli_fetch_assoc($adminQuery);
        mysqli_close($conn);
    } else {
        header("Location: admins.php");
        exit;
    }
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Admin</title>
    <?php include("includes/meta-tags-css.php"); ?>
</head>
<body>
    <main>
    <?php include("includes/header.php"); 
    include("includes/nav-for-update-admin.php"); 
   
    ?>

    <h2 class="admin-form-header">Update Admin</h2>
    <div class="form-container-edit-admin-profile">
        <form action="update-admin-profile.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $admin['name']; ?>">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $admin['email']; ?>">
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $admin['phone']; ?>">
            <label>Address:</label>
            <input type="text" name="address" value="<?php echo $admin['address']; ?>">
            <label>Password:</label>
            <input type="password" name="password" placeholder="Retain the current password if you prefer not to update it" required>
            <button type="submit">Update</button>
        </form>
    </div>
</main>
    <?php include("includes/footer.php"); ?>
</body>
</html>
