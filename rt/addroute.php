<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
      <?php
session_start();
if(!isset($_SESSION['session_username'])){header( "Location: /log/login.php" );}else{
    //блок підключення до бази
    include ($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
    // Opens a connection to a MySQL server
    $connection=mysql_connect ('localhost', $username, $password);
    if (!$connection) {
        die('Not connected : ' . mysql_error());
    }
    // Set the active MySQL database
    $db_selected = mysql_select_db($database, $connection);
    if (!$db_selected) {
        die ('Can\'t use db : ' . mysql_error());
    }
    //блок завантаження зображення
    $ff =mysql_query("SET NAMES utf8"); 
     if (!empty($_POST["start"])){
        $result = mysql_query ("INSERT INTO routes(lat,lng,start,finish,mark) VALUES('".$_POST["lat"]."','".$_POST["lng"]."','".$_POST["start"]."','".$_POST["finish"]."','".$_POST["marker"]."');");
   
    }
}
    ?>
    <title>Додавання маркера маршруту</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqNEsRW9TPPxmuNcxgBJYps7oZrC_ADSI&signed_in=true"></script>
    <script>
// [START region_initialization]
// This example creates a custom overlay called USGSOverlay, containing
// a U.S. Geological Survey (USGS) image of the relevant area on the map.

// Set the custom overlay object's prototype to a new instance
// of OverlayView. In effect, this will subclass the overlay class therefore
// it's simpler to load the API synchronously, using
// google.maps.event.addDomListener().
// Note that we set the prototype to an instance, rather than the
// parent class itself, because we do not wish to modify the parent class.

var overlay;
USGSOverlay.prototype = new google.maps.OverlayView();

// Initialize the map and the custom overlay.

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: {lat: 48.304031, lng: 24.442338},
    mapTypeId: google.maps.MapTypeId.SATELLITE
  });


  var bounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(47.715003, 23.500115),
      new google.maps.LatLng(49.063432, 25.353138)
);

  // The photograph is courtesy of the U.S. Geological Survey.
  var srcImage = 'https://polmap-slabinoha.c9.io/images/map1.jpg';

  // The custom USGSOverlay object contains the USGS image,
  // the bounds of the image, and a reference to the map.
 overlay=new USGSOverlay(bounds, srcImage, map);


  var bounds2 = new google.maps.LatLngBounds(
      new google.maps.LatLng(48.186003, 22.270115),
      new google.maps.LatLng(49.135432, 23.500115)
);

  // The photograph is courtesy of the U.S. Geological Survey.
  var srcImage2 = 'https://polmap-slabinoha.c9.io/images/map2.jpg';

  // The custom USGSOverlay object contains the USGS image,
  // the bounds of the image, and a reference to the map.
var overlay2=new USGSOverlay(bounds2, srcImage2, map);
  var marker = new google.maps.Marker({
                position: new google.maps.LatLng(48.304031, 24.442338),
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function (a) {
                console.log(a);
                document.getElementById("lat").value = a.latLng.lat().toFixed(6);
                document.getElementById("lng").value = a.latLng.lng().toFixed(6);
            });
}
// [END region_initialization]

// [START region_constructor]
/** @constructor */
function USGSOverlay(bounds, image, map) {

  // Initialize all properties.
  this.bounds_ = bounds;
  this.image_ = image;
  this.map_ = map;

  // Define a property to hold the image's div. We'll
  // actually create this div upon receipt of the onAdd()
  // method so we'll leave it null for now.
  this.div_ = null;

  // Explicitly call setMap on this overlay.
  this.setMap(map);

}
// [END region_constructor]
 
// [START region_attachment]
/**
 * onAdd is called when the map's panes are ready and the overlay has been
 * added to the map.
 */
USGSOverlay.prototype.onAdd = function() {

  var div = document.createElement('div');
  div.style.borderStyle = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = '100%';
  img.style.height = '100%';
  img.style.position = 'absolute';
  div.appendChild(img);

  this.div_ = div;

  // Add the element to the "overlayLayer" pane.
  var panes = this.getPanes();
  panes.overlayLayer.appendChild(div);
};
// [END region_attachment]

// [START region_drawing]
USGSOverlay.prototype.draw = function() {

  // We use the south-west and north-east
  // coordinates of the overlay to peg it to the correct position and size.
  // To do this, we need to retrieve the projection from the overlay.
  var overlayProjection = this.getProjection();

  // Retrieve the south-west and north-east coordinates of this overlay
  // in LatLngs and convert them to pixel coordinates.
  // We'll use these coordinates to resize the div.
  var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
  var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

  // Resize the image's div to fit the indicated dimensions.
  var div = this.div_;
  div.style.left = sw.x + 'px';
  div.style.top = ne.y + 'px';
  div.style.width = (ne.x - sw.x) + 'px';
  div.style.height = (sw.y - ne.y) + 'px';
};


// [END region_drawing]

// [START region_removal]
// The onRemove() method will be called automatically from the API if
// we ever set the overlay's map property to 'null'.
USGSOverlay.prototype.onRemove = function() {
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};
// [END region_removal]

google.maps.event.addDomListener(window, 'load', initMap);

    </script>

  <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
  </head>
  <body>
    <div id="map" style="width: 800px; height: 640px"></div>
      <form action="/rt/addroute.php" method="post" name="mark" id="mark" enctype="multipart/form-data">
      <b>Широта: </b> <input type="text" name="lat" id="lat" value=""><br>
      <b>Довгота: </b> <input type="text" name="lng" id="lng" value=""><br>
      <b>Початковий пункт: </b> <input type="text" name="start" id="start" value=""><br>
      <b>Кінцевий пункт: </b> <input type="text" name="finish" id="finish" value=""><br>
      <b>Колір маркування: </b><select name="marker" form="mark">
  <option value="red">Червоний</option>
  <option value="green">Зелений</option>
  <option value="black">Чорний</option>
  <option value="blue">Синій</option>
   <option value="yellow">Жовтий</option>
</select><br>
      <input type=submit value="Додати маркер">
                        </form>
  </body>
</html>