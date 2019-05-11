<?php if(isset($_GET['game']) && $_GET['game'] == ''){ }else{ ?>
<div id="section">
<?php
    $query=mysqli_query($connect,"SELECT * FROM games INNER JOIN categories ON categories.ct_id=games.ct_id WHERE games.game_link='".$_GET['game']."'");
    $sonuc=mysqli_fetch_assoc($query);
    $date = date_create($sonuc["game_date"]);
    $begeni_sayisi = mysqli_query($connect, "SELECT count(*) as t FROM likes WHERE game_id=".$sonuc['game_id']);
    $dislike_sayisi = mysqli_query($connect, "SELECT count(*) as t FROM dislikes WHERE game_id=".$sonuc['game_id']);
    if(!count($sonuc)){
        echo "Oyun bulunmuyor.";
    }else{
?>
    <span class="section-header"><?=$sonuc['game_name']?></span>
    <div class="section-content">
        <div class="game_img">
            <img src="./src/img/elements-banner/<?=$sonuc["game_img"] ?>"/>
        </div>
        <div class="game_info">
            <span >Oyun Adı:</span> <?= $sonuc["game_name"]?><br>
            <span >Kategori Adı:</span> <?= $sonuc["category_name"]?><br>
            <span >Beğenen:</span> <?= mysqli_fetch_assoc($begeni_sayisi)["t"] ?><br>
            <span >Beğenmeyen:</span> <?= mysqli_fetch_assoc($dislike_sayisi)["t"] ?><br>
            <?= date_format($date, "d.m.Y") ?><span > tarihinde eklenmiştir.</span><br>
            <div class="like_buttons">
                <?php
                if(isset($_SESSION['login'])){
                    $likes = mysqli_query($connect, "SELECT * FROM likes WHERE game_id=".$sonuc['game_id']." AND user_id=".$_SESSION['user_id']);
                    $likes_sonuc = mysqli_fetch_assoc($likes);
                    $dislikes = mysqli_query($connect, "SELECT * FROM dislikes WHERE game_id=".$sonuc['game_id']." AND user_id=".$_SESSION['user_id']);
                    $dislikes_sonuc = mysqli_fetch_assoc($dislikes);
                    if(count($likes_sonuc)){
                       ?>
                       <a href="?game=<?=$sonuc["game_link"]?>&like=0"><img src="./src/img/unlike.png"><br>Beğenmekten Vazgeç</a>
                       <?php  
                    }
                    else{
                        ?>
                    <a href="?game=<?=$sonuc["game_link"]?>&like=1"><img src="./src/img/like.png"><br>Beğen</a>
                    <?php
                    }

                    if(isset($_GET['like'])){
                        $like=$_GET['like'];
                        $sorgu;
                        if($like>1 && $like<0){
                 
                        }
                        else{
                             if($like==1 && !count($likes_sonuc)){
                                 $sorgu="INSERT INTO likes (user_id,game_id) VALUES (".$_SESSION['user_id'].", ".$sonuc['game_id'].")";
                                 if(count($dislikes_sonuc)){
                                    $sorgu2="DELETE FROM dislikes WHERE user_id=".$_SESSION['user_id']." AND game_id=".$sonuc['game_id'];
                                    mysqli_query($connect,$sorgu2);
                                 }
                             }
                             else{
                                 $sorgu="DELETE FROM likes WHERE user_id=".$_SESSION['user_id']." AND game_id=".$sonuc['game_id'];
                             }
                             $query=mysqli_query($connect,$sorgu);
                             header('Refresh: 1; url="?game='.$sonuc["game_link"].'"');
                         }
                       
                    }
              }
              ?>
            </div>
            <div class="dislike_buttons">
                <?php
                if(isset($_SESSION['login'])){
                    if(count($dislikes_sonuc)){
                       ?>
                       <a href="?game=<?=$sonuc["game_link"]?>&dislike=0"><img src="./src/img/undislike.png"><br>Beğenmemekten Vazgeç</a>
                       <?php  
                    }
                    else{
                        ?>
                    <a href="?game=<?=$sonuc["game_link"]?>&dislike=1"><img src="./src/img/dislike.png"><br>Beğenme</a>
                    <?php
                    }

                    if(isset($_GET['dislike'])){
                        $dislike=$_GET['dislike'];
                        $sorgu;
                        if($dislike>1 && $dislike<0){
                 
                        }
                        else{
                             if($dislike==1 && !count($dislikes_sonuc)){
                                 $sorgu="INSERT INTO dislikes (user_id,game_id) VALUES (".$_SESSION['user_id'].", ".$sonuc['game_id'].")";
                                 if(count($likes_sonuc)){
                                    $sorgu2="DELETE FROM likes WHERE user_id=".$_SESSION['user_id']." AND game_id=".$sonuc['game_id'];
                                    mysqli_query($connect,$sorgu2);
                                 }
                            }
                             else{
                                 $sorgu="DELETE FROM dislikes WHERE user_id=".$_SESSION['user_id']." AND game_id=".$sonuc['game_id'];
                             }
                             mysqli_query($connect,$sorgu);
                             header('Refresh: 1; url="?game='.$sonuc["game_link"].'"');
                         }
                       
                    }
              }
              ?>
            </div>
        </div>
        <div class="game_desc">
            <?= $sonuc["game_desc"] ?>
        </div>
        <div id="game-play">
            <img src="./src/img/elements-banner/<?=$sonuc["game_img"]?>" width="100" height="77"/> 
            <a href="?game-play=<?=$sonuc["game_id"]?>"><?=$sonuc["game_name"]?></a>
        </div>
        <div class="liked_ones">
            Beğenenler:
            <?php
                $sorgu = mysqli_query($connect, "SELECT * FROM likes INNER JOIN users ON users.user_id = likes.user_id WHERE likes.game_id=".$sonuc['game_id']."");
                $i = 0;
                
                while($liked_ones = mysqli_fetch_assoc($sorgu)){
                    if(isset($_SESSION['login']) && $liked_ones['username'] == $_SESSION['username'])
                        $liked_ones['username'] = "Ben";
                    $i++;
                    if($i>3){
                        ?>
                        ve <a href="?page=liked_ones&game_id=<?=$sonuc['game_id']?>"><?= mysqli_num_rows($sorgu) - 3 ?> kişi</a>
                        <?php
                        echo " beğendi";
                        break;
                    }
            ?>
            <a href="?page=userprofile&username=<?=$liked_ones['username']?>"><?=$liked_ones['username']?></a>,
            <?php
                }
            ?>
        </div>
    </div>
<?php
    }
?>
</div>
<?php
    if(isset($_SESSION['login'])){
?>
<div id="section">
    <span class="section-header">Yorum Yap</span>
    <div class="section-content create-comment">
        <form method="POST">
            <textarea name="comment" placeholder="Yorumunuz.."></textarea>
            <input type="submit"/>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['comment'])){
        $comment = trim(htmlspecialchars($_POST['comment']));

        if(empty($comment)){
            echo "Bir yorum metni giriniz";
        }else{
            $comment_query = mysqli_query($connect, "INSERT INTO comments (user_id, game_id, comment) VALUES(".$_SESSION['user_id'].", ".$sonuc["game_id"].", '$comment')");
            if(!$comment_query)
                echo "Bilinmeyen sebeplerden dolayı yorumunuz eklenemedi.";
            else
                header("Refresh: 1;");
        }
    }}
?>
<div id="section">
    <span class="section-header">Yorumlar</span>
    <div class="section-content">
    <?php
        $comment_query=mysqli_query($connect,"SELECT * FROM comments INNER JOIN users ON users.user_id = comments.user_id WHERE game_id=".$sonuc["game_id"]);
        if($comment_query){
            while($comments=mysqli_fetch_assoc($comment_query)){
    ?>
        <div class="comment-profile"><a href="?page=userprofile&username=<?=$comments['username']?>"><img src="./src/img/avatar-none.jpg"/><br><?=$comments['username']?></a></div>
        <div class="comment-div">
            <?=$comments['comment']?>
            <div class="liked_ones">
            Beğenenler:
            <?php
                $sorgu = mysqli_query($connect, "SELECT * FROM likesofcomment as likes INNER JOIN users ON users.user_id = likes.user_id WHERE likes.comment_id=".$comments['comment_id']."");
                $i = 0;
                
                while($liked_ones = mysqli_fetch_assoc($sorgu)){
                    if(isset($_SESSION['login']) && $liked_ones['username'] == $_SESSION['username'])
                        $liked_ones['username'] = "Ben";
                    $i++;
                    if($i>3){
                        ?>
                        ve <a href="?page=liked_ones&comment_id=<?=$comments['comment_id']?>"><?= mysqli_num_rows($sorgu) - 3 ?> kişi</a>
                        <?php
                        echo " beğendi";
                        break;
                    }
            ?>
            <a href="?page=userprofile&username=<?=$liked_ones['username']?>"><?=$liked_ones['username']?></a>,
            <?php
                }
            ?>
            </div>
            <?php
                if(isset($_SESSION['login'])){
                    $clikes = mysqli_query($connect, "SELECT * FROM likesofcomment WHERE comment_id=".$comments['comment_id']." AND user_id=".$_SESSION['user_id']);
                    $clikes_sonuc = mysqli_fetch_assoc($clikes);
            ?>
            <div class="comment_buttom_menu">
                <a class="cforc" href="?page=commentsforcomment&comment_id=<?=$comments["comment_id"]?>"><img src="./src/img/comment.png"/><br>Yorum Yap</a>
                    <?php if(!count($clikes_sonuc)){ ?>
                <a class="cforc" href="?game=<?=$sonuc["game_link"]?>&comment_id=<?=$comments["comment_id"]?>&likeforcomment=1"><img src="./src/img/like.png"/><br>Beğen</a>
                    <?php }else{ ?>
                <a class="cforc" href="?game=<?=$sonuc["game_link"]?>&comment_id=<?=$comments["comment_id"]?>&likeforcomment=0"><img src="./src/img/unlike.png"/><br>Beğenmekten Vazgeç</a>
                    <?php }
                    ?>
            </div>
            <?php } ?>
        </div>
        <hr/>
    <?php
            }
            if(isset($_GET['likeforcomment']) && isset($_SESSION['login'])){
                $like=$_GET['likeforcomment'];
                $sorgu;
                if($like>1 && $like<0){
         
                }
                else{
                     if($like==1 && !count($clikes_sonuc)){
                         $sorgu="INSERT INTO likesofcomment (user_id,comment_id) VALUES (".$_SESSION['user_id'].", ".$_GET['comment_id'].")";
                     }
                     else{
                         $sorgu="DELETE FROM likesofcomment WHERE user_id=".$_SESSION['user_id']." AND comment_id=".$_GET['comment_id'];
                     }
                     $query=mysqli_query($connect,$sorgu);
                     header('Refresh: 0; url="?game='.$sonuc["game_link"].'"');
                 }
               
            }
        }
    ?>
    </div>
</div>

    <?php } ?>