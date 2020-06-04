<?php
$host = 'localhost';
$name = 'Sultanbek';
$password = 'Rubin1!!';
$db_name = 'test';
$connection = mysqli_connect($host, $name, $password, $db_name) or die("Failed to connect to database");
function addFavouritesForUser($connection, $user_id, $film_id, $film_name){
    $check = mysqli_query($connection, "SELECT film_id FROM favourites WHERE user_id = $user_id");
    $row = mysqli_fetch_array($check);
    if(empty($row)){
        $add = mysqli_query($connection, "INSERT INTO favourites(user_id,film_id, film_name) VALUES($user_id, '$film_id', '$film_name');");
        if(!$add) echo '<script>alert("Failed to add to favourites");</script>';
    }
    else{
        if($row['film_id'] != $film_id){
            $add = mysqli_query($connection, "INSERT INTO favourites(user_id,film_id, film_name) VALUES($user_id, '$film_id', '$film_name');");
            if(!$add) echo '<script>alert("Failed to add to favourites");</script>';
        }
        else{
            echo '<script>alert("This film is already in favourites");</script>';
        }
    }
}

function deleteFavouritesForUser($connection, $user_id, $film_id){
    $sql = "DELETE FROM favourites WHERE user_id = $user_id AND film_id = $film_id";
    $deletion = mysqli_query($connection, $sql);
    if(!$deletion) echo '<script>alert("Failed");</script>';
}
?>