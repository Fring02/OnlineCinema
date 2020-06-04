<?php if(session_id() == '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="final.css" rel="stylesheet" type="text/css">
    <script src="scripts.js"></script>
</head>
<style>
    body{
        background : black;
    }
    form#form{
        display : block;
        width:60%;
        position: relative;
        left : 20%;
        border: 2px solid aliceblue;
        padding: 20px;
        margin: 10px;
        border-radius:30px;
    }   
</style> 
<body>
<div class="register">
<h1 style="text-align: center; padding-top: 30px; font-size: 3em; color: aliceblue; font-family:Arial, Verdana, sans-serif;">Registration</h1>
<form method="post" id="form" name="registration">
<div class="cell"><input name="name" size="20" type="text" placeholder="Name" class="cellinput"></div>
<div class="cell"><input name="surname" size="15" type="text" placeholder="Surname" class="cellinput"></div>
<div class="cell"><input name="email" size="40" type="email" placeholder="Email" class="cellinput"></div>
<div class="cell"><input name="nickname" size="15" type="text" placeholder="Nickname" class="cellinput"></div>
<div class="cell"><input name="password" size="20" type="password" placeholder="Password" class="cellinput"></div>
<div style="padding: 50px;">
<p style="color: aliceblue; font-size: 20px; display: block; text-align: center; font-family: Arial, Helvetica, sans-serif;">
<button type="submit" name="submit" id="sign" style=" font-size: 20px; display: block; border-radius: 25px; border: none; margin: 0 auto; margin-top: 10px !important;">Sign up</button></p>
</div>
</form>
</div>
</body>
</html>

<?php
require_once "classes.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        if(isset($_POST['name'])) $name = $_POST['name'];
        if(isset($_POST['surname'])) $surname = $_POST['surname'];
        if(isset($_POST['email'])) $email = $_POST['email'];
        if(isset($_POST['nickname'])) $nickname = $_POST['nickname'];
        if(isset($_POST['password'])) $password = $_POST['password'];
        if(!empty($name) && !empty($surname) && !empty($email) && !empty($nickname) && !empty($password)){
            $user = new User($name, $surname, $email, $nickname, $password);
            if($db->hasUser($user)) exit("<h1 style='color: white;'>Sorry, this nickname is already taken.</h1>");
            else{
                if($db->addUser($user)){
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['nickname'] = $user->getName();
                    $_SESSION['password'] = $user->getPass();
                    $_SESSION['filmsCount'] = $user->getFilmsCount();
                    $_SESSION['in_system'] = true;
                    $id = $_SESSION['id'];
                    header("Location: main.php?id=$id");
                    exit();
                }
                else exit("<h1 style='color: white;'>Sorry, failed to add new user</h1>");
            }
        }
        else exit("<h1 style='color: white;'>Fill all fields</h1>");
    }
}
/*
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        require_once 'database.php';
            if(isset($_POST['name'])) $name = $_POST['name'];
            if(isset($_POST['surname'])) $surname = $_POST['surname'];
            if(isset($_POST['email'])) $email = $_POST['email'];
            if(isset($_POST['nickname'])) $nickname = $_POST['nickname'];
            if(isset($_POST['password'])) $password = $_POST['password'];
            if(!empty($name) && !empty($surname) && !empty($email) && !empty($nickname) && !empty($password)){
                            $result = mysqli_query($connection, "SELECT id FROM users WHERE nickname = '$nickname'");
                            $row = mysqli_fetch_array($result);
                            if(empty($row['id'])){
$res = mysqli_query($connection, "INSERT INTO users (name, surname, email, nickname, password, filmsCount) VALUES('$name', '$surname', '$email', '$nickname', '$password', 0)");
                                    if($res){
                                        $id = mysqli_insert_id($connection);
                                        header("Location: main.php?id=$id");
                                        exit;
                                    }
                                    else exit("Failed");
                            }
                            else exit("Sorry, this nickname is already taken");
            }
            else echo "Fill all fields";
            }
    }*/
?>