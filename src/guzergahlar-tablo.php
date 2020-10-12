<?php 

include "baglan.php";

//Delete Komutu
if ($_GET['del'] != null ) {
	$del=$_GET['del'];
	$sql_del = "DELETE FROM guzergah WHERE guzergah_id='$del'";
	$gelenveri = mysql_query( $sql_del, $baglanti );
	if ($gelenveri) {
		header("location:guzergahlar-tablo.php?dr=ok");
	}
	else{
		header("location:guzergahlar-tablo.php?dr=no");
	}
}

//Güzergahlar
$sql_adresi = "SELECT guzergah_id,guzergah_sofor_id,guzergah_okayit_id,guzergah_sıra_no  FROM guzergah";

$gelenveri = mysql_query($sql_adresi, $baglanti);

$verisay = mysql_num_rows($gelenveri);

$id = 0;
$guzergah_sayi = 0;
$guzergah_id = array();
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
		$guzergah_id[$id] =$row['guzergah_id'];
		$id++;
	}
}
?>

<?php include 'header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Güzergahlar</h3>
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
								<h2>Buradan Güzergahları Görüntüleyip / Silebilirsiniz.</h2>
							</div>
							<div class="col-md-7"></div>
							<div class="col-md-3">
								<?php 
								if ($_GET['dr']=="ok") {
									?> 
									<b style="margin-left: 96px; color:green;">Kayıt Başarıyla Silindi...</b>
									<?php
								}  
								elseif($_GET['dr']=="no"){
									?>
									<b style="color:red;">Kayıt Bir Güzergah'a Bağlı Silinemez...</b>
									<?php  
								}
								?>
							</div>
						</div>
					</div>
					<div class="x_content">

						<!-- start project list -->
						<table class="table table-striped projects">
							<thead>
								<tr>
									<th style="width: 1%">#</th>
									<th style="width: 20%">Okul Adı</th>
									<th>Şoför Adı</th>
									<th>Doluluk Oranı</th>
									<th>Kişi Sayısı</th>
									<th style="width: 15%">#Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								for ($i=0; $i <$id; $i++) {
                  					//tek sql de yaz burayı 
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
									$y=$t*6.25;
									$p=$i+1;
									echo "<tr>
									<td>$p</td>
									<td><a>$sofor_adres_adi</a></td>
									<td>$sofor_adi</td>
									<td class='project_progress'>
									<div class='progress progress_sm'>
									<div class='progress-bar bg-green' role='progressbar' data-transitiongoal='$y'></div>
									</div>
									<small>$y% Complete</small>
									</td>
									<td>$t</td>
									<td>
									<a href='guzergah-tablo-view.php?id=$guzergah_id[$i]' class='btn btn-primary btn-xs'><i class='fa fa-folder'></i> Görüntüle </a>
									<a href='guzergahlar-tablo.php?del=$guzergah_id[$i]' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Sil </a>
									</td>
									</tr>
									";
								}
								mysql_close($baglanti);
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

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>