<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Додати пункт вантажу лісу</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
        //<![CDATA[

        function lload() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(48.304031, 24.442338),
                zoom: 8,
                mapTypeId: 'terrain'
            });
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
        };

    </script>

</head>
<body onload="    lload()">
<?php
session_start();
if(!isset($_SESSION['session_username'])){header( "Location: /log/login.php" );}else{
echo'
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
                            <li><a href="/log/login.php">Увійти</a></li>
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
	<li class="active"><a href="#add" role="tab" data-toggle="tab">Додати пункт</a></li>
	<li><a href="#manual" role="tab" data-toggle="tab">Інструкція</a></li>
</ul>

<!--Tab content-->
<div class="tab-content">
	<div class="active tab-pane fade in" id="add">
	Перетягніть маркер на потрібну позицію на карті:
                        <div id="map" style="'.'width: 640px; '.'height: 400px"></div>
                        <form action="/wddp/addwd.php" method="post" name="addwd" enctype="multipart/form-data">
                            <b>Координати: </b><br>
                            <b>Широта: </b> <input type="text" name="lat" id="lat" value=""><br>
                            <b>Довгота: </b> <input type="text" name="lng" id="lng" value=""><br>
                            <input type="hidden" name="authorid" value="'.$_SESSION['session_userid'].'">
                            <b>Розміри: </b><br>
                            <b>Ширина: </b> <input type="text" name="width" value=""><br>
                            <b>Довжина: </b> <input type="text" name="length" value=""><br>
                            <b>Глибина механічного проникнення в грунт: </b> <input type="text" name="height" value=""><br>
                            <b>Типи забруднення</b><br>
                            <input type="checkbox" name="trashtype[]" value="A" />тирса<br />
                            <input type="checkbox" name="trashtype[]" value="B" />дрібні гілки/хвоя(листя)<br />
                            <input type="checkbox" name="trashtype[]" value="C" />пально-мастильні матеріали<br />
                            <input type="checkbox" name="trashtype[]" value="D" />метал<br />
                            <input type="checkbox" name="trashtype[]" value="E" />пластик та інші побутові відходи<br />
                            <b>Коментар: </b><br><textarea rows="4" cols="50" id="commenta" name="commenta"></textarea><br>
                            <input type=submit value="Додати пункт складування лісу">
                            <br> Після створення пункту завантаження лісу ви будете перенаправлені на загальну карту, де він з’явиться.
                        </form>
	 
	</div>
	<div class="tab-pane fade" id="manual">
	<h4>Для того, щоб додати пункт завантаження лісу, який не позначений на карті, Вам необхідно зробити наступні кроки:</h4>

		<ol>
		    <li><h4><p>Натиснути на виділену область, яка направить Вас на сторінку додавання пунктів завантаження лісу</p></h4></li><br>
		    <img src="/images/man/wddp/1.png"></img><br><br>
		    <li><h4><p>Тепер, Вам необхідно перетягнути маркер на карті, на місце, де знаходиться пункт вирубки, який Ви хочете додати. Для зручності можна збільшити масштаб карти, щоб поставити маркер у необхідне місце</p></h4></li><br>
		    <img src="/images/man/wddp/2.png"></img><br><br>
		    <h5><p>Для зручності, при перетягуванні маркера, координати маркера записались у поля Широти та Довготи</p></h5>
		    <li><h4><p>Наступним кроком буде задання розмірів пункту відвантаження лісу, а саме ширини, довжини та глибини механічного проникнення в грунт, тобто, колії від автомобілів, тракторів та іншої спеціальної техніки</p></h4></li><br>
		    <img src="/images/man/wddp/3.png"></img><br><br>
			<p><b>УВАГА! </b>Всі значення записуються у метрах!</p></h4></li><br>
			<li><h4><p>Далі, відзначаємо типи забруднення, які присутні на даному пункті, а також пишемо коментарі, з описом пункту відвантаження лісу, деталями або побажанням:) Фінішним кроком буде натиснути кнопку "Додати пункт складування лісу"</p></h4></li><br>
		    <img src="/images/man/wddp/4.png"></img><br><br>


		</ol>
	</div>
</div>
                    
                    
                    
                    
                    
                    
                        

                    </div>

                </div>
            </div>
        </div>
    </section>
    <div><br><br><br></div>
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
';}
?>