<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Додати вирубку</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script type="text/javascript">
        var bermudaTriangle;
        function initialize() {
            var myLatLng = new google.maps.LatLng(48.304031, 24.442338);
            var mapOptions = {
                zoom: 10,
                center: myLatLng,
                mapTypeId: google.maps.MapTypeId.terrain
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
            var triangleCoords = [
            new google.maps.LatLng(48.28108,24.21835),
            new google.maps.LatLng(48.32407,24.24594),
            new google.maps.LatLng(48.32133,24.19501)

        ];
            // Construct the polygon 
            bermudaTriangle = new google.maps.Polygon({
                paths: triangleCoords,
                draggable: true,
                editable: true,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35
            });

            bermudaTriangle.setMap(map);
            google.maps.event.addListener(bermudaTriangle, "dragend", getPolygonCoords);
            google.maps.event.addListener(bermudaTriangle.getPath(), "insert_at", getPolygonCoords);
            google.maps.event.addListener(bermudaTriangle.getPath(), "remove_at", getPolygonCoords);
            google.maps.event.addListener(bermudaTriangle.getPath(), "set_at", getPolygonCoords);
        }

        function getPolygonCoords() {
            var len = bermudaTriangle.getPath().getLength();
            var htmlStr = "<points>\n";
            for (var i = 0; i < len; i++) {
                var latlng=bermudaTriangle.getPath().getAt(i).toUrlValue(5).split(',');
                htmlStr += '<point lat="'+latlng[0]+'" lng="'+latlng[1]+'"/>\n';
            }
            htmlStr+= "</points>";
            document.getElementById('info').innerHTML = htmlStr;
        }        
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
                                               session_start();
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
                        <ul class="nav nav-tabs" role="tablist">
	<li class="active"><a href="#add" role="tab" data-toggle="tab">Додати вирубку</a></li>
	<li><a href="#manual" role="tab" data-toggle="tab">Інструкція</a></li>
</ul>

<!--Tab content-->
<div class="tab-content">
	<div class="active tab-pane fade in" id="add">
	     <div id="map-canvas" style="height: 350px; width: auto;">
    </div>
   
        <form action="/vrbk/addervrb.php" method="post" name="add" id="add" enctype="multipart/form-data">
                                    
                                    <b>Координати (перетягніть полігон та рухайте точки, щоб фігура співпала з зоною вирубки): </b><br><textarea readonly rows="4" cols="50" id="info" name="info"></textarea><br>
                                    <input type="checkbox" name="trashtype[]" value="A" />Місце вирубки не було очищене від гілок<br />
                                    <input type="checkbox" name="trashtype[]" value="B" />Вирубка ускладнює рух маркованим маршрутом<br />
                                    <input type="checkbox" name="trashtype[]" value="C" />Вирубка межує з водоймою<br />
                                    <input type="checkbox" name="trashtype[]" value="D" />Вирубка здійснена на крутому схилі<br />
                                    <b>Основна порода дерева, що піддалась вирубці: </b><select name="wood" form="add">
  <option value="0">Виберіть...</option>
  <option value="1">Смерека</option>
  <option value="2">Дуб</option>
  <option value="3">Бук</option>
  <option value="4">Інша</option>
</select><br>
                                    <input type=submit value="Додати дані">
                                </form>
	 
	</div>
	<div class="tab-pane fade" id="manual">
	    <h4>Для того, щоб додати місце вирубки, яку немає на карті Вам необхідно зробити наступні кроки:</h4>
		<ol>
		    <li><h4><p>Натиснути на виділену область, яка направить Вас на сторінку додавання вирубки на карті</p></h4></li><br>
		    <img src="/images/man/vrbk/1.png"></img><br><br>
		    <li><h4><p>Наступним кроком буде відзначення на карті полігону вирубки. Для цього Вам необхіно перетягнути полігон на область, де знаходиться вирубка. Для зміни форми полігону, потягніть за будь-який кут полігону. Для зручності можна збільшити масштаб карти, щоб точно зазначити місце та форму вирубки</p></h4></li><br>
		    <img src="/images/man/vrbk/2.png"></img><br><br>
		    <h5><p>Для зручності, при перетягуванні полігону вирубки, координати полігону записуються у поле координатів</p></h5>
		    <li><h4><p>Далі, відзначаємо пункти, які притаманні даній вирубці, та вибираємо породу дерева, яка в основному піддалась вирубці. Кінцевим кроком буде натискання кнопки "Додати дані"</p></h4></li><br>
		    <img src="/images/man/vrbk/3.png"></img><br><br>
		    
		    
		    
		</ol>
	</div>
</div>
                        
                      
    </div>
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
