<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("Location:index.php");
} else {

    if (isset($_POST["nm"]) && isset($_POST["em"]) && isset($_POST["phn"]) && isset($_POST["addr"]) && isset($_POST["pwd"])) {
        $nm = sanitizeInput($_POST["nm"]);
        $em = sanitizeInput($_POST["em"]);
        $phn = sanitizeInput($_POST["phn"]);
        $addr = sanitizeInput($_POST["addr"]);
        $pwd = sanitizeInput($_POST["pwd"]);
        
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $checkEmailQuery = "SELECT email FROM users WHERE email = ?";
        $checkStmt = $conn->prepare($checkEmailQuery);
        $checkStmt->bind_param("s", $em);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $conn->close();
            header("Location: signup.php?msg1=EMAIL_IN_USE");
            exit;
            
        }
        $hpwd = password_hash($pwd, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, phone, address, password, type) VALUES (?, ?, ?, ?, ?, 'U')";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }
        $stmt->bind_param('sssss', $nm, $em, $phn, $addr, $hpwd);
        $stmt->execute();

        $conn->close();
        header("Location: login.php?msg=SRA");
        exit;
        
    } else {
        header("Location: login.php?msg=UERR");
        exit;
       
    }
}
