<!DOCTYPE html>
<html lang="en" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Joy Akademi CMS Yönetim Paneli Eğitim Sürümü </title>
  <link rel="stylesheet" href="css/style.css">

</head>
<body  class="login">
  <div> 
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div id="bg"></div>
    <section class="login_content">
      <form action="../netting/islem.php" method="POST">
        <h1>Yönetim Paneli </h1>
        
        <div class="form-field">
          <input  type="email" name="kullanici_mail" placeholder="Kullanıcı Adınız (Mail)" required=""/>
        </div>

        <div class="form-field">
          <input type="password" name="kullanici_password" placeholder="Şifreniz" required=""/>                         
        </div>

        <div class="form-field">
          <button class="btn btn-default" type="submit" name="admingiris">Giriş Yap</button>
        </div>

        <div class="clearfix"></div>
        <div class="separator">
          <p class="change_link">
           <?php 

           if (isset($_GET['durum']) && $_GET['durum']=="no") {

             echo "Kullanıcı Bulunamadı...";

           } elseif (isset($_GET['durum']) && $_GET['durum']="exit") {

             echo "Başarıyla Çıkış Yaptınız.";

           }

           ?>

         </p>

         <div class="clearfix"></div>
         <br />

         <div>
          <h1><i class="fa fa-paw"></i> Joy Akademi</h1>
          <p>©2017 Joy Akademi Eğitim Sürümü</p>
        </div>
      </div>
    </form>
  </section>
  <!-- partial -->
</div>
</body>
</html>
