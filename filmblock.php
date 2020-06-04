<?php
    if(session_id() == '') session_start();
    require_once "database.php";
    $id = $_GET['film_id'];
    $res4 = mysqli_query($connection, "SELECT * FROM films WHERE film_id = '$id' ") or exit("No response");
    $film = mysqli_fetch_array($res4);
    if(isset($_SESSION['id'])){
        if(isset($_POST['add'])) addFavouritesForUser( $connection,$_GET['id'], $film['film_id'], $film['film_name']);
         $user_id = $_SESSION['id'];
         if(isset($_POST['delete'])){
            deleteFavouritesForUser($connection, $user_id, $film['film_id']);
        }
         $res = mysqli_query($connection, "SELECT * FROM favourites WHERE user_id = $user_id");
         $row = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
?>
<article class="content" style="display: block; width: 80%;
font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', Verdana, sans-serif; background: white; color: black;">
<?php if(isset($_GET['id']) and $_GET['id'] != -1): ?>
<form method="post">
    <?php
        $check = false;
     foreach($row as $j){
         if($j['film_id'] == $id) $check = true;
     }
     if(!$check):
     ?>
    <button id="sign" name="add" class="add">Add to my favourites</button> 
    <?php else: ?>
    <span style="color: black !important; background: gray; font-weight: bold; border: none;
     padding: 20px; font-family: Arial, Verdana, sans-serif; margin-bottom: 30px">In favourites</span>
      <button id="sign" name="delete" class="add" style="margin-bottom: 30px">Remove from my favourites</button> 
    <?php endif; ?>
</form>
    <?php endif; ?>
 <?php if(isset($_GET['id']) and $_GET['id'] == 1): ?>
    <a id="sign" href="updatefilm.php?film_id=<?=$_GET['film_id']?>" style=" text-align:center;">Update film</a>
    <a id="sign" href="deletefilm.php?film_id=<?=$_GET['film_id']?>" style="text-align: center">Delete film</a>
<?php endif; ?>
<br>
<h1 style="font-size: 2em; padding-bottom: 1.5em;"><?=$film['film_name'];?></h1>
            
        <div class="film">
        <img src="<?=$film['imgpath']?>" class="filmimg" style="display: block; border: 2px solid black;">
        <div class="filminfo">
        <div class="info">
        <span id="userRate">
        <?php if(isset($_SESSION['id']) and!empty($_SESSION['rate'])):
        for($i = 0; $i < $_SESSION['rate']; $i++) echo '<span class="fas fa-star checked" aria-hidden="true"></span>';
        for($i = 10; $i > $_SESSION['rate']; $i--) echo '<span class="fa fa-star" aria-hidden="true"></span>';
        ?>
        </span>
        <span style="font-weight: bold; margin-left: 10px;">Your rating: <?php echo $_SESSION['rate']; ?> /10</span><br><br>
        <?php endif; ?>
        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 1.3em; ">People's rating: <span class="rate" style="color: crimson;">
        <?php
            $name = $film['film_name'];
            if(!empty($_SESSION['rate'])){
                $num = $_SESSION['rate'];
                    $setviews = mysqli_query($connection, "UPDATE filmstatistics SET views = views + 1 WHERE film_id = $id") or die();
                    $settotal = mysqli_query($connection, "UPDATE filmstatistics SET total = total + '$num' WHERE film_id = $id") or die();
                    if($setviews and $settotal){
                        $setrate = mysqli_query($connection, "UPDATE filmstatistics set rate = total/views WHERE film_id = $id") or die();
                    }
            }
            $printrate = mysqli_query($connection, "SELECT rate FROM filmstatistics WHERE film_id = $id");
            $rate = mysqli_fetch_array($printrate);
            for($i = 1; $i <= $rate['rate']; $i++) echo '<i class="fas fa-star checked" aria-hidden="true"></i>';
            for($i = 10; $i > $rate['rate']; $i--) echo '<i class="fas fa-star" style="color:black"></i>';
        ?>  
        </span>
        </div>
        <div class="info"><span style="font-weight: bold;">Genre: </span><?=$film['genre']?></div>
        <div class="info"><span style="font-weight: bold;">Country: </span><?=$film['country']?></div>
        <div class="info"><span style="font-weight: bold;">Director: </span><?=$film['director']?></div>
        <div class="info"><span style="font-weight: bold;">Premiere date: </span><?=$film['premiere_date']?></div>
        <div class="info"><span style="font-weight: bold;">Actors: </span><?=$film['actors']?></div>
        </div>
        </div>
        <p class="filmdescription">
           <?=$film['description']?>
        </p>
        <?php if(isset($_GET['id']) and $_GET['id'] != -1): ?>
        <form method="post" action="setrate.php" style="display:block; justify-content:center">
            <label for="number" style="display:block">Choose your rating for film: <input id="number" type="number" name="number" min="0" max="10"></label>
            <button id="sign" type="submit" name="submitrate" style="border:none; display:block">Send rate</button>
        </form>
        <?php endif; ?>
        <video class="video" width="80%" height="500" style="position: relative; left: 10%; margin-top: 30px;
         border: 2px solid black;" controls preload="none">
            <source src="https://vk.com/video-145114816_456240159">
        </video>




<div class="comments" style="grid-template-rows: none; row-gap: 20px;">
<?php
$film_id = $_GET['film_id'];
$res = mysqli_query($connection, "SELECT * FROM comments where film_id = $film_id");
$comments = mysqli_fetch_all($res, MYSQLI_ASSOC);
foreach($comments as $comm):
    if(isset($_SESSION['id']) and $_SESSION['id'] == 1){
        $comm_id = $comm['comm_id'];
        echo '<a href="deletepost.php?comm=<?=$comm_id?>" id="sign" style="border: none;">Delete</a>';
    }
?>
<div style="display: flex; margin-bottom: 20px">
<div class="user" style="color: white;"><img src="images/user.png" style="max-width: 100px !important; display: block"><h2><?=$comm['username']?></h2></div>
<div class="comm" style="color: white; width: 100%"><?=$comm['comment']?></div>
</div>
<?php endforeach; ?>
</div>
<?php if(isset($_GET['film_id']) and isset($_SESSION['id'])): ?>
<?php
if(!empty($_POST['comment'])){
    $comm = $_POST['comment'];
    $film_id = $_GET['film_id'];
    $username = $_SESSION['nickname'];
$sql = "INSERT INTO comments(film_id, username, comment) VALUES($film_id, '$username', '$comm');";
$res = mysqli_query($connection, $sql) or die("Failed to add comment");
}
?>
<form id="commsection" method="post" style="background: white;
 text-align: center; display: flex; align-items: center">
 <div>
<label for="comment" style="font-size: 20px; font-family: Arial; display: block">Leave your comment: </label>
<button class="commsubmit" id="sign" style="border: none;" type="submit" name="commentsubmit">Submit</button>
</div>
<textarea id="comm" name="comment" rows="5" style="width: 100%; outline: none; display: block;
 padding: 10px; background: rgba(0, 0, 0, 0.8); color: aliceblue;
font-family: Bahnschrift, Arial,sans-serif; font-size: 20px"></textarea>

</form>
<?php endif; ?>

</article>