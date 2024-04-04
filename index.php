<!DOCTYPE html>
<?php
$con = mysqli_connect("localhost","root","", "social");  // Establishing connection with server name, username and password.
if(mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_errno();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GV-World</title>
</head>
<body>
    <h1>Welcome to GV World!</h1>
</body>
</html>