<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
    (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")
) {
    if (isset($_GET["id"])) {
        $productId = $_GET["id"];
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $productQuery = mysqli_query($conn, "SELECT * FROM products WHERE id = '$productId'");
        $product = mysqli_fetch_assoc($productQuery);
        mysqli_close($conn);
    } else {
        header("Location: show-products.php");
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
    <?php include("includes/meta-tags-css.php"); ?>
    <title>Edit Product</title>
</head>
<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/nav-update-products.php"); ?>

    <div class="edit-container">
        <h2 class="edit-form-header">Update Product</h2>
        <?php if (isset($_GET["success"])) { ?>
            <div class="success-message">
                Record updated successfully!
            </div>
        <?php } ?>
        <div class="edit-form-container">
            <form class="edit-product-form" action="update-product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <label class="form-label">Name:</label>
                <input class="form-input" type="text" name="name" value="<?php echo $product['name']; ?>">
                <label class="form-label">Price:</label>
                <input class="form-input" type="number" name="price" value="<?php echo $product['price']; ?>">
                <label class="form-label">Quantity:</label>
                <input class="form-input" type="number" name="quantity" value="<?php echo $product['quantity']; ?>">
                <label class="form-label">Brand:</label>
                <input class="form-input" type="text" name="brand" value="<?php echo $product['brand']; ?>">
                <label class="form-label">Description:</label>
                <textarea class="form-input" name="description"><?php echo $product['description']; ?></textarea>
                <label class="form-label">Image:</label>
                <input class="form-input" type="file" name="image">
                <button class="form-button" type="submit">Update</button>
            </form>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>
