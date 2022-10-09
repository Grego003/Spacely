<?php
session_start();
require 'db.php';
global $db;

if(isset($_POST['back'])) {
    header('location: profile.php');
    return;
}

if (isset($_POST['username'])){
    $sql = "UPDATE user 
        SET username = ?
        WHERE id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_POST["username"], $_SESSION["id"]];
    $stmt->execute($data);
    $_SESSION["username"] = $_POST["username"];
}
if (isset($_POST['email'])){
    $sql = "UPDATE user 
        SET email = ?
        WHERE id = ?";
    $stmt = $db->prepare($sql);
    $data = [$_POST["email"], $_SESSION["id"]];
    $stmt->execute($data);
    $_SESSION["email"] = $_POST["email"];
}
if (!empty($_FILES['img']["name"])){
    $img = $_FILES["img"]["name"];
    $img_temp = $_FILES["img"]['tmp_name'];
    $file_ext = explode(".", $img);
    $file_ext = end($file_ext);
    $file_ext = strtolower($file_ext);
    //check if database is empty
    $sql = "SELECT img FROM user
    WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION["id"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (check_img_type($file_ext)) {
        if(file_exists("user_img/".$row['img'])) unlink("user_img/".$row['img']);
        move_uploaded_file($img_temp, "user_img/{$_SESSION["id"]}.{$file_ext}");
        $sql = "UPDATE user 
        SET img = ?
        WHERE id = ?";
        $stmt = $db->prepare($sql);
        $data = ["{$_SESSION["id"]}.{$file_ext}", $_SESSION["id"]];
        $stmt->execute($data);
    }
}
header('location: edit_profile.php');


function check_img_type($img_type)
{
    switch ($img_type) {
        case 'jpg':
        case 'png':
        case 'jpeg':
        case 'svg':
        case 'webp':
        case 'bmp':
        case 'gif':
            return true;
            break;
        default:
            $_SESSION['ERROR'] = "YOU CAN ONLY UPLOAD AN IMAGE FILE.";
            return false;
    }
}