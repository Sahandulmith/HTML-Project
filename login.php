<?php

    // connect with database
    include "conf.php";
     
    if (isset($_POST["login"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
 
 
        // check if credentials are okay, and email is verified
        $sql = "SELECT * FROM register WHERE email = '" . $email . "'";
        $result = mysqli_query($conn, $sql);
 
        if (mysqli_num_rows($result) == 0)
        {
            die("Email not found.");
        }
 
        $user = mysqli_fetch_object($result);
 
        //if (!password_verify($password, $user->password))
        {
        //    die("Password is not correct");
        }
 
        if ($user->email_verified_at == "0000-00-00 00:00:00")
        {
            die("Please verify your email <a href='email-verification.php?email=" . $email . "'>from here</a>");
        }
 
        header("Location: grocery.html");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <form method="POST">
        <h1>SING IN</h1>
        <input type="email" name="email" placeholder="Enter email" required /><br><br>
        <input type="password" name="password" placeholder="Enter password" required /><br><br>
        <div class="links">
            <a href="#">Forgot Password</a>
            <a href="register.php">Signup</a>
        </div><br><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>

