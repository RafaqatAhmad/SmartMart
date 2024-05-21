<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");
if(isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])){
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-86400,'/');
    }
        session_destroy();
    header("Location:login.php?msg=SLO");
}
    
else{
    header("Location:login.php");
    exit;
}
?>

