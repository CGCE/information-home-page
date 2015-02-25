<?php

class CJForm{

	public $action=null;
  public $formNumber=0;
	public $lang=array();
	public $langCode="en";
	public $method="post";
	public $onSubmit=null;
  public $sectionNumber=0;
	
  public function CJForm(){
    $this->formNumber++;
    $form="<form name='CJForm_{$this->formNumber}' id='CJForm_{$this->formNumber}' method='{$this->method}' action='{$this->action}' ";
    if($this->onSubmit){
      $form.="onsubmit='{$this->onSubmit}' ";
    }
    $form.=">\n";
    echo $form;
  }

	public function setLanguage($lang){
//		$this->lang=$GLOBALS['lang'][$lang];
		$this->lang=$GLOBALS['lang'];
		$this->langCode=strtolower($lang);
	}

	public function inputText($id,$required=false){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
		
		echo "<tr><td><label for='$id'>$strong1{$this->lang[$id]}$star$strong2</label></td>\n";
		echo "<td><input type='text' name='$id' id='$id' class='$classRequired' /></td></tr>\n";
	}
	
	public function textarea($id,$required=false){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
		
		echo "<tr><td><label for='$id'>$strong1{$this->lang[$id]}$star$strong2</label></td>\n";
		echo "<td><textarea name='$id' id='$id' class='$classRequired'></textarea></td></tr>\n";
	}

	public function inputDates($id,$required=false,$hours=false,$multiple=false){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
		
		echo "<tr><td><label for='{$id}_date_0'>$strong1{$this->lang[$id]}$star$strong2</label></td>\n";
		echo "<td><input type='text' name='{$id}_date[]' id='{$id}_date_0' class='CJDatePicker $classRequired'/>\n";
		
		if($hours){
			echo "&nbsp;{$this->lang['heure1']}&nbsp;\n";
			echo "<select name='{$id}_hour1[]' id='{$id}_hour1_0' class='$classRequired' >\n";
			echo "<option value=''>&nbsp;</option>";
			if($this->langCode=="en"){
				for($i=8;$i<13;$i++){
					echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>\n";
				}
				for($i=13;$i<22;$i++){
					echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>\n";
				}
			}else{
				for($i=8;$i<22;$i++){
					echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>\n";
				}
			}
			echo "</select>\n";
			echo "&nbsp;{$this->lang['heure2']}&nbsp;\n";
			echo "<select name='{$id}_fin[]' id='{$id}_fin_0' class='$classRequired' >\n";
			echo "<option value=''>&nbsp;</option>\n";
			if($this->langCode=="en"){
				for($i=8;$i<13;$i++){
					echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>\n";
				}
				for($i=13;$i<22;$i++){
					echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>\n";
				}
			}else{
				for($i=8;$i<22;$i++){
					echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>\n";
				}
			}
			echo "</select>\n";
		}
		
		if($multiple){
			echo "<img src='../img/add.gif' class='CJFormAddDate' style='cursor:pointer;' alt='{$this->lang['ajouter']}' />\n";
		}
		echo "</td></tr>\n";
	}

	public function selectHours($id,$required=false,$multiple=false){
		$strong1=$required?"<strong>":null;
		$strong2=$required?"</strong>":null;
		$star=$required?"&nbsp;<sup>*</sup>":null;
		$classRequired=$required?"required":null;
		
		echo "<tr><td><label for='{$id}_hours_0'>$strong1{$this->lang[$id]}$star$strong2</label></td>\n";
		echo "<td>";
		
		echo "{$this->lang['heure1']}&nbsp;\n";
		echo "<select name='{$id}_hour1[]' id='{$id}_hour1_0' class='$classRequired' style='width:150px;'>\n";
		echo "<option value=''>&nbsp;</option>";
		if($this->langCode=="en"){
			for($i=8;$i<13;$i++){
				echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>\n";
			}
			for($i=13;$i<22;$i++){
				echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>\n";
			}
		}else{
			for($i=8;$i<22;$i++){
				echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>\n";
			}
		}
		echo "</select>\n";
		echo "&nbsp;{$this->lang['heure2']}&nbsp;\n";
		echo "<select name='{$id}_fin[]' id='{$id}_fin_0' class='$classRequired' style='width:150px;' >\n";
		echo "<option value=''>&nbsp;</option>\n";
		if($this->langCode=="en"){
			for($i=8;$i<13;$i++){
				echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00 AM</option>\n";
			}
			for($i=13;$i<22;$i++){
				echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i-12).":00 PM</option>\n";
			}
		}else{
			for($i=8;$i<22;$i++){
				echo "<option value='".sprintf("%02d",$i).":00:00'>".sprintf("%02d",$i).":00</option>\n";
			}
		}
		echo "</select>\n";
		
		if($multiple){
			echo "<img src='../img/add.gif' class='CJFormAddHours' style='cursor:pointer;' alt='{$this->lang['ajouter']}' />\n";
		}
		echo "</td></tr>\n";
	}
	
	public function br(){
		echo "<tr><td colspan='2'><br/></td></tr>\n";
	}

	public function hr(){
		echo "<tr><td colspan='2'><hr class='CJHr'/></td></tr>\n";
	}
	
	public function h($id,$level=2){
		echo "<tr><td colspan='2'><h$level class='CJH'>{$this->lang[$id]}</h$level></td></tr>\n";
	}
	
	public function p($id){
		echo "<tr><td colspan='2'><p class='CJP'>{$this->lang[$id]}</p></td></tr>\n";
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
		
		echo "<tr><td><label for='$id'>$strong1{$lang[$id]}$star$strong2</label></td>\n";
		echo "<td><select name='$id' id='$id'>\n";
		echo "<option value=''>&nbsp;</option>\n";
		foreach($options as $option){
      $option2=array_key_exists($option,$lang)?$lang[$option]:$option;
			echo "<option value='$option'>$option2</option>\n";
		}
		echo "</select></td></tr>\n";
		
		echo "<tr id='tr_other_{$id}' style='display:none;'><td><label for='other_{$id}'>$strong1{$this->lang['autre']}$star$strong2</label></td>\n";
		echo "<td><input type='text' name='other_{$id}' id='other_{$id}' class='$classRequired' /></td></tr>\n";
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
		
		echo "<tr><td colspan='$colspan'>$strong1{$lang[$id]}$star$strong2</td>\n";
		if($colspan>1){
			echo "</tr><tr><td>&nbsp;</td>\n";
		}
		echo "<td>\n";
		
		$i=0;
		foreach($options as $option){
			echo "<input type='radio' id='{$id}_$i' name='{$id}' value='$option' class='$classRequired' />\n";
			echo "<label for='{$id}_$i'>{$lang[$option]}</label>\n";
			$i++;
		}
		
		echo "</td></tr>\n";
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
			echo "<tr><td colspan='$colpsan'>$strong1{$lang[$id]}$star$strong2</td>\n";
			if($colpsan>1){
				echo "</tr><tr><td>&nbsp;</td>\n";
			}
			echo "<td>\n";
		
			$i=0;
      $class=count($options)>1?"class='CJCheckboxesDiv'":null;
			foreach($options as $options2){
        echo "<div $class>\n";
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
	
  				echo "<br/>\n";
          if($select){
            echo "<div class='CJCheckboxesDiv'>\n";
          }
          echo "<input type='checkbox' id='{$id}_$i' name='{$id}[]' value='$option' class='$classRequired' />\n";
					echo "<label for='{$id}_$i'>{$lang[$option]}$select_options</label>\n";
          if($select){
            echo "</div> <!-- class=CJCheckboxesDiv -->\n";
            echo "<div class='CJCheckboxesSelectNb'>\n";
            echo $lang['nombre'];
            echo "<select name='{$id}_{$option}_nb' id='{$id}_{$option}_nb'>\n";
            echo "<option value=''>&nbsp;</option>\n";
            foreach($select as $elem){
              echo "<option value='$elem'>$elem</option>\n";
            }
            echo "</select>\n";
            echo "</div> <!-- class=CJCheckboxesSelectnb -->\n";
          }
					$i++;
				}
				echo "</div> <!-- class=CJCheckboxesDiv -->\n";		// Remplacer par des div inline-block
			}
		}
		
		echo "</td></tr>\n";
		echo "<tr id='tr_other_{$id}' style='display:none;'><td><label for='other_{$id}'>$strong1{$this->lang['autre']}$star$strong2</label></td>\n";
		echo "<td><textarea name='other_{$id}' id='other_{$id}' class='$classRequired'></textarea></td></tr>\n";
	}


  public function newSection(){
    $this->sectionNumber++;
    echo "<table class='CJTable' id='CJTable_{$this->sectionNumber}'>\n";
  }

  public function endSection(){
    echo "</table> <!--CJTable -->\n";
  }

  public function endForm(){
    echo "</form> <!--CJForm -->\n";
  }

  public function buttons(){
    $lang=$this->lang;
    echo "<tr><td colspan='2' class='CJTdButtons'>\n";
    echo "<input type='reset' value='{$lang['reset']}' />\n";
    echo "<input type='submit' value='{$lang['valider']}' />\n";
    echo "</td></tr>\n";
  }
}

?>
