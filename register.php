<!DOCTYPE html>
<?php
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
    $error_array = ''; //Holds error messages

    if(isset($_POST['reg_button'])) { 
        //Registration Form Values
        //Strip tags is a security messure to remove HTML tags/code from entered input values
        $fname = strip_tags($_POST['reg_fname']);
        //Str_replace function used to replace any unwanted characters with nothing in the variable.
        $fname = str_replace(" ", '', $fname); //Removes spaces in this instance
        $fname = ucfirst(strtolower($fname)); //Converts first character of string to uppercase and all others to lower case

        $lname = strip_tags($_POST['reg_lname']);
        $lname = str_replace(" ", '', $lname);
        $lname  = ucwords(strtolower($lname));
        
        $em = strip_tags($_POST['reg_email']);
        $em = str_replace(" ", '', $em);
        $em  = ucwords(strtolower($em));

        $em2 = strip_tags($_POST['reg_email2']);
        $em2 = str_replace(" ", '', $em2);
        $em2  = ucwords(strtolower($em2));

        $pw = strip_tags($_POST['reg_password']);
        $pw2 = strip_tags($_POST['reg_password2']);

        $date = date("Y-m-d")


    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GV-World</title>
</head>
<body>

    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" required>
        <br/>
        <input type="text" name="reg_lname" placeholder="Last Name" required>
        <br/>
        <input type="email " name="reg_email" placeholder="Email" required>
        <br/>
        <input type="email" name="reg_email2" placeholder="Confirm Email" required>
        <br/>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br/>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br/>
        <input type="submit" name="reg_button" value="Register">
    </form>

</body>
</html>