<?php
require_once "classes.php";
$user = $db->getUser($_GET['id']);
$user_id = $user->getId();
$user_nick = $user->getNickname();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="final.css" rel="stylesheet" type="text/css">
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
<?php if($user === null):?>
<h1 style="color:white;">Unknown user</h1>
<?php else: ?>
<h1 style="color:white"><?=$user_nick?> <?=$user_id?></h1>
<?php endif; ?>
<div class="register">
<form method="post">
<h1 style="text-align: center; padding-top: 30px; font-size: 3em; color: aliceblue; font-family:Arial, Verdana, sans-serif;">Edit user information</h1>
    <div class="cell"><input name="nick" size="40" type="text" placeholder="Nickname" class="cellinput"></div>
    <div class="cell"><input name="email" size="40" type="email" placeholder="Email" class="cellinput"></div>
    <div class="cell"><input name="password" size="20" type="password" placeholder="Password" class="cellinput"></div>
    <div style="padding: 50px;">
    <p style="color: aliceblue; font-size: 20px; display: block; text-align: center; font-family: Arial, Helvetica, sans-serif;">
       <button name="submit" id="sign" style=" font-size: 20px; display: block; border-radius: 25px; border: none; margin: 0 auto; margin-top: 10px !important;">Edit</button>
    </p>
</div>
</form>
</div>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        if(!empty($_POST['email'])) $email = $_POST['email'];
        if(!empty($_POST['password'])) $password = $_POST['password'];
        if(!empty($_POST['nick'])) $nick = $_POST['nick'];
        if($db->updateUser($user, $email, $nick, $password)){
            header("Location: main.php?id=$user_id");
            exit();
        }
        else exit("Sorry, failed to update user");
    }
}
?>