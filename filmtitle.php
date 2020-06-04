<?php 
        $result = mysqli_query($connection, "SELECT * FROM films ORDER BY film_id DESC LIMIT 1, 1");
        $filmrow = mysqli_fetch_array($result);
        if(!empty($filmrow['film_name'])):
        ?>
            <div class="filmblock">
             <h2 class="film-name"><?=$filmrow['film_name']?></h2>
            <a href="film.php?id=<?=$userinfo['id'];?>&film_id=<?=$row['film_id']?>" class="hoverlink"><img src="images/irishman.jpg" class="filmimg"></a>
            <a class="more" href="film.php?id=<?=$userinfo['id'];?>&film_id=<?=$row['film_id']?>">Learn more...</a>
            </div>
        <?php endif; ?>