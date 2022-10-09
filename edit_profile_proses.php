<?php
session_start();
include "security.php";
$sql = "SELECT * FROM user
WHERE id = ?";
//open database if needed
$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION["id"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$username = $email =
    $img = $img_temp = $file_ext = "";
$id = $_SESSION["id"];

if (!empty($_POST["username"])) {
    $username = $_POST["username"];
    //$_SESSION["username"] = $username;
} else $username = $row["username"];

if (!empty($_POST["email"])) {
    $email = $_POST["email"];
} else $email = $row["email"];

if (!empty($_FILES["img"]["name"])) {
    $img = $_FILES["img"]["name"];
    $img_temp = $_FILES["img"]["tmp_name"];
    $file_ext = GetImgType($img);
    if (check_img_type2($file_ext)) {
        echo "yes!";
        move_uploaded_file($img_temp, "user_img/{$id}{$file_ext}");
        $img = $id . $file_ext;
    } else {
        //validation here how?
        //header("location:edit_profile.php");
    }
} else $img = $row["img"];

update_database($username, $email, $img, $id);
$_SESSION["username"] = $username;
$_SESSION["img"] = GetImgType($img);
echo $row["img"];


function update_database($_username, $_email, $_img, $_id)
{
    global $db;
    $sql = "UPDATE user SET username = ?, email = ?, img = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_username, $_email, $_img, $_id];
    $stmt->execute($data);
}

function check_img_type2($img_type)
{
    switch ($img_type) {
        case '.jpg':
        case '.png':
        case '.jpeg':
        case '.svg':
        case '.webp':
        case '.bmp':
        case '.gif':
            return true;
            break;
        default:
            return false;
    }
}
