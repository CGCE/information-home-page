<?php

class CJForm{

	public $action=null;
    public $elem=array();
    public $formBalise="";
	public $formNumber=0;
	public $lang=array();
	public $langCode="en";
	public $method="post";
	public $nav=false;
	public $navTable=array();
	public $onSubmit=null;
    public $sectionNumber=0;
    public $token=null;
	
  public function CJForm(){
    $this->formNumber++;
    $this->formBalise="<form name='CJForm_{$this->formNumber}' id='CJForm_{$this->formNumber}' class='CJForm' method='post' action='submit.php' >";
  }

	public function action($action){
	    $this->formBalise=str_replace("action='submit.php'","action='$action'",$this->formBalise);
	}
	
	public function setLanguage($lang){
		$this->lang=$GLOBALS['lang'];
		$this->langCode=strtolower($lang);
  		$this->elem[]="<input type='hidden' name='lang' value='$lang' class='CJLang'/>";
	}

	public function inputText($id,$required=false,$type=null){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
		
		if($type=="date"){
			$type.=strtoupper($this->langCode);
		}
		
		if($type){
			$classRequired.=" CJ".ucfirst($type);
		}	
		
		$this->elem[]="<tr><td><label for='$id'>$strong1{$this->lang[$id]}$star$strong2</label></td>";
		$this->elem[]="<td><input type='text' name='$id' id='$id' class='CJField $classRequired' /></td></tr>";
	}
	
	public function textarea($id,$required=false){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
		
		$this->elem[]="<tr><td><label for='$id'>$strong1{$this->lang[$id]}$star$strong2</label></td>";
		$this->elem[]="<td><textarea name='$id' id='$id' class='CJField $classRequired'></textarea></td></tr>";
	}

	public function inputDates($id,$required=false,$hours=false,$multiple=false){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
				
		$type="CJDate".strtoupper($this->langCode);
		
		$this->elem[]="<tr><td><label for='{$id}_date_0'>$strong1{$this->lang[$id]}$star$strong2</label></td>";
		$this->elem[]="<td><input type='text' name='{$id}_date[]' id='{$id}_date_0' class='CJField CJDatePicker $classRequired $type'/>";
		
		if($hours){
			$this->elem[]="{$this->lang['heure1']}&nbsp;";
			$this->elem[]="<select name='{$id}_hour1[]' id='{$id}_hour1_0' class='CJField $classRequired' >";
			$this->elem[]="<option value=''>&nbsp;</option>";
			if($this->langCode=="en"){
				for($i=8;$i<13;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>";
				}
				for($i=13;$i<22;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>";
				}
			}else{
				for($i=8;$i<22;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>";
				}
			}
			$this->elem[]="</select>";
			$this->elem[]="&nbsp;{$this->lang['heure2']}&nbsp;";
			$this->elem[]="<select name='{$id}_fin[]' id='{$id}_fin_0' class='CJField $classRequired' >";
			$this->elem[]="<option value=''>&nbsp;</option>";
			if($this->langCode=="en"){
				for($i=8;$i<13;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>";
				}
				for($i=13;$i<22;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>";
				}
			}else{
				for($i=8;$i<22;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>";
				}
			}
			$this->elem[]="</select>";
		}
		
		if($multiple){
			$this->elem[]="<img src='../img/add.gif' class='CJFormAddDate' style='cursor:pointer;' alt='{$this->lang['ajouter']}' />";
		}
		$this->elem[]="</td></tr>";
	}

	public function selectHours($id,$required=false,$multiple=false){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
		
		$this->elem[]="<tr><td><label for='{$id}_hours_0'>$strong1{$this->lang[$id]}$star$strong2</label></td>";
		$this->elem[]="<td>";
		
		$this->elem[]="<div class='CJCheckboxesDiv'>";
		$this->elem[]="{$this->lang['heure1']}&nbsp;";
		$this->elem[]="<select name='{$id}_hour1[]' id='{$id}_hour1_0' class='CJField CJFieldHours $classRequired' style='width:150px;'>";
		$this->elem[]="<option value=''>&nbsp;</option>";
		if($this->langCode=="en"){
			for($i=8;$i<13;$i++){
				$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>";
			}
			for($i=13;$i<22;$i++){
				$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>";
			}
		}else{
			for($i=8;$i<22;$i++){
				$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>";
			}
		}
		$this->elem[]="</select></div>";
		
		$this->elem[]="<div class='CJCheckboxesDiv'>";
		$this->elem[]="{$this->lang['heure2']}&nbsp;";
		$this->elem[]="<select name='{$id}_fin[]' id='{$id}_fin_0' class='CJField CJFieldHours $classRequired' style='width:150px;' >";
		$this->elem[]="<option value=''>&nbsp;</option>";
		if($this->langCode=="en"){
			for($i=8;$i<13;$i++){
				$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>";
			}
			for($i=13;$i<22;$i++){
				$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>";
			}
		}else{
			for($i=8;$i<22;$i++){
				$this->elem[]="<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>";
			}
		}
		$this->elem[]="</select></div>";
		
		if($multiple){
			$this->elem[]="<img src='../img/add.gif' class='CJFormAddHours' style='cursor:pointer;' alt='{$this->lang['ajouter']}' />";
		}
		$this->elem[]="</td></tr>";
	}
	
	public function br(){
		$this->elem[]="<tr><td colspan='2'><br/></td></tr>";
	}

	public function hr(){
		$this->elem[]="<tr><td colspan='2'><hr class='CJHr'/></td></tr>";
	}
	
	public function h($id,$level=2){
		$this->elem[]="<tr><td colspan='2'><h$level class='CJH'>{$this->lang[$id]}</h$level></td></tr>";
	}
	
	public function p($id){
		$this->elem[]="<tr><td colspan='2'><p class='CJP'>{$this->lang[$id]}</p></td></tr>";
	}
	
	public function select($id,$options,$required=false){
		$lang=$this->lang;
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;

    // if options like [0-20-1] : table between 0 and 20, increment = 1
    if(substr($options,0,1)=="["){
      $options=str_replace(array("[","]"),null,$options);
      $tmp=explode("-",$options);
      $options=array();
      for($i=$tmp[0];$i<=$tmp[1];$i=$i+$tmp[2]){
        $option=$tmp[2]==1?$i:$i."-".($i+$tmp[2]-1);
        $options[]=$option;
      }      
    }

    // if options is a string 
		if(!is_array($options)){
			$options=explode(",",$options);
		}
		
		$this->elem[]="<tr><td><label for='$id'>$strong1{$lang[$id]}$star$strong2</label></td>";
		$this->elem[]="<td><select name='$id' id='$id' class='CJField $classRequired'>";
		$this->elem[]="<option value=''>&nbsp;</option>";
		foreach($options as $option){
      $option2=array_key_exists($option,$lang)?$lang[$option]:$option;
			$this->elem[]="<option value='$option'>$option2</option>";
		}
		$this->elem[]="</select></td></tr>";
		
		$this->elem[]="<tr id='tr_other_{$id}' style='display:none;'><td><label for='other_{$id}'>$strong1{$this->lang['autre']}$star$strong2</label></td>";
		$this->elem[]="<td><input type='text' name='other_{$id}' id='other_{$id}' class='CJField CJOther $classRequired' /></td></tr>";
	}
	
	public function radio($id,$options,$required=false,$colspan=1){
		$lang=$this->lang;
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;

		if(!is_array($options)){
			$options=explode(",",$options);
		}
		
		$this->elem[]="<tr><td colspan='$colspan'>$strong1{$lang[$id]}$star$strong2</td>";
		if($colspan>1){
			$this->elem[]="</tr><tr><td>&nbsp;</td>";
		}
		$this->elem[]="<td>";
		
		$i=0;
		foreach($options as $option){
			$this->elem[]="<input type='radio' id='{$id}_$i' name='{$id}' value='$option' class='CJField $classRequired' />";
			$this->elem[]="<label for='{$id}_$i'>{$lang[$option]}</label>";
			$i++;
		}
		
		$this->elem[]="</td></tr>";
	}
	
	public function checkboxes($id,$options,$required=false,$colpsan=1){
		$lang=$this->lang;
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;

		if(!is_array($options)){
			$options=explode(",",$options);
		}

		if(!is_array($options[0])){
      $options=array($options);
    }
    
		
		if(is_array($options[0])){
			$this->elem[]="<tr><td colspan='$colpsan'>$strong1{$lang[$id]}$star$strong2</td>";
			if($colpsan>1){
				$this->elem[]="</tr><tr><td>&nbsp;</td>";
			}
			$this->elem[]="<td>";
		
			$i=0;
      $class=count($options)>1?"class='CJCheckboxesDiv'":null;
			foreach($options as $options2){
        $this->elem[]="<div $class>";
				foreach($options2 as $option){
          $select=null;
          if($pos=strpos($option,"[")){
            $select=substr($option,$pos);
            $option=substr($option,0,$pos);

            $tmp=str_replace(array("[","]"),null,$select);
            $tmp=explode("-",$tmp);
            $select=array();
            for($j=$tmp[0];$j<=$tmp[1];$j=$j+$tmp[2]){
              $value=$tmp[2]==1?$j:$j."-".($j+$tmp[2]-1);
              $select[]=$value;
            }
          }
	
  				$this->elem[]="<br/>";
          if($select){
            $this->elem[]="<div class='CJCheckboxesDiv'>";
          }
          $this->elem[]="<input type='checkbox' id='{$id}_$i' name='{$id}[]' value='$option' class='CJField CJCheckbox $classRequired' />";
					$this->elem[]="<label for='{$id}_$i'>{$lang[$option]}$select_options</label>";
          if($select){
            $this->elem[]="</div> <!-- class=CJCheckboxesDiv -->";
            $this->elem[]="<div class='CJCheckboxesSelectNb'>";
            $this->elem[]=$lang['nombre'];
            $this->elem[]="<select name='{$id}_{$option}_nb' id='{$id}_{$i}_nb' data-id='{$id}_$i' class='CJField CJCheckboxesSelect'>";
            $this->elem[]="<option value=''>&nbsp;</option>";
            foreach($select as $elem){
              $this->elem[]="<option value='$elem'>$elem</option>";
            }
            $this->elem[]="</select>";
            $this->elem[]="</div> <!-- class=CJCheckboxesSelectnb -->";
          }
					$i++;
				}
				$this->elem[]="</div> <!-- class=CJCheckboxesDiv -->";		// Remplacer par des div inline-block
			}
		}
		
		$this->elem[]="</td></tr>";
		$this->elem[]="<tr id='tr_other_{$id}' style='display:none;'><td><label for='other_{$id}'>$strong1{$this->lang['autre']}$star$strong2</label></td>";
		$this->elem[]="<td><textarea name='other_{$id}' id='other_{$id}' class='CJField CJOther $classRequired'></textarea></td></tr>";
	}


  public function newArticle($id=null){
    $this->sectionNumber++;
    
  	if($id){
    	$this->navTable[]=array("id"=>$this->sectionNumber,"text"=>$this->lang[$id]);
    }

    $display=$this->sectionNumber==1?null:"style='display: none;'";
    $this->elem[]="<article id='CJArticle_{$this->sectionNumber}' class='CJArticle' data-id='{$this->sectionNumber}' $display>";
    $this->elem[]="<table class='CJTable' id='CJTable_{$this->sectionNumber}'>";
  }

  public function endArticle(){
    $this->elem[]="</table> <!--CJTable -->";
    $this->elem[]="</article> <!--CJArticle -->";
  }

  public function endForm(){
    $this->elem[]="</form> <!--CJForm -->";
  }

	// buttons($ids) : 
	// $ids (string) = id1-function1,id2-function2 ... 
	// or $ids (array) = array("id1-function1","id2-function2")

  public function buttons($ids){
    $lang=$this->lang;
    
    if(!is_array($ids)){
    	$ids=explode(",",$ids);
    }
    $this->elem[]="<tr><td colspan='2' class='CJTdButtons'>";
	foreach($ids as $id){
		$id=trim($id);
		$tmp=explode("-",$id);
		$id=$tmp[0];
		$function=$tmp[1];
		switch($function){
			case "next" : $class="CJButtonNext"; break;
			case "previous" : $class="CJButtonPrevious"; break;
			case "submit" : $class="CJButtonSubmit"; break;
		}
		$this->elem[]="<input type='button' id='{$id}_{$this->sectionNumber}' value='{$lang[$id]}' class='CJButton $class' data-sectionId='{$this->sectionNumber}' />";
	}
    $this->elem[]="</td></tr>";
  }
  
  public function show(){
  	// Navigation
  	if($this->nav){
 	   echo "<nav class='CJTdNavLinks'><ul>\n";
 	   foreach($this->navTable as $elem){
 	   		echo "<li id='CJNavLi_{$elem['id']}' class='CJNavLi' data-id='{$elem['id']}' >\n";
 	   		echo "<span class='CJNavIcon' id='CJNavIcon_{$elem['id']}'>{$elem['id']}</span>\n";
 	   		echo "<span class='CJNavText' id='CJNavText_{$elem['id']}'>{$elem['text']}</span></li>\n";
	    }
	    echo "</ul></nav>\n";
	}

	// Balise "form"
	echo "{$this->formBalise}\n";
	
	// Si Token : Javascript chargera les données dans le formulaire à partir de la BDD
	if(!$this->token){
		$this->token=date("Ymd-His-").rand(100,999);
	}
	echo "<input type='hidden' name='token' id='CJToken' class='CJToken' value='{$this->token}' />\n";


	// Reste du formulaire
  	foreach($this->elem as $elem){
  		echo $elem;
  		echo "\n";
  	}
  }
  
  public function newSection(){
  	$this->elem[]="<section class='CJSection'>";
  }

  public function endSection(){
  	$this->elem[]="</section>";
  }

}

?>
