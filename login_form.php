<?php
session_start();
$incomplete_msg = "Please fill all required fields and submit again.";
$alert_msg = $incomplete_msg;
$style = "display:none;";
if (isset($_SESSION['ERROR'])) {
    if ($_SESSION['ERROR'] != "") {
        $alert_msg = $_SESSION['ERROR'];
        $style = "display:block;";
        $_SESSION['ERROR'] = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/login.css" rel="stylesheet">
    <title>Login Page</title>
</head>

<body>
    <div class="main container d-flex flex-column justify-content-center align-items-center">
        <div class="text-center mt-4 header mx-auto">
            <img src="img/SPACELY.svg" class="logo mt-2 mb-4" alt="...">
            <header>
                <p class="h3" style="font-weight:100;">Login to Spacely</p>
                <span class="text-muted">
                    <p>Forum pemrograman terbaik di Indonesia</p>
                </span>
            </header>
            <h4 id="alert" style=<?php echo $style ?>>
                <?php echo $alert_msg ?>
        </div>
        <div class="login d-flex justify-content-center align-items-center mt-4">
            <form id="form_week6" action="login_process.php" method="post" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col">
                        <label for="username" class="form-label mt-4 mb-2"> Username </label>
                        <input type="text" class="form-control" id="username" name="username" required />
                        <label for="password" class="form-label mt-2 mb-2"> Password </label>
                        <input type="password" class="form-control" id="password" name="password" required />
                        <div class="button-container mt-3 mb-4 text-center">
                            <button type="submit" class="mt-2 mb-2 btn btn-danger" name="login" required>login</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="footer mt-4 d-flex text-center justify-content-center">
            <p>Don't have an Account yet? &nbsp;</p>
            <a href="create_account_form.php"> Sign up here</a>
        </div>

        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>