<?php
    session_start();
    include("includes/config.php"); 
    include("includes/common-function.php");
   
    if(isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])){
        header("Location:index.php");
        }
    else{
       
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
    <?php 
    include("includes/meta-tags-css.php");
     ?>
</head>
<body>
<?php
    include("includes/header.php");
    include("includes/menu.php");
    ?>
    <div class="main-div-page">
        <section class="section1-pg">
            <img src="./graphics/index_cover.png" alt="picture">
        </section>
        <section id ="signup-sec2id" class="section2-pg">
        <?php
                if(isset($_GET["msg1"])){
                    $msg1=sanitizeInput($_GET["msg1"]);
                    if($msg1=="EMAIL_IN_USE"){
                        echo"<p><strong>Email already in use. </strong> Try again with another email.</p>";
                    }
                   
                }
                ?>
       
                <form action="signup-action.php" method="post">
                    <div class="form-div">
                        <div class="form-div1">
                        <p class="Form-p1">Create Account</p>
                        <p>Create your account or Login, if you already have <a href="./login.php" class="index-link">Login</a>  it.</p>
                        
                    </div>
                    <label ><b>Name:</b></label>
                    <input type="text" placeholder="Enter Name" name="nm" class="signup-input"  required><br>
                    <label ><b>Email:</b></label>
                    <input type="email" placeholder="Enter Email"  name="em"  required/><br>
                    <label ><b>Phone:</b></label>
                    <input type="number" placeholder="Enter Phone No" id="signup-no"name="phn"  required><br>
                    <label ><b>Address:</b></label>
                    <input type="text" placeholder="Enter Address" name="addr" required><br>
                    <label><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" name="pwd"  required/><br>
          
                    <button type="submit" class="submit">Create Account</button>
                    </div>
                </form>   
        </section>
    </div>
</body>
</html>
<?php
}
    
?>