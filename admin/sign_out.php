<?php
//リダイレクト先考える
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ');
    exit();
}

$_SESSION = array();
setcookie(session_name(), '', time() - 3600, '/' );
session_destroy();

header('Location: sign_in.php');
exit();