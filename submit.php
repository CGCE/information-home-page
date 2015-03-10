<?php
ini_set('display_errors',1);
error_reporting(999);

require_once "config.php";
require_once "vendor/CJDB.php";

$data=$_POST["data"];
$token=$_POST["token"];
$lang=$data["lang"];
$dateReplace=$lang=="fr"?'\3-\2-\1':'\3-\1-\2';


$db=new CJDBH();
$db->prepare("REPLACE INTO `{$config['dbtable']}` SET `token`=:token, `token-field`=:tokenField, `field`=:field, `value`=:value");


foreach($data as $elem){
	// Met les dates au format SQL
	if(strpos($elem["field"],"_date_")){
		$elem["value"]=preg_replace('/([0-9]*)\/([0-9]*)\/([0-9]*)/', $dateReplace, $elem['value']);
	}

	$tmp=array(":token"=>$token,":tokenField"=>$token."-".$elem['field'],":field"=>$elem['field'],":value"=>htmlentities($elem['value'],ENT_QUOTES|ENT_IGNORE,"utf-8"));
	$db->execute($tmp);
}

echo json_encode("");

?>