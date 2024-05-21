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

    $successMessage = isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : "";
    unset($_SESSION['successMessage']);
    $errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : "";
    unset($_SESSION['errorMessage']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/meta-tags-css.php"); ?>
    <title>Show Products</title>
</head>
<body>
<?php 
    include("includes/header.php");
    include("includes/nav-for-products&remove.php"); 
?>

<h2 id="h2-remove-product">Remove Products:</h2>
<?php if (!empty($successMessage)) { ?>
    <div class="success-message"><?php echo $successMessage; ?></div>
<?php } ?>
<?php if (!empty($errorMessage)) { ?>
    <div class="error-message"><?php echo $errorMessage; ?></div>
<?php } ?>

<div class="remove-table-container">
    <table class="remove-product-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        while ($product = mysqli_fetch_assoc($productQuery)) {
            ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image"></td>
                <td>
                    <form action="delete-product.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="remove-btns">Remove</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

<?php 
    include("includes/footer.php");
?>
</body>
</html>

<?php
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
