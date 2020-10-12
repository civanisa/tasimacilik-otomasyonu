<?php

if (isset($_POST['guzergah_adres'])) {
	$is_adresi = $_POST['is_adresi_sec'];
}

include "baglan.php";

$sql_adresi = "SELECT is_adresi_id, is_adresi_adi FROM is_adresi WHERE is_adresi_adi='$is_adresi'";
$gelenveri = mysql_query( $sql_adresi, $baglanti );

if(! $gelenveri ) {
	die('Veri alınamadı: ' . mysql_error());
} 
while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {
	$is_adresi_id = $row['is_adresi_id'];
}

$sql_kayıt = "SELECT okayit_id, okayit_adi, okayit_soyadi,okayit_adres,okayit_kordinat,okayit_is_adres_id FROM okayit WHERE okayit_is_adres_id='$is_adresi_id' and not okayit_id in (select guzergah_okayit_id from guzergah)";
$gelenveri = mysql_query( $sql_kayıt, $baglanti );

$sql_guzergah = "SELECT okayit.okayit_id ,guzergah_id,okayit.okayit_kordinat,okayit.okayit_adi,okayit.okayit_soyadi, okayit.okayit_adres FROM okayit,guzergah WHERE okayit.okayit_is_adres_id='$is_adresi_id' and okayit.okayit_id = guzergah.guzergah_okayit_id";
$gelenveri2 = mysql_query( $sql_guzergah, $baglanti );

if(! $gelenveri ) {
	die('Veri alınamadı:2 ' . mysql_error());
}
mysql_close($baglanti);
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		var s = 0;
		var markersay = 0;
		var diziKordinat = new Array();
		var diziGuzergah = new Array();
		var diziAdsoyad = new Array();
		var diziAdres = new Array();
		var diziInfoWindow = new Array();

		var diziGuzergahKayit = new Array();
		var gdiziKordinat = new Array();
		var gdiziGuzergahId = new Array();
		var gdiziAdsoyad = new Array();
		var gdiziAdres = new Array();
		var gdiziInfoWindow = new Array();
		<?php 
		while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {
			?>
			var kordinat = '<?php echo $row['okayit_kordinat']; ?>';
			var guzergah = '<?php echo $row['okayit_id']; ?>';
			var adsoyad = '<?php echo $row['okayit_adi']; ?>'+' '+'<?php echo $row['okayit_soyadi']; ?>';
			var adres = 'Adresi : '+'<?php echo $row['okayit_adres']; ?>';
			var infowindow ='<center>'+ adsoyad + '</center></br>'+ adres;
			diziKordinat[s]=kordinat;
			diziGuzergah[s]=guzergah;
			diziAdsoyad[s]=adsoyad;
			diziAdres[s]=adres;
			diziInfoWindow[s]=infowindow;
			s++;
		<?php } ?>
		s = 0;
		<?php 
		while($row = mysql_fetch_array($gelenveri2, MYSQL_ASSOC)) {
			?>
			diziGuzergahKayit[s] = '<?php echo $row['okayit_id']; ?>';
			gdiziGuzergahId[s] = '<?php echo $row['guzergah_id']; ?>';
			gdiziKordinat[s] = '<?php echo $row['okayit_kordinat']; ?>';
			gdiziAdsoyad[s] = '<?php echo $row['okayit_adi']; ?>'+' '+'<?php echo $row['okayit_soyadi']; ?>';
			gdiziAdres[s] = 'Adresi : '+'<?php echo $row['okayit_adres']; ?>';
			gdiziInfoWindow[s] = '<center>'+ gdiziAdsoyad[s] + '</center></br>'+ gdiziAdres[s];
			s++;
		<?php } ?>
	</script>
	<title>Güzergah Oluşturma</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<style>
		#map {
			height: 100%;
		}
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
		#form {
			position: absolute;
			z-index: 5;
			background-color:#fff;
			padding: 5px;
			padding-bottom: 24px;
			line-height: 20px;
		}
	</style>
</head>
<body>
	<div id="form">
		<form method="POST" action="guzergah-tablo.php">
			<table>
				<?php 
				for ($i=21; $i <=40 ; $i++) { 
					?>
					<tr>
						<td><label style="color: black;"><?php echo $i-20; ?></label></td>
						<td><input type="text" id="<?php echo $i; ?>"  name="<?php echo $i; ?>" class="textbox" readonly="yes"></td>
						<td ><input style="display: none;" type="text" id="<?php echo $i-20; ?>"  name="<?php echo $i-20; ?>" class="textbox"></td>
					</tr>
					<?php 
				}
				?>
				<tr>
					<td style="display: none;"><input type="text" id="is_adresi_adi"  name="is_adresi_adi" value="<?php echo $is_adresi ; ?>" class="textbox"></td>
					<td></td>
					<td><input type="submit" name="olustur" value="Oluştur" class="btn btn-secondary">
						<input type="submit" name="geri" value="İptal" class="btn btn-secondary">
						<input style="width: 30px;display:none; " type="text" name="markersay" id="markersay" disabled></td>
					</tr>
				</table>
			</div>
		</form>
		<div id="map"></div>
		<script>
			function initMap() {
				var sivas = {lat: 39.750546, lng: 37.015022};
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 12,
					center: sivas
				});

				//Eski Marker
				for (var i = 0; i<gdiziKordinat.length; i++) {
					m = 1;
					adSoyadId=gdiziAdsoyad[i];
					guzergahId=gdiziGuzergahId[i];
					adresId="";
					for (var j = i+1; j<gdiziKordinat.length; j++) {
						if (gdiziKordinat[i] == gdiziKordinat[j] && gdiziKordinat[j] !=-1) {
							//Aynı Kordinat
							m++;
							gdiziKordinat[j] = -1;
							adSoyadId += "," + gdiziAdsoyad[j];
							guzergahId +="," + gdiziGuzergahId[j];
							adresId = gdiziInfoWindow[j];
						}
					}
					infoWindowId = '<center>' + adSoyadId + '</center><br>' +adresId;
					if (m == 1 && gdiziKordinat[i] != -1) {
						kordinat = gdiziKordinat[i];
						var kor = kordinat.slice(1,kordinat.length-1);
						//kordinatı virgülden ayırır.
						var kordinatlar = kor.split(",");
						var kordinatt = {lat: Number(kordinatlar[0]), lng: Number(kordinatlar[1])};
						MarkerGuzegah(map,gdiziInfoWindow[i],kordinatt,gdiziGuzergahId[i],gdiziAdsoyad[i],1);
						markersay++;	
					}
					if (1 < m ) {
						kordinat = gdiziKordinat[i];
						var kor = kordinat.slice(1,kordinat.length-1);
						//kordinatı virgülden ayırır.
						var kordinatlar = kor.split(",");
						var kordinatt = {lat: Number(kordinatlar[0]), lng: Number(kordinatlar[1])};
						MarkerGuzegah(map,infoWindowId,kordinatt,guzergahId,adSoyadId,m,);
						markersay++;
					}	
				}
				
				//Yeni Marker
				for (var i = 0; i<diziKordinat.length; i++) {
					m = 1;
					adSoyadId=diziAdsoyad[i];
					guzergahId=diziGuzergah[i];
					adresId="";
					for (var j = i+1; j<diziKordinat.length; j++) {
						if (diziKordinat[i] == diziKordinat[j] && diziKordinat[j] !=-1) {
							//Aynı Kordinat
							m++;
							diziKordinat[j] = -1;
							adSoyadId += "," + diziAdsoyad[j];
							guzergahId +="," + diziGuzergah[j];
							adresId = diziAdres[j];
						}
					}
					infoWindowId = '<center>' + adSoyadId + '</center><br>' +adresId;
					if (m == 1 && diziKordinat[i] != -1) {
						kordinat = diziKordinat[i];
						var kor = kordinat.slice(1,kordinat.length-1);
						//kordinatı virgülden ayırır.
						var kordinatlar = kor.split(",");
						var kordinatt = {lat: Number(kordinatlar[0]), lng: Number(kordinatlar[1])};
						MarkerEkle(map,diziInfoWindow[i],kordinatt,diziGuzergah[i],diziAdsoyad[i],1);
						markersay++;	
					}
					if (1 < m ) {
						kordinat = diziKordinat[i];
						var kor = kordinat.slice(1,kordinat.length-1);
						//kordinatı virgülden ayırır.
						var kordinatlar = kor.split(",");
						var kordinatt = {lat: Number(kordinatlar[0]), lng: Number(kordinatlar[1])};
						MarkerEkle(map,infoWindowId,kordinatt,guzergahId,adSoyadId,m,);
						markersay++;
					}	
				}
				document.getElementById("markersay").value = markersay++;
			}
			function MarkerGuzegah(remap,infowin,kordinat,guzergah,adsoyad,s){
				var marker = new google.maps.Marker({
					map: remap,
					position: kordinat,
					label : s.toString()
				});
				var markeron = new google.maps.Marker({
					map:remap,
					icon: {
						path: google.maps.SymbolPath.BACKWARD_OPEN_ARROW,
						scale: 5								
					},
					draggable: true,
					position: kordinat
				});
				var infowindow = new google.maps.InfoWindow({
					content: infowin
				});
				marker.addListener('mouseover', function() {
					infowindow.open(map, marker);
				});
				marker.addListener('mouseout', function() {
					infowindow.close(map, marker);
				});
				marker.addListener('click', function() {
					alert("Bir Güzergaha Kayıtlı Şeçilemez");
				});
			}

			function MarkerEkle(remap,infowin,kordinat,guzergah,adsoyad,s){
				var t = 0;
				var marker = new google.maps.Marker({
					map: remap,
					position: kordinat,
					label : s.toString()
				});
				var markeron = new google.maps.Marker({
					icon: {
						path: google.maps.SymbolPath.BACKWARD_OPEN_ARROW,
						scale: 5								
					},
					draggable: true,
					position: kordinat
				});
				var infowindow = new google.maps.InfoWindow({
					content: infowin
				});
				marker.addListener('mouseover', function() {
					infowindow.open(map, marker);
				});
				marker.addListener('mouseout', function() {
					infowindow.close(map, marker);
				});
				marker.addListener('rightclick', function() {
					markeron.setMap(null);
					t=0;
					if (s == 1) {
						for (var i = 1; i<=20; i++) {
							if (document.getElementById(i+20).value == adsoyad) {
								document.getElementById(i+20).value = "";
								break;
							}
						}
					}
					if (1 < s) {
						i = 1;
						while(i<=20){
							var diziadsoyad=adsoyad.split(",");
							if(diziadsoyad[0] == document.getElementById(i+20).value){
								k = i;
								for(var p = 0; p<diziadsoyad.length; p++) {
									document.getElementById(k+20).value = "";
									k++;
								}
							}
							else
								i++;
						}
					}
				});
				marker.addListener('click', function() {
					if(1 <= t){
						alert("Zaten Seçili");
					}
					else{
						for (var i = 1; i<=20; i++) {
							if (document.getElementById(i+20).value == "") {
								if(s == 1){
									t++;
									document.getElementById(i).value = guzergah;
									document.getElementById(i+20).value = adsoyad;
									markeron.setMap(remap);
									break;
								}
								if(1 < s){
									var diziguzergah=guzergah.split(",");
									var diziadsoyad=adsoyad.split(",");
									for (var p = 0; p<diziguzergah.length; p++) {
										document.getElementById(i).value = diziguzergah[p];
										document.getElementById(i+20).value = diziadsoyad[p];
										i++;
										markeron.setMap(remap);
									}
									t++;
									break;
								}
							}
						}
					}
				});
			}
		</script>
		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=##&callback=initMap">
	</script>
</body>
</html>


