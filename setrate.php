<?php
if(session_id() == '') session_start();
if(isset($_POST['submitrate'])){
    if(!empty($_POST['number'])){
        $_SESSION['rate'] = $_POST['number'];
        $id = $_SESSION['id'];
        header("Location: main.php?id=$id");
    } 
}
?>