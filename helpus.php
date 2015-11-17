<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $human = intval($_POST['human']);
    $from = "Форма зворотнього зв'язку";
    $to = 'info@ecomap.if.ua';
    $subject = 'Message from Contact Demo ';

    $body ="From: $name\n E-Mail: $email\n Message:\n $message";
    // Check if name has been entered
    if (!$_POST['name']) {
        $errName = "Введіть своє ім'я та прізвище";
    }

    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Введіть правильну адресу';
    }

    //Check if message has been entered
    if (!$_POST['message']) {
        $errMessage = 'Введіть повідомлення';
    }
    //Check if simple anti-bot test is correct
    if ($human !== 5) {
        $errHuman = 'Відповідь на антиспам невірна';
    }
    // If there are no errors, send the email
    if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
        if (mail ($to, $subject, $body, $from)) {
            $result='<div class="alert alert-success">Дякую Вам! Повідомленя надіслано</div>';
        } else {
            $result='<div class="alert alert-danger">На жаль сталася помилка при відправці повідомлення. Будь-ласка спробуйте пізніше.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Чим ви можете допомогти проекту?</title>
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
                    <a href="/">
                        <img src="/images/logo.png" alt="Logo" /></a>
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
                            <li class"active"><a href="/helpus.php">Чим ви можете допомогти проекту?</a></li>
                            <li><a href="/stats.php">Статистика</a></li>
                            <li><a href="/testimonials.php">Відгуки</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-8 col-md-pull-1"><!--Акордіони=)-->
                    <div class="panel-group" id="collapse">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-one">
                                        Чим ви можете допомогти проекту?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-one" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    Оскільки частина даного проекту, реалізована даним веб-ресурсом, носить в першу чергу соціальний характер, ми надіємося на допомогу нашої туристичної спільноти, та і просто небайдужих людей (в тому числі і Вас:)). Отже, як ви можете допомогти проекту?
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-two">
                                        Наповнюйте базу даних нашого проекту
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-two" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Як сказала одна мудра людина, хто володіє інформацією, той володіє світом. Якщо ви побачили в горах смітник, вирубку, чи інший негативний прояв впливу людини на природу, запишіть його координати в навігаторі або відзначте на карті, оцініть на око масштаби, зробіть декілька фото — це займе у вас хвилинку-дві. Стільки ж займе простенька <a href="/log/register.php">реєстрація</a> на сайті та заповнення форми додавання об’єкту, після чого ви долучитеся до доброї справи, доповнивши своєю роботою інформацію про екологічну ситуацію в Карпатах.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-three">
                                        Розкажіть друзям
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-three" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Як відомо, інформаційне агенство “ОБС” (одна бабка сказала) — це найкращий спосіб поширення інформації. Розкажіть про цей проект вашим друзям, попросіть долучитися до нього!
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-four">
                                        Беріть участь в екологічних акціях
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-four" class="panel-collapse collapse">
                                <div class="panel-body">
                                  Наш проект поки що не виходить за межі веб-мережі, хоча в майбутньому це планується робити. Однак <a href="http://stezhky.org.ua/">“Карпатські стежки”</a> та інші громадські організації вже давно організовують екологічні акції з прибирання та благоустрою карпатських теренів. Допоможіть їм зробити наші Карпати кращими! 
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-five">
                                        Поділіться з нами своїми знаннями фахівця
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-five" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Ви займаєтеся екологічними проблемами та маєте своє бачення, як зробити наш проект кращим? Можете допомогти нам реалізувати <a href="/about.phpl#collapse-six">наукову складову</a> Зв’яжіться з нами (контактні дані внизу сторінки), ми будемо раді будь-якій допомозі.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-six">
                                        ... і незручна тема фінансів :(
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-six" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Ми запустили проект, за власні кошти придбавши хостинг і домен. Це річний мінімум, який нам потрібно буде сплачувати щороку, щоб існувати. Для реалізації наукової складової нам потрібне обладнання, кошти на яке ми зараз стараємося знайти. Крім того, хотілося би розповсюджувати інформаційні матеріали про екологічні проблеми в Українських Карпатах. Це все потребує фінансування. Якщо можете допомогти, не залишайтеся байдужими, зв’яжіться з нами!
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-seven">
                                        Наші контактні дані
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-seven" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>+38 (066) ll69З60 (Слабінога Мар’ян Остапович)</p>
                                <p>+38 (098) 8O622Ol (Депутович Андрій Іванович)</p>
                                <p>e-mail: info@ecomap.if.ua</p>
                                <p>Ви також можете відправити листа з форми зворотного зв’язку, розташованої нижче.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#collapse" href="#collapse-eight">
                                        Форма зворотнього зв'язку
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-eight" class="panel-collapse collapse">
                                <div class="panel-body">
                                  <form class="form-horizontal" role="form" method="post" action="/helpus.php">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Ім'я та прізвище</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ім'я та прізвище" value="<?php echo htmlspecialchars($_POST['name']); ?>">
                                            <?php echo "<p class='text-danger'>$errName</p>";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                                            <?php echo "<p class='text-danger'>$errEmail</p>";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="message" class="col-sm-2 control-label">Повідомлення</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                                            <?php echo "<p class='text-danger'>$errMessage</p>";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="human" name="human" placeholder="Ваша відповідь">
                                            <?php echo "<p class='text-danger'>$errHuman</p>";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <input id="submit" name="submit" type="submit" value="Відправити" class="btn btn-default">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <?php echo $result; ?>
                                        </div>
                                    </div>
                                </form>
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
