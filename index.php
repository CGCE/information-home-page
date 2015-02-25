<?php
include "header.php";

echo "<section>\n";

$f=new CJForm();
$f->setLanguage($_SESSION['lang']);

$f->newSection();

$f->hr();

$f->p("intro1");
$f->hr();

$f->h("project");
$f->inputText("CUGlobalCenter",true);
$f->inputText("school",true);
$f->inputText("programTitle",true);
$f->inputText("programProject",true);
$f->inputText("costEstimate",true);
$f->inputDates("beginningDate",true);
$f->inputDates("endingDate",true);

$f->hr();
$f->h("organizer");
$f->inputText("organizer",true);
$f->inputText("firstname",true);
$f->inputText("lastname",true);
$f->inputText("courriel",true);

$f->hr();
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

$f->hr();
$f->h("salle_equipements");
$f->select("disposition","chaises,tables,cocktail",true);
$f->checkboxes("equipement","micros_avec_fils[1-6-1],micros_sans_fils[1-2-1],videoprojecteur,dvd,tableau_blanc,paper_board,autre_precisez");

$f->hr();
$f->h("commentaires");
$f->textarea("commentaires");

$f->buttons();

$f->endSection();
$f->endForm();
?>
<!-- 
<br/>
<?php echo "* {$lang['obligatoire']}\n"; ?>
<br/>
<br/>
<?php echo "<input type='submit' value='{$lang['valider']}' name='valider' />\n"; ?>
-->
</section>
</body>
</html>	
