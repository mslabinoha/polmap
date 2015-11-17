<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Команда</title>
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
                        <li><a href="/index.php">Головна</a></li>
                        <li><a href="/about.php">Про проект </a></li>
                        <li class"active"><a href="/team.php">Команда </a></li>
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
                <div class="col-md-8 col-md-pull-2"> <!--Резюме-->                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><b>Резюме учасників</b></h3>                                
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-8 col-md-pull-1"> <!--інформація про нас-->                   
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <p><i>Слабінога Мар'ян Остапович</i>, аспірант кафедри комп’ютерних систем і мереж Івано-Франківського національного технічного університету нафти і газу— проведення експериментальних вимірювань, статистичний аналіз результатів, побудова емпіричних моделей, розробка математичного апарату для вирішення наукової проблеми, проектування структури програмного забезпечення, викладення результатів досліджень у наукових публікаціях.</p>
                                <p><i>Депутович Андрій Іванович</i>, студент Національного університету “Львівська Політехніка” - розробка програмного забезпечення, організація проведення екологічних акцій, розробка інформаційних матеріалів, поширення інформації у тематичних спільнотах через соціальні мережі.</p>
                                <p><i>Шевчук Михайло Ігорович</i>, студент Прикарпатського національного університету імені Василя Стефаника — систематизація експериментальних даних, контент-менеджмент програмного забезпечення, організація дослідницьких походів-експедицій.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2"> <!--Опис організації-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><b>Опис організації</b></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-3"><!--інформація про організацію-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Усі учасники проекту мають досвід у реалізації проектів та діяльності за суміжними темами. Зокрема, Слабінога М. О. — автор 6 публікацій у фахових наукових виданнях та 5 публікацій у виданнях, що індексуються наукометричними базами знань, приймав участь у 9 наукових конференціях, напрям досліджень — застосування систем штучного інтелекту для моніторингу стану технологічних та екологічних об’єктів. Шевчук М.І. під керівництвом Слабіноги М.О. у 2013 році прийняв участь у Всеукраїнському конкурсі-захисті науково-дослідницьких робіт Малої Академії Наук. Науково-дослідницька робота “Використання теорії графів для розрахунку оптимальних туристичних маршрутів на основі інформаційної бази даних” посіла 3 місце на всеукраїнському етапі конкурсу у секції “Інформаційні системи, бази даних та системи штучного інтелекту”. Депутович А.І. брав активну участь у розробці веб-сторінок багатьох освітніх закладів та установ: Перегінської ЗОШ 1-3 ст., районного навчального методичного центру Рожнятівської РДА, Будинку дитячої та юнацької творчості м. Рожнятів (спільно зі Слабіногою М.О.), а також ряду веб-сайтів громадських проектів: сайт співпраці української та польської молоді “Наша Молодь”, веб-каталогу “Освітній простір Рожнятівщини”. Крім того, кожен з учасників проекту має значний досвід у пішохідному туризмі та брав участь у залікових походах 1 категорії складності.</p>
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
