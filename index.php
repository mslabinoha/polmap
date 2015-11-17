<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Інтерактивна карта забруднень</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
</head>
<body>
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
                        <li class"active"><a href="/index.php">Головна</a></li>
                        <li><a href="/about.php">Про проект </a></li>
                        <li><a href="/team.php">Команда </a></li>
                    </ul>

                </div>
            </div>
        </div>
    </header>

    <section id="main">
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
                <div class="col-md-6 col-md-pull-1"> <!--Контент блок-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <a href="/smt/smitnyk.php" style="color:#000">
                                        <div class="col-md-6" style="margin-top:10px">
                                            <img src="/images/smit.png" />
                                    </a>
                                </div>
                                <a href="/rt/route.php" style="color:#000">
                                        <div class="col-md-6" style="margin-top:10px">
                                            <img src="/images/shl.png" />
                                        </div>
                                    </a>
                                
                                 <a href="/vrbk/virubka.php" style="color:#000">
                                        <div class="col-md-6" style="margin-top:10px">
                                            <img src="/images/vurubka.png" />
                                        </div>
                                     </a>
                                <a href="/wddp/wooddump.php" style="color:#000">
                                    <div class="col-md-6" style="margin-top:10px">
                                        <img src="/images/lis.png" />
                                    </div>
                                </a>
</div>

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
