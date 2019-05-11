<?php 
if(isset($_SESSION['login'])){
    header("Location: index.php");
}else{
    if(count($_POST) > 0){
        $username=trim(htmlspecialchars($_POST['username']));
        $pass=trim(htmlspecialchars($_POST['pass']));
        $passRepeat=trim(htmlspecialchars($_POST['passRepeat']));
        $email=trim(htmlspecialchars($_POST['email']));
        $userpp=trim(htmlspecialchars($_POST['avatar']));
        $gender=$_POST['gender'];
        $captcha=trim(htmlspecialchars($_POST['captcha']));
        if(!empty($username)&&!empty($pass)&&!empty($passRepeat)&&!empty($email)&&!empty($captcha)){
            if($pass==$passRepeat&&strlen($pass)>=8){
                unset($passRepeat);
                $pass=md5($pass);
                print_r($_SESSION['captcha']);
                if($captcha == $_SESSION['captcha']){
                    $sorgu=mysqli_query($connect,"SELECT count(*) as toplam FROM users WHERE username='".$username."' AND user_email='".$email."'");
                    if($sorgu){
                        $sonuc= mysqli_fetch_assoc($sorgu);
                        if($sonuc['toplam']==0){
                            $sorgu=mysqli_query($connect,"INSERT INTO users (username,pass,user_email,user_gender,user_pp) VALUES('$username', '$pass', '$email', $gender, '$userpp')");
                            if($sorgu){
                                $inserted=mysqli_insert_id ($connect );
                                $_SESSION['user_id']=$inserted;
                                $_SESSION['username']=$username;
                                $_SESSION['login']=true;
                                header('Refresh: 1; url=index.php');
                        }
                        }else{
                            echo "Email veya Kullanıcı Adı Bulunmaktadır";
                        }
                    }
                }else{
                    echo "Güvenlik Kodunu Doğru Giriniz";
                }    
            }else{
                echo "Şifreler Farklı";
            }    
        }else{
            echo "Tüm Alanları Lütfen Doldurun";
        }
    }
    
?>

<div id="section">
    <span class="section-header">Üye Ol</span>
    <div class="section-content">
        <form id="register" method="POST">
            <div class="left-form">
                <label for="username">Kullanıcı Adı</label>:<input type="text" name="username" id="username"/><br>
                <label for="pass">Şifre</label>:<input type="password" name="pass" id="pass"/><br>
                <label for="passRepeat">Şifre Tekrar</label>:<input type="password" name="passRepeat" id="passRepeat"/><br>
                <label for="email">E-Posta</label>:<input type="email" name="email" id="email"/><br>
                <label for="gender">Cinsiyet</label>:<select name="gender" id="gender">
                        <option value="0">Kadın</option>
                        <option value="1">Erkek</option>
                    </select><br>
                <label for="captcha"><img src="./captcha.php"/></label>:<input type="text" name="captcha" id="captcha"/><span style="font-size: 12px;"> - Güvenlik Kodu</span><br>
                <input type="submit" id="submit" name="signup" value="Üye Ol"/>
            </div>
            <div class="right-form">
                <label for="avatar">Avatar</label><select name="avatar" id="avatar" size="8" onchange="onChangeAvatarSelect()">
                        <option value="avatar-none" selected>Yok</option>
                        <option value="avatar-1">1</option>
                        <option value="avatar-2">2</option>
                        <option value="avatar-3">3</option>
                        <option value="avatar-4">4</option>
                        <option value="avatar-5">5</option>
                        <option value="avatar-6">6</option>
                        <option value="avatar-7">7</option>
                        <option value="avatar-8">8</option>
                    </select>
                <img src="./src/img/avatar-none.jpg"/>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function onChangeAvatarSelect(){
        var select = document.getElementById("avatar");
        var img = document.querySelector(".right-form img");
        img.src = "./src/img/"+select.value+".jpg"
    }
</script>

<?php
}
?>