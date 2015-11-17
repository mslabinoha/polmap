<?php session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Смітники</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
        //<![CDATA[

        var customIcons = {
            approved: {
                icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
            },
            notapproved: {
                icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
            },
            cleaned: {
                icon: 'http://labs.google.com/ridefinder/images/mm_20_green.png'
            }
        };
        function load() {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(48.304031, 24.442338),
                zoom: 8,
                mapTypeId: 'terrain'
            });
            var infoWindow = new google.maps.InfoWindow;

            // Change this depending on the name of your PHP file
            downloadUrl("/smt/genxml.php", function (data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName("marker");
                for (var i = 0; i < markers.length; i++) {
                    var id = markers[i].getAttribute("id");
                    var width = markers[i].getAttribute("width");
                    var lengt = markers[i].getAttribute("length");
                    var depth = markers[i].getAttribute("depth");
                    var point = new google.maps.LatLng(
                        parseFloat(markers[i].getAttribute("lat")),
                        parseFloat(markers[i].getAttribute("lng")));
                    var trashtype = markers[i].getAttribute("trashtype");
                    var approved = markers[i].getAttribute("approved");
                    if (approved >= 2) { type = 'approved'; } else if (approved < 0) { type = 'cleaned'; } else { type = 'notapproved'; }
                    var trashcontent = "<b>Склад сміття:</b> <br>";
                    if ((trashtype % 200000) >= 100000) { trashcontent = trashcontent + "органіка <br>"; }
                    if ((trashtype % 20000) >= 10000) { trashcontent = trashcontent + "пластик <br>"; }
                    if ((trashtype % 2000) >= 1000) { trashcontent = trashcontent + "скло <br>"; }
                    if ((trashtype % 200) >= 100) { trashcontent = trashcontent + "метал <br>"; }
                    if ((trashtype % 20) >= 10) { trashcontent = trashcontent + "папір <br>"; }
                    if ((trashtype % 2) >= 1) { trashcontent = trashcontent + "поліетилен <br>"; }
                    var lnk = "<a href='/smt/trashdetails.php?tid=" + id + "'>Більше інформації...</a><br>";
                    var html = "<b>Розміри смітника:</b> <br/>" + "Довжина: " + lengt + "<br> Ширина: " + width + "<br> Глибина/Висота: " + depth + "<br>" + trashcontent + lnk;
                    var icon = customIcons[type] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        icon: icon.icon
                    });
                    bindInfoWindow(marker, map, infoWindow, html);
                }
            });
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

        //]]>

    </script>

</head>
<body onload="load()">
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
                        <div id="map" style="width: 800px; height: 600px"></div>
                        <div>
                                <p><img src="http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_red.png" alt="Red point"> - непідтверджений смітник</p>
                                <p><img src="http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_blue.png" alt="Blue point"> - підтверджений смітник</p>
                                <p><img src="http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_green.png" alt="Green point"> - смітник ліквідований</p>
                                <p colspan="2">Клік на маркер виводить інформацію про смітник</p>
                        </div>
                        <h4>Якщо Ви не знайшли на цій карті смітник, про який вам відомо, ви можете <a href="/smt/addsmm.php">додати його</a></h4>
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
