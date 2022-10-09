<?php
session_start();
$incomplete_msg = "All fields are required. Please fill all required fields and submit again.";
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
    <title>Create Account</title>
</head>

<body>
    <div class="main container d-flex flex-column justify-content-center align-items-center">
        <div class="text-center mt-4 header mx-auto">
            <img src="img/SPACELY.svg" class="logo mt-2 mb-4" alt="...">
            <header>
                <p class="h3" style="font-weight:100;">Create Your Account</p>
            </header>
            <h4 id="alert" style=<?php echo $style ?>>
                <?php echo $alert_msg; ?>
                <?php echo $_SESSION['ERROR']; ?>
        </div>
        <div class="login d-flex justify-content-center align-items-center mt-3">
            <form id="form-create-account" action="create_account_proses.php" method="post" enctype="multipart/form-data">
                <div class="row form-group">
                    <div class="col">
                        <label for="name" class="form-label mt-4 mb-2"> Full Name </label>
                        <input type="text" class="form-control" id="name" name="name" require />
                        <label for="username" class="form-label mt-2 mb-2"> Username </label>
                        <input type="text" class="form-control" id="username" name="username" require />
                        <label for="email" class="form-label mt-2 mb-2"> Email </label>
                        <input type="email" class="form-control" id="email" name="email" require />
                        <label for="password" class="form-label mt-2 mb-2"> Password </label>
                        <input type="password" class="form-control" id="password" name="password" require />
                        <label for="password" class="form-label mt-2 mb-2"> Confirm Password </label>
                        <input type="password" class="form-control" id="password" name="password2" require />
                        <label for="password" class="form-label mt-2 mb-2"> Upload Profile Picture </label>
                        <input type="file" class="form-control" id="img" name="img" require />
                        <div class="button-container mt-3 mb-4 text-center">

                            <button type="submit" class="mt-2 mb-2 btn btn-danger" name="submit" require>Create</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="footer mt-4 d-flex text-center justify-content-center">
            <p>Already have an account? &nbsp;</p>
            <a href="login_form.php">Login here </a>
        </div>

        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>