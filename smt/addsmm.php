
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Додати смітник</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
    <script src = "/Scripts/if.js"></script>
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
<body onload="lload()">
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
	<li class="active"><a href="#add" role="tab" data-toggle="tab">Додати смітник</a></li>
	<li><a href="#manual" role="tab" data-toggle="tab">Інструкція</a></li>
</ul>

<!--Tab content-->
<div class="tab-content">
	<div class="active tab-pane fade in" id="add">
	 Перетягніть маркер на потрібну позицію на карті:
                        <div id="map" style="'.'width: 640px; '.'height: 400px"></div>
                        <form action="/smt/addsm.php" method="post" name="addsm" enctype="multipart/form-data" onsubmit="return check ( );">
                            <b>Координати: </b><br>
                            <b>Широта: </b> <input type="text" name="lat" id="lat" value="" required pattern="\d+(\.\d{6})?"><br>
                            <b>Довгота: </b> <input type="text" name="lng" id="lng" value="" required pattern="\d+(\.\d{6})?"><br>
                            <input type="hidden" name="authorid" value="'.$_SESSION['session_userid'].'">
                            <b>Розміри: </b><br>
                            <b>Ширина: </b> <input type="text" name="width" value="" required pattern="\d+(\.\d{1,2})?"><br>
                            <b>Довжина: </b> <input type="text" name="length" value="" required pattern="\d+(\.\d{1,2})?"><br>
                            <b>Висота/Глибина: </b> <input type="text" name="height" value="" required pattern="\d+(\.\d{1,2})?"><br>
                            <b>Типи сміття</b><br>
                            <input type="checkbox" name="trashtype[]" value="A" />органіка<br />
                            <input type="checkbox" name="trashtype[]" value="B" />пластик<br />
                            <input type="checkbox" name="trashtype[]" value="C" />скло<br />
                            <input type="checkbox" name="trashtype[]" value="D" />метал<br />
                            <input type="checkbox" name="trashtype[]" value="E" />папір<br />
                            <input type="checkbox" name="trashtype[]" value="F" />поліетилен<br />
                            <b>Коментар: </b><br><textarea rows="4" cols="50" id="commenta" name="commenta"></textarea><br>
                            <input type=submit value="Додати смітник">
                            <br> Після створення смітника ви будете перенаправлені на загальну карту, де він з’явиться.
                        </form>
	</div>
	<div class="tab-pane fade" id="manual">
		<h4>Для того, щоб додати смітник, якого немає позначено на карті Вам необхідно зробити наступні кроки:</h4>
		<ol>
			<li><h4><p>Натиснути на виділену область, яка направить Вас на сторінку додавання смітника на карту</p></h4></li><br>
			<img src = "/images/man/smt/1.png"><br><br>
			<li><h4><p>Тепер, Вам необхідно перетягнути маркер на карті, на місце, де знаходиться смітник, який Ви хочете додати. Для зручності можна збільшити масштаб карти, щоб поставити маркер у необхідне місце</p></li><br>
			<img src = "/images/man/smt/2.png"><br><br>
			<h5><p>Для зручності, при перетягуванні маркера, координати маркера записались у поля Широти та Довготи</p></h5>
			<li><h4><p>Наступним кроком буде задання розмірів самого смітника, а саме ширини, довжини та висоти/глибини смітника</p>
			<p><b>УВАГА! </b>Всі значення записуються у метрах!</p></h4></li><br>
			<img src = "/images/man/smt/3.png"><br><br>
			<li><h4><p>Далі, відзначаємо вміст смітника, а також пишемо коментарі, з детальним описом місця, вмісту смітника або побажанням:) Фінішним кроком буде натиснути кнопку "Додати смітник"</p></h4></li><br>
			<img src = "/images/man/smt/4.png"><br>
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
