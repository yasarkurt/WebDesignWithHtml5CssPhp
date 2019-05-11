<div id="section">
    <?php
    if(isset($_GET['username']) && $_GET['username'] != @$_SESSION["username"]){
        $sorgu=mysqli_query($connect,"SELECT user_id FROM users WHERE username='".$_GET['username']."'");
        $id=mysqli_fetch_assoc($sorgu)["user_id"];
    }else{
        $id = $_SESSION["user_id"];
    }
    if(isset($_SESSION['login'])){ ?>
    <span class="section-header"><?= (isset($_GET['username']) && $_GET['username'] != @$_SESSION["username"]) ? $_GET['username']." kullanıcısının beğendiği oyunlar":"Beğendiğiniz Oyunlar" ?></span>
    <div class="section-content">
    <?php
        $query=mysqli_query($connect,"SELECT * FROM games INNER JOIN likes ON likes.game_id=games.game_id WHERE likes.user_id =".$id);
        if($query){
            while($sonuc=mysqli_fetch_assoc($query)){
    ?>
        <a href="?game=<?php echo $sonuc["game_link"] ?>">
            <div class="element">
                <img src="./src/img/elements-banner/<?=$sonuc["game_img"] ?>"/>
                <span class="element-title"><?= $sonuc["game_name"]?></span>
            </div>
        </a>
    <?php 
            }
        }
    ?>
    </div>
    <?php
        }  
    ?>
</div>