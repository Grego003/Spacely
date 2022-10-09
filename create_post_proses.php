<?php
include "security.php";
date_default_timezone_set("Asia/Jakarta");
session_start();
if (isset($_POST["categories"]) && isset($_POST["title"]) && isset($_POST["body"])) {
    $curr_date = date("y-m-d");
    $curr_time = date("h");
    $post_id = Get_PostID();
    $user_id = $_SESSION["id"];
    $forum_id = get_forumID($_POST["categories"]);
    $title = $_POST["title"];
    $body = $_POST["body"];

    echo $curr_date;
    echo $curr_time;
    echo $post_id;
    echo $user_id;
    echo $forum_id;
    echo $title;
    echo $body;

    insert_post_to_database($post_id, $user_id, $forum_id, $title, $body, $curr_time, $curr_date);
    header("location: category.php");
}

function insert_post_to_database($_post_id, $_user_id, $_forum_id, $_title, $_body, $_time_created, $_date_created)
{
    $sql = "INSERT INTO post(id, user_id, forum_id, title, body, time_created, date_created, like_ammount, comment_ammount)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    global $db;
    $stmt = $db->prepare($sql);
    $data = [$_post_id, $_user_id, $_forum_id, $_title, $_body, $_time_created, $_date_created, 0, 0];
    $stmt->execute($data);
}

function Get_PostID()
{
    $id = 0;
    $sql = "SELECT * FROM post";
    global $db;
    $hasil = $db->query($sql);
    while ($row = $hasil->fetch(PDO::FETCH_ASSOC)) {
        $id = intval(substr($row['id'], 1));
    }
    $re = strval("p");
    $re .= str_pad(strval($id + 1), 4, '0', STR_PAD_LEFT);
    return $re;
}

function get_forumID($category)
{
    switch ($category) {
        case "c++":
            $forum_id = "F0001";
            break;
        case "python":
            $forum_id = "F0002";
            break;
        case "java":
            $forum_id = "F0003";
            break;
        case "ruby":
            $forum_id = "F0004";
            break;
        case "sql":
            $forum_id = "F0005";
            break;
        case "php":
            $forum_id = "F0006";
            break;
        case "c":
            $forum_id = "F0007";
            break;
        case "javascript":
            $forum_id = "F0008";
            break;
    }
    return $forum_id;
}
