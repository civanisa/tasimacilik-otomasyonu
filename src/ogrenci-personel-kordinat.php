<?php include "header.php" ?>

<!-- Php Code -->
<?php

//Update Kontrolü
if ($_GET['id'] != null) {
	$id=$_GET['id'];
}

$ogrenci_name = $_POST['ogrenci_name'];
$ogrenci_soyad = $_POST['ogrenci_soyad'];
$ogrenci_is_adres = $_POST['ogrenci_is_adres'];
$ogrenci_adres = $_POST['ogrenci_adres'];
$ogrenci_tel = $_POST['ogrenci_tel'];

include "baglan.php";

$sql = "SELECT * FROM is_adresi WHERE is_adresi_adi='$ogrenci_is_adres'";
mysql_select_db('servisotomasyonu');
$gelenveri = mysql_query( $sql, $baglanti );

if(! $gelenveri ) {
	die('Veri alınamadı: ' . mysql_error());
} 
mysql_close();
?>
<!-- /Php Code -->

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Öğrenci-Personel Kayıt Formu</h3>
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
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Öğrenci-Personel'in<small>bilgileri eksiksiz ve yanlışsız girin</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<form method="POST" action="islem.php?id=<?php echo $id; ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adı<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" name="ogrenci_name" id="ogrenci_name" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ali" readonly="yes">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Soyadi<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" name="ogrenci_soyad" id="ogrenci_soyad" required="required" class="form-control col-md-7 col-xs-12" placeholder="Veli" readonly="yes">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Okul-İş Adresi<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" name="ogrenci_is_adres_1" id="ogrenci_is_adres_1" required="required" class="form-control col-md-7 col-xs-12" placeholder="Veli" readonly="yes">
								</div>
							</div>

							<div class="form-group" style="display: none;">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Okul-İş Adresi<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<?php 
									while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {
										?>
										<input type="text" name="ogrenci_is_adres" id="ogrenci_is_adres" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row['is_adresi_id'] ?>">
									<?php } ?>
								</div>
							</div>						

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Ev Adresi <span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<textarea class="form-control" name="ogrenci_adres" id="ogrenci_adres" rows="3" placeholder="Kardeşler Mahallesi, Cumhuriyet Üniversitesi Kampüsü, 58000 Merkez/Sivas Merkez/Sivas" required="required" readonly="yes"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon No<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-6 col-xs-12">
									<input type="text" name="ogrenci_tel" id="ogrenci_tel" required="required" class="form-control col-md-7 col-xs-12" placeholder="0 505 123 44 55" readonly="yes">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kordinat<span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-6 col-xs-12">
									<input type="text" name="ogrenci_kordinat" id="ogrenci_kordinat" required="required" class="form-control col-md-7 col-xs-12" placeholder="(39.75, 37.013)" readonly="yes">
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" name="ogrenci_kaydet" class="btn btn-success">Kaydet</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">                
				<div id="map"></div>            
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
<script>
	document.getElementById('ogrenci_name').value = "<?php echo $ogrenci_name; ?>";
	document.getElementById('ogrenci_soyad').value = "<?php echo $ogrenci_soyad; ?>";
	document.getElementById('ogrenci_tel').value = "<?php echo $ogrenci_tel; ?>";
	document.getElementById('ogrenci_adres').value = "<?php echo $ogrenci_adres; ?>";
	document.getElementById('ogrenci_is_adres_1').value = "<?php echo $ogrenci_is_adres; ?>";

	function initMap() {
		var sivas = {lat: 39.750546, lng: 37.015022};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 14,
			center: sivas
		});
		var geocoder = new google.maps.Geocoder();
		var address ="<?php echo $ogrenci_adres ?>";
		geocodeAddress(geocoder, map, address);
	}
	function geocodeAddress(geocoder, resultsMap,address) {
		geocoder.geocode({'address': address}, function(results, status) {
			if (status === 'OK') {
				resultsMap.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: resultsMap,
					position: results[0].geometry.location
				});
				document.getElementById('ogrenci_kordinat').value = results[0].geometry.location;
			}
			else{
				alert(address+" Adresi Bulunamadı.");
			}
		});
	}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=##&callback=initMap">
</script>
</body>
</html>
