<div id="section">
    <?php
        $query = mysqli_query($connect, "SELECT * FROM categories WHERE category_link='".$_GET['category']."'");
        $sonuc = mysqli_fetch_assoc($query);
        if(!count($sonuc)){
            echo "Kategori bulunamıyor";
        }else{
    ?>
    <span class="section-header"><?= $sonuc["category_name"] ?></span>
    <div class="section-content">
    <?php
        $query=mysqli_query($connect,"SELECT * FROM games WHERE ct_id =".$sonuc['ct_id']);
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