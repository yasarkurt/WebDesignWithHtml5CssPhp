<div id="section" style="padding-bottom: 25px;">
    <span class="section-header">Üye Paneli</span>
    <div class="section-content">
    <?php
        if(isset($_GET['username'])){
            $userid=$_GET['username'];
        }else{
            $userid=$_SESSION['username'];
        }
            $sorgu=mysqli_query($connect,"SELECT * FROM users WHERE username='".$userid."'");
            $sonuc=mysqli_fetch_assoc($sorgu);
            if(!count($sonuc)){
                echo "Böyle bir kullanıcı yok";
            }else{
    ?>
  
            <div class="left-profile">
                <div style="width:185px;float:left;">
                        <img width="100" height="100" src="./src/img/<?=$sonuc['user_pp'] ?>.jpg"/>
                </div>
            </div>
            <div class="right-profile">
            <table border=0>
                <tr>
                    <td>Kullanıcı Adı</td>
                    <td>:</td>
                    <td><?=$sonuc['username']?></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>:</td>
                    <td><?=$sonuc['user_email']?></td>
                </tr>
                <tr>
                    <td>Cinsiyet</td>
                    <td>:</td>
                    <td><?php
                    if($sonuc['user_gender']==0){
                        echo "Kadın";
                    }else{
                        echo "Erkek";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td>Kayıt Tarihi</td>
                    <td>:</td>
                    <td>
                        <?php
                        $date=date_create($sonuc['register_date']);
                        echo date_format($date,"d.m.Y");
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Son Online Tarih</td>
                    <td>:</td>
                    <td>
                        <?php
                        $date=date_create($sonuc['online_date']);
                        echo date_format($date,"d.m.Y");
                        ?>
                    </td>
                </tr>
            </table>
            </div>
      <?php
            }
      ?>
    </div>
</div>