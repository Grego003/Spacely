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
//post history
$sql2 = "SELECT * FROM post
WHERE user_id = ?";
$stmt = $kunci->prepare($sql2);
$stmt->execute([$_SESSION["id"]]);
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link href="css/navbar.css" rel="stylesheet">
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">
	<link href="css/profile.css" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<!-- navbar -->
	<?php include_once './components/navbar.php' ?>

	<main>
		<div class="container d-flex flex-row mb-4 justify-content-center">
			<div class="container col-lg-3 card profile-container d-flex flex-row mt-4 mx-2" style="max-height: 25rem;">
				<div class="profile-bio d-flex flex-column justify-content-center align-items-center ms-auto me-auto">
					<img src=<?= "user_img/" . $row["img"] ?> class="rounded-circle my-2" style="max-width: 10rem;">
					<h3><?= $row["username"] ?></h3>
					<span class="my-1"><?= $row["email"] ?></span>
					<a href="edit_profile.php"><button class="edit-profile btn btn-warning my-2 px-3" style="max-width: 10rem;">Edit Profile</button></a>
				</div>
			</div>
			<div class="container card profile-container d-flex flex-row mt-4 mx-2 col-lg-8">
				<div class="profile-posts-container flex-column col-lg-12 py-3 px-3">
					<div class="pb-3">
						<h3>History</h3>
					</div>
					<?php if (!$row2) {
					?>
						<div>
							<h2> You haven't posted anything yet </h2>
							<div class="container temporary text-center d-flex align-items-center justify-content-center">
								<a href="create_post_form.php"><button class="category-button" role="button">Add Post</button></a>
							</div>
						</div>
						<?php
					} else {
						while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
						?>
							<div class="profile-posts my-2 mb-3">
							<span class="mb-3 text-muted" style="font-size: 14px"><?= $row2["date_created"] ?></span>

								<div class="w-100 mt-1 d-flex justify-content-between align-items-center p-2 text-white" 
									style="border-top-right-radius: 30px; border-bottom-right-radius: 30px; border-top-left-radius: 6px; border-bottom-left-radius: 6px; background-color:#44318d;">
										
								<h5 class="ms-2"><?= $row2["title"] ?></h5>
									<button class="category-button" role="button"><?= get_category($row2["forum_id"]) ?></button>
								</div>
								<div class="my-2 d-flex flex-column">

									<a onMouseOver="this.style.backgroundColor='#D9D9D9'" onMouseOut="this.style.backgroundColor='rgba(236,236,236,0.5)'" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row2["id"]?>" class="p-3 rounded" style="cursor: pointer; background-color:rgba(236,236,236,0.5); color: black; text-decoration: none; ">
									<span class="post-body-content"><?= $row2["body"] ?></span></a>

									<!-- modal to show more text of body -->
									<div class="modal" id="modal<?php echo $row2["id"]?>" tabindex="-1" role="dialog" aria-labelledby="modallabel1" aria-hidden= "true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content p-3">
											<div class="modal-header">
												<h5 class="modal-title">Post Body</h5>
											</div>
											<div class="modal-body">
												<p><?= $row2["body"] ?></p>
											</div>			
										</div>
										</div>
									</div>
								<!-- close modal-->
								<div class="feedback-container d-flex flex-row my-3">
									<div class="border border-3 border-light rounded me-2 p-1">
										<button disabled class="rounded-circle bg-transparent">
											<i class="fa-solid fa-thumbs-up"></i>
										</button>
									<span class="mx-1"><?= $row2["like_ammount"] ?></span>
									</div>

									<div class="border border-3 border-light rounded me-2 p-1">
										<button disabled class="rounded-circle bg-transparent">
											<i class="fa-solid fa-comment"></i>
										</button>
									<span class="mx-1"><?= $row2["comment_ammount"] ?></span>
									</div>
									
								</div>
								<hr class="pembatas-post">
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include_once './components/footer.php' ?>

	<?php
	function get_category($forum_id)
	{
		switch ($forum_id) {
			case "F0001":
				$forum_id = "C++";
				break;
			case "F0002":
				$forum_id = "Python";
				break;
			case "F0003":
				$forum_id = "Java";
				break;
			case "F0004":
				$forum_id = "Ruby";
				break;
			case "F0005":
				$forum_id = "SQL";
				break;
			case "F0006":
				$forum_id = "PHP";
				break;
			case "F0007":
				$forum_id = "C";
				break;
			case "F0008":
				$forum_id = "Javascript";
				break;
		}
		return $forum_id;
	} ?>

</body>

</html>