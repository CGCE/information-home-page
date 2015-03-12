<?php
ini_set('display_errors',1);
error_reporting(999);

require_once "config.php";
require_once "vendor/CJDB.php";

$token=$_POST["token"];


$result=array();
$db=new CJDB();
$db->select($config['dbtable'],null,"token='$token'");
if($db->result){
	foreach($db->result as $elem){
		$result[$elem['field']]=html_entity_decode($elem['value'],ENT_QUOTES|ENT_IGNORE,"utf-8");
	}
}

$keys=array_keys($result);
foreach($keys as $key){
	// Met les dates aux formats EN et FR
	if(strpos($key,"_date_")){
		if(substr($key,-2)=="fr"){
			$dateReplace='\3/\2/\1';
		}
		if(substr($key,-2)=="en"){
			$dateReplace='\2/\3/\1';
		}

		$result[$key]=preg_replace('/([0-9]*)-([0-9]*)-([0-9]*)/', $dateReplace, $result[$key]);
	}

}

echo json_encode($result);

?>