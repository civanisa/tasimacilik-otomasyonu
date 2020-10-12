<?php 
session_start();

if (!isset($_SESSION['admin_kadi'])) {
  header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Öğrenci Ve Personel Taşımacılık Otomasyonu | </title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <style type="text/css">
  #map{
    height: 500px;
  }
</style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-bus"></i> <span>SKOTOYN</span></a>
          </div>
          
          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Hoşgeldin,</span>
              <h2><?php echo $_SESSION['admin_kadi'];?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Menüler</h3>
              <ul class="nav side-menu">
                <li>
                  <a href="index.php"><i class="fa fa-home"></i>AnaSayfa</a>
                </li>
                <li><a><i class="fa fa-edit"></i>Kayıt Ekle<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="ogrenci-personel-kayit.php">Öğrenci - Personel Kayıt</a></li>
                    <li><a href="okul-is-kayit.php">Okul - İşyeri Kayıt</a></li>
                    <li><a href="sofor-kayit.php">Şoför Kayıt</a></li>
                    <li><a href="arac-kayit.php">Araç Kayıt</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bus"></i>Güzergahlar<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="guzergah-adres-sec.php">Güzergah Ekle</a></li>
                    <li><a href="guzergahlar-tablo.php">Güzergah Kayıtlar</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i>Kayıtlar<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="ogrenci-personel-tablo.php">Öğrenci - Personel Kayıtlar</a></li>
                    <li><a href="okul-is-tablo.php">Okul - İşyeri Kayıtlar</a></li>
                    <li><a href="arac-tablo.php">Araç Kayıtlar</a></li>
                    <li><a href="sofor-tablo.php">Şoför Kayıtlar</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-book"></i>Aidatlar<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="aidat-tablo.php">Aidat Kayıtları</a></li>
                  </ul>
                </li>
                <li><a href="hakkimizda.php"><i class="fa fa-info-circle"></i>Hakkımızda</a>

                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
             <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Güvenli Çıkış</a></li>
           </ul>
         </nav>
       </div>
     </div>
     <!-- /top navigation -->