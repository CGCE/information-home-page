<?php
ini_set('display_errors',1);
error_reporting(999);

include "vendor/fpdf17/fpdf.php";

$fname=$_POST["fname"];

$p=new FPDF("P","mm","A4");
$p->AddPage();
$p->SetMargins(20,20);

$p->AddFont("TrajanPro","","TrajanPro-Regular.php");
$p->AddFont("AGaramondPro","","AGaramondPro-Regular.php");
$p->AddFont("AGaramondPro-Semibold","","AGaramondPro-Semibold.php");
$p->AddFont("AGaramondPro-Italic","","AGaramondPro-Italic.php");

// Header Logo
$p->SetFont("TrajanPro","",13.5);
$p->SetTextColor(0,38,127);
$p->Text(20,20,"Columbia Global Centers");

$p->SetTextColor(108,171,231);
$p->Text(94,20,"Europe");

$p->SetDrawColor(108,171,231);
$p->Line(91.7,16,91.7,23.4);

$p->SetFont("TrajanPro","",7.5);
$p->Text(94.3,23.1,"Paris");

//$p->SetDrawColor(0,38,127);
$p->Line(20,32,190,32);

// Footer
$p->SetTextColor(0,38,127);
$p->SetFont("AGaramondPro","",8.4);
$p->Text(20,284,"Tel  +33 1 43 20 33 07    Fax  +33 1 43 20 52 96    paris.cgc@columbia.edu    globalcenters.columbia.edu/paris");
$p->Text(20,287,"Reid Hall   4 rue de Chevreuse   75006 Paris   France");


// Content

$x0=20;
$x1=110;
$y0=50;
$x=$x0;
$y=$y0;

$p->SetTextColor(0,0,0);

$str1="CU Global Center:";
$str2="test test test test test etest test testtes tetest testet testtes tetst";
$str3=substr($str2,0,45);
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+$p->GetStringWidth($str1)+3;
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str3);

$str1="School/Institution:";
$str2="";
$x=($x+$p->GetStringWidth($str3)+3)>$x1?$x+$p->GetStringWidth($str3)+3:$x1;
$str3=substr($str2,0,45);
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str3);

$str1="Program/Project Title:";
$str2="";
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str2);


$str1="Program/Project Description:";
$str2="";
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str2);

$str1="Cost Estimate*:";
$str2="";
$str3=substr($str2,0,45);
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str3);


$str1="Beginning / Ending Dates:";
$str2="";
$x=($x+$p->GetStringWidth($str3)+3)>$x1?$x+$p->GetStringWidth($str3)+3:$x1;
$str3=substr($str2,0,45);
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str3);


$str1="*Attach Project/Program Budget";
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro-Italic","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);


$str1="We, the undersigned representatives of the School/Institution noted above, acknowledge our School/Institution's responsibility "
  ."for the expense(s) incurred through Columbia's Global Center, listed above.  We authorize the Center to incur these expenses "
  ."on their bank account, and then to invoice us for the expenses and any agreed upon administrative fees.  Please attach a copy "
  ."of the associated project/program budget to this form.";
$x=$x0;
$y=$y+12;
$p->SetX($x+20);
$p->SetY($y);
$p->SetFont("AGaramondPro","",10);
$p->MultiCell(0,5,$str1);


$p->Output($fname,"F");



echo json_encode("OK");
?>
