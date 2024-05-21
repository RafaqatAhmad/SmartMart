<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
    (isset($_SESSION["type"])) && ($_SESSION["type"] == "U")
) {
    $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
    $user_id = $_SESSION["id"];
    $userQuery = mysqli_query($conn, "SELECT id, name, email, phone, address FROM users WHERE id = '$user_id'");
    $user = mysqli_fetch_assoc($userQuery);

    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Profile</title>
    <?php include("includes/meta-tags-css.php"); ?>
</head>
<body>
    <?php include("includes/header.php");
          include("includes/menu.php"); ?>

    <h2 id="user-update-profile-title">Update Profile</h2>
    
    <?php
    if (isset($_GET["msg"])) {
        if ($_GET["msg"] === "CurrentPasswordIncorrect") {
            echo '<p class="user-update-error-msg"><img src="./graphic/icons/error.png" alt="Error"> Current password is incorrect.</p>';
        } elseif ($_GET["msg"] === "Error") {
            echo '<p class="user-update-error-msg"><img src="./graphic/icons/error.png" alt="Error" > Error occurred while updating the profile.</p>';
        }
    }
    ?>
    
    <div class="user-update-form-container">
        <form action="user-update-action-profile.php" method="post">
            <label>Name:</label>
            <input type="text" id="user-update-name" name="name" placeholder="Enter new name" value="<?php echo $user['name']; ?> " required>
            
            <label>Email:</label>
            <input type="email" id="user-update-email" name="email"   placeholder="Enter new Email" value="<?php echo $user['email']; ?>" required>
            <label>Phone:</label>
            <input type="text" id="user-update-phone" name="phone"  placeholder="Enter new Phone Number" value="<?php echo $user['phone']; ?>" required>
            
            <label>Address:</label>
            <input type="text" id="user-update-address" name="address"  placeholder="Enter new Address" value="<?php echo $user['address']; ?>" required>
            
            <label>Current Password:</label>
            <input type="password" id="user-update-current_password" name="current_password"  placeholder="Enter current password (required if making changes)" required>
            
            <label>New Password:</label>
            <input type="password" id="user-update-new_password" name="new_password" placeholder="Enter new password (optional)" >
            
            <button type="submit">Update</button>
        </form>
    </div>
    <?php include("includes/footer.php");?> 
</body>

</html>
<?php
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
