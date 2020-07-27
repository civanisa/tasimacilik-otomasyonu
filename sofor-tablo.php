<!-- Php Code -->
<?php 
include "baglan.php";
//Delete Komutu
if ($_GET['del'] != null ) {
  $del=$_GET['del'];
  $sql_del = "DELETE FROM sofor WHERE sofor_id='$del'";
  $gelenveri = mysql_query( $sql_del, $baglanti );
  if ($gelenveri) {
    header("location:sofor-tablo.php?dr=ok");
  }
  else{
    header("location:sofor-tablo.php?dr=no");
  }
}

//Tablo Veri Çekme
$sql = "SELECT sofor_id,sofor_adi_soyadi,sofor_tel_no,sofor_src_bel,sofor_arac_id FROM sofor";

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
        <h3>Şoför Kayıtları</h3>
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
               <h2>Şoför'ün</h2>
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
                <b style="margin-left:30px; ;color:red;">Şoför Bir Güzergaha Bağlı Silinemez...</b>
                <?php  
              }
              elseif($_GET['durum']=="ok"){
                ?>
                <b style="margin-left: 70px; color:green;">Kayıt Güncelleme Başarılı...</b>
                <?php  
              }elseif($_GET['durum']=="no"){
                ?>
                <b style=" margin-left: 110px; color:red;">Kayıt Güncelleme Başarız...</b>
                <?php  
              }
              ?>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <p>Buradan Şoför Kayıtlarınızı Düzenleyip / Silebilirsiniz.</p>

          <!-- start project list -->
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 1%">#</th>
                <th style="width: 10%">Adı</th>
                <th style="width: 10%">Telefon Numarası</th>
                <th style="width: 10%">Src Belgesi</th>
                <th style="width: 10%">Araç Plaka No</th>
                <th style="width: 10%">#Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {
                $id=$row['sofor_id'];
                $ad = $row['sofor_adi_soyadi'];
                $tel = $row['sofor_tel_no'];
                $src = $row['sofor_src_bel'];
                $plaka = $row['sofor_arac_id'];
                echo "<tr>
                <td>$i</td>
                <td>$ad</td>
                <td>$tel</td>
                <td>$src</td>
                <td>$plaka</td>
                <td>
                <a href='sofor-kayit.php?id=$id'' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Düzenle </a>
                <a href='sofor-tablo.php?del=$id'' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Sil </a>
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