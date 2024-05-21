<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if ((isset($_SESSION["loggedin"])) && ($_SESSION["loggedin"]) && 
(isset($_SESSION["type"])) && ($_SESSION["type"] == "A")) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adminId = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = $_POST["password"];

        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', password='$hashedPassword' WHERE id='$adminId' AND type='A'";
        $result = mysqli_query($conn, $updateQuery);
        mysqli_close($conn);

        if ($result) {
            header("Location: view-admin-profile.php?message=updated");
            exit;
        } else {
            header("Location: view-admin-profile.php?error=update_failed");
            exit;
        }
    } else {
        header("Location: view-admin-profile.php");
        exit;
    }
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
