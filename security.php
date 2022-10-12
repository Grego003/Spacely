<?php

// hidupkan sebelum di kumpul
//error_reporting(0);
require_once "db.php";
$blacklist = array(
    '&', ';', '`', '‘',
    "\"", '“', '|', '*', '?',
    '~', '<', '>', '^', '(', ')',
    '[', ']', '{', '}', '$', '\n',
    '\r'
);

$AlpStr = array(
    '8', '5', 'i', 'n', 'k', 'I', 'F', 'K',
    '3', 'o', 'D', '4', 'x', 'W', 'y', 'O',
    'd', 'C', 'z', 'c', 'P', 'b', '6', '7',
    'L', 'e', '0', 'U', 'j', 'V', 'q', '9',
    '1', 'E', 'v', '2', 's', 'a', 'h', 'B',
    'A', 'f', 'w', '!', 'N', 'r', 'l', 'H',
    'J', 'm', 'Y', 'G', 'M', 'Z', 'Q', 'u',
    'X', 'g', 'S', 'T', 'R', 'p', 't'
);

function Encode($text, $key = null)
{
    global $AlpStr;
    $re = array(
        "key" => "",
        "encoded" => ""
    );

    if ($key == null) $re['key'] = Random_String(20);
    else $re['key'] = $key;

    $tmp = array_merge(str_split($re["key"]), str_split($text));
    $keylen = strlen($re["key"]);
    $tmplen = count($tmp);
    for ($i = $keylen; $i < $tmplen; $i++) {
        $tmp[$i] = $AlpStr[ReCircle(
            array_search(
                $tmp[$i - $keylen],
                $AlpStr
            ) *
                round($i + count($AlpStr)),
            count($AlpStr)
        )];
    }
    $AlpLen = count($AlpStr);
    $tmp[0] = $AlpStr[ReCircle(array_search($tmp[$tmplen / 2], $AlpStr) - $i + $AlpLen, $AlpLen)];
    for ($i = 1; $i < $tmplen; $i++) {
        $tmp[$i] = $AlpStr[ReCircle(array_search($tmp[$i], $AlpStr) - $i + $AlpLen, $AlpLen)];
        $re["encoded"] .= $tmp[$i];
    }
    return $re;
}

function CheckAccount($_username, $_password)
{
    global $db;
    $sql = "SELECT * FROM user
        where username = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $t = Encode($_password, $row['user_key']);
    if ($row) {
        //account exist
        if ($t['encoded'] == $row['encrypted_password']) {
            $sql_ = "SELECT * FROM banned
                    where user_id = ?";
            $stmt_ = $db->prepare($sql_);
            $stmt_->execute([$row['id']]);
            $row_ = $stmt_->fetch(PDO::FETCH_ASSOC);
            if($row_['user_id'] == $row['id']){
                $_SESSION['ERROR'] = "ACCOUNT HAS BEEN BANNED.";
                exit(header('location: login_form.php'));
                return;
            }

            //login success
            $_SESSION['ERROR'] = "";
            $_SESSION['id'] = $row['id'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["name"] = $row["name"];
            $_SESSION["email"] = $row['email'];
            $_SESSION["img"] = GetImgType($row['img']);
            if(substr($_SESSION['id'],0,1) == 1){
                $_SESSION['isAdmin'] = true;
            }
            else $_SESSION['isAdmin'] = false;
            exit(header('location: dashboard.php'));
        } else {
            //login failed
            $_SESSION['ERROR'] = "Password is wrong, try again.";
            exit(header('location: login_form.php'));
        }
    } else {
        $_SESSION['ERROR'] = "Username / Password is wrong, try again.";
        exit(header('location: login_form.php'));
    }
}

function CheckEncode($text, $key, $encoded)
{
    global $AlpStr;
    $re = Encode($text, $key);
    if ($re["encoded"] == $encoded) return "true";
    return "false";
};

function Random_String($RMax)
{
    global $AlpStr;
    $re = "";
    for ($i = 0; $i < $RMax; $i++) {
        $r = floor(rand(0, count($AlpStr) - 1));
        $re .= $AlpStr[$r];
    }
    return $re;
}

function ReCircle($input, $Max)
{
    if ($input >= $Max) {
        $input -= $Max;
        return ReCircle($input, $Max);
    } else if ($input < 0) {
        $input += $Max;
        return ReCircle($input, $Max);
    }
    return $input;
}
function CheckValidString($string)
{
    //false = Valid
    global $blacklist;
    return ($string != str_ireplace($blacklist, "XX", $string)) ? true : false;
}

function CheckEmailExist($_email){
    global $db;
    $sql = "SELECT email FROM user";
    $hasil = $db->query($sql);
    while($row = $hasil->fetch(PDO::FETCH_ASSOC)){
        if($row['email'] == $_email) return true;
    }
    return false;
}
function CheckUserNameExist($_username){
    global $db;
    $sql = "SELECT username FROM user";
    $hasil = $db->query($sql);
    while($row = $hasil->fetch(PDO::FETCH_ASSOC)){
        if($row['username'] == $_username) return true;
    }
    return false;
}

function GetImgType($img)
{
    $file_ext = explode(".", $img);
    $file_ext = end($file_ext);
    $file_ext = strtolower($file_ext);
    $file_ext = "." . $file_ext;
    return $file_ext;
}

function check_img_type($img_type, $redirect_to)
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
            exit(header("location: $redirect_to"));
            return false;
    }
}
