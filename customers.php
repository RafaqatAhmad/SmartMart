<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");
function deleteUser($userId, $conn) {
    $userId = mysqli_real_escape_string($conn, $userId);
    mysqli_query($conn, "DELETE FROM selected_products WHERE user_id = $userId");
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
    $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
    $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE type = 'U'");

    if (isset($_POST['delete'])) {
        $userId = $_POST['userId'];
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
        <?php include("includes/header.php"); ?>

        <aside class="sidebar">
        <p class="Intro-p">Welcome <?php echo getfullname(); ?></p>
                <p id="mode-admin">Mode: <?php echo getUserType(); ?></p>
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

        <h2 id="show-users">User Details</h2>
        <table id="user-details-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php
            while ($user = mysqli_fetch_assoc($userQuery)) {
                ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        if (isset($message)) {
            echo "<p>$message</p>";
        }
        ?>
    </body>
    </html>

    <?php
    mysqli_close($conn);
    exit;
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
