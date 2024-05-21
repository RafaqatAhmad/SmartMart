<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");
if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
    (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")
) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $productId = $_GET['id'];
        $productQuery = mysqli_query($conn, "SELECT * FROM products WHERE id = $productId");
        $product = mysqli_fetch_assoc($productQuery);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>SmartMart - Product Details</title>
            <?php include("includes/meta-tags-css.php"); ?>
        </head>
        <body>
            <?php include("includes/header.php"); 
              include("includes/nav-for-admin.php"); 
              ?>

            <h2 id="show-users">Product Details</h2>
            <table id="user-details-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['brand']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image"></td>

                </tr>
            
            </table>
            <?php include("includes/footer.php");?> 
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
