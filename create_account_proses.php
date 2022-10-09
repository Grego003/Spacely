<?php
session_start();
require_once("security.php");
var_dump($name);

if (
    !empty($_POST["name"]) && !empty($_POST["username"]) && !empty($_POST["email"]) &&
    !empty($_POST["password"]) && isset($_FILES['img'])
) {
    if (CheckValidString($_POST["email"])) {
        $_SESSION['ERROR'] = "Invalid Email";
        header('location: create_account_form.php');
    }
    if (CheckValidString($_POST["password"]) || CheckValidString($_POST['password2'])) {
        if (CheckValidString($_POST["password"]) != CheckValidString($_POST['password2'])) {
            $_SESSION['ERROR'] = "Password not match";
            header('location: create_account_form.php');
        }
        $_SESSION['ERROR'] = "Password must be alphanumeric";
        header('location: create_account_form.php');
    }
    if (CheckValidString($_POST["username"])) {
        $_SESSION['ERROR'] = "username must be alphanumeric";
        header('location: create_account_form.php');
    }
    if (CheckValidString($_POST["name"])) {
        $_SESSION['ERROR'] = "name must be alphanumeric";
        header('location: create_account_form.php');
    }
    $id = "U";
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $encrypted = Encode($_POST["password"]);
    $user_key = $encrypted['key'];
    $encrypted_password = $encrypted['encoded'];
    $img = $_FILES["img"]["name"];
    $img_temp = $_FILES["img"]['tmp_name'];
    $file_ext = explode(".", $img);
    $file_ext = end($file_ext);
    $file_ext = strtolower($file_ext);

    //check if database is empty

    if (check_img_type($file_ext)) {
        // 0 = user, 1 = admin
        $id = GetID(0);
        move_uploaded_file($img_temp, "user_img/{$id}.{$file_ext}");
        insert_to_database($id, $name, $username, $email, $user_key, $encrypted_password, "{$id}.{$file_ext}");
        header('location: login_form.php');
    }
} else {
    $_SESSION['ERROR'] = "All fields are required. Please fill all required fields and submit again.";
    header('location: create_account_form.php');
}


function insert_to_database($_id, $_name, $_username, $_email, $_user_key, $_encrypted_password, $_img)
{
    global $blacklist;
    $sql = "INSERT INTO user(id, name, username, email, user_key, encrypted_password, img)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    global $db;
    $stmt = $db->prepare($sql);
    $_username = str_replace($blacklist, "", $_username);
    $_email = str_replace($blacklist, "", $_email);
    $data = [$_id, $_name, $_username, $_email, $_user_key, $_encrypted_password, $_img];
    $stmt->execute($data);
}

function GetID($type)
{
    $id = 0;
    $sql = "SELECT * FROM user";
    global $db;
    $hasil = $db->query($sql);
    while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) {
        $id = intval($row['id']);
    }
    $re = strval($type);
    $re .= str_pad(strval($id + 1), 4, '0', STR_PAD_LEFT);
    return $re;
}
