<!-- Php Code -->
<?php 
include "baglan.php";
//Delete Komutu
if ($_GET['del'] != null ) {
  $del=$_GET['del'];
  $sql_del = "DELETE FROM arac WHERE arac_plaka_no='$del'";
  $gelenveri = mysql_query( $sql_del, $baglanti );
  if ($gelenveri) {
    header("location:arac-tablo.php?dr=ok");
  }
  else{
    header("location:arac-tablo.php?dr=no");
  }
}

//Tablo Veri Çekme
$sql = "SELECT arac_plaka_no,arac_yasi,arac_bil FROM arac";

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
        <h3>Araç Kayıtlar</h3>
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
               <h2>Arac'ın</h2>
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
                <b style="margin-left:30px; ;color:red;">Araç Bir Şoföre Bağlı Silinemez...</b>
                <?php  
              }
              elseif($_GET['durum']=="ok"){
                ?>
                <b style="margin-left: 70px; color:green;">Kayıt Güncelleme Başarılı...</b>
                <?php  
              }elseif($_GET['durum']=="no"){
                ?>
                <b style=" margin-left: 110px; color:red;">Plaka Değiştirlemez...</b>
                <?php  
              }
              ?>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <p>Buradan Araç Kayıtlarınızı Düzenleyip / Silebilirsiniz.</p>

          <!-- start project list -->
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 1%">#</th>
                <th style="width: 20%">Plaka Numarası</th>
                <th style="width: 20%">Yaşı</th>
                <th style="width: 20%">Bilgileri</th>
                <th style="width: 10%">#Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {
                $plaka = $row['arac_plaka_no'];
                $yas = $row['arac_yasi'];
                $bilgi = $row['arac_bil'];
                echo "<tr>
                <td>$i</td>
                <td>$plaka</td>
                <td>$yas</td>
                <td>$bilgi</td>
                <td>
                <a href='arac-kayit.php?id=$plaka'' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Düzenle </a>
                <a href='arac-tablo.php?del=$plaka'' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Sil </a>
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