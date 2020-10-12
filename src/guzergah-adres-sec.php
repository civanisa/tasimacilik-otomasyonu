<!-- Php Code -->
<?php 

include "baglan.php";

$sql = 'SELECT is_adresi_id, is_adresi_adi FROM is_adresi';
mysql_select_db('servisotomasyonu');
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
        <h3>Güzergah Oluşturma Formu</h3>
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
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>Güzergah oluştumak için bir adresi seçimi yapınız.
            </h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" action="guzergah.php"  id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

             <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12">Okul-İş Adresi<span class="required">*</span></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="is_adresi_sec" id="is_adresi_sec">
                  <?php 
                  while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {

                    ?>
                    <option><?php echo  $row['is_adresi_adi'];?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
              <button type="submit" name="guzergah_adres" class="btn btn-success">Oluştur</button>
            </div>
          </div>

        </form>
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