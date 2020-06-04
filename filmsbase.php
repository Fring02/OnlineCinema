<?php
require "database.php";
$res = mysqli_query($connection, "SELECT * FROM films");
$films = mysqli_fetch_all($res, MYSQLI_ASSOC);
foreach($films as $film){
    echo json_encode($film);
}
?>