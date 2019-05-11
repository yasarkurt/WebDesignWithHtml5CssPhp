<?php if($_GET['comment_id']){ ?>
<div id="section">
    <?php
        $comment_query=mysqli_query($connect,"SELECT * FROM comments INNER JOIN users ON users.user_id = comments.user_id WHERE comment_id = ".$_GET["comment_id"]);
        if($comment_query){
        $comments=mysqli_fetch_assoc($comment_query)
    ?>
    <span class="section-header"><?=$comments['username']?> nickli kullanıcının yorumu</span>
    <div class="section-content">
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
                        ve <a href="?page=liked_ones&comment_id=<?=$sonuc['comment_id']?>"><?= mysqli_num_rows($sorgu) - 3 ?> kişi</a>
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
                    $likes = mysqli_query($connect, "SELECT * FROM likesofcomment WHERE comment_id=".$comments['comment_id']." AND user_id=".$_SESSION['user_id']);
                    $likes_sonuc = mysqli_fetch_assoc($likes);
            ?>
            <div class="comment_buttom_menu">
                    <?php if(!count($likes_sonuc)){ ?>
                <a class="cforc" href="?page=commentsforcomment&comment_id=<?=$_GET["comment_id"]?>&likeforcomment=1"><img src="./src/img/like.png"/><br>Beğen</a>
                    <?php }else{ ?>
                <a class="cforc" href="?page=commentsforcomment&comment_id=<?=$_GET["comment_id"]?>&likeforcomment=0"><img src="./src/img/unlike.png"/><br>Beğenmekten Vazgeç</a>
                    <?php }
                        if(isset($_GET['likeforcomment'])){
                            $like=$_GET['likeforcomment'];
                            $sorgu;
                            if($like>1 && $like<0){
                     
                            }
                            else{
                                 if($like==1 && !count($likes_sonuc)){
                                     $sorgu="INSERT INTO likesofcomment (user_id,comment_id) VALUES (".$_SESSION['user_id'].", ".$comments['comment_id'].")";
                                 }
                                 else{
                                     $sorgu="DELETE FROM likesofcomment WHERE user_id=".$_SESSION['user_id']." AND comment_id=".$comments['comment_id'];
                                 }
                                 $query=mysqli_query($connect,$sorgu);
                                 header('Refresh: 0; url="?page=commentsforcomment&comment_id='.$_GET["comment_id"].'"');
                             }
                           
                        }
                    ?>
            </div>
            <?php } ?>
        </div>
        <hr/>
    <?php
        }
    ?>
    </div>
</div>
<?php
    if(isset($_SESSION['login']) && isset($_GET["comment_id"])){
?>
<div id="section">
    <span class="section-header">Yorum Yap</span>
    <div class="section-content create-comment">
        <form method="POST">
            <textarea name="c_comment" placeholder="Yorumunuz.."></textarea>
            <input type="submit"/>
        </form>
    </div>
    <?php
    if(isset($_POST['c_comment'])){
        $c_comment = trim(htmlspecialchars($_POST['c_comment']));

        if(empty($c_comment)){
            echo "Bir yorum metni giriniz";
        }else{
            $c_comment_query = mysqli_query($connect, "INSERT INTO commentsofcomment (user_id, comment_id, c_comment) VALUES(".$_SESSION['user_id'].", ".$_GET["comment_id"].", '$c_comment')");
            if(!$c_comment_query)
                echo "Bilinmeyen sebeplerden dolayı yorumunuz eklenemedi.";
            else
                header("Refresh: 1;");
        }
    }
?>
</div>
<?php } ?>
<div id="section">
    <span class="section-header">Bu yoruma gelen yorumlar</span>
    <div class="section-content">
    <?php
        $c_comment_query=mysqli_query($connect,"SELECT * FROM commentsofcomment INNER JOIN users ON users.user_id = commentsofcomment.user_id WHERE comment_id=".$_GET["comment_id"]);
        if($c_comment_query){
            while($c_comments=mysqli_fetch_assoc($c_comment_query)){
    ?>
        <div class="comment-profile"><a href="?page=userprofile&username=<?=$c_comments['username']?>"><img src="./src/img/avatar-none.jpg"/><br><?=$c_comments['username']?></a></div>
        <div class="comment-div">
            <?=$c_comments['c_comment']?>
        </div>
        <hr/>
    <?php
            }
        }
    ?>
    </div>
</div>
<?php } ?>