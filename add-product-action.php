<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");
if((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) && 
(isset($_SESSION["type"])) && ($_SESSION["type"]== "A"))
{
?>
<?php
$conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
$name = $price = $quantity = $brand = $description = $image = "";
$errors = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $errors["name"] = "Name is required";
    } else {
        $name = sanitizeInput($_POST["name"]);
    }

    if (empty($_POST["price"])) {
        $errors["price"] = "Price is required";
    } else {
        $price = sanitizeInput($_POST["price"]);
    }

    if (empty($_POST["quantity"])) {
        $errors["quantity"] = "Quantity is required";
    } else {
        $quantity = sanitizeInput($_POST["quantity"]);
    }

    if (empty($_POST["brand"])) {
        $errors["brand"] = "Brand is required";
    } else {
        $brand = sanitizeInput($_POST["brand"]);
    }

    if (empty($_POST["description"])) {
        $errors["description"] = "Description is required";
    } else {
        $description = sanitizeInput($_POST["description"]);
    }
    if ($_FILES["image"]["error"] == 0) {
        $image = $_FILES["image"]["name"];
        $imageTmp = $_FILES["image"]["tmp_name"];
        $imageType = $_FILES["image"]["type"];
        $allowedTypes = array("image/jpeg", "image/png", "image/gif");
        if (!in_array($imageType, $allowedTypes)) {
            $errors["image"] = "Invalid image file format. Allowed formats: JPEG, PNG, GIF";
        }
    } else {
        $errors["image"] = "Please upload an image";
    }
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, quantity, brand, description, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $name, $price, $quantity, $brand, $description, $image);
        $uploadDirectory = "uploads/";
        $imagePath = $uploadDirectory . $image;
        if (move_uploaded_file($imageTmp, $imagePath)) {
            if ($stmt->execute()) {
                $message = "Product added successfully";
                header("Location: add-product.php?message=". urlencode($message));
                exit();
            } else {
                header("Location: add-product.php?message=". urlencode($message));
                $message = "Failed to add product";
            }
        } else {
            header("Location: add-product.php?message=". urlencode($message));
            $message = "Failed to upload image";
        }
        $stmt->close();
    } else {
        header("Location: add-product.php?message=". urlencode($message));
        $message1 = "Form was not submitted";
    }
}
mysqli_close($conn);
?>

<?php
}
else{
    header("Location: login.php?msg=UUAA");
    exit;
}
?>