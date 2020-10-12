<!-- Php Code -->
<?php 
include "baglan.php";
//Delete Komutu
if ($_GET['del'] != null ) {
  $del=$_GET['del'];
  $sql_del = "DELETE FROM okayit WHERE okayit_id='$del'";
  $gelenveri = mysql_query( $sql_del, $baglanti );
  if ($gelenveri) {
    header("location:ogrenci-personel-tablo.php?dr=ok");
  }
  else{
    header("location:ogrenci-personel-tablo.php?dr=no");
  }
}
//Tablo Veri Çekme
$sql = "SELECT okayit_id,okayit_adi,okayit_soyadi,okayit_adres,okayit_tel,is_adresi.is_adresi_adi 
FROM okayit,is_adresi
WHERE is_adresi.is_adresi_id = okayit_is_adres_id";

$gelenveri = mysql_query( $sql, $baglanti );

if(! $gelenveri ) {
  die('Veri alınamadı: ' . mysql_error());
}
mysql_close($baglanti);
?>
<?php include "header.php" ?>
<!-- /Php Code -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Öğrenci-Pesrsonel Kayıtlar</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="row">
              <div class="col-md-2">
               <h2>Ögrenci-Personel'in</h2>
             </div>
             <div class="col-md-7"></div>
             <div class="col-md-3">
              <?php 
              if ($_GET['dr']== "ok") {
                ?> 
                <b style="margin-left: 96px; color:green;">Kayıt Başarıyla Silindi...</b>
                <?php
              }  
              elseif($_GET['dr']=="no"){
                ?>
                <b style="color:red;">Kayıt Bir Güzergah'a Bağlı Silinemez...</b>
                <?php  
              }
              elseif($_GET['durum']=="ok"){
                ?>
                <b style="margin-left: 70px; color:green;">Kayıt Güncelleme Başarılı...</b>
                <?php  
              }elseif($_GET['durum']=="no"){
                ?>
                <b style=" margin-left: 70px; color:red;">Kayıt Güncelleme Başarısız...</b>
                <?php  
              }
              ?>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <p>Buradan Öğrenci-Pesrsonel Kayıtlarınızı Düzenleyip / Silebilirsiniz.</p>

          <!-- start project list -->
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 1%">#</th>
                <th style="width: 6%">Adı</th>
                <th style="width: 6%">Soyadı</th>
                <th style="width: 25%">Adresi</th>
                <th style="width: 10%">Telefon Numarası</th>
                <th style="width: 15%">Okul-İşYeri Adı</th>
                <th style="width: 12%">#Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {
                $id = $row['okayit_id'];
                $ad = $row['okayit_adi'];
                $soyad = $row['okayit_soyadi'];
                $adres = $row['okayit_adres'];
                $tel = $row['okayit_tel'];
                $is_adresi =$row['is_adresi_adi'];
                echo "<tr>
                <td>$i</td>
                <td>$ad</td>
                <td>$soyad</td>
                <td>$adres</td>
                <td>$tel</td>
                <td>$is_adresi</td>
                <td>
                <a href='ogrenci-personel-kayit.php?id=$id'' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Düzenle </a>
                <a href='ogrenci-personel-tablo.php?del=$id'' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Sil </a>
                </td>";
                $i++; 
              } 
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

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>