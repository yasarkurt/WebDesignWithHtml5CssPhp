<div id="section">
    <span class="section-header">Beğenenler</span>
    <div class="section-content">
        <ul>
        <?php
            if(isset($_GET["game_id"])){
                $sorgu = mysqli_query($connect, "SELECT * FROM likes INNER JOIN users ON users.user_id = likes.user_id WHERE likes.game_id=".$_GET['game_id']."");
                while($liked_ones = mysqli_fetch_assoc($sorgu)){
                ?>
                <li><a href="?page=userprofile&username=<?=$liked_ones['username']?>"><?=$liked_ones['username']?></a></li>
                <?php
                }
            }else if(isset($_GET["comment_id"])){
                $sorgu = mysqli_query($connect, "SELECT * FROM likesofcomment as likes INNER JOIN users ON users.user_id = likes.user_id WHERE likes.comment_id=".$_GET['comment_id']."");
                while($liked_ones = mysqli_fetch_assoc($sorgu)){
                ?>
                <li><a href="?page=userprofile&username=<?=$liked_ones['username']?>"><?=$liked_ones['username']?></a></li>
                <?php
                }
            }
        ?>
        </ul>
    </div>
</div>