<?php
    if(!strlen(trim(htmlspecialchars($_GET['search'])))){
        header("Location: index.php");
    }else{
?>
<div id="section">
    <span class="section-header"><?=$_GET['search']?> ifadesini içeren oyunlar</span>
    <div class="section-content">
    <?php
        $query=mysqli_query($connect,"SELECT * FROM games WHERE game_name LIKE '%".$_GET['search']."%'");
        if(count(mysqli_fetch_assoc($query))){
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
        }else{
            echo "Aradığınız kritere ait sonuç bulunamamıştır.";
        }
    ?>
    </div>
</div>
<?php
    }
?>