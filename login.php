<?php
session_start();
include("includes/config.php");
include("includes/common-function.php");
if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])) {
    header("Location:index.php");
} else {
    $email = "";
    if(isset($_COOKIE["email"])){
        $email = $_COOKIE["email"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <?php include("includes/meta-tags-css.php"); ?>  
</head>

<body>

<?php
    include("includes/header.php");
    include("includes/menu.php");
    ?>  

    <main>       
        <div class="main-div-page">
            <section class="section1-pg">
                <img src="./graphics/index-pic.jpg" alt="picture">
            </section>
            <section class="section2-pg">
                <?php
                if (isset($_GET["msg"])) {
                    $msg = sanitizeInput($_GET["msg"]);
                    if ($msg == "SLO") {
                        echo "<p><strong>Access denied </strong> Please Login.</p>";
                    } elseif ($msg == "LOF") {
                        echo "<p><strong>Logged off. </strong></p>";
                    } elseif ($msg == "UERR") {
                        echo "<p><strong>Warning: </strong>Access denied </p>";
                    } elseif ($msg == "SRA") {
                        echo "<p id=\"account-created-msg\"><strong>Account Successfully Registered </strong> Please Login.</p>";
                    } elseif ($msg == "IEA") {
                        echo "<p><strong>Failed. </strong> Incorrect email address.</p>";
                    } elseif ($msg == "IPW") {
                        echo "<p><strong>Incorrect password. </strong></p>";
                    } elseif ($msg == "ACR") {
                        echo "<p><strong>Account Removed Successfully. </strong></p>";
                    }elseif ($msg == "UUAA") {
                        echo "<p><strong>Unauthorised Access. </strong>please first login to access.</p>";
                    }
                    
                }
                ?>
                
                <form action="login-action.php" method="post">
                    <div class="form-div">
                        <div class="form-div1">
                            <p class="Form-p1">Login Account</p>
                            <p>If you haven't created an account, try to <a href="./signup.php" class="index-link">Create</a> it.</p>
                        </div>
                        <label><b>Email *</b></label>
                        <input type="email" value="<?php echo $email ?>" placeholder="Enter Email" name="em" required/><br>
                        <label><b>Password *</b></label>
                        <input type="password" placeholder="Enter Password" name="pwd" required/><br>
                        <?php
                        if (isset($_GET["msg"])) {
                            $msg = sanitizeInput($_GET["msg"]);
                        }
                        ?>
                        <button type="submit" class="submit">Login</button>
                    </div>
                </form>   
            </section>
        </div>        
    </main>
    <script src="./js/signup-msg.js"></script>
</body>
</html> 
<?php
}
?>
