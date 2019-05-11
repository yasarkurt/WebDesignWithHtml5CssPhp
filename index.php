<?php
ob_start();
require_once("./connect.php");
session_start();

if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $username = $_COOKIE['username'];
    $pass= $_COOKIE['password'];
    $sorgu=mysqli_query($connect,"SELECT * FROM users WHERE username='".$username."' AND pass='".$pass."' LIMIT 1");
    if($sorgu){
        $sonuc= mysqli_fetch_assoc($sorgu);
        if(count($sonuc)>0){
            $_SESSION['user_id']=$sonuc['user_id'];
            $_SESSION['username']=$username;
            $_SESSION['login']=true;
            header('Refresh: 1;');
        }else{
            echo "Böyle bir kullanıcı yoktur.";
        }
    }
}

if(count($_POST) > 0 && isset($_POST['username'])){
    $username=trim(htmlspecialchars($_POST['username']));
    $pass=trim(htmlspecialchars($_POST['pass']));
    if(!empty($username)&&!empty($pass)){
        
        $pass=md5($pass);
        $sorgu=mysqli_query($connect,"SELECT *FROM users WHERE username='".$username."' AND pass='".$pass."' LIMIT 1");
        if($sorgu){
            $sonuc= mysqli_fetch_assoc($sorgu);
            if(count($sonuc)>0){
                $_SESSION['user_id']=$sonuc['user_id'];
                $_SESSION['username']=$username;
                $_SESSION['login']=true;

                if(isset($_POST["remember_me"])){
                    setcookie("username", $username, strtotime("+15 Days"));
                    setcookie("password", $pass, strtotime("+15 Days"));
                }else{
                    setcookie("username", "", strtotime("-15 Days"));
                    setcookie("password", "", strtotime("-15 Days")); 
                }
                header('Refresh: 1;');
            }else{
                echo "Böyle bir kullanıcı yoktur.";
            }
        }
    }else{
        echo "Tüm Alanları Lütfen Doldurun";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/style.css">
    <title>SubwaySurfers</title>
</head>
<body>
    <div id="header">
        <div id="top-bar">
            <a href="./index.php">
                <img src="./src/img/logo.png" id="logo"/>
            </a>
            <ul id="top-menu">
                <li><a>Anasayfa</a></li>
                <li><a>Yeni Subway Surfers Oyunları</a></li>
                <li><a>Popüler Subway Surfers Oyunları</a></li>
                <li><a>Editör Subway Surfers Oyunları</a></li>
                <li><a>İletişim</a></li>
            </ul>
        </div>
        <div id="lang-div">
            <span style="display: block; width: 200px; height: 15px; text-decoration:underline; font-weight: bold;">
                ÜYELİK SİSTEMİ AKTİFTİR.
            </span>
            <a href="http://www.subwaysurfers.name.tr/Theme/Default/oyunlar.htm" id="oyunac">
                <img src="./src/img/oyunacma.png" style="width: 430px; height: 30px;"/>
            </a>
            <img src="./src/img/tr.png" class="lang"/>
            <img src="./src/img/az.png" class="lang"/>
            <img src="./src/img/us.png" class="lang"/>
            <img src="./src/img/bg.png" class="lang"/>
            <img src="./src/img/ru.png" class="lang"/>
            <img src="./src/img/uk.png" class="lang"/>
        </div>
        <div id="search-bar">
            <a href="./index.php">
                <img src="./src/img/homepage.png" id="homepage"/>
            </a>
            <div class="search-outline">
                <form class="search" method="GET">
                    <input type="search" placeholder="Oyun Ara..." name="search"/>
                    <input type="submit" value="BUL"/>
                </form>
            </div>
            <?php
                if(isset($_SESSION['login'])){
                ?>
                 <div class="user_login" >
                 <div style="float:left;">Hoşgeldiniz  <span id="hosgeldin"> <?php echo $_SESSION["username"];?> </span></div>
                 <ul id="user-menu">
                    <li><a href="?page=userprofile">Üye Paneli</a>
                    <li><a href="?page=favorites">Favorilerim</a>
                    <li><a href="?page=logout">Çıkış</a>
                </ul>

                </div>
                <?php
                }else{
            ?>
            <form class="user_login" method="POST">
                Kullanıcı Adı: <input type="text" name="username"/>
                Şifre: <input type="password" name="pass"/>
                <input type="submit" value="Giriş"/>
                <input type="checkbox" name="remember_me" id="remember_me"/><label for="remember_me">Beni Hatırla</label>
                <div id="uye_link"><a href="?page=register">Üye Ol</a></div>
            </form>
                <?php } ?>
        </div>
    </div>
    <div id="content">
        <?php if(isset($_GET["game-play"])){
            include('game-play.php');
        }else{ ?>
        <div id="categories">
            <?php if(isset($_GET['page']) && $_GET['page'] == "userprofile") {
                ?>

            <span id="categories-header">Kontrol Paneli</span>
            <ul>
               <li><a href="?page=userprofile">Üye Paneli</a></li>
               <li><a href="?page=favorites&username=<?= isset($_GET['username']) ? $_GET['username'] : $_SESSION['username']?>">Favori Oyunları</a></li>
               <?php if(isset($_GET['username']) && $_GET['username'] != @$_SESSION['username']){

               }else{
               ?>
               <li><a href="?page=userprofile&menu=updateprofile">Düzenle</a></li>
               <?php } ?>
            </ul>

                <?php
            }else{
            ?>
            <span id="categories-header">KATEGORİLER</span>
            <ul>
                <?php 
                $query=mysqli_query($connect,"SELECT * FROM categories");
                if($query){
                    while($sonuc=mysqli_fetch_assoc($query)){  
                ?>
               <li><a href="?category=<?php echo $sonuc["category_link"] ?>"><?php echo $sonuc["category_name"] ?></a></li>
           <?php }    
                } ?>
                
            </ul>
            <?php } ?>
        </div>
        <?php
            if(count($_GET) == 0){
        ?>
        <div id="section">
            <span class="section-header">Yeni Subway Surfers Oyunları</span>
            <div class="section-content">
            <?php     
                $query=mysqli_query($connect,"SELECT * FROM games");
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
        </div>
        <?php
            }else{
                if(isset($_GET["category"])){
                    include("category_page.php");
                }else if(isset($_GET["game"])){
                    include("game.php");
                }else if(isset($_GET["page"])){
                    include($_GET["page"].".php");
                }else if(isset($_GET["search"])){
                    include("search-page.php");
                }
            }
        ?>
        <div style="clear: both"></div>
        <?php } ?>
    </div>
</body>
</html>