<?php 
$baglan=mysqli_connect("localhost","root","root1234","servisotomasyonu"); 
mysqli_set_charset($baglan, "utf8");

if(! $baglan) {
	die('Bağlanılamıyor: ' . mysql_error());
}

//Login Kontrol
if (isset($_POST['loggin'])) {

	include "baglan.php";
	
	mysql_select_db('servisotomasyonu');

	$admin_kadi = $_POST['kadi'];
	$admin_sifre = $_POST['sifre'];

	if ($admin_kadi && $admin_sifre) {
		$sqlekle = "SELECT * From admin where admin_kul_adi = '$admin_kadi' and admin_sifre='$admin_sifre'";

		$sonuc=mysql_query($sqlekle);

		$verisay = mysql_num_rows($sonuc);
		mysql_close($baglanti);
		if ($verisay >= 1) {
			session_start();

			$_SESSION['admin_kadi'] = $admin_kadi;
			$_SESSION['admin_sifre'] = $admin_sifre;
			header("location:index.php");
		}
		else{
			header("location:login.php?login=no");
		}
	}
}

//Okul-İş Yeri Kayıt
if (isset($_POST['is_kaydet'])) {
	
	$is_adi = $_POST['is_name'];
	$is_adresi = $_POST['is_adres'];
	$is_kordinat = $_POST['is_kordinat'];

	//Update 
	if ($_GET['id'] != null) {
		$id=$_GET['id'];
		$sql_update = "UPDATE is_adresi SET is_adresi_adi='$is_adi',is_adresi_adresi='$is_adresi',is_adresi_kordinati='$is_kordinat' 
		WHERE is_adresi_id='$id'";
		$sonuc=mysqli_query($baglan,$sql_update);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:okul-is-tablo.php?durum=ok");
		}
		else{
			header("Location:okul-is-tablo.php?durum=no");
		}
	}
	//Yeni Kayıt
	else{
		$sqlekle="INSERT INTO is_adresi(is_adresi_adi, is_adresi_adresi, is_adresi_kordinati) 
		VALUES ('$is_adi','$is_adresi','$is_kordinat')";

		$sonuc=mysqli_query($baglan,$sqlekle);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:okul-is-kayit.php?durum=ok");
		}
		else{
			header("Location:okul-is-kayit.php?durum=no");
		}
	}	
}

//Öğrenci Personel Kayıt/Update
if (isset($_POST['ogrenci_kaydet'])) {

	$ogrenci_name = $_POST['ogrenci_name'];
	$ogrenci_soyad = $_POST['ogrenci_soyad'];
	$ogrenci_is_adres = $_POST['ogrenci_is_adres'];
	$ogrenci_adres = $_POST['ogrenci_adres'];
	$ogrenci_tel = $_POST['ogrenci_tel'];
	$ogrenci_kordinat = $_POST['ogrenci_kordinat'];

	//Update 
	if ($_GET['id'] != null) {
		$id=$_GET['id'];
		$sql_update = "UPDATE okayit SET okayit_adi='$ogrenci_name',okayit_soyadi='$ogrenci_soyad',okayit_is_adres_id='$ogrenci_is_adres',okayit_tel='$ogrenci_tel',okayit_kordinat='$ogrenci_kordinat',okayit_adres='$ogrenci_adres'
		WHERE okayit_id = '$id'";
		$sonuc=mysqli_query($baglan,$sql_update);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:ogrenci-personel-tablo.php?durum=ok");
		}
		else{
			header("Location:ogrenci-personel-tablo.php?durum=no");
		}
	}
	//Yeni Kayıt
	else{
		$sqlekle="INSERT INTO okayit( okayit_adi, okayit_soyadi, okayit_adres, okayit_is_adres_id, okayit_tel,okayit_kordinat) 
		VALUES ('$ogrenci_name','$ogrenci_soyad','$ogrenci_adres',$ogrenci_is_adres,'$ogrenci_tel','$ogrenci_kordinat')";

		$sonuc=mysqli_query($baglan,$sqlekle);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:ogrenci-personel-kayit.php?durum=ok");
		}
		else{
			header("Location:ogrenci-personel-kayit.php?durum=no");
		}
	}
}

//Arac Kayıt
if (isset($_POST['arac_kaydet'])){

	$arac_plaka = $_POST['arac_plaka'];
	$arac_yas = $_POST['arac_yas'];
	$arac_bil = $_POST['arac_bil'];

	//Update 
	if ($_GET['id'] != null) {
		$id=$_GET['id'];
		$sql_update = "UPDATE arac SET arac_plaka_no='$arac_plaka', arac_yasi='$arac_yas',arac_bil='$arac_bil'
		WHERE arac_plaka_no='$id'";
		$sonuc=mysqli_query($baglan,$sql_update);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:arac-tablo.php?durum=ok");
		}
		else{
			header("Location:arac-tablo.php?durum=no");
		}
	}
	//Yeni Kayıt
	else{
		echo $arac_plaka; echo $arac_yas; echo $arac_bil;

		$sqlekle="INSERT INTO arac(arac_plaka_no, arac_yasi,arac_bil) 
		VALUES ('$arac_plaka','$arac_yas','$arac_bil')";

		$sonuc=mysqli_query($baglan,$sqlekle);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:arac-kayit.php?durum=ok");
		}
		else{
			header("Location:arac-kayit.php?durum=no");
		}
	}
}

//Şoför Kayıt
if (isset($_POST['sofor_kaydet'])){

	$sofor_ad= $_POST['sofor_ad'];
	$sofor_tel= $_POST['sofor_tel'];
	$sofor_src= $_POST['sofor_src'];
	$sofor_plak_no= $_POST['sofor_plak_no'];

	//Update 
	if ($_GET['id'] != null) {
		$id=$_GET['id'];
		$sql_update = "UPDATE sofor SET sofor_adi_soyadi='$sofor_ad', sofor_tel_no='$sofor_tel',sofor_src_bel='$sofor_src' , sofor_arac_id='$sofor_plak_no'
		WHERE sofor_id='$id'";
		$sonuc=mysqli_query($baglan,$sql_update);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:sofor-tablo.php?durum=ok");
		}
		else{
			header("Location:sofor-tablo.php?durum=no");
		}
	}
	//Yeni Kayıt
	else{
		$sqlekle="INSERT INTO sofor(sofor_adi_soyadi, 	sofor_tel_no,sofor_src_bel,sofor_arac_id) 
		VALUES ('$sofor_ad','$sofor_tel','$sofor_src','$sofor_plak_no')";

		$sonuc=mysqli_query($baglan,$sqlekle);
		mysqli_close($baglan);
		if ($sonuc) {
			header("Location:sofor-kayit.php?durum=ok");
		}
		else{
			header("Location:sofor-kayit.php?durum=no");
		}
	}	
}

//Güzegah Kaydet
if (isset($_POST['kaydet-guzergah'])){

	$saat = $_POST['saat'];

	$dbanamakine = 'localhost';
	$dbkullanici = 'root';
	$dbsifre = 'root1234';

	$baglanti = mysql_connect($dbanamakine, $dbkullanici, $dbsifre);

	if(! $baglanti) {
		die('Bağlanılamıyor: ' . mysql_error());
	}
	$sofor_adi= $_POST['sofor_adi'];
	$sql_adresi = "SELECT sofor_id, sofor_adi_soyadi FROM sofor WHERE sofor_adi_soyadi='$sofor_adi'";
	mysql_select_db('servisotomasyonu');
	$gelenveri = mysql_query( $sql_adresi, $baglanti );

	if(! $gelenveri ) {
		die('Veri alınamadı: ' . mysql_error());
	} 
	while($row = mysql_fetch_array($gelenveri, MYSQL_ASSOC)) {
		$sofor_id = $row['sofor_id'];
	}
	mysql_close($baglanti);
	$guzergah_id = $_POST['guzergah_id'];
	$sayi = 1;
	while($sayi < 21){ 
		if ($_POST[$sayi] != null) {
			$id=$_POST[$sayi];
			$say=$_POST[$sayi+20];
			$km=$_POST[$sayi+40];	
			$dakika=$_POST[$sayi+60];	
			$sqlekle="INSERT INTO guzergah(guzergah_sofor_id,guzergah_okayit_id,guzergah_sıra_no,guzergah_km_bil,guzergah_dk_bil,guzergah_id) 
			VALUES ('$sofor_id','$id','$sayi','$km','$dakika','$guzergah_id')";
			$sonuc=mysqli_query($baglan,$sqlekle);
		}
		$sayi++; 
	}
	if ($sonuc) {
		header("Location:guzergahlar-tablo.php?durum=ok");
	}
	else{
		header("Location:guzergahlar-tablo.php?durum=no");
	}
	//mysql_close($baglan);
}
//Guzergah Oluşturma İptal
if (isset($_POST['geri-g'])){
	header("Location:guzergah-adres-sec.php");
}

?>