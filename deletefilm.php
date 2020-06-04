
<?php
require_once "database.php";
require_once "classes.php";
$id = $_GET['film_id'];
if($filmsSet->deleteById($connection, $id)){
    header("Location: main.php");
    exit();
}
else exit("Failed to delete");
?>