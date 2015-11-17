<?php
session_start();
unset($_SESSION['session_username']);
session_destroy('session_username');
header( "Location: /index.php" );

?>