<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["id"]) &&
 $_SESSION["id"] && isset($_SESSION["type"]) && $_SESSION["type"] == "U") {
    if (isset($_GET["product_id"])) {
        $product_id = $_GET["product_id"];
        $user_id = $_SESSION["id"];

        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $stmt = mysqli_prepare($conn, "DELETE FROM selected_products WHERE user_id = ? AND product_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        $_SESSION["remove_cart_message"] = "Product removed from the cart.";
    }
}

header("Location: user-cart.php");
exit;
?>
