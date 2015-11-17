<?php
//блок підключення до бази
session_start();
if(!isset($_SESSION['session_username'])){header( "Location: /log/login.php" );}else{
include ($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
// Opens a connection to a MySQL server
$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}
// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
//блок завантаження зображення
$ff =mysql_query("SET NAMES utf8"); 
if (!empty($_FILES['imgupload']['name'])){

$path_directory = 'photos/';

	
if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['imgupload']['name']))//перевіряємо зображення
	 {	
	 	 	
		$filename = $_FILES['imgupload']['name'];//завантажуємо
		$source = $_FILES['imgupload']['tmp_name'];	
		$target = $path_directory . $filename;
		move_uploaded_file($source, $target);

	if(preg_match('/[.](GIF)|(gif)$/', $filename)) { //конвертуємо з інших типів у жпег
	$im = imagecreatefromgif($path_directory.$filename) ;
	}
	if(preg_match('/[.](PNG)|(png)$/', $filename)) {
	$im = imagecreatefrompng($path_directory.$filename) ;
	}	
	if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
    $im = imagecreatefromjpeg($path_directory.$filename); 

	}

$w = 640; //ресайзимо до потрібного розміру
$h =480;
$w_src = imagesx($im); 
$h_src = imagesy($im); 


 if ($w_src>$h_src) {
      $dest = imagecreatetruecolor($w,$h); 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, $w_src, $h_src); 
} else{
     $dest = imagecreatetruecolor($h,$w); 
     imagecopyresampled($dest, $im, 0, 0, 0, 0, $h, $w, $w_src, $h_src); 
}
$date=time(); 

imagejpeg($dest, $path_directory.$date.".jpg"); //кидаємо оброблене зображення в папку, стираємо старе

$imgpath = $path_directory.$date.".jpg";
$delfull = $path_directory.$filename; 
unlink ($delfull);

}
$result = mysql_query ("INSERT INTO wdimages(path,data,authid,smitnid) VALUES('".$imgpath."',CURDATE(),".$_SESSION['session_userid'].",".$_POST['tid'].");"); //прописуємо в бд
}
//блок оновлення статусу
$status=0;
if (!empty($_POST['app'])){// якщо значення більше 0, то смітник ліквідований, якщо більше 2 - підтверджений
	if($_POST['app']==1){$status=$_POST['approved']+1;}//голос за підтвердження додає 1

	if($_POST['app']==2){$status=$_POST['approved']-1;}//голос за то, що смітника там нема віднімає 1

	if($_POST['app']==3){$status=$_POST['approved']-5;}//голос за то, що смітник вичищений, ліквідований віднімає 5

$result = mysql_query ("UPDATE smitnyk SET approved=".$status." WHERE id=".$_POST['tid'].";");
}
//блок додавання коментарів
if (!empty($_POST["commenta"])){
	echo $_POST["commenta"];
	$result = mysql_query ("INSERT INTO wdcomments(ctext,data,authid,smitnid) VALUES('".$_POST["commenta"]."',CURDATE(),".$_SESSION['session_userid'].",".$_POST['tid'].");");
}
$url='/wddp/wddetails.php?tid='.$_POST['tid'];
header( "Location: $url" );
}
?>