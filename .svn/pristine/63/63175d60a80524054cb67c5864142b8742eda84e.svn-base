<?php 
$js_array = MyFormat::makeRequestApi(MyFormat::URL_AGENT_MAP);
?>
<div class="page-header-cnt-2"><?php echo $model->getName();?></div>
<div class="document">
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyCfsbfnHgTh4ODoXLXFfEFhHskDhnRVtjQ" type="text/javascript"></script>
    <div id="map" style="width: 100%; height: 700px;"></div>
    <script type="text/javascript">
        var locations = <?php echo $js_array;?>;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: new google.maps.LatLng(12.663024, 108.173691),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;
    //    var image = 'http://daukhi.huongminhgroup.com/apple-touch-icon.png';

        for (i = 0; i < locations.length; i++) {  
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
    //        icon: image
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
      </script>
</div>