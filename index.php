<?php
include "header.php";

$token=isset($_GET['token'])?$_GET['token']:null;

$f=new CJForm();
$f->setLanguage($_SESSION['lang']);
$f->token=$token;
$f->nav=true;
$f->newSection();

$f->newArticle("intro");
$f->h("intro");
$f->p("intro1");
$f->buttons("startForm-next");
$f->endArticle();

$f->newArticle("project-nav");
$f->h("project");
$f->inputText("CUGlobalCenter",true);
$f->inputText("school",true);
$f->inputText("programTitle",true);
$f->inputText("programProject",true);
$f->inputText("costEstimate",true);
$f->inputDates("beginningDate",true);
$f->inputDates("endingDate",true);
$f->buttons("previous-previous,next-next");
$f->endArticle();

$f->newArticle("organizer-nav");
$f->h("organizer");
$f->inputText("organizer",true);
$f->inputText("firstname",true);
$f->inputText("lastname",true);
$f->inputText("courriel",true,"mail");
$f->buttons("previous-previous,next-next");
$f->endArticle();

$f->newArticle("nature-nav");
$f->h("nature");
$f->select("roomReserved","grandeSalle,salleConference,autre_precisez",true);

$f->select("type","colloque,conference,seminaire,table-ronde,autre_precisez",true);
$f->radio("refreshments","oui,non",true,2);
$f->p("contact_paris_admin");
$f->br();

$f->selectHours("timesRequested",true);

$f->checkboxes("public",array(array("professeurs","etudiants","professionnels","grand_public"),array("europeen","francais","americain","international")));

$f->select("intervenants","[0-20-1]",true);
$f->select("personnes","[1-120-10]",true);
$f->buttons("previous-previous,next-next");
$f->endArticle();

$f->newArticle("salle_equipements-nav");
$f->h("salle_equipements");
$f->select("disposition","chaises,tables,cocktail",true);
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