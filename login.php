<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SKOTOYN | </title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login" style="background-image:url('images/admin-panel.jpg');">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form" >
        <section class="login_content">
          <form action="islem.php" method="POST">
            <h1 style="color: black;"><b>Admin Giriş</b> </h1>
            <div>
              <input type="text" name="kadi" class="form-control" placeholder="Kullanıcı Adı" required="" />
            </div>
            <div>
              <input type="password" name="sifre" class="form-control" placeholder="Şifre" required="" />
            </div>
            <div style="margin-left: 228px;">
              <input type="submit" name="loggin" class="btn btn-primary" value="Giriş Yap">
            </div>

            <div class="clearfix"></div>

            <div class="separator" style="color: black;">


              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-bus"></i> SKOTOYN!</h1>
                <p>©2019 All Rights Reserved. SKOTOYN! is a Bootstrap 4 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>
</html>
