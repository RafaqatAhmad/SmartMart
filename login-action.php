<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("Location: index.php");
    exit;
} else {
    if (isset($_POST["em"]) && isset($_POST["pwd"])) {
        $em = sanitizeInput($_POST["em"]);
        $pwd = sanitizeInput($_POST["pwd"]);
        $conn = connect($dbserver, $dbusername, $dbpassword, $dbname);
        $sql = "SELECT * FROM users WHERE email = ?";
 
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        };
        $stmt->bind_param('s', $em);
        $stmt->execute();
        $stmt->store_result();

        $rc = $stmt->num_rows;
        if ($rc > 0) {
            $stmt->bind_result($id, $name, $email, $phone, $address, $hpwd, $type);
            $stmt->fetch();

            $matched = password_verify($pwd, $hpwd);
            if ($matched) {
                $_SESSION["loggedin"] = true;
                $_SESSION["type"] = $type;
                $_SESSION["nm"] = $name;
                $_SESSION["em"] = $email;
                $_SESSION["id"] = $id;
                setcookie("email", $email, time() + 60 * 60 * 24 * 30);
                

                if ($type === 'A') {
                    header("Location: admin.php");
                } else {
                    header("Location: user.php");
                }
                exit;
            } else {
                header("Location: login.php?msg=IPW");
                exit;
            }
        }
            $stmt->free_result();
            $stmt->close();
        } else {
            header("Location: login.php?msg=UUAA");
            exit;
        }

        $conn->close();
    }
header("Location: login.php?msg=IEA");
exit;
?>
