<?php 
require_once "database.php";
require_once "classes.php";
echo $_GET['film_id'];
?>
            <article class="content" style="display: flex; flex-direction: column; justify-content: center; align-items: center; position: relative; top: 20%;
     font-family: 'Lucida Sans', 'Lucida Sans Regular', sans-serif; background: white; color: black; border: 2px solid black; padding-top: 10px;">
        <div class="film">
            <form method="post" enctype="multipart/form-data">
            <div class="filminfo">
                <div class="info"><span style="font-weight: bold;">Genre:</span> <input type="text" name="genre" style="width:  300px; height: 30px"> </div><br>
                <div class="info"><span style="font-weight: bold;">Country:</span> <input type="text" name="country" style="width:  300px; height: 30px"> </div><br>
                <div class="info"><span style="font-weight: bold;">Director:</span> <input type="text" name="director" style="width:  300px; height: 30px"> </div><br>
                <div class="info"><span style="font-weight: bold;">Premiere date:</span> <input type="date" name="premier_date" ></div><br>
                <div class="info"><span style="font-weight: bold;">Actors:</span> <input type="text" name="actors" style="width:  300px; height: 30px"> </div><br>
            </div>
        </div>
            <p class="filmdescription"><p>Description</p>
            <textarea type="text" name="description"></textarea>
            </p>
            <button type="submit" name="update">Update</button>
            </form>
    </article>
    <?php
if(isset($_POST['update'])){
    if(!empty($_POST['genre']) and !empty($_POST['country']) and !empty($_POST['director'])
    and !empty($_POST['premier_date']) and !empty($_POST['actors']) and !empty($_POST['description'])){
        $genre = $_POST['genre'];
        $country = $_POST['country'];
        $director = $_POST['director'];
        $date = $_POST['premier_date'];
        $actors = $_POST['actors'];
        $desc = $_POST['description'];
        $id = $_GET['film_id'];
        if($filmsSet->contains($connection, $id)){
            $film = new Film();
            $film->setId($id);
            $film->setGenre($genre);
            $film->setCountry($country);
            $film->setDirector($director);
            $film->setDate($date);
            $film->setActors($actors);
            $film->setDesc($desc);
            if($filmsSet->update($connection, $film)){
                header("Location: main.php");
                exit();
            }
            else exit("Failed to update");
        }
        else exit("This film doesn't exist");
    }
    else exit("Fill files");
}
?>