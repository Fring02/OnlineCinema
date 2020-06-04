<?php
if(session_id() == '') session_start();
require_once "database.php";
$id = $_SESSION['id'];
$res = mysqli_query($connection, "SELECT film_id FROM favourites WHERE user_id = $id");
$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
$arr = array();
$i = 0;
if($res){
   foreach($row as $film){
       $id = $film['film_id'];
       $res = mysqli_query($connection, "SELECT * FROM films WHERE film_id = $id");
       $j = mysqli_fetch_array($res);
       $arr[$i++] = $j;
   }
}
$mul = json_encode($arr);
echo $mul;
?>