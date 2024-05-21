<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["id"]) && $_SESSION["id"] && isset($_SESSION["type"]) && $_SESSION["type"] == "U") {
    $user_id = $_SESSION["id"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];

        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $passwordQuery = mysqli_query($conn, "SELECT password FROM users WHERE id = '$user_id'");
        $row = mysqli_fetch_assoc($passwordQuery);
        $hashed_password = $row["password"];

        if (password_verify($current_password, $hashed_password)) {
            $updateQuery = mysqli_query($conn, "UPDATE users SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = '$user_id'");
            if (!empty($new_password)) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $updatePasswordQuery = mysqli_query($conn, "UPDATE users SET password = '$hashed_new_password' WHERE id = '$user_id'");
            }

            mysqli_close($conn);

            if ($updateQuery) {
                header("Location: user-profile.php?msg=ProfileUpdated");
                exit;
            } else {
                header("Location: user-profile.php?msg=Error");
                exit;
            }
        } else {
            header("Location: user-update-profile.php?msg=CurrentPasswordIncorrect");
            exit;
        }
    } else {
        header("Location: user-update-profile.php");
        exit;
    }
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
