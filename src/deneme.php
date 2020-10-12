<?php 
include "baglan.php";

$id = $_GET['id'];

$sql_say = "SELECT guzergah_sıra_no,okayit.okayit_adi,okayit.okayit_soyadi,okayit.okayit_adres,okayit.okayit_tel,okayit.okayit_kordinat,guzergah_km_bil,guzergah_dk_bil FROM guzergah,sofor,okayit 
WHERE guzergah_sofor_id=sofor.sofor_id and guzergah_okayit_id =okayit.okayit_id and guzergah_id = '$id'
ORDER BY guzergah_sıra_no";
$gelenveri1 = mysql_query( $sql_say, $baglanti );

$sql_okul_sofor = "SELECT is_adresi_adi,sofor_adi_soyadi,is_adresi_kordinati
FROM guzergah,sofor,okayit,is_adresi 
WHERE guzergah_sofor_id=sofor.sofor_id and guzergah_okayit_id=okayit.okayit_id and okayit.okayit_is_adres_id=is_adresi.is_adresi_id and guzergah_id = '$id'";
$gelenveri2 = mysql_query( $sql_okul_sofor, $baglanti );
$row2 = mysql_fetch_array($gelenveri2, MYSQL_ASSOC);

mysql_close($baglanti);
?>
<!-- Bootstrap -->
<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
  #map{
    height: 0px;
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h4><b><?php echo $row2['sofor_adi_soyadi']; ?></b></h4>
            <h4>Okul Adı : <b><?php echo $row2['is_adresi_adi']; ?></b></h4>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <!-- start project list -->
          <table class="table-striped" border="1" width="1000" >
            <thead>
              <tr>
                <th><b>#</b></th>
                <th><b>Adı</b></th>
                <th><b>Soyadı</b></th>
                <th><b>Telefon No</b></th>
                <th style="width: 5%;"><b>Saati</b></th>
                <th><b>Adresi</b></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $kordinat = array();
              $say=0;
              $topSaat = 0;
              $km_bil = 0.0;
              while ($row = mysql_fetch_array($gelenveri1, MYSQL_ASSOC)) {
                $kordinat[$say] = $row['okayit_kordinat'];
                $say++;
                $sira=$row['guzergah_sıra_no'];
                $adi=$row['okayit_adi'];
                $soyadi=$row['okayit_soyadi'];
                $tel=$row['okayit_tel'];
                $saat=$row['guzergah_dk_bil'];
                $diziSaat=explode (" ",$saat);
                $topSaat += $diziSaat[0];
                $adres=$row['okayit_adres'];
                $km = $row['guzergah_km_bil'];
                $diziKm = explode (" ",$km);
                $km_float= str_replace(",",".",$diziKm[0]);
                if ($diziKm[1] == "km") {
                  $km_bil += $km_float;
                }else{
                  $km_bil += $diziKm[0]/1000;
                }
                echo "<tr>
                <td>".$sira."</td>
                <td>".$adi."</td>
                <td>".$soyadi."</td>
                <td>".$tel."</td>
                ";
                  //2 saat için sadece
                if ($topSaat > 59) {
                  $top = $topSaat-60;
                  if ($top < 10) {
                    echo "<td>01.0".$top."</td>";
                  }
                  else{
                    echo "<td>01.".$top."</td>";
                  }
                }else{
                  if ($topSaat < 10) {
                    echo "<td>00.0".$topSaat."</td>";
                  }
                  else{
                    echo "<td>00.".$topSaat."</td>";
                  }
                }
                echo "<td>".$adres."</td>
                </tr>";
              }
              ?>
            </tbody>
          </table>
          <input style="display: none" type="text" id="gkm" value="<?php echo $km_bil; ?>"><br>
          <p>Güzegah Uzunluğu Yaklaşık Olarak <b id="km"></b> km</p>
          <!-- end project list -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="map"></div>
  </div>
</div>
</div>
</div>


<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script >
 var gkm = document.getElementById('gkm').value;
 function initMap() {
  var sivas = {lat: 39.750546, lng: 37.015022};
  var map = new google.maps.Map(document.getElementById('map'), {
    center: sivas,
    zoom: 12
  });
  kordinat1 = "<?php echo $kordinat[$say-1];?>";
  var kor1= kordinat1.slice(1,kordinat1.length-1);
  var kordinatlar1 = kor1.split(",");
  var kordinatt1 = {lat: Number(kordinatlar1[0]), lng: Number(kordinatlar1[1])};

  kordinat2 ="<?php echo $row2['is_adresi_kordinati']; ?>";
  var kor2= kordinat2.slice(1,kordinat2.length-1);
  var kordinatlar2 = kor2.split(",");
  var kordinatt2 = {lat: Number(kordinatlar2[0]), lng: Number(kordinatlar2[1])};
  kmbul(map,kordinatt1,kordinatt2,'km');
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
          deger=results[j].distance.text;
          sonkm(deger,gkm); 
        }
      }
    }
  });
}

function yuvarla(sayi,basamak){
  basamak=Math.pow(10,basamak);
  return Math.round(sayi*basamak)/basamak;  
}

function sonkm(deger,gkm){
  deger=deger.split(" ");
  deger[0]=deger[0].replace(",", ".");
  if (deger[1] == "km") {
    deger[0] = parseFloat(gkm) + parseFloat(deger[0]);
    deger[0] = yuvarla(deger[0],2);
    document.getElementById("km").innerHTML = deger[0];
  }
  else{
    document.getElementById("km").innerHTML = deger[0];
  }
}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=##&callback=initMap">
</script>

</body>
</html>
