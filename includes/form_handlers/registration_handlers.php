<?php 
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
            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($error_array, "Your password can only contain english letters or numbers.<br/>");
            };
        };

        if(strlen($pw) > 30) {
            array_push($error_array, "Your password must be less than 30 characters long!<br/>");
        } else if (strlen($pw) < 5) {
            array_push($error_array, "Your password must be at least 5 characters long!<br/>");
        };

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
            };
            
            //Generate profile picture for users
            $rand = rand(1,16);
            switch($rand) {
                case 1:
                    $profile_pic = "assets/images/default_profile_pictures/head_alizarin.png";
                    break;
                case 2:
                    $profile_pic = "assets/images/default_profile_pictures/head_amethyst.png";
                    break;
                case 3:
                    $profile_pic = "assets/images/default_profile_pictures/head_belize_hole.png";
                    break;
                case 4:
                    $profile_pic = "assets/images/default_profile_pictures/head_carrot.png";
                    break;
                case 5:
                    $profile_pic = "assets/images/default_profile_pictures/head_deep_blue.png";
                    break;
                    case 6:
                        $profile_pic = "assets/images/default_profile_pictures/head_emerald.png";
                        break;
                    case 7:
                        $profile_pic = "assets/images/default_profile_pictures/head_green_sea.png";
                        break;
                    case 8:
                        $profile_pic = "assets/images/default_profile_pictures/head_nephritis.png";
                        break;
                    case 9:
                        $profile_pic = "assets/images/default_profile_pictures/head_pete_river.png";
                        break;
                    case 10:
                        $profile_pic = "assets/images/default_profile_pictures/head_pomegranate.png";
                        break;
                    case 11:
                        $profile_pic = "assets/images/default_profile_pictures/head_pumpkin.png";
                        break;
                    case 12:
                        $profile_pic = "assets/images/default_profile_pictures/head_red.png";
                        break;
                    case 13:
                        $profile_pic = "assets/images/default_profile_pictures/head_sun_flower.png";
                        break;
                    case 14:
                        $profile_pic = "assets/images/default_profile_pictures/head_turqoise.png";
                        break;
                    case 15:
                        $profile_pic = "assets/images/default_profile_pictures/head_wet_asphalt.png";
                        break;
                    case 16:
                        $profile_pic = "assets/images/default_profile_pictures/head_wisteria.png";
                        break;
                };
                $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$pw', '$date', '$profile_pic', '0', '0', 'no', ',')");
    
                array_push($error_array, "<span style='color: #14C800;'>You're all set to login!</span><br/>");
    
                //Clear Session
                $_SESSION['reg_fname'] = '';
                $_SESSION[ 'reg_lname' ] = '';
                $_SESSION[ 'reg_email' ] = '';
                $_SESSION[ 'reg_email2' ] = '';
            };
        };
    
?>