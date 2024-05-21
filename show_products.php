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
    <header>
        <?php include("includes/header.php"); ?>
    </header>
    <nav>
        <?php include("includes/nav-for-products&remove.php"); ?>
    </nav>
    <main>
        <h2>Show Products</h2>
        <div class="search-container">
            <input type="text" class="admin-search-bar" placeholder="Search by name">
            <button class="admin-cancel-search-button">Cancel</button>
        </div>
        <table class="product-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Image</th>
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
                </tr>
                <?php
            }
            ?>
        </table>
    </main>
    <?php include("includes/footer.php"); ?>
    <script src="js/admin-search-script.js"></script>
</body>
</html>
<?php
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
