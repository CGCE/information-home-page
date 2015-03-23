<?php

class CJForm{

	public $action=null;
    public $elem=array();
    public $formBalise="";
	public $formNumber=0;
	public $idTable=array();
	public $method="post";
	public $nav=false;
	public $navTable=array();
	public $onSubmit=null;
    public $sectionNumber=0;
    public $token=null;
	
  public function CJForm(){
    $this->formNumber++;
    $this->formBalise="<form name='CJForm_{$this->formNumber}' id='CJForm_{$this->formNumber}' class='CJForm' method='post' action='submit.php' >";
  	$this->elem[]="<input type='hidden' name='lang' value='en' class='CJLang' id='CJLang'/>";
  	}

	public function action($action){
	    $this->formBalise=str_replace("action='submit.php'","action='$action'",$this->formBalise);
	}
	
	public function inputText($id,$required=false,$type=null){
		$classRequired=$required?"required":null;
		$star=$required?"<span class='required'>&nbsp;*</span>":null;

		if($type){
			$classRequired.=" CJ".ucfirst($type);
		}	
		
		$label=$id;
		
		if(in_array($id,$this->idTable)){
			$i=2;
			$tmp=$id."_".$i;
			while(in_array($tmp,$this->idTable)){
				$i++;
				$tmp=$id."_".$i;
			}
			$id=$tmp;			
		}
		$this->idTable[]=$id;
		
		$this->elem[]="<tr><td><label for='$id' class='CJLabel $classRequired' data-label='$label'>$label</label>$star</td>";
		$this->elem[]="<td><input type='text' name='$id' id='$id' class='CJField $classRequired' /></td></tr>";
	}
	
	public function textarea($id,$required=false){
		$classRequired=$required?"required":null;
		$star=$required?"<span class='required'>&nbsp;*</span>":null;
		
		$this->elem[]="<tr><td><label for='$id' class='CJLabel $classRequired' data-label='$id'>$id</label>$star</td>";
		$this->elem[]="<td><textarea name='$id' id='$id' class='CJField $classRequired'></textarea></td></tr>";
	}

	public function inputDates($id,$required=false,$hours=false,$multiple=1){
		$classRequired=$required?"required":null;
		$star=$required?"<span class='required'>&nbsp;*</span>":null;
		$CJFieldDateHours=$hours?"CJFieldDateHours":null;
		
		for($j=0;$j<$multiple;$j++){
			$classRequired=$j==0?$classRequired:null;
			$star=$j==0?$star:null;
			$display=$j==0?null:"style='display:none;'";

			$this->elem[]="<tr $display class='CJTRDate'><td><label for='{$id}_date_$j' class='CJLabel $classRequired' data-label='$id'>$id</label>$star</td><td>";
			$this->elem[]="<input type='text' name='{$id}_date_{$j}_fr' id='{$id}_date_{$j}_fr' class='CJField CJDatePicker $CJFieldDateHours $classRequired CJDateFR'/>";
			$this->elem[]="<input type='text' name='{$id}_date_{$j}_fr' id='{$id}_date_{$j}_en' class='CJField CJDatePicker $CJFieldDateHours $classRequired CJDateEN'/>";
		
			if($hours){
				$classMultiple=$multiple>1?"CJDatesMultiple":null;
				$this->elem[]="<div class='CJDatesHours $classMultiple'>";
				$this->elem[]="<label class='CJLabel' data-label='heure1'>heure1</label>";
				$this->elem[]="<select name='{$id}_beginning_$j' id='{$id}_beginning_$j' class='CJField CJSelect CJFieldHours CJFieldHour1 $classRequired' >";
				$this->elem[]="<option value=''>&nbsp;</option>";
				for($i=8;$i<22;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00' class='CJLabel' data-label='hour".sprintf("%02d",$i)."00'></option>";
					$this->elem[]="<option value='".sprintf("%02d",$i).":30:00' class='CJLabel' data-label='hour".sprintf("%02d",$i)."30'></option>";
				}
				$this->elem[]="</select>";
				$this->elem[]="<label class='CJLabel' data-label='heure2'>heure2</label>";
				$this->elem[]="<select name='{$id}_ending_$j' id='{$id}_ending_$j' class='CJField CJSelect CJFieldHours CJFieldHour2 $classRequired' >";
				$this->elem[]="<option value=''>&nbsp;</option>";
				for($i=8;$i<22;$i++){
					$this->elem[]="<option value='".sprintf("%02d",$i).":00:00' class='CJLabel' data-label='hour".sprintf("%02d",$i)."00'></option>";
					$this->elem[]="<option value='".sprintf("%02d",$i).":30:00' class='CJLabel' data-label='hour".sprintf("%02d",$i)."30'></option>";
				}
				$this->elem[]="</select>";
				$this->elem[]="</div> <!-- CJDatesHours -->";
			}
			if($j>0){
				$this->elem[]="<img src='css/img/delete.png' alt='delete' title='delete' class='CJFormDeleteDate CJLabel' data-label='delete' />";
			}
			
			
			$this->elem[]="</td></tr>";
		}
		
		if($multiple>1){
			$this->elem[]="<tr><td></td><td><img src='css/img/add.png' alt='add' title='add' class='CJFormAddDate CJLabel' data-label='add' />";
			$this->elem[]="<label class='CJFormAddDate CJLabel' data-label='addDate'>addDate</label></td></tr>";
		}

	}

	public function selectHours($id,$required=false,$multiple=false){
		$classRequired=$required?"required":null;
		$star=$required?"<span class='required'>&nbsp;*</span>":null;
		
		$this->elem[]="<tr><td><label for='{$id}_hours_0' class='CJLabel $classRequired' data-label='$id'>$id</label>$star</td>";
		$this->elem[]="<td>";
		
		$this->elem[]="<div class='CJCheckboxesDiv'>";
		$this->elem[]="<label class='CJLabel' data-label='heure1'>heure1</label>";
		$this->elem[]="<select name='{$id}_hour1[]' id='{$id}_hour1_0' class='CJField CJSelect CJFieldHours $classRequired'>";
		$this->elem[]="<option value=''>&nbsp;</option>";
		for($i=8;$i<22;$i++){
			$this->elem[]="<option value='".sprintf("%02d",$i).":00:00' class='CJLabel' data-label='hour".sprintf("%02d",$i)."'></option>";
		}
		$this->elem[]="</select></div>";
		
		$this->elem[]="<div class='CJCheckboxesDiv'>";
		$this->elem[]="<label class='CJLabel' data-label='heure2'>heure2</label>";
		$this->elem[]="<select name='{$id}_fin[]' id='{$id}_fin_0' class='CJField CJSelect CJFieldHours $classRequired' >";
		$this->elem[]="<option value=''>&nbsp;</option>";
		for($i=8;$i<22;$i++){
			$this->elem[]="<option value='".sprintf("%02d",$i).":00:00' class='CJLabel' data-label='hour".sprintf("%02d",$i)."'></option>";
		}
		$this->elem[]="</select></div>";
		
		if($multiple){
			$this->elem[]="<img src='../img/add.gif' class='CJFormAddHours' style='cursor:pointer;' alt='ajouter' class='CJLabel' data-label='ajouter' />";
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
		$this->elem[]="<tr><td colspan='2'><h$level class='CJH CJLabel' data-label='$id'>{$id}</h$level></td></tr>";
	}
	
	public function p($id){
		$this->elem[]="<tr><td colspan='2'><p class='CJP CJLabel' data-label='$id'>{$id}</p></td></tr>";
	}
	
	public function select($id,$options,$required=false){
		$classRequired=$required?"required":null;
		$star=$required?"<span class='required'>&nbsp;*</span>":null;

    // if options like [0-20-1] : table between 0 and 20, increment = 1
    // if options like [0-60-10],[60-200-20] : table between 0 and 60 increment = 10 then between 60 and 200 increment 20
    if(substr($options,0,1)=="["){
    	$tab=explode(",",$options);
    	$options=array();
		foreach($tab as $elem){
      		$elem=str_replace(array("[","]"),null,$elem);
    		$tmp=explode("-",$elem);
     		for($i=$tmp[0];$i<=$tmp[1];$i=$i+$tmp[2]){
      			$option=$tmp[2]==1?$i:$i."-".($i+$tmp[2]-1);
       			$options[]=$option;
     		}
     	}
    }

    // if options is a string 
		if(!is_array($options)){
			$options=explode(",",$options);
		}
		
		$this->elem[]="<tr><td><label for='$id' class='CJLabel $classRequired' data-label='$id'>$id</label>$star</td>";
		$this->elem[]="<td><select name='$id' id='$id' class='CJField CJSelect $classRequired'>";
		$this->elem[]="<option value=''>&nbsp;</option>";
		foreach($options as $option){
			$this->elem[]="<option value='$option' class='CJLabel' data-label='$option' >$option</option>";
		}
		$this->elem[]="</select></td></tr>";
		
		$this->elem[]="<tr id='tr_other_{$id}' style='display:none;'><td>";
		$this->elem[]="<label for='other_{$id}' class='CJLabel $classRequired' data-label='autre'>autre</label>$star</td>";
		$this->elem[]="<td><input type='text' name='other_{$id}' id='other_{$id}' class='CJField CJOther $classRequired' /></td></tr>";
	}
	
	public function radio($id,$options,$required=false,$colspan=1){
		$classRequired=$required?"required":null;
		$star=$required?"<span class='required'>&nbsp;*</span>":null;

		if(!is_array($options)){
			$options=explode(",",$options);
		}
		
		$this->elem[]="<tr><td colspan='$colspan'><label for='$id' class='CJLabel $classRequired' data-label='$id'>$id</label>$star</td>";
		if($colspan>1){
			$this->elem[]="</tr><tr><td>&nbsp;</td>";
		}
		$this->elem[]="<td>";
		
		$i=0;
		foreach($options as $option){
			$this->elem[]="<input type='radio' id='{$id}_$i' name='{$id}' value='$option' class='CJField $classRequired' />";
			$this->elem[]="<label for='{$id}_$i' class='CJLabel' data-label='$option'>{$option}</label>";
			$i++;
		}
		
		$this->elem[]="</td></tr>";
	}
	
	public function checkboxes($id,$options,$required=false,$colpsan=1){
		$classRequired=$required?"required":null;
		$star=$required?"<span class='required'>&nbsp;*</span>":null;

		if(!is_array($options)){
			$options=explode(",",$options);
		}

		if(!is_array($options[0])){
      $options=array($options);
    }
    
		
		if(is_array($options[0])){
			$this->elem[]="<tr><td colspan='$colpsan'><label class='CJLabel $classRequired' data-label='$id'>$id</label>$star</td>";
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
					$this->elem[]="<label for='{$id}_$i' class='CJLabel' data-label='{$option}$select_options'>{$option}$select_options</label>";
          if($select){
            $this->elem[]="</div> <!-- class=CJCheckboxesDiv -->";
            $this->elem[]="<div class='CJCheckboxesSelectNb'>";
            $this->elem[]="<label class='CJLabel' data-label='nombre'>nombre</label>";
            $this->elem[]="<select name='{$id}_{$option}_nb' id='{$id}_{$i}_nb' data-id='{$id}_$i' class='CJField CJSelect CJCheckboxesSelect'>";
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
		$this->elem[]="<tr id='tr_other_{$id}' style='display:none;'><td><label for='other_{$id}' class='CJLabel $classRequired' data-label='autre'>autre</label>$star</td>";
		$this->elem[]="<td><textarea name='other_{$id}' id='other_{$id}' class='CJField CJOther $classRequired'></textarea></td></tr>";
	}


  public function newArticle($id=null){
    $this->sectionNumber++;
    
  	if($id){
    	$this->navTable[]=array("id"=>$this->sectionNumber,"text"=>$id);
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
		$this->elem[]="<input type='button' id='{$id}_{$this->sectionNumber}' value='{$id}' class='CJLabel CJButton $class' data-sectionId='{$this->sectionNumber}' data-label='$id'/>";
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
 	   		echo "<span class='CJNavText CJLabel' id='CJNavText_{$elem['id']}' data-label='{$elem['text']}'>{$elem['text']}</span></li>\n";
	    }
	    echo "</ul></nav>\n";
	}

	// Balise "form"
	echo "{$this->formBalise}\n";
	
	// Si Token : Javascript chargera les données dans le formulaire à partir de la BDD
	if(!$this->token){
		$this->token=date("Ymd-His-").rand(100,999);
		echo "<input type='hidden' id='CJTokenNotGiven' />\n";
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