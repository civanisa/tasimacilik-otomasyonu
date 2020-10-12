<?php include "header.php" ?>

<!-- Php Code -->
<?php 
include "baglan.php";

//Update İşlemi
if ($_GET['id'] != null) {
	$id=$_GET['id'];
	$sql_update = "SELECT arac_plaka_no,arac_yasi,arac_bil FROM arac  WHERE arac_plaka_no='$id'";
	$gelenveri_update = mysql_query( $sql_update, $baglanti );
	$row_update = mysql_fetch_array($gelenveri_update, MYSQL_ASSOC);
}


?>
<!-- /Php Code -->

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Arac Kayıt Formu</h3>
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
						<h2>Arac'ın<small>bilgileri eksiksiz ve yanlışsız girin</small>
						</h2>
						<?php 
						if ($_GET['durum']== "ok") {
							?> 
							<b style="margin-left: 100px; color:green;">Kayıt Başarıyla Eklendi...</b>
							<?php
						}  
						elseif($_GET['durum']=="no"){
							?>
							<b style="margin-left: 100px; color:red;">Kayıt Ekleme Başarısız...<br><small style="margin-left: 100px; color:red;">Not: Aynı plaka daha önce kayıt edilmiş olabilir</small></b>
							<?php  
						}
						?>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<form method="POST" action="islem.php?id=<?php echo $id; ?>"  id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Plaka No<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" id="arac_plaka" name="arac_plaka" required="required" class="form-control col-md-7 col-xs-12" placeholder="Cumhuriyet Üniversitesi">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Yaşı
								</label>
								<div class="col-md-9 col-sm-6 col-xs-12">
									<input type="text" name="arac_yas" id="arac_yas" class="form-control col-md-7 col-xs-12" placeholder="2">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12"> Açıklama
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<textarea class="form-control" id="arac_bil" name="arac_bil" rows="3" placeholder="Kazasız..."></textarea>
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
									<button type="submit" name="arac_kaydet" class="btn btn-success">Kaydet</button>
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
	document.getElementById('arac_plaka').value = "<?php echo $row_update['arac_plaka_no']; ?>";
	document.getElementById('arac_yas').value = "<?php echo $row_update['arac_yasi']; ?>";
	document.getElementById('arac_bil').value = "<?php echo $row_update['arac_bil']; ?>";
</script>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>