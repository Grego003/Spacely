<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if (!isset($_SESSION['id'])) {
    exit(header('location: login_form.php'));
    return;
}
if(substr($_SESSION['id'],0,1) != '1'){
    exit(header('location: dashboard.php'));
    return;
}
$_SESSION['isAdmin'] = true;