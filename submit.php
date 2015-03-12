<?php
ini_set('display_errors',1);
error_reporting(999);

require_once "config.php";
require_once "vendor/CJDB.php";

$data=$_POST["data"];
$token=$_POST["token"];

$db=new CJDBH();
$db->prepare("REPLACE INTO `{$config['dbtable']}` SET `token`=:token, `token-field`=:tokenField, `field`=:field, `value`=:value");


foreach($data as $elem){
	// Met les dates au format SQL
	if(strpos($elem["field"],"_date_")){
		// Si une date au format FR est donnée, on la converti au format SQL et on ajoute un champ date_en correspondant pour qu'il ne soit pas vide si on recharge le formulaire 
		if(substr($elem["field"],-2)=="fr"){
			// Conversion
			$dateReplace='\3-\2-\1';
			// Nouveau champ date_en
			$date2=array("field"=>substr($elem["field"],0,-2)."en");
		}
		// Même chose si date EN donnée
		if(substr($elem["field"],-2)=="en"){
			// Conversion
			$dateReplace='\3-\1-\2';
			// Nouveau champ date_fr
			$date2=array("field"=>substr($elem["field"],0,-2)."fr");
		}

		// Conversion de la date (FR ou EN) en SQL
		$elem["value"]=preg_replace('/([0-9]*)\/([0-9]*)\/([0-9]*)/', $dateReplace, $elem['value']);

		// Enregistrement du nouveau champ date_fr ou date_en
		$tmp=array(":token"=>$token,":tokenField"=>$token."-".$date2['field'],":field"=>$date2['field'],":value"=>htmlentities($elem['value'],ENT_QUOTES|ENT_IGNORE,"utf-8"));
		$db->execute($tmp);
	}

	// Enregistrement des infos dans la base de données
	$tmp=array(":token"=>$token,":tokenField"=>$token."-".$elem['field'],":field"=>$elem['field'],":value"=>htmlentities($elem['value'],ENT_QUOTES|ENT_IGNORE,"utf-8"));
	$db->execute($tmp);
}

echo json_encode("");
?>