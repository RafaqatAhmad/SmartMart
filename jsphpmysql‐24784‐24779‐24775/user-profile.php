<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] &&
 isset($_SESSION["id"]) && $_SESSION["id"] && isset($_SESSION["type"]) && $_SESSION["type"] == "U") {
    $user_id = $_SESSION["id"];

    $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);

    $userQuery = mysqli_query($conn, "SELECT id, name, email, phone, address FROM users WHERE id = '$user_id'");
    $user = mysqli_fetch_assoc($userQuery);

    mysqli_close($conn);

    if (!$user) {
        echo "User not found.";
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>User Profile</title>
        <?php include("includes/meta-tags-css.php"); ?>
    </head>
    <body>
        <?php include("includes/header.php"); 
          include("includes/menu.php");?>
<main>
        <h2 id="user-profile-title">User Profile</h2>
        <?php
        if (isset($_GET["msg"])) {
            if ($_GET["msg"] === "ProfileUpdated") {
                echo '<p class="success-msg">Profile updated successfully.</p>';
            }
        }
        ?>  
        <table class="user-profile-table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
                <th>Delete Account</th>
            </tr>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['address']; ?></td>
                <td> <a href="user-update-profile.php" class="user-edit-button">update</a></td>
                <td> <a href="removed-user-action.php" class="user-edit-button"> Delete </a></td>

            </tr>
        </table>
        </main>
        <?php include("includes/footer.php"); ?>
    </body>
    </html>
    <?php
    exit;
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
