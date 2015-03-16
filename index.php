<?php
ini_set('display_errors',1);
error_reporting(999);

include "vendor/CJForm/CJForm.php";
include "vendor/fpdf17/fpdf.php";
include "header.php";



$token=isset($_GET['token'])?$_GET['token']:null;

$f=new CJForm();
$f->token=$token;
$f->nav=true;
$f->newSection();

$f->newArticle("intro");
$f->h("intro");
$f->p("intro1");
$f->buttons("startForm-next");
$f->endArticle();

$f->newArticle("projectNav");
$f->h("project");
$f->inputText("CUGlobalCenter",true);
$f->inputText("school",true);
$f->inputText("programTitle",true);
$f->inputText("programDesc",true);
$f->inputText("costEstimate",true);
$f->inputDates("dates",true,true,7);
$f->buttons("previous-previous,next-next");
$f->endArticle();

$f->newArticle("organizerNav");
$f->h("organizer");

$f->h("leader",3);
$f->inputText("firstname",true);
$f->inputText("lastname",true);
$f->inputText("courriel",true,"mail");
$f->inputText("tel");

$f->h("collaborator",3);
$f->inputText("firstname");
$f->inputText("lastname");
$f->inputText("courriel",false,"mail");
$f->inputText("tel");

$f->buttons("previous-previous,next-next");
$f->endArticle();

$f->newArticle("natureNav");
$f->h("nature");
$f->select("roomReserved","grandeSalle,salleConference,autre_precisez",true);

$f->select("type","colloque,conference,seminaire,table-ronde,autre_precisez",true);
$f->radio("refreshments","oui,non",true,2);
$f->p("contact_paris_admin");

$f->checkboxes("public",array(array("professeurs","etudiants","professionnels","grand_public"),array("europeen","francais","americain","international")));

$f->select("intervenants","[0-20-1]",true);
$f->select("personnes","[1-60-10],[61-200-20]",true);
$f->buttons("previous-previous,next-next");
$f->endArticle();

$f->newArticle("salle_equipementsNav");
$f->h("salle_equipements");
$f->select("disposition","chaises,tables,cocktail,autre_precisez",true);
$f->checkboxes("equipement","micros_avec_fils[1-4-1],micros_sans_fils[1-2-1],videoprojecteur,dvd,tableau_blanc,paper_board,autre_precisez");
$f->buttons("previous-previous,next-next");
$f->endArticle();

$f->newArticle("commentaires");
$f->h("commentaires");
$f->textarea("commentaires");
$f->buttons("previous-previous,endForm-next");
$f->endArticle();

$f->newArticle();
$f->h("thanks");
$f->p("thanks1");
$f->endArticle();

$f->endSection();
$f->endForm();
$f->show();
include "footer.php";
?>
