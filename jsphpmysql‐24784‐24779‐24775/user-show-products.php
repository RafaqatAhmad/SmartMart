<!DOCTYPE html>
<html lang="en">
<head>
    <title>SmartMart</title>
    <?php include("includes/meta-tags-css.php");?>
</head>
<body>  
    <?php
    session_start();
    include("includes/config.php");
    include("includes/common-function.php");

    if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
        (isset($_SESSION["type"])) && ($_SESSION["type"] == "U")
    ) {
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $productQuery = mysqli_query($conn, "SELECT * FROM products");
        mysqli_close($conn);
    ?>

    <?php include("includes/header.php"); ?>
    <?php include("includes/menu.php"); ?>
    <hr>
    <main>
        <h2 id="show-product">All Products</h2>
        <?php
        if (isset($_SESSION["add_to_cart_message"])) {
            $add_to_cart_message = $_SESSION["add_to_cart_message"];
            unset($_SESSION["add_to_cart_message"]);
        }
        ?>
        <div class="search-container">
            <input type="text" id="search-bar" placeholder="Search product by name">
            <button id="cancel-search-button">Cancel</button>
        </div>
        <?php
        if (isset($add_to_cart_message)) {
            echo '<p class="success-message">' . $add_to_cart_message . '</p>';
        }
        ?>
        <div class="table-container">
            <table class="product-table">
                <tr>
                    
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
                    <tr class="product-row">
                       
                        <td class="product-name"><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td><?php echo $product['brand']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image"></td>
                        <td>
                            <form action="add-cart-action.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="add_to_cart" class="user-edit-button">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </main>

    <?php include("includes/footer.php"); ?>
    <script src="./js/search-script.js"></script>
    <?php
    } else {
        header("Location: login.php?msg=UUAA");
        exit;
    }
    ?>
</body>
</html>
