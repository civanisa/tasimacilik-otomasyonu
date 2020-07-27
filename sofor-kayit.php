<!-- Php Code -->
<?php 

include "baglan.php";

//Update İşlemi
if ($_GET['id'] != null) {
	$id=$_GET['id'];
	$sql_update = "SELECT sofor_id,sofor_adi_soyadi,sofor_tel_no,sofor_src_bel,sofor_arac_id FROM sofor  WHERE sofor_id='$id'";
	$gelenveri_update = mysql_query( $sql_update, $baglanti );
	$row_update = mysql_fetch_array($gelenveri_update, MYSQL_ASSOC);
}

$sql = 'SELECT arac_plaka_no FROM arac';
mysql_select_db('servisotomasyonu');
$gelenveri = mysql_query( $sql, $baglanti );

if(! $gelenveri ) {
	die('Veri alınamadı: ' . mysql_error());
}
mysql_close($baglanti);

?>
<!-- /Php Code -->
<?php include "header.php" ?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Şoför Kayıt Formu</h3>
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
						<h2>Şoför'ün<small>bilgileri eksiksiz ve yanlışsız girin</small>
						</h2>
						<?php 
						if ($_GET['durum']== "ok") {
							?> 
							<b style="margin-left: 100px; color:green;">Kayıt Başarıyla Eklendi...</b>
							<?php
						}  
						elseif($_GET['durum']=="no"){
							?>
							<b style="margin-left: 100px; color:red;">Kayıt Ekleme Başarısız...<br><small style="margin-left: 100px; color:red;">Not: Aynı plaka daha kayıt edilmiş olabilir</small></b>
							<?php  
						}
						?>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<form method="POST" action="islem.php?id=<?php echo $id; ?>"  id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Adı Soyadı<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" id="sofor_ad" name="sofor_ad" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ali Veli">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Telefon No<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-6 col-xs-12">
									<input type="text" name="sofor_tel" id="sofor_tel" required="required" class="form-control col-md-7 col-xs-12" placeholder="0 505 123 44 55">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Src Belgesi
								</label>
								<div class="col-md-9 col-sm-6 col-xs-12">
									<input type="text" name="sofor_src" id="sofor_src" class="form-control col-md-7 col-xs-12" placeholder="Var">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12">Aracı<span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select class="form-control" name="sofor_plak_no" id="sofor_plak_no" required="required">
										<?php 
										while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {

											?>
											<option><?php echo  $row['arac_plaka_no'];?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
								<button type="submit" name="sofor_kaydet" class="btn btn-success">Kaydet</button>
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
<script type="text/javascript">
	document.getElementById('sofor_ad').value = "<?php echo $row_update['sofor_adi_soyadi']; ?>";
	document.getElementById('sofor_tel').value = "<?php echo $row_update['sofor_tel_no']; ?>";
	document.getElementById('sofor_src').value = "<?php echo $row_update['sofor_src_bel']; ?>";
</script>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>