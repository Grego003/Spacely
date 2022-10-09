 <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">
            <img src="img/SPACELY.svg" width="45" height="45" alt="">
        </a>
        <a href="create_post_form.php"><button class="border-0 ms-3 px-3 py-2" style="border-radius: 20px; font-size: 14px; background-color: #B92B27; color: #fff"><i class="fa-solid fa-pencil me-2" style="font-size: 13px;"></i>Add Post</button></a>
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
                <?php
                if (empty($_SESSION["id"])) {
                ?>
                    <li class="nav-item mx-2 align-middle">
                        <a href="login_form.php"><button type="button" class="btn btn-outline-danger mr-2 px-3">Login</button></a>
                    </li>
                    <li class="nav-item align-middle">
                        <a href="create_account_form.php"><button type="button" class="btn btn-danger mr-2">Register</button></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item mx-2 my-2 align-middle">
                        <a class="nav-link" href="profile.php">
                            <?= $_SESSION["username"]; ?>
                            <img src=<?= "user_img/" . $_SESSION["id"] . $_SESSION["img"] ?> alt="You" class="rounded-circle " style="width: 25px; height:25px;">
                        </a>
                    </li>

                    <li class="nav-item mx-2 my-2">
                        <a href="logout.php"><button type="button" class="btn btn-outline-danger mr-2 px-3">Log Out</button></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
