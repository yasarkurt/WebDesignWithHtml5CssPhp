<div id="section" style="width: 100%; float: none;">
<?php
    $query=mysqli_query($connect,"SELECT * FROM games WHERE games.game_id='".$_GET['game-play']."'");
    $sonuc=mysqli_fetch_assoc($query);
    if(!count($sonuc)){
        echo "Oyun bulunmuyor.";
    }else{
?>
    <span class="section-header"><?=$sonuc['game_name']?></span>
    <div class="section-content" style="width: calc(100% - 10px);">
        <?=$sonuc['game_address']?>
    </div>
<?php
    }
?>
</div>