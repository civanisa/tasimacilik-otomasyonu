<?php 
include "baglan.php";

//Güzergahlar
$sql_adresi = "SELECT guzergah_id,guzergah_sofor_id,guzergah_okayit_id,guzergah_sıra_no  FROM guzergah";
mysql_select_db('servisotomasyonu');

$gelenveri = mysql_query( $sql_adresi, $baglanti );

$verisay = mysql_num_rows($gelenveri);

$id = 0;
$guzergah_sayi = 0;
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
		$guzergah_sofor[$id]=$row['guzergah_sofor_id'];
		$guzergah_kayit[$id]=$row['guzergah_okayit_id'];
		$id++;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table border="2">
		<?php 
		for ($i=0; $i <=$id ; $i++) { 
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
			echo "<tr>
			<td>$sofor_adi</td>
			<td>$sofor_adres_adi</td>
			<td>$t</td>
			</tr>
			";

		}
		?>
	</table>
</body>
</html>