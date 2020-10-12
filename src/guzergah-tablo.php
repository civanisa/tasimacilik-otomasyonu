<?php 
if (isset($_POST['geri'])) {
  header("location:guzergah-adres-sec.php");  
}

include "baglan.php";

$is_adresi_adi = $_POST['is_adresi_adi'];

//Soforler
$sql_sofor = 'SELECT sofor_id, sofor_adi_soyadi FROM sofor';
$gelenveri2 = mysql_query( $sql_sofor, $baglanti);

$sql_guzergah = 'SELECT MAX(guzergah_id) FROM guzergah';
$gelenveri3 = mysql_query( $sql_guzergah, $baglanti);

$row = mysql_fetch_array($gelenveri3, MYSQL_ASSOC);
if ($row['MAX(guzergah_id)'] == NULL) {
  $row['MAX(guzergah_id)']=-1;
}
$t = $row['MAX(guzergah_id)']+1; 
include "header.php" ; 
?>
<style type="text/css">
  #map{
    height: 0px;
  }
</style>
<script type="text/javascript">
  var say = 0;
  var diziSıra = new Array();
  var diziId = new Array();
  var diziKordinat = new Array();
</script>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Güzergah Oluşturma</h3>
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
                <h2>Okul İşyeri Adı : <b><?php echo $is_adresi_adi; ?></b></h2>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <!-- start project list -->
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th style="width: 10%">Adı</th>
                  <th style="width: 10%">Soyadı</th>
                  <th style="width: 10%">Telefon Numarası</th>
                  <th style="width: 30%">Adresi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($i=1; $i <21 ; $i++) {
                  if ($_POST[$i] != null) {
                    $sql_adres = "SELECT * FROM okayit,is_adresi WHERE  is_adresi_adi='$is_adresi_adi' and okayit_id = '$_POST[$i]'";
                    $gelenveri1 = mysql_query( $sql_adres, $baglanti );
                    $row = mysql_fetch_array($gelenveri1, MYSQL_ASSOC);
                    $adı = $row['okayit_adi'];
                    $soyad = $row['okayit_soyadi'];
                    $tel = $row['okayit_tel'];
                    $adres = $row['okayit_adres'];
                    echo "<tr>
                    <td>$i</td>
                    <td>$adı</td>
                    <td>$soyad</td>
                    <td>$tel</td>
                    <td>$adres</td>";
                    ?>
                    <script type="text/javascript">
                      diziSıra[say] = '<?php echo $row['okayit_id']; ?>';
                      diziId[say] = '<?php echo $i; ?>';
                      diziKordinat[say] = '<?php echo $row['okayit_kordinat']; ?>';
                      say++;
                    </script>
                    <?php
                  } 
                }
                mysql_close($baglanti);
                ?>
              </tbody>
            </table>
            <!-- end project list -->
            <form method="POST" action="islem.php" >
              <table>
                <input style="display: none" type="text" id="guzergah_id"  name="guzergah_id" class="textbox" value="<?php echo $t ?>">
                <?php 
                for ($i=1; $i <21 ; $i++) { 
                  ?>
                  <tr>
                    <td style="display: none;"><input type="text" id="<?php echo $i; ?>"  name="<?php echo $i; ?>" class="textbox"></td>
                    <td style="display: none;"><input type="text" id="<?php echo $i+20; ?>"  name="<?php echo $i+20; ?>" class="textbox"></td>
                    <td style="display: none;"><input type="text" id="<?php echo $i+40; ?>"  name="<?php echo $i+40; ?>" class="textbox"></td>
                    <td style="display: none;"><input type="text" id="<?php echo $i+60; ?>"  name="<?php echo $i+60; ?>" class="textbox"></td>
                  </tr>
                  <?php 
                }
                ?>
                <tr>
                  <td><label>Şoför Seçiniz :</label></td>
                  <td style="padding-left:10px">
                    <select name="sofor_adi" class="form-control" id="sofor_adi">
                      <?php 
                      while($row = mysql_fetch_array($gelenveri2, MYSQL_ASSOC)) {

                        ?>
                        <option><?php echo  $row['sofor_adi_soyadi'];?>
                      </option>
                    <?php } ?>  
                  </select>
                </td>
                <td style="padding-left:660px">
                  <input type="submit" class="btn btn-success" name="kaydet-guzergah" value="Kaydet">
                  <input type="submit" class="btn bnt-back" name="geri-g" value="Geri">
                </td>
              </tr>
            </table>
          </form>

        </div>
      </div>
    </div>

  </div>
  <div id="row">
    <div id="map"></div>
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
  for (var i = 0; i< say; i++) {
    document.getElementById(i+1).value = diziSıra[i];
    document.getElementById(i+1+20).value = diziId[i];
  }
  function initMap() {
    var sivas = {lat: 39.750546, lng: 37.015022};
    var map = new google.maps.Map(document.getElementById('map'), {
      center: sivas,
      zoom: 12
    });
    for (var i = 0; i<21; i++) {
      if (i == 0) {
        document.getElementById(i+1+40).value="0 km";
        document.getElementById(i+1+60).value="0 dakika";
      }
      else{
        if (diziKordinat[i-1] == diziKordinat[i]) {
          document.getElementById(i+1+40).value="0 km";
          document.getElementById(i+1+60).value="0 dakika";
        }
        else{
          kordinat1 = diziKordinat[i-1];
          var kor1= kordinat1.slice(1,kordinat1.length-1);
          var kordinatlar1 = kor1.split(",");
          var kordinatt1 = {lat: Number(kordinatlar1[0]), lng: Number(kordinatlar1[1])};
          kordinat2 = diziKordinat[i];
          var kor2= kordinat2.slice(1,kordinat2.length-1);
          var kordinatlar2 = kor2.split(",");
          var kordinatt2 = {lat: Number(kordinatlar2[0]), lng: Number(kordinatlar2[1])};
          kmbul(map,kordinatt1,kordinatt2,i+1+40);
        }
        
      }
    }
  }
  function kmbul(map,origin1,destinationA,t){
    var bounds = new google.maps.LatLngBounds;
    var markersArray = [];
    var destinationIcon = 'https://chart.googleapis.com/chart?' +
    'chst=d_map_pin_letter&chld=D|FF0000|000000';
    var originIcon = 'https://chart.googleapis.com/chart?' +
    'chst=d_map_pin_letter&chld=O|FFFF00|000000';
    var geocoder = new google.maps.Geocoder;

    var service = new google.maps.DistanceMatrixService;
    service.getDistanceMatrix({
      origins: [origin1],
      destinations: [destinationA],
      travelMode: 'DRIVING',
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status !== 'OK') {
        alert('Error was: ' + status);
      } else {
        var originList = response.originAddresses;
        var destinationList = response.destinationAddresses;

        var showGeocodedAddressOnMap = function(asDestination) {
          var icon = asDestination ? destinationIcon : originIcon;
          return function(results, status) {
            if (status === 'OK') {
              map.fitBounds(bounds.extend(results[0].geometry.location));
              markersArray.push(new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                icon: icon
              }));
            } 
          };
        };
        for (var i = 0; i < originList.length; i++) {
          var results = response.rows[i].elements;
          geocoder.geocode({'address': originList[i]},
            showGeocodedAddressOnMap(false));
          for (var j = 0; j < results.length; j++) {
            geocoder.geocode({'address': destinationList[j]},
              showGeocodedAddressOnMap(true));
            document.getElementById(t).value=results[j].distance.text;
            document.getElementById(t+20).value=results[j].duration.text;
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
