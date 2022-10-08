<?php
require "NeedLogin.php";
//user data
$dsn = "mysql:host=localhost;dbname=uts_forum";
$kunci = new PDO($dsn, "root", "");
$sql = "SELECT * FROM user
WHERE id = ?";
$stmt = $kunci->prepare($sql);
$stmt->execute([$_SESSION["id"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <img src="img/SPACELY.svg" width="45" height="45" alt="">
            </a>
            <button class="navbar-toggler navbar-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#nvbCollapse" aria-controls="nvbCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="nvbCollapse">
                <ul class="navbar-nav nav ms-auto">
                    <li class="nav-item mx-2 my-2">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item mx-2 my-2">
                        <a class="nav-link" href="category.php">Categories</a>
                    </li>
                    <li class="nav-item mx-2 my-1">
                        <a class="nav-link" href="profile.php">
                            <?= $_SESSION["username"]; ?>
                            <img src=<?= "user_img/" . $_SESSION["id"] . $_SESSION["img"] ?> alt="Tes Foto User" class="rounded-circle" style="width: 32px;">
                        </a>
                    </li>
                    <li class="nav-item mx-2 my-2">
                        <a href="login_form.php"><button type="button" class="btn btn-outline-danger mr-2 px-3">Log Out</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container card profile-container d-flex flex-row mt-4 justify-content-evenly align-items-center">
            <div class="profile-bio d-flex flex-column col-lg-3 ms-3 py-3 justify-content-center align-items-center">
                <img src=<?= "user_img/" . $row["img"] ?> style="max-width: 10rem;" class="rounded-circle my-2">
                <h3><?= $row["username"] ?></h3>
                <span class="my-1"><?= $row["email"] ?></span>
            </div>
            <div class="profile-posts-container flex-column col-lg-9 py-4 px-5">
                <div class="pb-3">
                    <form id="form-edit-account" action="edit_profile_proses.php" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col">
                                <label for="username" class="form-label mt-4 mb-2"> Username </label>
                                <input type="text" class="form-control" id="username" name="username" require />
                                <label for="email" class="form-label mt-2 mb-2"> Email </label>
                                <input type="email" class="form-control" id="email" name="email" require />
                                <label for="password" class="form-label mt-2 mb-2"> Upload Profile Picture </label>
                                <input type="file" class="form-control" id="img" name="img" require />
                                <div class="button-container mt-3 mb-4">
                                    <a href="edit_profile_proses.php"><button class="edit-profile btn btn-success my-2 p-2 me-1" style="max-width: 8rem;">Save Profile</button></a>
                                    <a href="profile.php"><button class="edit-profile btn btn-danger my-2 p-2 px-3 me-1" style="max-width: 8rem;">Back</button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="profile-posts my-2 mb-3">

                </div>
            </div>
        </div>
    </main>