<?php
ini_set('display_errors',1);
error_reporting(999);

session_start();

if(isset($_GET['fr'])){
	include "lang/fr.php";
	$_SESSION['lang']="fr";
}else{
  include "lang/en.php";
  $_SESSION['lang']="en";
}
	
include "vendor/CJForm/CJForm.php";

$token=isset($_GET['token'])?$_GET['token']:null;

?>
<!DOCTYPE html>
<html>
<head>
<?php 
echo "<title>Columbia Global Centers | Europe</title>\n";
echo "<script type='text/JavaScript'>var date_format=\"{$lang['date_format']}\";</script>\n";
?>
<link rel='shortcut icon' type='image/x-icon' href='css/img/favicon.ico' /> 
<link rel='stylesheet' type='text/css' href= 'vendor/jquery-ui-1.10.4.custom/css/CGC/jquery-ui-1.10.4.custom.min.css' media='all' />
<link rel='stylesheet' type='text/css' href= 'vendor/CJForm/CJForm.css' media='all' />
<link rel='stylesheet' type='text/css' href= 'css/style.css' media='all' />
<script type='text/JavaScript' src='vendor/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js'></script>
<script type='text/JavaScript' src='vendor/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js'></script>
<script type='text/JavaScript' src='vendor/datePickerFr.js'></script>
<script type='text/JavaScript' src='lang/en.js'></script>
<script type='text/JavaScript' src='lang/fr.js'></script>
<script type='text/JavaScript' src='vendor/CJForm/CJForm.js'></script>
<script type='text/JavaScript' src='vendor/CJScript.js'></script>
<script type='text/JavaScript' src='js/script.js'></script>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
</head>


<body>

<header>
  <div id='logo'>
    <img src='css/img/logo.gif' alt='Columbia Global Centers | Europe'/>
  </div> <!-- logo -->

  <div id='title'>
    <?php echo "{$lang['titre']}\n"; ?>
  </div> <!-- title -->

  <nav id='flag'>
  	<img src='css/img/english_flag.jpg' alt='English' border='0' style='display:none;' class='CJFlag' data-lang='en'/>
  	<img src='css/img/french_flag.jpg' alt='Fran&ccedil;ais' border='0' class='CJFlag' data-lang='fr' />
  </nav> <!-- flag -->
  <hr/>
</header>