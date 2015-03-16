<?php
ini_set('display_errors',1);
error_reporting(999);

include "config.php";
include "vendor/CJDB.php";
include "vendor/fpdf17/fpdf.php";

$fname=$_POST["fname"];
$token=$_POST["token"];

$data=array();
$date1="9000-00-00";
$date2="0000-00-00";

$db=new CJDB();
$db->select($config['dbtable'],null,"token='$token'");
if($db->result){
	foreach($db->result as $elem){
		$data[$elem['field']]=html_entity_decode($elem['value'],ENT_QUOTES|ENT_IGNORE,"ISO-8859-1");
	// Dates : to be continued
		if(substr($elem['field'],0,11)=="dates_date_"){
			if($elem["value"] and strcmp($elem["value"],$date1)<0){
				$date1=$elem["value"];
			}
			if($elem["value"] and strcmp($elem["value"],$date2)>0){
				$date2=$elem["value"];
			}
		}
	}
}

$date1=preg_replace('/([0-9]*)-([0-9]*)-([0-9]*)/','\2/\3/\1',$date1);
$date2=preg_replace('/([0-9]*)-([0-9]*)-([0-9]*)/','\2/\3/\1',$date2);

$data['dates']="$date1 -> $date2";

$p=new FPDF("P","mm","Letter");
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

$p->Line(20,35,196,35);

// Footer
$p->SetTextColor(0,38,127);
$p->SetFont("AGaramondPro","",8.4);
$p->Text(20,267,"Tel  +33 1 43 20 33 07    Fax  +33 1 43 20 52 96    paris.cgc@columbia.edu    globalcenters.columbia.edu/paris");
$p->Text(20,270,"Reid Hall   4 rue de Chevreuse   75006 Paris   France");


// Content

$x0=20;
$x1=115;
$x2=173;
$y0=40;
$x=$x0;
$y=$y0;

// Title
$str1="Non-CU Expense Authorization Form";
$p->SetTextColor(0,38,127);
$p->SetFont("TrajanPro","",13.5);
$p->Text(55,$y,$str1);
$p->Line(20,41.5,196,41.5);

$y=$y+12;

$p->SetTextColor(0,0,0);

$str1="CU Global Center:";
$str2=$data['CUGlobalCenter'];
$str3=substr($str2,0,45);
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+$p->GetStringWidth($str1)+2;
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str3);

$str1="School/Institution:";
$str2=$data['school'];
$x=($x+$p->GetStringWidth($str3)+3)>$x1?$x+$p->GetStringWidth($str3)+3:$x1;
$str3=substr($str2,0,36);
$str4=substr($str2,36,72);
$str5=substr($str2,72,108);
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x1+$p->GetStringWidth($str1)+2;
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str3);
$y=$y+5;
$p->Text($x,$y,$str4);
$y=$y+5;
$p->Text($x,$y,$str5);
$y=$y-10;

$str1="Program/Project Title:";
$str2=$data['programTitle'];
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+$p->GetStringWidth($str1)+2;
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str2);


$str1="Program/Project Description:";
$str2=$data['programDesc'];
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+$p->GetStringWidth($str1)+2;
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str2);

$str1="Cost Estimate*:";
$str2=$data['costEstimate'];
$str3=substr($str2,0,45);
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+$p->GetStringWidth($str1)+2;
$p->SetFont("AGaramondPro-Semibold","",11);
$p->Text($x,$y,$str3);


$str1="Beginning -> Ending Dates:";
$str2=$data['dates'];
$x=($x+$p->GetStringWidth($str3)+3)>$x1?$x+$p->GetStringWidth($str3)+3:$x1;
$str3=substr($str2,0,45);
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x1+$p->GetStringWidth($str1)+2;
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
$y=$y+10;
$p->SetX($x+20);
$p->SetY($y);
$p->SetFont("AGaramondPro","",10);
$p->MultiCell(0,5,$str1);




$y=$y+35;
$p->SetDrawColor(108,171,231);
$p->Line($x0,$y,$x0+123,$y);
$p->SetDrawColor(108,171,231);
$p->Line($x2-15,$y,$x2+22,$y);

$str1="Project Leader/PI";
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);

$str1="(Signature)";
$str2="Date";
$p->Text($x1,$y,$str1);
$p->Text($x2,$y,$str2);


$y=$y+27;
$p->SetDrawColor(108,171,231);
$p->Line($x0,$y,$x0+123,$y);
$p->SetDrawColor(108,171,231);
$p->Line($x2-15,$y,$x2+22,$y);

$str1="Departmental Approver/DAF Authorizer";
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);

$str1="(Signature)";
$str2="Date";
$p->Text($x1,$y,$str1);
$p->Text($x2,$y,$str2);


$y=$y+27;
$p->SetDrawColor(108,171,231);
$p->Line($x0,$y,$x0+123,$y);
$p->SetDrawColor(108,171,231);
$p->Line($x2-15,$y,$x2+22,$y);

$str1="Finance Director/Dean of School or Division";
$x=$x0;
$y=$y+8;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);

$str1="(Signature)";
$str2="Date";
$p->Text($x1,$y,$str1);
$p->Text($x2,$y,$str2);



$str1="Remit payment to:";
$x=$x0;
$y=$y+27;
$p->SetFont("AGaramondPro","",10);
$p->Text($x,$y,$str1);
$x=$x0+(strlen($str1)*1.7);


$str1="Columbia University";
$y=$y+7;
$p->SetTextColor(108,171,231);
$p->SetFont("AGaramondPro-Semibold","",12);
$p->Text($x0,$y,$str1);


$str1="ATTN: Columbia Global Centers | Europe";
$y=$y+5;
$p->Text($x0,$y,$str1);

$str1="91 Claremont Ave. Suite 529";
$y=$y+5;
$p->Text($x0,$y,$str1);

$str1="New York, NY 10027";
$y=$y+5;
$p->Text($x0,$y,$str1);


$p->Output($fname,"F");



echo json_encode("OK");
?>
