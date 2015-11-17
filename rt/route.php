<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php  session_start();?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Шляхи</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>

</head>
<body>
    <script src="/Scripts/jquery-2.1.4.js"></script>
    <script src="/Scripts/bootstrap.js"></script>
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
var customIcons = {
            red: {
                icon: '/images/red_mark.png'
            },
             blue: {
                icon: '/images/blue_mark.png'
            },
             green: {
                icon: '/images/green_mark.png'
            },
             black: {
                icon: '/images/black_mark.png'
            },
             yellow: {
                icon: '/images/yellow_mark.png'
            }
        };
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 11,
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
 var infoWindow = new google.maps.InfoWindow;

            // Change this depending on the name of your PHP file
            downloadUrl("/rt/getrtxml.php", function (data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName("marker");
                for (var i = 0; i < markers.length; i++) {
                    var id = markers[i].getAttribute("id");
                    var start = markers[i].getAttribute("start");
                    var finish = markers[i].getAttribute("finish");
                    var mark = markers[i].getAttribute("mark");
                    var point = new google.maps.LatLng(
                        parseFloat(markers[i].getAttribute("lat")),
                        parseFloat(markers[i].getAttribute("lng")));
                    var lnk = "<a href='/rt/rtdetails.php?rid=" + id + "'>Більше інформації...</a><br>";
                    var html = "Ділянка <b>" + start + " - " + finish + "</b> <br>" + lnk;
                    var icon = customIcons[mark] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        icon: icon.icon
                    });
                    bindInfoWindow(marker, map, infoWindow, html);
                }
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
 function bindInfoWindow(marker, map, infoWindow, html) {
            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });
        }

        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing() { }

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
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <a href="/"> <img src="/images/logo.png" alt="Logo" /></a>
                </div>
                <div class="col-md-4">
                    <ul class="nav nav-pills nav-pos">
                        <li><a href="/index.php">Головна</a></li>
                        <li><a href="/about.php">Про проект </a></li>
                        <li><a href="/team.php">Команда </a></li>
                    </ul>

                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <nav class="navmenu navmenu-default navmenu-fixed-left" role="navigation">
                        <ul class="nav navmenu-nav">
                            <li><?php
                                              
                                               if(!isset($_SESSION['session_username'])){echo'<a href="/log/login.php">Увійти</a>';}else{ echo'<a href="log/logout.php">Вийти</a>';}?></li>
                            <li><a href="/helpus.php">Чим ви можете допомогти проекту?</a></li>
                            <li><a href="/stats.php">Статистика</a></li>
                            <li><a href="/testimonials.php">Відгуки</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-8 col-md-pull-1">
                    <!--Контент блок-->
                    <div class="container-fluid">
                        <div id="map" style="width: 800px; height: 640px"></div>
                        <div>
                            <br>
                            <br>
                            <b>Додані всі маршрути із 8 карт серії "Відпочивай активно" видавництва "АССА"</b> <br>
                            Якщо у вас є інформація про стан стежки на конкретній ділянці, клікніть на іконці маркування та перейдіть на сторінку деталей. <br>
                            <b>Розробники проекту "Ecomap" щиро вдячні організації "Карпатські стежки" за надані карти-схеми з маркованими маршрутами.<b>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="navbar-fixed-bottom row-fluid">
            <div class="navbar-inner">
                <div class="container-fluid">

                    <h4>©ecomap 2015</h4>

                </div>
            </div>
        </div>
    </footer>
</body>
</html>
