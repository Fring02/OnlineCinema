<?php
if(session_id() == '') {
    session_start();
}
require_once "classes.php";
if(isset($_POST['login'])){
    if(isset($_POST['nickname'])) $nickname = $_POST['nickname'];
    if(isset($_POST['password'])) $password = $_POST['password'];
    if(!empty($nickname) && !empty($password)){
        $id = $db->login($nickname, $password);
        if(isset($id)){
            $_SESSION['id'] = $id;
            $_SESSION['in_system'] = true;
            $id = $_SESSION['id'];
            header("Location: main.php?id=$id");
            exit();
        }
    } 
    else echo "<script>alert('Fill all fields');</script>";
}
?>
<h1 style="text-align: center; padding-top: 30px; font-size: 3em; color: aliceblue; font-family: Bahnschrift, Arial, serif">Sign in</h1>
<form method="post" id = "form" name="registration" action="form.php">
<div class="cell"><input name="nickname" size="15" type="text" placeholder="Nickname" class="cellinput"></div>
<div class="cell"><input name="password" size="20" type="password" placeholder="Password" class="cellinput"></div>
<div style="padding-top: 15px;">
<p style="color: aliceblue; font-size: 20px; text-align: center; font-family: Arial, Helvetica, sans-serif;">Don't have account yet?
<a id="sign" href="registerpage.php" style=" font-size: 20px; display: block; border: none; margin: 0 auto; margin-top: 10px !important;
background-color: aliceblue; color: black; display: block; width:50%">Sign up</a></p>
<button name="login" type="submit" id="sign" style="font-size: 25px; display: block; border: none; margin: 0 auto; font-family: Bell MT">Sign in</button>
</div>
</form>
<div id="socnet" style=" border: 2px solid aliceblue; border-left: none; border-right: none;">
<div class="socicon"><i class="fab fa-google"></i></div>
<div class="socicon"><i class="fab fa-vk"></i></div>
<div class="socicon"><i class="fab fa-instagram"></i></div>
<div class="socicon"><i class="fab fa-facebook"></i></div>
</div>
