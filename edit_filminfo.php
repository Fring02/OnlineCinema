<?php 
require_once "database.php";
?>
<?php
function uploadGeneral(){
    $dir = "images/";
$file = $dir . basename($_FILES['image']['name']);
$uploadCheck = 1;
$imgtype = strtolower(pathinfo($file, PATHINFO_EXTENSION));
if(isset($_POST['submit'])){
    $check = getimagesize($_FILES['image']['tmp_name']);
    if($check === false){
        echo "File is not image";
        $uploadCheck = 0;
    }
}
if($_FILES['image']['size'] > 500000){
    echo "File is too large";
    $uploadCheck = 0;
}
if($imgtype != "jpg" && $imgtype != "png" && $imgtype != "jpeg"
&& $imgtype != "gif" && $imgtype != "jfif") {
    echo "Sorry, only JPG, JPEG, PNG, JFIF & GIF files are allowed.";
    $uploadCheck = 0;
}

if($uploadCheck = 0) echo "Your file is not uploaded";
else{
    if(move_uploaded_file($_FILES['image']['tmp_name'], $file)){
        echo "The image ". basename($_FILES['image']['tmp_name']). " is uploaded";
    }
    else echo "Not uploaded";
}
}
function uploadExtra(){
    $dir = "images/thisweek/";
$file = $dir . basename($_FILES['extraimage']['name']);
$uploadCheck = 1;
$imgtype = strtolower(pathinfo($file, PATHINFO_EXTENSION));
if(isset($_POST['submit'])){
    $check = getimagesize($_FILES['extraimage']['tmp_name']);
    if($check === false){
        echo "File is not image";
        $uploadCheck = 0;
    }
}
if($_FILES['extraimage']['size'] > 500000){
    echo "File is too large";
    $uploadCheck = 0;
}
if($imgtype != "jpg" && $imgtype != "png" && $imgtype != "jpeg"
&& $imgtype != "gif" && $imgtype != "jfif") {
    echo "Sorry, only JPG, JPEG, PNG, JFIF & GIF files are allowed.";
    $uploadCheck = 0;
}

if($uploadCheck = 0) echo "Your file is not uploaded";
else{
    if(move_uploaded_file($_FILES['extraimage']['tmp_name'], $file)){
        echo "The image ". basename($_FILES['extraimage']['tmp_name']). " is uploaded";
    }
    else echo "Not uploaded";
}
}
?>
<?php
require_once "database.php";
require_once "classes.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['fname']) and !empty($_POST['genre']) and !empty($_POST['country']) and !empty($_POST['director'])
    and !empty($_POST['premier_date']) and !empty($_POST['actors']) and !empty($_POST['description'])){
        $name = $_POST['fname'];
        $genre = $_POST['genre'];
        $country = $_POST['country'];
        $director = $_POST['director'];
        $date = $_POST['premier_date'];
        $actors = $_POST['actors'];
        $desc = $_POST['description'];
        $film = new Film();
        $film->setId($id);
        $film->setName($name);
        $film->setGenre($genre);
        $film->setCountry($country);
        $film->setDirector($director); 
        $film->setActors($actors);
        $film->setDesc($desc);   
        $film->setDate($date);
        if($filmsSet->hasFilm($connection, $name)) exit("This film already in database");
        else{
            if($filmsSet->add($connection, $film)){
                echo "Inserted values";
                echo $name;
                uploadGeneral();
                uploadExtra();
            $dir= 'images/' . basename($_FILES["image"]["name"]);
            echo $dir."<br>";
            $extradir = 'images/thisweek/' . basename($_FILES["extraimage"]["name"]);
            echo $extradir;
    $res3 = mysqli_query($connection, "UPDATE films SET imgpath = '$dir', extrapath = '$extradir' WHERE film_name = '$name'");
                if($res3){
                    echo "Successful upload and name register";
    $insert = mysqli_query($connection, "INSERT INTO filmstatistics(film_id) SELECT film_id FROM films WHERE film_name = '$name';");
                    if($insert){
                      header("Location: main.php");
                    exit();  
                    }
                    else exit("Failed to add to statistics");
                }
                else exit("Name registered but image cant be uploaded");
            }
            else exit("Failed to add film");
        }
    }
    else exit("Fill all buttons");
}
?>
<article class="content" style="display: flex; flex-direction: column; justify-content: center; align-items: center; position: relative; top: 20%;
     font-family: 'Lucida Sans', 'Lucida Sans Regular', sans-serif; background: white; color: black; border: 2px solid black; padding-top: 10px;">
        <div class="film">
            <form method="post" action="edit_filminfo.php" enctype="multipart/form-data">
            <label for="fname">Film name: <input type="text" name="fname" style="width:  300px; height: 30px"></label><br><br>
            Select main image: <input type="file" name="image" id="uploadimage"><br><br>
            Select extra image: <input type="file" name="extraimage" id="uploadimage"><br><br>
            <div class="filminfo">
                <div class="info"><span style="font-weight: bold;">Genre:</span> <input type="text" name="genre" style="width:  300px; height: 30px"> </div><br>
                <div class="info"><span style="font-weight: bold;">Country:</span> <input type="text" name="country" style="width:  300px; height: 30px"> </div><br>
                <div class="info"><span style="font-weight: bold;">Director:</span> <input type="text" name="director" style="width:  300px; height: 30px"> </div><br>
                <div class="info"><span style="font-weight: bold;">Premiere date:</span> <input type="date" name="premier_date" ></div><br>
                <div class="info"><span style="font-weight: bold;">Actors:</span> <input type="text" name="actors" style="width:  300px; height: 30px"> </div><br>
            </div>
        </div>
            <p class="filmdescription"><p>Description</p><textarea type="text" name="description"></textarea></p>
            <button type="submit" name="submit">Add</button>
            </form>
    </article>