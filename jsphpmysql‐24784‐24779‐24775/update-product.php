<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
    (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")
) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $productId = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $brand = $_POST["brand"];
        $description = $_POST["description"];
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $image = $_FILES["image"]["name"];
            $tempFilePath = $_FILES["image"]["tmp_name"];
            $uploadPath = "uploads/" . $image;
            move_uploaded_file($tempFilePath, $uploadPath);

            $updateQuery = mysqli_query($conn, "UPDATE products SET name='$name', price='$price', quantity='$quantity', brand='$brand', description='$description', image='$image' WHERE id='$productId'");
        } else {
            $updateQuery = mysqli_query($conn, "UPDATE products SET name='$name', price='$price', quantity='$quantity', brand='$brand', description='$description' WHERE id='$productId'");
        }

        mysqli_close($conn);
        header("Location: edit-product.php?success=true");
        exit;
    } else {
        header("Location: edit-product.php");
        exit;
    }
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
