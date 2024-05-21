<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("includes/config.php");
$hideMenu = false;

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    $hideMenu = false; 
} else {
    $currentPage = basename($_SERVER["PHP_SELF"]);
    if ($currentPage === "login.php" || $currentPage === "signup.php") {
        $hideMenu = true; 
    } else {
        $hideMenu = false;
    }
}
?>

<nav>
    <ul class="navigation">
        <?php if (!$hideMenu) { ?>
            <li><a href="admin.php"> <img src="./graphics/icons/home.png" alt="icon" class="nav-icon-img">
</a></li>
            <li><a href="logoff.php"> <img src="./graphics/icons/logoff.png" alt="icon" class="nav-icon-img"></a></li>
        <?php } ?>
    </ul>
</nav>
