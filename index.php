<?php
ini_set('display_errors',0);
error_reporting(0);

include "vendor/CJForm/CJForm.php";
include "header.php";

$f=new CJForm();
$f->newSection();

$f->newArticle("intro");
$f->h("intro");
$f->p("intro1");
$f->endArticle();


$f->endSection();
$f->endForm();
$f->show();
include "footer.php";
?>
