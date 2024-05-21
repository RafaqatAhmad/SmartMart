<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["id"]) && 
    $_SESSION["id"] && isset($_SESSION["type"]) && $_SESSION["type"] == "U") {
    $user_id = $_SESSION["id"];

    $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);

    mysqli_query($conn, "DELETE FROM selected_products WHERE user_id = '$user_id'");

    $deleteQuery = mysqli_query($conn, "DELETE FROM users WHERE id = '$user_id'");

    mysqli_close($conn);

    if ($deleteQuery) {
        session_unset();
        session_destroy();

        header("Location: login.php?msg=ACR");
        exit;
    } else {
        echo "Failed to remove the account.";
        exit;
    }
} else {
    header("Location: login.php?msg=UUAA");
    exit;
}
?>
