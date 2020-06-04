<?php
if(session_id() == '') {
    session_start();
}
if(isset($_POST['exit'])){
    setcookie(session_name(), '', time() - 86400);
    session_unset();
    session_destroy();
    if(empty($_SESSION['id'])) header("Location: main.php");
    exit();
}
?>