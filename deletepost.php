<?php
require_once "database.php";
if(isset($_GET['comm'])){
    $id = $_GET['comm'];
    $res = mysqli_query($connection, "DELETE FROM comments WHERE comm_id = $id");
    if($res){
        header("Location: main.php");
        exit();
    }
    else exit("Failed to delete");
}
?>  
