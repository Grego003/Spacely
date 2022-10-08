<?php
session_start();
//need login
if (!isset($_SESSION["id"])) {
    header("location: login.php");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/jquery.js"></script>
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/category.css" rel="stylesheet">
    <link href="css/create_post.css" rel="stylesheet">
    <title>Profile</title>
</head>

<body>
<?php include_once './components/navbar.php';?>

<article>
    <div class='container mt-4'>
        <h3 class="mb-3 text-center">Create your post</h3>
    </div>
    <div class="container my-4 col-lg-7">
        <div class="card-group vgr-cards">
            <div class="card px-3 py-2">
                <div class="card-body">
                    <form action="create_post_proses.php" method="post" enctype="multipart/form-data">
                        <div class="user-container d-flex align-items-center mb-2 text-nowrap">
                            <div class="categories mx-auto w-100">
                                <div>
                                <h5 class="mb-2 text-start text-danger" style="font-weight: bolder;">STEP 1</h5>
                                <h5 class="mb-2 text-start" style="font-size: 15px">Choose a programming language to discuss</h5>
                                </div>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category1" value="c++">
                                    <label class="form-check-label" for="category1">C++</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category2" value="python">
                                    <label class="form-check-label" for="category2">Python</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category3" value="java">
                                    <label class="form-check-label" for="category3">Java</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category4" value="ruby">
                                    <label class="form-check-label" for="category4">Ruby</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category5" value="sql">
                                    <label class="form-check-label" for="category5">SQL</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category5" value="php">
                                    <label class="form-check-label" for="category5">PHP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category6" value="c">
                                    <label class="form-check-label" for="category6">C</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="categories" id="category7" value="javascript">
                                    <label class="form-check-label" for="category7">Javascript</label>
                                </div>
                            </div>
                        </div>
                        <div class="content-container d-flex flex-column">
                        <h5 class="mb-2 mt-3 text-start text-danger" style="font-weight: bolder;">STEP 2</h5>
                        <h5 class="mb-2 text-start" style="font-size: 15px">Write the title of your post</h5>
                            <input type="text" class="form-control mb-3" id="title" name="title" required placeholder="Title" maxlength="100" />
                            <span id="maxCharacters"></span>
                        <h5 class="mb-2 mt-3 text-start text-danger" style="font-weight: bolder;">STEP 3</h5>
                        <h5 class="mb-2 text-start" style="font-size: 15px">Write your post content</h5>
                            <div class="form-floating">
                                <textarea type="text" class="form-control mb-3" id="body" name="body" required style="height: 250px" aria-label="floating label"></textarea>
                                <label for="body">Your post here...</label>
                            </div>
                            <button type="submit" class="mt-2 mb-2 btn btn-danger" name="login" required>Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>

<?php include_once './components/footer.php';?>

    <script>

    </script>
</body>