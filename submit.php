<?php
ini_set('display_errors',1);
error_reporting(999);

require_once "config.php";
require_once "vendor/CJDB.php";

$data=$_POST["data"];
$token=$_POST["token"];

$db=new CJDBH();
$db->prepare("REPLACE INTO `form` SET `token`=:token, `token-field`=:tokenField, `field`=:field, `value`=:value");


foreach($data as $elem){
	$tmp=array(":token"=>$token,":tokenField"=>$token."-".$elem['field'],":field"=>$elem['field'],":value"=>htmlentities($elem['value'],ENT_QUOTES|ENT_IGNORE,"utf-8"));
	$db->execute($tmp);
}

echo json_encode("");

?>