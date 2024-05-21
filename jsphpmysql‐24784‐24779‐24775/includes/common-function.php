<?php
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function connect ($DBServer, $DBUser, $DBPass, $DBName){ 
    
    $c = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
    
    if($c->connect_error) {
        trigger_error('Database connection failed: ' .
        $c->connect_error, E_USER_ERROR);
    }
    return $c;
}   
function getfullname(){
            if(isset($_SESSION["nm"])){
                return($_SESSION["nm"]);
            }
            else{
                return "Guest";
            }
        }
function getUserType(){
    if(isset($_SESSION["type"])){
        if($_SESSION["type"]=="U"){
            return "User";
        }
        if($_SESSION["type"]=="A"){
            return "Admin";
        }
        else{
            return "Unauthorized User";
        }
    }
}
function fetchProductById($conn, $product_id) {
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        return $product;
    }

    return null;
}
function storeProductInCart($conn, $user_id, $product)
{
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $product_id = mysqli_real_escape_string($conn, $product['id']);
    $product_name = mysqli_real_escape_string($conn, $product['name']);
    $product_price = mysqli_real_escape_string($conn, $product['price']);
    $product_quantity = mysqli_real_escape_string($conn, $product['quantity']);
    $product_brand = mysqli_real_escape_string($conn, $product['brand']);
    $product_description = mysqli_real_escape_string($conn, $product['description']);
    $product_image = mysqli_real_escape_string($conn, $product['image']);

    $query = "INSERT INTO selected_products (user_id, product_id, product_name, product_price, product_quantity, product_brand, product_description, product_image) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_brand', '$product_description', '$product_image')";

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

function getProductById($conn, $product_id) {
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        return $product;
    }
    return null;
}

function addToCart($conn, $user_id, $product) {
    $product_id = $product['id'];
    $name = $product['name'];
    $price = $product['price'];
    $quantity = 1;

    $sql = "INSERT INTO selected_products (user_id, product_id, product_name, product_price, product_quantity) VALUES ('$user_id', '$product_id', '$name', '$price', '$quantity')";
    $result = mysqli_query($conn, $sql);

    return $result;
}
?>



