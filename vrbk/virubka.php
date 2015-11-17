<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php  session_start();?>
    <title>Вирубки</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script type="text/javascript">
        
        function initialize() {
            
            var myLatLng = new google.maps.LatLng(48.304031, 24.442338);
            var mapOptions = {
                zoom: 10,
                center: myLatLng,
                mapTypeId: google.maps.MapTypeId.terrain
            };
            
            var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
            //var infoWindow = new google.maps.InfoWindow;
            var col=[];
            // Change this depending on the name of your PHP file
            downloadUrl("/vrbk/getvrbxml.php", function (data) {
                var xml = data.responseXML;
                var polygons = xml.documentElement.getElementsByTagName("polygon");
                var harr=[];
                var k=0;
                var coords=[];
                for (var i = 0; i < polygons.length; i++) {
                    var bermudaTriangle=[];
                    var id = polygons[i].getAttribute("id");
                    var file = polygons[i].getAttribute("file");
                     var trashtype = polygons[i].getAttribute("vopt");
                    var wood = polygons[i].getAttribute("wood");
                    var approved = polygons[i].getAttribute("approved");
                    var woods='';
                    
                    if(wood==0){woods='Не вказано';} else if(wood==1){woods='Смерека';} else if (wood==2){woods='Дуб';}else if(wood==3){woods='Бук';}else if(wood==4){woods='Інша порода дерева';}
                    if (approved ==0) { var lnk = "<b>Вирубка непідтверджена.</b> <a href='/vrbk/prove.php?vid=" + id + "'>Підтвердити інформацію...</a><br>";col.push('#FF0000');} 
                    else { var lnk = "<b>Вирубка підтверджена.</b><br>"; col.push('#0000FF');}
                    var trashcontent = "<b>Відомості:</b> <br>";
                    if ((trashtype % 2000) >= 1000) { trashcontent = trashcontent + "Місце вирубки не було очищене від гілок. <br>"; }
                    if ((trashtype % 200) >= 100) { trashcontent = trashcontent + "Вирубка ускладнює рух маркованим маршрутом. <br>"; }
                    if ((trashtype % 20) >= 10) { trashcontent = trashcontent + "Вирубка межує з водоймою <br>"; }
                    if ((trashtype % 2) >= 1) { trashcontent = trashcontent + "Вирубка здійснена на крутому схилі <br>"; }
                    var html = "<b>Вирубана порода дерева:</b>" + woods + "<br>"+ trashcontent + lnk;
                    
                    downloadUrl(file, function (datap) {
                        var xml1 = datap.responseXML;
                        var triangleCoords = [];
                        var points = xml1.documentElement.getElementsByTagName("point");

                        for (var j = 0; j < points.length; j++) {
                            var point = new google.maps.LatLng(
                            parseFloat(points[j].getAttribute("lat")),
                            parseFloat(points[j].getAttribute("lng")));
                            triangleCoords.push(point);
                }
                coords.push(triangleCoords);
                bermudaTriangle= new google.maps.Polygon({
                paths: coords[k],
                draggable: false,
                editable: false,
                strokeColor: col[k],
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: col[k],
                fillOpacity: 0.35,
                indexID:k
            });
                    k+=1;
                    //html="";
                    bermudaTriangle.setMap(map);
                    
                google.maps.event.addListener(bermudaTriangle, 'click', function (event) {
                    //alert(this.indexID);
                document.getElementById('virinfo').innerHTML ="<h4> Інформація про вирубку:</h4>"+harr[this.indexID] ; 
});  
                            });
                            harr.push(html);
                            html="";
                    //var point = new google.maps.LatLng(
             //           parseFloat(markers[i].getAttribute("lat")),
                 //       parseFloat(markers[i].getAttribute("lng")));
                   
                    
           
                    //bindInfoWindow(bermudaTriangle, map, infoWindow, html);
                }
            });
            
        }
           // var triangleCoords = [
                
           // new google.maps.LatLng(48.28108,24.21835),
           // new google.maps.LatLng(48.32407,24.24594),
     //       new google.maps.LatLng(48.32133,24.19501)

       // ];
            // Construct the polygon 
            

    /*
        function bindInfoWindow(polygon, map, infoWindow, html) {
            google.maps.event.addListener(polygon, 'click', function () {
                infoWindow.setContent(html);
                infoWindow.open(map, polygon);
            });
        }

       */ function downloadUrl(url, callback) {
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

        //]]>
    </script>
</head>

<body onload="initialize()">
    <script src="/Scripts/jquery-2.1.4.js"></script>
    <script src="/Scripts/bootstrap.js"></script>

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
if(!isset($_SESSION['session_username'])){echo'<a href="/log/login.php">Увійти</a>';}else{ echo'<a href="/log/logout.php">Вийти</a>';}?></li>
                            <li><a href="/helpus.php">Чим ви можете допомогти проекту?</a></li>
                            <li><a href="/stats.php">Статистика</a></li>
                            <li><a href="/testimonials.php">Відгуки</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-8 col-md-pull-1">
                    <!--Контент блок-->
                    <div class="container-fluid">
                         <div id="map-canvas" style="height: 350px; width: 70%; float:left;"> </div>
                         <div id="virinfo" style="height: 350px; width: 30%; float:left;" > <h4> Інформація про вирубку:</h4> <i>Клікніть на потрібній вирубці</i><br>
    </div>
    <p><img src="http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_red.png" alt="Red point"> - непідтверджена вирубка</p>
                                <p><img src="http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_blue.png" alt="Blue point"> - підтверджена вирубка</p>
     <h4>Якщо Ви не знайшли на цій карті вирубку, про яку вам відомо, ви можете <a href="/vrbk/addvrb.php">додати її</a></h4>
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
