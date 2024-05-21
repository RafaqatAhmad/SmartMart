<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
    (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")
) {
    $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
    $productQuery = mysqli_query($conn, "SELECT * FROM products");
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("includes/meta-tags-css.php"); ?>
    <title>Show Products</title>
</head>
<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/nav-for-products&remove.php"); ?>

    <h2 id="update-product-h2">Products</h2>
    <?php if (isset($_GET["success"]) && $_GET["success"] == "true") { ?>
        <div class="success-message">Record updated successfully!</div>
    <?php } ?>
    <div class="table-container">
        <table class="product-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            while ($product = mysqli_fetch_assoc($productQuery)) {
                ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['brand']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image"></td>
                    <td class="btns"><a href="edit-product-action.php?id=<?php echo $product['id']; ?>">Update</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>

<?php
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
