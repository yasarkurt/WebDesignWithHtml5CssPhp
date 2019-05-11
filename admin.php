<?php 
    require_once("./connect.php");
    session_start();
    if(isset($_SESSION["admin"])){
        ?>
        <head>
         <link rel="stylesheet" href="./src/admin.css">
    </head>
            <form method="POST">
                <table id="categori">
                    <tr>
                        <td>Kategori Adı</td>
                        <td>:</td>
                        <td><input type="text" name="categori_Name"/></td>
                    </tr>
                    <tr>
                        <td>Kategori Linki </td>
                        <td>:</td>
                        <td><input type="text" name="categori_Link"/> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> <input type="submit" value="Kategori Ekle"/> </td>
                    </tr>
                </table>
            </form>
        <?php
if(count($_POST) > 0 && isset($_POST['categori_Name'])){
    $ct_name=trim(htmlspecialchars($_POST['categori_Name']));
    $ct_link=trim(htmlspecialchars($_POST['categori_Link']));
    if(!empty($ct_link) && !empty($ct_name)){
        mysqli_query($connect,"INSERT INTO categories (category_name, category_link) VALUES('$ct_name', '$ct_link')");
        header('Refresh: 1;');
    }else{
        echo "Tüm Alanları Doldurunuz";
    }
    }    
}else{
?>
<form method="POST">
  <span style="text-align:center;">  ADMİN GİRİŞİ </span><br><br>
  <table>
                    <tr>
                        <td> Kullanıcı Adı</td>
                        <td>:</td>
                        <td><input type="text" name="admin"/></td>
                    </tr>
                    <tr>
                        <td>şifre</td>
                        <td>:</td>
                        <td><input type="password" name="pass"/> </td>
                    </tr>
                </table>
    <input type="submit" value="Giriş Yap"/>
</form>
<?php
if(count($_POST) > 0 && isset($_POST['admin'])){
    $admin="admin";
    $password="oyunasigi";
    $username=trim(htmlspecialchars($_POST['admin']));
    $pass=trim(htmlspecialchars($_POST['pass']));
    if(!empty($username)&&!empty($pass)){
            if($admin==$username && $password==$pass){
                $_SESSION['admin']=true;
                header("Refresh:1;");
            }else{
                echo "Böyle bir admin yoktur.";
            }
        }else{
        echo "Tüm Alanları Lütfen Doldurun";
    }
}
    }
?>