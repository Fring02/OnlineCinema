
<?php
require_once "classes.php";
if(isset($_SESSION['id'])) $id = $_SESSION['id'];
else $id = 1;
$user = $db->getUser($id);
$_SESSION['nickname'] = $user->getNickname();
$_SESSION['filmsCount'] = $user->getFilmsCount();
$_SESSION['id'] = $user->getId();
?>
<?php if($user === null): ?>
<h2 style="font-size: 1.5em; font-family: Arial; color:aliceblue">Sorry, current information about user is unavailable.</h2>
<?php else: ?>
<div style="border-top: 2px solid aliceblue;">
<h1 style="font-family: Arial, Verdana, sans-serif; font-size: 1.8em; color: aliceblue; text-align: center; padding: 30px 0;">Welcome, <?=$_SESSION['nickname']?></h1>
<a href="main.php?favourites" id="sign" style="font-size: 20px; display: block; max-width:50%;
 border-radius: 25px; border: none; margin: 0 auto; margin-top: 10px !important; background-color: gold; color: black">Favourites</a> 
<a href="edit_profile.php?id=<?=$_SESSION['id']?>"  id="sign" style="font-size: 20px; display: block; max-width:50%;
 border-radius: 25px; border: none; margin: 0 auto; margin-top: 10px !important;">Edit</a>
<form method="post" action="userinfo.php">
<button name="exit" id="sign" style="font-size: 20px; display: block; border-radius: 25px; border: none;
 margin: 0 auto; margin-top: 10px !important;">Sign out</button>
</form>
<?php if($id == 1): ?>
<h2 id="visitsinfo" style="color: white; font-family: Arial, Bahnschrift, serif; text-align: center;
 margin-top: 20px; font-size: 2em; border: 2px solid aliceblue; padding: 10px 0">Visits: <?=$_COOKIE['visits']?></h2>
<?php endif; ?>
</div>
<?php endif; ?>
