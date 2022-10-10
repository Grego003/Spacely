<?php 
session_start();
if($_SESSION['OTPTimespan'] != 'YOU WIN!' && $_SESSION['OTPcode'] != 'YOU WIN!'){
    header('location: login_form.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/forgot.css">
</head>

<body>
    <div id="container">
        <h2>Password</h2>
        <div id="line"></div>
        <form action="newPassword_process.php" method="POST" autocomplete="off">
            <?php
            if (isset($_SESSION['ERROR'])) {
                if($_SESSION['ERROR'] != ''){?>
                    <div id="alert"><?php echo $_SESSION['ERROR']; ?></div>
                <?php
                $_SESSION['ERROR'] = '';
                }
            }
            ?>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="password2" placeholder="Confirm Password" required><br>
            <input type="submit" name="changePassword" value="Save">
        </form>
    </div>
</body>

</html>