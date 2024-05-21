<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");
function deleteUser($userId, $conn) {
    $userId = mysqli_real_escape_string($conn, $userId);
    $deleteQuery = mysqli_query($conn, "DELETE FROM users WHERE id = $userId");
    if ($deleteQuery) {
        return true;
    } else {
        return false;
    }
}

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
    (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")
) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $userId = $_GET['id'];
        $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
        $user = mysqli_fetch_assoc($userQuery);

        if (!$user) {
            echo "User not found.";
            mysqli_close($conn);
            exit;
        }
        $isAdmin = ($_SESSION["type"] == "A");

        if (isset($_POST['delete']) && !$isAdmin) {
            if (deleteUser($userId, $conn)) {
                $message = "User deleted successfully.";
            } else {
                $message = "Failed to delete user.";
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>SmartMart - User Details</title>
            <?php include("includes/meta-tags-css.php"); ?>
        </head>
        <body>
            <?php include("includes/header.php");
                 include("includes/nav-for-admin.php"); 
             ?>

            <h2 id="show-users">User Details</h2>
            <table id="user-details-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <?php if (!$isAdmin): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                </tr>
            </table>
            <?php
            if (isset($message)) {
                echo "<p>$message</p>";
            }
            ?>
             <?php include("includes/footer.php"); ?>           
        </body>
        </html>
        <?php
        mysqli_close($conn);
        exit;
    }
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
