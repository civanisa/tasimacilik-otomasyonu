<!-- Php Code -->
<?php 
include "baglan.php";

//Delete Komutu
if ($_GET['del'] != null ) {
  $del=$_GET['del'];
  $sql_del = "DELETE FROM guzergah WHERE guzergah_id='$del'";
  $gelenveri = mysql_query( $sql_del, $baglanti );
  if ($gelenveri) {
    header("location:guzergahlar-tablo.php?dr=ok");
  }
  else{
    header("location:guzergahlar-tablo.php?dr=no");
  }
}

//Kullanıcı Kayıt Sayısı
$sql_adresi = "SELECT okayit_id  FROM okayit";


$gelenveri = mysql_query( $sql_adresi, $baglanti );

$verisay_kul = mysql_num_rows($gelenveri);


//Okul-İşyeri Adres Kayıt Sayısı
$sql_adresi = "SELECT is_adresi_id  FROM is_adresi";
mysql_select_db('servisotomasyonu');

$gelenveri = mysql_query( $sql_adresi, $baglanti );

$verisay_adres = mysql_num_rows($gelenveri);

//Şoför Kayıt Sayısı
$sql_adresi = "SELECT sofor_id  FROM sofor";


$gelenveri = mysql_query( $sql_adresi, $baglanti );

$verisay_sofor = mysql_num_rows($gelenveri);

//Arac Kayıt Sayısı
$sql_adresi = "SELECT arac_plaka_no  FROM arac";

$gelenveri = mysql_query( $sql_adresi, $baglanti );

$verisay_arac = mysql_num_rows($gelenveri);

//Güzergah Kayıt Sayısı
$sql_adresi = "SELECT guzergah_id,guzergah_sofor_id,guzergah_okayit_id,guzergah_sıra_no  FROM guzergah";


$gelenveri = mysql_query( $sql_adresi, $baglanti );

$guzergah_id = 0;

//Güzergahlar
$sql_adresi = "SELECT guzergah_id,guzergah_sofor_id,guzergah_okayit_id,guzergah_sıra_no  FROM guzergah";

$gelenveri = mysql_query( $sql_adresi, $baglanti );

$verisay = mysql_num_rows($gelenveri);

$id = 0;
$guzergah_sayi = 0;
$guzergah_id = array();
$guzergah_sofor = array();
$guzergah_kayit = array();
$guzergah_kisi_sayi = array();

for ($i=0; $i <$verisay ; $i++) { 
  $sql = "SELECT guzergah_id,guzergah_sofor_id,guzergah_okayit_id FROM guzergah WHERE guzergah_id='$i'";
  $gelenveri = mysql_query( $sql, $baglanti );
  $guzergah_sayi = mysql_num_rows($gelenveri);
  if ($guzergah_sayi != 0) {
    $guzergah_kisi_sayi[$id] = $guzergah_sayi;
    $row = mysql_fetch_array($gelenveri, MYSQL_ASSOC);
    $guzergah_id[$id]=$row['guzergah_id'];
    $guzergah_sofor[$id]=$row['guzergah_sofor_id'];
    $guzergah_kayit[$id]=$row['guzergah_okayit_id'];
    $id++;
  }
}
?>
<?php include "header.php" ?>
<!-- /Php Code -->


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-users"></i></div>
          <div class="count"><?php echo $verisay_kul; ?></div>
          <h3>Öğreci-Personel</h3>
          <p>Kayıtlı öğreci-personel sayısı.</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-building"></i></div>
          <div class="count"><?php echo $verisay_adres; ?></div>
          <h3>Okul-İşyeri</h3>
          <p>Kayıtlı okul-işyeri sayısı.</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-user"></i></div>
          <div class="count"><?php echo $verisay_sofor; ?></div>
          <h3>Şoför</h3>
          <p>Kayıtlı şoför sayısı.</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-bus"></i></div>
          <div class="count"><?php echo $verisay_arac; ?></div>
          <h3>Araç</h3>
          <p>Kayıtlı araç Sayısı.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Güzergahlar</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <p>Buradan Güzergahları Görüntülüyebilirsiniz.</p>

            <!-- start project list -->
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th style="width: 20%">Okul Adı</th>
                  <th>Şoför Adı</th>
                  <th>Doluluk Oranı</th>
                  <th>Kişi Sayısı</th>
                  <th style="width: 15%">#Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                for ($i=0; $i <$id; $i++) {
                  //tek sql de yaz burayı 
                  $sql_ekle = "SELECT sofor_id,sofor_adi_soyadi FROM sofor WHERE sofor_id='$guzergah_sofor[$i]'";

                  $gelenveri = mysql_query( $sql_ekle, $baglanti );
                  $row = mysql_fetch_array($gelenveri, MYSQL_ASSOC);
                  $sofor_adi=$row['sofor_adi_soyadi'];

                  $sql_ekle = "SELECT okayit_id,okayit_is_adres_id FROM okayit WHERE okayit_id='$guzergah_kayit[$i]'";
                  $gelenveri = mysql_query( $sql_ekle, $baglanti );
                  $row = mysql_fetch_array($gelenveri, MYSQL_ASSOC);
                  $sofor_adres_id=$row['okayit_is_adres_id'];

                  $sql_ekle = "SELECT is_adresi_id,is_adresi_adi FROM is_adresi WHERE is_adresi_id='$sofor_adres_id'";
                  $gelenveri = mysql_query( $sql_ekle, $baglanti );
                  $row = mysql_fetch_array($gelenveri, MYSQL_ASSOC);
                  $sofor_adres_adi=$row['is_adresi_adi'];
                  $t=$guzergah_kisi_sayi[$i];
                  $y=$t*6.25;
                  $p=$i+1;
                  echo "<tr>
                  <td>$p</td>
                  <td><a>$sofor_adres_adi</a></td>
                  <td>$sofor_adi</td>
                  <td class='project_progress'>
                  <div class='progress progress_sm'>
                  <div class='progress-bar bg-green' role='progressbar' data-transitiongoal='$y'></div>
                  </div>
                  <small>$y% Complete</small>
                  </td>
                  <td>$t</td>
                  <td>
                  <a href='guzergah-tablo-view.php?id=$guzergah_id[$i]' class='btn btn-primary btn-xs'><i class='fa fa-folder'></i> Görüntüle </a>
                  <a href='index.php?del=$guzergah_id[$i]' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Sil </a>
                  </td>
                  </tr>
                  ";
                }
                mysql_close($baglanti);
                ?>
              </tbody>
            </table>
            <!-- end project list -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<!-- footer content -->
<?php include 'footer.php' ?>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
