<?php
ini_set('display_errors',1);
error_reporting(999);

require_once "config.php";
require_once "vendor/CJDB.php";

$token=$_POST["token"];
$lang=$_POST["lang"];


$result=array();
$db=new CJDB();
$db->select($config['dbtable'],null,"token='$token'");
if($db->result){
	foreach($db->result as $elem){
		$result[$elem['field']]=$elem['value'];
	}
}

$dateReplace=$lang=="fr"?'\3/\2/\1':'\2/\3/\1';

$keys=array_keys($result);
foreach($keys as $key){
	if(strpos($key,"_date_")){
		$result[$key]=preg_replace('/([0-9]*)-([0-9]*)-([0-9]*)/', $dateReplace, $result[$key]);
	}
}

echo json_encode($result);

?>