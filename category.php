<?php
session_start();
//need login

if (!isset($_SESSION["id"])) {
	header("location: login_form.php");
}

// if (!isset($_SESSION["id"])) {
// 	header("location: login_forum.php");
// }

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
	<link href="css/category.css" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<!-- navbar -->
	<?php include_once './components/navbar.php' ?>

	<article>
		<div class='container tabbed round mt-4'>
			<ul>
				<li><img src="img/sql.svg"> SQL</li>
				<li><img src="img/ruby.svg"> Ruby</li>
				<li><img src="img/java.svg"> Java</li>
				<li><img src="img/python.svg"> Python</li>
				<li><img src="img/cpp.svg"> C++</li>
				<li><img src="img/javascript.svg"> Javascript</li>
				<li><img src="img/c.svg"> C</li>
				<li class='active'><img src="img/php.svg"> PHP</li>
			</ul>
		</div>
		<div class="container my-4 col-lg-8">
			<?php ?>
			<div class="card-group vgr-cards">
				<div class="card">
					<div class="card-body mx-3">
						<div class="user-container d-flex align-items-center mb-2 text-nowrap">
							<img src="img/SPACELY.svg" alt="Tes Foto User" class="post-header rounded-circle">
							<span class="post-username mx-2">NiceTryKemosabe</span>
							<span class="post-date">24h ago</span>
							<div class="w-100 d-flex justify-content-end">
								<button class="category-button" role="button">PHP</button>
							</div>
						</div>
						<div class="content-container d-flex flex-column">
							<h4 class="card-title">Judul</h4>
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis ipsam ex et assumenda soluta, voluptatem accusantium tempore aspernatur dolorum nostrum quos, repudiandae culpa quaerat non expedita dolores eveniet illo quisquam repellendus voluptas deleniti! Illum quo molestias necessitatibus tempore quaerat placeat esse?.</p>
						</div>
						<div class="feedback-container d-flex flex-row my-2">
							<button><i class="fa-solid fa-thumbs-up"></i></button>
							<span class="mx-1">5 likes</span>
							<button><i class="fa-solid fa-comment"></i></button>
							<span class="mx-1">2 comments</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>

	<?php include_once './components/footer.php' ?>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var tabs = document.querySelectorAll('.tabbed li');

			for (var i = 0, len = tabs.length; i < len; i++) {
				tabs[i].addEventListener("click", function() {
					if (this.classList.contains('active'))
						return;

					var parent = this.parentNode,
						innerTabs = parent.querySelectorAll('li');

					for (var index = 0, iLen = innerTabs.length; index < iLen; index++) {
						innerTabs[index].classList.remove('active');
					}

					this.classList.add('active');
				});
			}
		});
	</script>
</body>