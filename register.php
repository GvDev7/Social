<!DOCTYPE html>
<?php
    require 'config/connection.php';
    require 'includes/form_handlers/registration_handlers.php';
    require 'includes/form_handlers/login_handlers.php';

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEV-World</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <?php
    if(isset($_POST['reg_button'])) {
        echo '
        <script>
        $(document).ready(function() {
            $(".first").hide();
            $(".second").show();
        });
        </script>
        ';
    }

    ?>
    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h1>DEV World</h1>
                <p>Signup or Login below!</p>
            </div>
            <div class="first">
                <form action="register.php" method="POST">
                    <input type="text" name="log_email" placeholder="Email Address" value="<?php 
                    if(isset($_SESSION['log_email'])){
                        echo $_SESSION['log_email'];
                    }?>" required>
                    <br/>
                    <input type="password" name="log_password" placeholder="Password">
                    <br/>
                    <input type="submit" name="log_button" value="Login">
                    <br/>
                    <?php
                    if(in_array("Email or Password was incorrect.<br/>" , $error_array))
                    echo "Email or Password was incorrect.<br/>";
                    ?>
                    <a href="#" id="signup" class="signup">Need an account? Register here!</a>
                </form>
            </div>

            <div class="second">
                <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
                    if(isset($_SESSION['reg_fname'])){
                        echo $_SESSION['reg_fname'];
                    }?>" required>
                    <br/>
                    <?php if(in_array("Your first name must be between 2 and 25 characters long.<br/>", $error_array))
                    echo "Your first name must be between 2 and 25 characters long.<br/>"; ?>
                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
                    if(isset($_SESSION['reg_lname'])) {
                        echo $_SESSION['reg_lname'];
                    }?>" required>
                    <br/>
                    <?php if(in_array("Your last name must be between 2 and 25 characters long.<br/>", $error_array))
                    echo "Your last name must be between 2 and 25 characters long.<br/>";?>
                    <input type="email" name="reg_email" placeholder="Email" value="<?php 
                    if(isset($_SESSION[ 'reg_email'])){
                        echo $_SESSION['reg_email'];
                    }
                    ?>" required>
                    <br/>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
                    if(isset($_SESSION['reg_email2'])) {
                        echo $_SESSION['reg_email2'];
                    }
                    ?>" required>
                    <br/>
                    <?php if(in_array("Invalid email format.<br/>" ,$error_array))
                    echo "Invalid email format.<br/>";
                    ?>
                    <?php if(in_array("Emails don't match.<br/>", $error_array)) 
                    echo "Emails don't match.<br/>";
                    ?>
                    <?php if(in_array("Email already exists!<br/>" ,$error_array)) 
                    echo "Email already exists!<br/>";
                    ?>
                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br/>
                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br/>
                    <?php if(in_array("Passwords don't match.<br/>" ,$error_array))
                    echo "Passwords don't match.<br/>";
                    ?>
                    <?php if(in_array("Your password can only contain english letters or numbers.<br/>", $error_array)) 
                    echo "Your password can only contain english letters or numbers.<br/>";
                    ?>
                    <?php if(in_array("Your password must be less than 30 characters long!<br/>" ,$error_array)) 
                    echo "Your password must be less than 30 characters long!<br/>";
                    ?>
                    <?php if(in_array("Your password must be at less 5 characters long!<br/>", $error_array)) 
                    echo  "Your password must be at least 5 characters long!<br/>";
                    ?>
                    <input type="submit" name="reg_button" value="Register">
                    <br/>
                    <?php if(in_array("<span style='color: #14C800;'>You're all set to login!</span><br/>", $error_array))
                    echo "<span style='color: #14C800;'>You're all set to login!</span><br/>";
                    ?>
                    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>