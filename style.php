<?php
header("Content-type: text/css");
require_once "database.php";
$res = mysqli_query($connection, "SELECT film_name from films");
$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
$i = 1;
foreach($row as $film):
?>
#img<?=$i++?>:hover:after{
    content: <?php echo "'".$film['film_name']."';";?>
    
}
<?php
endforeach;
unset($i);
?>