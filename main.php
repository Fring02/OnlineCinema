<?php session_start(); 
setcookie('visits', 0, time() + 86400);
if(isset($_SESSION['id']) and $_SESSION['id'] != 1) $_COOKIE['visits']++;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Document</title>
    <link rel="stylesheet" href="style.php" media="screen">
    <link href="final.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/1aba20f126.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="scripts.js"></script>
<script>
$(document).ready(function(){
let width = $('.more').width();
$('.filmimg').css('width', width + '%');
if($('body').width() > 800 + 'px') $('#nav-list').css('display', 'block');
let n = $('.hoverlink').length;
$('.side').css('background', 'rgba(0, 0, 0, 0.5)');

$('button.commsubmit').prop(disabled, true);
if($('#comm').val() != null) $('.commsubmit').prop(disabled, false);
}); 
</script>
<style>
    
    @media all and (max-width: 1510px){
        h2.film-name{  min-height: 80px !important;}
    }
    @media all and (max-width: 1300px){
            header.header{  display: block; }
            ul#nav-list{  flex: none;  max-width: 100%;  padding:  50px; }
            a.nav-link{ font-size: 2.5em;}
            div.title{    display: flex;    justify-content: center;    max-width: 100%;}
            img#titleimg{    max-height: 150px;}
            div.row{
                flex-direction: column-reverse;
            }
            div.filmgallery, div.intro{    flex: none;    max-width: 100%;}
            .prev, .next{    top: 90%;}
             div.intro{ display: flex; flex-direction: column-reverse;}
            h1#present{   text-align: center;}
    }
    @media all and (max-width: 1210px){
        article.content{    grid-template-columns: 1fr 1fr 1fr !important;}
        .prev, .next{    top: 90%;}
    }
    @media all and (max-width: 1020px){
        article.content{ width: 100% !important; grid-template-columns: 1fr 1fr !important; }
        main{ display: block; }
        footer{ padding:50px; }
    }
    @media all and (max-width:800px){
        button.prev, button.next{  top: 105%; }
        button#click{  display: block !important; }
        footer{  display: block !important; }
        .faq, .about, .contacts{  flex: none;   max-width: 100%;   border-left: 2px solid skyblue; }
        .contacts{ border-right: 2px solid skyblue;  text-align: center;  border-bottom: 2px solid skyblue; }
        ul#nav-list{  display: none;  border: 2px solid crimson;   background: rgba(0, 0, 0, 0.8);}
        li.nav-li{  margin-bottom: 10px;  border-bottom: 2px solid crimson;   text-align: center;   max-width: 100%;}
        a.nav-link{   font-size: 2em; }
    }
    @media all and (max-width: 500px){
        header{ padding: 0 40px; }
        article.content{ grid-template-columns: 1fr !important; }
        h1#titlename{ font-size: 2em; }
    }
    @media all and (max-width:1100px){
        #map{ left: -150px !important; }    
    }
    #map{ width: 80%; position: relative; left: 10%; height: 200px; }
    

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
  -moz-appearance: textfield;
}
</style>
</head>
<?php
require_once "classes.php";
$result = mysqli_query($db->connect(), "SELECT * FROM films");
$films = mysqli_fetch_all($result, MYSQLI_ASSOC);
$users = $db->getAllUsers();
?>
<body style="background-image: url(bodybackground.jpg); background-attachment: fixed; background-size: cover;" onload="document.registration.name.focus();"
onpageshow="hideUl();">
    <header class="header">
        <div class="title">
            <img src="cinemalogo.jpg" id="titleimg">
            <h1 id="titlename">
            <?php if(isset($_GET['id'])): $id = $_GET['id'];?>
            <a style="color:aliceblue; text-decoration: none; font-size: 0.9em !important; z-index: 999 !important" href="main.php?id=<?=$id?>">FILMGRID</a>
            <?php else: ?>
            <a style="color:aliceblue; text-decoration: none; font-size: 0.9em !important; z-index: 999 !important" href="main.php">FILMGRID</a>
            <?php endif; ?>
            </h1>
        </div>
        <button id="click" type="button" style="color: aliceblue; font-size: 3.5em; margin-left: 20px; border: none; background: none;" onclick="showList()" ><i class="fas fa-bars"></i></button>
            <ul id="nav-list">
                <li class="nav-el"><a style="font-size: 1.3em" class="nav-link" href="main.php?films">Movies</a></li>
                <li class="nav-el"><a style="font-size: 1.3em" class="nav-link" href="main.php?serials">Serials</a></li>
                <li class="nav-el"><a style="font-size: 1.3em" class="nav-link" href="#bottom">About us</a></li>
                <li class="nav-el"><a style="font-size: 1.3em" class="nav-link" href="#">Home</a></li>
            </ul>
    </header>
    <div class="row">
   <div class="intro">
        <h1 id="present" style="padding: 30px; font-size: 2em; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; border-bottom: 3px solid skyblue;">Welcome to our website!</h1>
        <p style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; display: block;">
            This is our online platform of watching TV series online! Here you can look for today's premieres, TV series, and also, find information about us!
            Visit us more! You can also sign in, by going bottom.
        </p>
        <span style="display: block; padding:30px; font-family: 'Noto Sans JP', Arial, sans-serif; font-size: 2.7em; color: skyblue;
         font-variant: small-caps; text-align: center;">This week's charts: </span>
    </div>
     <div class="filmgallery">
<div class="slider" style="position: relative">
    <?php
        $i = 1;
        foreach($films as $film):
            if(isset($_GET['id'])) $id = $_GET['id'];
            else $id = -1;
    ?>
    <div class="slide fade" style="display: none">
    <a href="main.php?id=<?=$id;?>&film_id=<?=$film['film_id'];?>&path=<?=$film['imgpath'];?>" 
    class="hoverlink" id="img<?=$i++?>"><img src="<?=$film['extrapath']?>" class = "galleryfilm"></a>
    </div>
    <?php endforeach; unset($i); ?>
    <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
    <button class="next" onclick="plusSlides(1)">&#10095;</button>
</div>

<div style="text-align:center; background: rgba(0, 0, 0, 0.8); padding: 15px 0;">
<?php 
    $res = mysqli_query($db->connect(), "SELECT * FROM films");
    $row = mysqli_num_rows($result);
    for($i = 1; $i <= $row; $i++):
?>
    <span class="dot" onclick="currentSlide(<?=$i;?>)"></span>
<?php endfor; ?>
</div>
</div> 
</div>

<main>
<?php
    if(isset($_SESSION['id']))
    $user_id = $_SESSION['id'];
    else $user_id = -1;
?> 
<?php 
    if(!isset($_GET['film_id']) and !isset($_GET['path'])):
        if(!isset($_GET['genre'])){
            $result = mysqli_query($db->connect(), "SELECT * FROM films");
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if(empty($row)) exit("<h2 style='color: white'>On this time, current films are unavailable</h2>");
        }
    else{
       $genre = $_GET['genre'];
       $show = mysqli_query($db->connect(), "SELECT * FROM films WHERE genre = '$genre' ") or die("Incorrect query");
       $row = mysqli_fetch_all($show, MYSQLI_ASSOC);
       if(empty($row)) echo '<h2 style="background: white; font-size: 3em;
        font-family: Arial;">Genfilms are not available</h2>';
    }
?>

<article class="content" style="width: 80%; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 
sans-serif; background: white; color: black; grid-template-columns: repeat(4, 1fr)">
<?php if(isset($_GET['favourites'])): ?>
<script>
    $(document).ready(function(){
        $.ajax({
            url: 'uploadimage.php',
            success: function(data){
                let films = JSON.parse(data);
                for(let i = 0; i < films.length; i++){
$('.content').append('<div class="filmblock"><a href="main.php?id=' + <?php echo $_SESSION['id']; ?> + '&film_id=' + films[i].film_id + '&path=' + films[i].imgpath + '" class="hoverlink"><img src="' + films[i].imgpath + '" class="filmimg"></a>'+
'<a style="font-size: 15px; font-weight: bold" class="more" href="main.php?id=' + <?php echo $_SESSION['id']; ?> + '&film_id=' + films[i].film_id + '&path=' + films[i].imgpath + '">' + films[i].film_name + '</a></div>');
                }
            }
        });
    });
</script>
<?php else: ?>
<?php foreach($row as $film): ?>   
    <div class="filmblock">
    <a href="main.php?id=<?=$user_id;?>&film_id=<?=$film['film_id'];?>&path=<?=$film['imgpath'];?>" class="hoverlink"><img src="<?=$film['imgpath']?>" class="filmimg"></a>
    <a style="font-size: 15px; font-weight: bold" class="more" href="main.php?id=<?=$user_id;?>&film_id=<?=$film['film_id']?>&path=<?=$film['imgpath']?>"><?=$film['film_name']?></a>
    </div> 
<?php endforeach; endif; ?>
</article>
<?php else: require_once "filmblock.php"; ?>
<?php endif; ?>
<aside class="side">
<div class="register">
<?php
if(isset($_SESSION['in_system']) and $_SESSION['in_system'] === true) require_once "welcome.php";
else require_once "form.php";
?>
</div>
<div class="genres" style="background: rgba(0, 0, 0, 0.5); color: aliceblue;">
<ul id="genrelist">
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=action&id=<?=$user_id?>">Action</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=drama&id=<?=$user_id?>">Drama</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=comedy&id=<?=$user_id?>">Comedy</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=thriller&id=<?=$user_id?>">Thriller<a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=arthouse&id=<?=$user_id?>">Art-house</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=biography&id=<?=$user_id?>">Biography</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=documentary&id=<?=$user_id?>">Documentary</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=historical&id=<?=$user_id?>">Historical</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=fantasy&id=<?=$user_id?>">Fantasy</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=scifi&id=<?=$user_id?>">Science Fiction</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=horror&id=<?=$user_id?>">Horror</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=romance&id=<?=$user_id?>">Romance</a></li>
    <li class="genrelist-el"><a class="genre-link" href="main.php?genre=sport&id=<?=$user_id?>">Sport</a></li>
</ul> 

<form style="padding: 50px;">
    <input type="search" placeholder="Search for..." id="search" onkeyup="findName()">
    <ul id="catalog" style="display: block; background: aliceblue; padding: none;">
    <?php
    foreach($films as $film):
    ?>
    <li class="neededfilmel">
    <a href="main.php?id=<?=$_GET['id'];?>&film_id=<?=$film['film_id'];?>&path=<?=$film['imgpath'];?>" 
    class="neededfilm"><?=$film['film_name']?>
    </a>
    </li>
    <?php endforeach; ?>
    </ul>
    <br>
    <?php if(isset($_SESSION['id']) and $_SESSION['id'] == 1): 
        $id = $_SESSION['id']?>
        <a href="edit_filminfo.php" id="sign" style="display:block">Add film</a>
    <?php endif; ?>
</form>
</div>
</aside>
</main>

<footer class="footer" style="border-top: 1px solid aliceblue;">
    <div class="about">
        <h3 class="footertitle" style="border-bottom: 2px solid skyblue;">About Us<br><br><i class="fas fa-address-card"></i></h3>
        <p class="footerinfo" style="display: block;"><a name = "bottom"></a>
           We are young team of web-developers. Our goal is to provide good relational design, together with strong bonefish, and <a></a>bla bla bla.</p>
    </div>
    <div class="faq">
        <h3 class="footertitle" style="border-bottom: 2px solid crimson;">F.A.Q.<br><br><i class="fas fa-question"></i></h3>
        <dl class="footerinfo">
            <dt style="background: skyblue; padding: 10px; color: black; font-weight: bold; letter-spacing: -1px; font-size: 20px;">1.Are movies on this website free?</dt>
            <dd style="font-size: 13px; margin: 15px 0; letter-spacing: 0px;">Yes, you don't have to pay for watching not only movies, but serials, TV series.</dd>
            <dt style="background: skyblue; padding: 10px; color: black; font-weight: bold; letter-spacing: -1px; font-size: 20px;">2.How can i sign in?</dt>
            <dd style="font-size: 13px; margin: 15px 0; letter-spacing: 0px;">You need to fill the registration form. After you become website's visitors' member, you don't need to register further.</dd>
            <dt style="background: skyblue; padding: 10px; color: black; font-weight: bold; letter-spacing: -1px; font-size: 20px;">3.Will you work with this website next time?</dt>
            <dd style="font-size: 13px; margin: 15px 0; letter-spacing: 0px;">Yes, it's our new project, and with time, all bugs would be eliminated. Therefore, new design will be added, and previous will be changed.</dd>
        </dl>
    
</div>
    </div>
    <div class="contacts">
        <h3 class="footertitle">Contacts<br><br><i class="fas fa-phone"></i></h3>
         <p class="footerinfo">
            <div class="phonenum">+7(776) - 166 - 70 - 60 - <span class="numtext">Team lead - Jack</span></div>
            <div class="phonenum">+7(705) - 115 - 23 - 66 - <span class="numtext">Co-founder</span></div>
            <div class="phonenum">8(717 - 2) 84 - 12 - 48 - <span class="numtext">Office phone number</span></div><br>
         <br>
            <small style="text-align: center; display: block;">All rights are reserved &copy; 2020</small>
        </p>
    </div>
</footer>
</body>
</html>
