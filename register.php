<!DOCTYPE html>
<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "social");

    if(mysqli_connect_errno()){
        echo 'Error: Could not connect to MySql: '.mysqli_connect_error();
    }

    //Declare variables to prevent errors
    $fname = ''; //First Name
    $lname = ''; //Last Name
    $em = ''; //Email
    $em2 = ''; //Second Email
    $pw = ''; //Password
    $pw2 = ''; //Second Password
    $date = ''; //SignUp Date
    $error_array = array(); //Holds error messages

    if(isset($_POST['reg_button'])) { 
        //Registration Form Values
        //Strip tags is a security messure to remove HTML tags/code from entered input values
        $fname = strip_tags($_POST['reg_fname']);
        //Str_replace function used to replace any unwanted characters with nothing in the variable.
        $fname = str_replace(" ", '', $fname); //Removes spaces in this instance.
        $fname = ucfirst(strtolower($fname)); //Converts first character of string to uppercase and all others to lower case.
        $_SESSION['reg_fname'] = $fname; //Stores first name value into session variable

        $lname = strip_tags($_POST['reg_lname']);
        $lname = str_replace(" ", '', $lname);
        $lname  = ucwords(strtolower($lname));
        $_SESSION['reg_lname'] = $lname;
        
        $em = strip_tags($_POST['reg_email']);
        $em = str_replace(" ", '', $em);
        $em  = ucwords(strtolower($em));
        $_SESSION['reg_email'] = $em;

        $em2 = strip_tags($_POST['reg_email2']);
        $em2 = str_replace(" ", '', $em2);
        $em2  = ucwords(strtolower($em2));
        $_SESSION['reg_email2'] = $em2;

        $pw = strip_tags($_POST['reg_password']);
        $_SESSION['reg_pw'] = $pw;
        $pw2 = strip_tags($_POST['reg_password2']);
        $_SESSION['reg_pw2'] = $pw2;

        $date = date("Y-m-d");

        //First Name Validation
        if(strlen($fname) > 25 || strlen($fname) < 2) {
            array_push($error_array, "Your first name must be between 2 and 25 characters long.<br/>");
        }

        //Last Name Validation
        if(strlen($lname) > 25 || strlen($lname) < 2) {
            array_push($error_array,"Your last name must be between 2 and 25 characters long.<br/>");
        }

        //Email validation
        if($em == $em2) {
            if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);

                //Check if email exists
                $em_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

                //Check number of rows
                $num_rows = mysqli_num_rows($em_check);

                if($num_rows > 0) {
                    array_push($error_array,"Email already exists!<br/>");
                }
            }
            else {
                array_push($error_array, "Invalid email format.<br/>");
            };
        } else {
            array_push($error_array, "Emails don't match.<br/>");
        };

        //Password Validation
        if($pw != $pw2) {
            array_push($error_array, "Passwords don't match.<br/>");
        } else {
            if(preg_match('/[^A-Za-z0-9]', $pw)) {
                array_push($error_array, "Your password can only contain english letters or numbers.<br/>");
            }
        };

        if(strlen($pw > 30 || strlen($pw > 5))) {
            array_push($error_array, "Your password must be between 5 and 30 characters long!<br/>");
        }

        if(empty($error_array)) {
            $pw = md5($pw); //Encrypting the password before storing it in database.
            //Generate username
            $username = strtolower($fname . "_" . $lname);
            //Checks if username already exists in database
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            //If username exists, add a number to the new username
            $i = 0;
            while(mysqli_num_rows($check_username_query) != 0) {
                $i++;
                $username = $username . '_' . $i;
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            }   

        }

    };
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GV-World</title>
</head>
<body>

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
        <input type="email " name="reg_email" placeholder="Email" value="<?php 
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
        <?php if(in_array("Your password must be between 5 and 30 characters long!<br/>" ,$error_array)) 
        echo "Your password must be between 5 and 30 characters long!<br/>";
        ?>
        <input type="submit" name="reg_button" value="Register">
    </form>

</body>
</html>