<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && 
isset($_SESSION["id"]) && $_SESSION["id"] && isset($_SESSION["type"]) && $_SESSION["type"] == "U") {
    $user_id = $_SESSION["id"];
    $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);

    $stmt = mysqli_prepare($conn, "SELECT * FROM selected_products WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    ?>



<!DOCTYPE html>
        <html lang="en">
        <head>
            <title>SmartMart - User Details</title>
            <?php include("includes/meta-tags-css.php"); ?>
        </head>    
        <body>
            <?php include("includes/header.php");
             include("includes/menu.php");?>
    <main>
        
        <hr>
        <h2 id="show-users">Your Cart</h2>
        <?php
        if (isset($_SESSION["remove_cart_message"])) {
            echo '<p class="success-message">' . $_SESSION["remove_cart_message"] . '</p>';
            unset($_SESSION["remove_cart_message"]);
        }

        if (mysqli_num_rows($result) > 0) {
            echo '<table class="customer-cart">';
            echo '<tr>';
            echo '<th>Name</th>';
            echo '<th>Price</th>';
            echo '<th>Quantity</th>';
            echo '<th>Brand</th>';
            echo '<th>Image</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["product_name"] . '</td>';
                echo '<td>' . $row["product_price"] . '</td>';
                echo '<td>' . $row["product_quantity"] . '</td>';
                echo '<td>' . $row["product_brand"] . '</td>';
                echo '<td><img src="uploads/' . $row["product_image"] . '" alt="' . $row["product_name"] . '" class="product-image"></td>';
                echo '<td><a href="remove-cart-action.php?product_id=' . $row["product_id"] . '" class="user-edit-button">Remove</a></td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>Your cart is empty.</p>';
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
    </main>
    <?php include("includes/footer.php"); ?>           
        </body>
        </html>
    <?php
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
