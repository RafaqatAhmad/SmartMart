<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] &&
 isset($_SESSION["id"]) && $_SESSION["id"] && isset($_SESSION["type"]) && $_SESSION["type"] == "U") {
    $user_id = $_SESSION["id"];

    if (isset($_POST["add_to_cart"]) && isset($_POST["product_id"])) {
        $product_id = $_POST["product_id"];

        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $productQuery = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'");
        $product = mysqli_fetch_assoc($productQuery);

        if (!$product) {
            $_SESSION["add_to_cart_message"] = "Product not found.";
            mysqli_close($conn);
            header("Location: show-products.php");
            exit;
        }
        $stmt = mysqli_prepare($conn, "SELECT * FROM selected_products WHERE user_id = ? AND product_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION["add_to_cart_message"] = "This item is already in your cart.";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: user-show-products.php");
            exit;
        }
        $stmt = mysqli_prepare($conn, "INSERT INTO selected_products (user_id, product_id, product_name, product_price, product_quantity, product_brand, product_description, product_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iisdisss", $user_id, $product_id, $product["name"], $product["price"], $product["quantity"], $product["brand"], $product["description"], $product["image"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        $_SESSION["add_to_cart_message"] = "Product added to cart successfully.";
        header("Location: user-show-products.php");
        exit;
    } else {
        header("Location: user-show-products.php");
        exit;
    }
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
