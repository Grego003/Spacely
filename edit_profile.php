<?php
session_start();
require "NeedLogin.php";
require "db.php";
//user data
$sql = "SELECT * FROM user
WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION["id"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$incomplete_msg = "Please fill all required fields and submit again.";
$alert_msg = $incomplete_msg;
$style = "display:none;";
if (!empty($_SESSION['ERROR'])) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/regular.min.css" integrity="sha512-aNH2ILn88yXgp/1dcFPt2/EkSNc03f9HBFX0rqX3Kw37+vjipi1pK3L9W08TZLhMg4Slk810sPLdJlNIjwygFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/solid.min.css" integrity="sha512-uj2QCZdpo8PSbRGL/g5mXek6HM/APd7k/B5Hx/rkVFPNOxAQMXD+t+bG4Zv8OAdUpydZTU3UHmyjjiHv2Ww0PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="js/jquery.js"></script>
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <title>Profile</title>
</head>

<body>
    <!-- navbar -->
    <?php include_once './components/navbar.php';?>
    
    <main>
        <div class="container d-flex flex-row mb-4 justify-content-center">
            <div class="container col-lg-3 card profile-container d-flex flex-column mt-4 mx-2 align-items-center justify-content-center" style="max-height: 25rem;">
                <h4>Current Profile</h4>
                <div class="profile-bio d-flex flex-column justify-content-center align-items-center ms-auto me-auto">
                    <img src=<?= "user_img/" . $row["img"] ?> class="rounded-circle my-2" style="max-width: 10rem;">
                    <h3><?= $row["username"] ?></h3>
                    <span class="my-1"><?= $row["email"] ?></span>
                </div>
            </div>
            <div class="container card profile-container d-flex flex-row justify-content-center mt-4 mx-2 col-lg-8">
                <div class="profile-posts-container flex-column col-lg-9 py-2 px-5">
                    <div class="pb-3">
                        <form id="form-edit-account" action="edit_profile_proses.php" method="post" enctype="multipart/form-data">
                            <div class="row form-group">
                                <div class="col">
                                    <label for="username" class="form-label mt-4 mb-2"> Username </label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                    value=<?php echo $_SESSION['username']?>>
                                    <label for="email" class="form-label mt-2 mb-2"> Email </label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                    value=<?php echo $_SESSION['email']?>>
                                    <label for="password" class="form-label mt-2 mb-2"> Upload Profile Picture </label>
                                    <label for="password" class="form-label mt-2 mb-2" style=<?php echo $style ?>> <?php echo $alert_msg ?> </label>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*"/>
                                    <div class="button-container mt-3 mb-4 d-flex justify-content-center">
                                        <a href="edit_profile_proses.php"><button class="edit-profile btn btn-success my-2 p-2 me-1" style="max-width: 8rem;">Save Profile</button></a>
                                        <a href="profile.php"><button class="edit-profile btn btn-danger my-2 p-2 px-3 me-1" style="max-width: 8rem;" name="back" value="GO_BACK">Back</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="profile-posts my-2 mb-3">

                    </div>
                </div>
            </div>
        </div>
    </main>