<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) &&
    (isset($_SESSION["type"])) && ($_SESSION["type"] == "A")
) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $productId = $_POST["id"];
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $deleteQuery = mysqli_query($conn, "DELETE FROM products WHERE id = '$productId'");
        
        if ($deleteQuery) {
            $_SESSION['successMessage'] = "Product removed successfully!";
        } else {
            $_SESSION['errorMessage'] = "Failed to remove the product. Please try again.";
        }
        
        mysqli_close($conn);
        header("Location: remove-products.php");
        exit;
    } else {
        header("Location: remove-products.php");
        exit;
    }
} else 
{
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
