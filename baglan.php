<?php 

$dbanamakine = 'localhost';
$dbkullanici = 'root';
$dbsifre = 'root1234';

$baglanti = mysql_connect($dbanamakine, $dbkullanici, $dbsifre);

if(! $baglanti) {
	die('Bağlanılamıyor: ' . mysql_error());
}

mysql_select_db('servisotomasyonu');

?>