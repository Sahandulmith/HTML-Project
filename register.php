<?php

    // connect with database
    include "conf.php";

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
 
    if (isset($_POST["register"]))
    {
        $name = $_POST["fullname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["Password"];
 
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
 
        try {
            
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
            //Send using SMTP
            $mail->isSMTP();
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = 'sahandulmith948@gmail.com';
 
            //SMTP password
            $mail->Password = 'lgil dhlz njci ritk';
 
            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
 
            //Recipients
            $mail->setFrom('sahandulmith948@gmail.com', 'sahan dulmith');
 
            //Add a recipient
            $mail->addAddress($email, $name);
 
            //Set email format to HTML
            $mail->isHTML(true);
 
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
 
            $mail->send();
            echo 'Message has been sent';
 
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
 
            
 
            // insert in users table
            $sql = "INSERT INTO register(full_name, user_name, email, phone_number, password, verification_code, email_verified_at) VALUES ('$name', '$username', '$email', '$phone', '$encrypted_password', '$verification_code', '')";
            mysqli_query($conn, $sql);
 
            header("Location: email-verification.php?email=" . $email);
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="reg.css" />
</head>
<body>
    <form method="POST" name="myform" id="myform">
        <h1>SING UP</h1>
        <div class="inputBox">
            <input type="text" name="fullname" id="fullname" required> <i>First Name</i>
            <label class="error" id="fullnameError"></label><br><br>
        </div>
        
        <div class="inputBox">
            <input type="text" name="username" id="username" required> <i>Second Name</i>
            <label class="error" id="usernameError"></label><br><br>
        </div>
        
        <div class="inputBox">
            <input type="email" name="email" id="email" required> <i>Email</i>
            <label class="error" id="emailError"></label><br><br>
        </div>
        
        <div class="inputBox">
            <input type="tel" name="phone" id="phone" required> <i>Phone Number</i>
            <label class="error" id="phoneError"></label><br><br>
        </div>
        
        <div class="inputBox">
            <input type="password" name="password" id="password" required> <i>Password</i>
            <label class="error" id="passwordError"></label><br><br>
        </div>
        
        <div class="inputBox">
            <input type="password" name="retp" id="retp" required> <i>Retype Password</i>
            <label class="error" id="retpError"></label><br><br>
        </div>
        
        <div class="inputBox">
            <input type="submit" name="register" value="Register">
        </div>
    </form>
</body>
<script type="text/javascript" src="reg.js"></script>
<script type="text/javascript" src="jquery-3.7.1.min.js"></script>
</html>
