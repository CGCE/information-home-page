$(function(){
	// Boutons JQuery-UI
	$(".CJButton").button();
	
	// Clic sur Previous
	$(".CJButtonPrevious").click(function(){
		var sectionId=$(this).attr("data-sectionId");
		var PreviousSectionId=parseInt(sectionId)-1;
		
		if(CJSubmitForm()){
			// Navigation
			$(".CJNavLi").removeClass("current");
			$("#CJNavLi_"+sectionId).addClass("done");
			$("#CJNavLi_"+PreviousSectionId).addClass("current");

			// Article
			$("#CJArticle_"+sectionId).hide("slide",{direction:"right"},500,function(){
				$("#CJArticle_"+PreviousSectionId).show("slide",{direction:"left"},500);
			});
		}
	});
	
	// Clic sur Next
	$(".CJButtonNext").click(function(){
		var sectionId=$(this).attr("data-sectionId");
		var nextSectionId=parseInt(sectionId)+1;
	

		if(CJSubmitForm()){

			// Navigation
			$(".CJNavLi").removeClass("current");
			$("#CJNavLi_"+sectionId).addClass("done");
			$("#CJNavLi_"+nextSectionId).addClass("current");
		
			// Article
			$("#CJArticle_"+sectionId).hide("slide",{direction:"left"},500,function(){
				$("#CJArticle_"+nextSectionId).show("slide",{direction:"right"},500);
			});
		}
	});
	
	
	// Suppression des classes .CJField lors des cliques dans les champs
	$(".CJField").click(function(){
		$(this).closest("td").removeClass("CJFieldError");
		$(this).closest("td").removeClass("CJFieldOK");
	});
	
	
	// Clic sur un item du menu de navigation
	$(".CJNavLi").click(function(){
		if($(this).hasClass("done") && !$(this).hasClass("current")){
			var current = $(".CJNavLi.current").attr("data-id");
			var newId=$(this).attr("data-id");
		
			if(CJSubmitForm()){
	
				// Navigation
				$("#CJNavLi_"+current).removeClass("current");	
				$("#CJNavLi_"+current).addClass("done");
				$("#CJNavLi_"+newId).addClass("current");
		
				var direction1=current>newId?"right":"left";
				var direction2=current<newId?"right":"left";

				// Article
				$(".CJArticle:visible").hide("slide",{direction:direction1},500,function(){
					$("#CJArticle_"+newId).show("slide",{direction:direction2},500);
				});
			}
		}
	});

	// Modification d'un select attaché à une checkbox
	$(".CJCheckboxesSelect").change(function(){
		var id=$(this).attr("data-id");
		if($(this).val()){
			$("#"+id).prop("checked",true);
		} else {
			$("#"+id).prop("checked",false);
		}
	});
	
	
	// Modification d'une checkbox ayant un select attaché
	$(".CJCheckbox").change(function(){
		var id=$(this).attr("id");
		
		if($(this).prop("checked")){
			$("#"+id+"_nb").val(1);
		} else {
			$("#"+id+"_nb").val(0);
		}
	});
	
	
	// Choix de plusieurs date (A CONTINUER) 
	// Ajout de dates
	$(".CJFormAddDate").click(function(){
		$(".CJTRDate:hidden:first").show();
	});
	// Suppression de dates
	$(".CJFormDeleteDate").click(function(){
		$(this).closest(".CJTRDate").find(".CJField").val(null);
		$(this).closest(".CJTRDate").hide();
	});
	
	// Select avec option "other"
	$(".CJSelect").change(function(){
		var id=$(this).attr("id");
		if($("#tr_other_"+id).length>0){
			if($(this).val()=="autre_precisez"){
				$(this).attr("name","disabled_"+id);
				$("#other_"+id).attr("name",id);
				$("#tr_other_"+id).show();
			}else{
				$(this).attr("name",id);
				$("#other_"+id).attr("name","other_"+id);
				$("#tr_other_"+id).hide();
			}			
		}
	});

	// Checkbox avec option "other"
	$(".CJCheckbox").click(function(){
		var id=$(this).attr("id");
	    if(index=id.indexOf("_")){
    	  id=id.substr(0,index);
   		}
		var val=$(this).val();

    	if($("#tr_other_"+id).length>0 && val=="autre_precisez"){
			if($(this).prop("checked")){
				$("#tr_other_"+id).show();
			}else{
				$("#tr_other_"+id).hide();
			}			
		}
	});

	// Changement de la langue lors du click sur les drapeaux
	$(".CJFlag").click(function(){
	 	$("#CJLang").val($(this).attr("data-lang")); 

		// Affichage des labels dans la langue choisie
		switch($(this).attr("data-lang")){
			case "en" : var CJLang=CJLangEN; $(".CJDateFR").hide(); $(".CJDateEN").show(); break;
			case "fr" : var CJLang=CJLangFR;  $(".CJDateEN").hide(); $(".CJDateFR").show(); break;
			default : var CJLang=CJLangEN;  $(".CJDateFR").hide(); $(".CJDateEN").show(); break;
		}


		$(".CJLabel").each(function(){
			var text=CJLang[$(this).attr("data-label")];
		
			if($(this).is("input")){
				$(this).val(text);
			} else if($(this).is("img")){
				$(this).attr("alt",text);
				$(this).attr("title",text);
			} else if($(this).is("title")){
				$(this).text(text.substring(0,text.indexOf("<")));
			} else {
				$(this).html(text);
			}
		});

		$(".CJFlag:hidden").show();
		$(this).hide();

	});


	$(".CJDateFR").change(function(){
		var val=$(this).val();
		val=val.replace(/([0-9]*)\/([0-9]*)\/([0-9]*)/,"$2/$1/$3");
		$(this).closest("td").find(".CJDateEN").val(val)
	});
	
	$(".CJDateEN").change(function(){
		var val=$(this).val();
		val=val.replace(/([0-9]*)\/([0-9]*)\/([0-9]*)/,"$2/$1/$3");
		$(this).closest("td").find(".CJDateFR").val(val)
	});
	
	
});


$(document).ready(function(){
	// Position verticale des sections
	if($(".CJTdNavLinks").length>0){
		var top=$(".CJTdNavLinks").position().top+$(".CJTdNavLinks").height();
	} else {
		var top=$("header").height();
	}
	$(".CJSection").css("top",top);
	

	// Position verticale du footer
	var top=0;
	var maxTop=0;
	// Hauteur du plus grand article
	$(".CJArticle").each(function(){
		var top=$(this).height();
		maxTop=top>maxTop?top:maxTop; 
	});
	
	// + position haute des articles
	maxTop+=$(".CJSection").position().top;

	// + marge de 60px pour les inputs other cachés
	maxTop+=40;
	$("footer").css("top",maxTop);
	
	// Navigation
	// Recherche de l'article affiché
	var id=$(".CJArticle:visible").attr("data-id");
	$("#CJNavLi_"+id).addClass("current");

	// Chargement des données
	if(!$("#CJTokenNotGiven").length){
		// Cache la page le temps de récupérer les données
		$("body").hide();
		var token=$("#CJToken").val();
		
		$.ajax({
			url: "getData.php",
			type: "post",
			dataType: "json",
			data: {token: token},
			// Async sinon ne récupère pas la valeur de CJLang
			async: false,
			success: function(data){
				for(field in data){
					// Checkbox et radio
					if($("#"+field).attr("type")=="radio" || $("#"+field).attr("type")=="checkbox"){
						if(data[field]){
							// .click mieux que .prop("checked",true) car permet d'afficher les textarea cachés si la valeur est autre_precisez
							$("#"+field).click();
						}
					// Text, textarea, select, hidden
					} else {
						$("#"+field).val(data[field]);
						
						// Affichage des dates cachées (option multiple)
						if($("#"+field).val()){
							$("#"+field).closest("tr").show();
						}
					}
					
					// Select : la valeur est précédement positionnée et on ajoute .change pour afficher les input[type=text] cachés si la valeur est autre_precisez
					if($("#"+field).is("select")){
						$("#"+field).change();
					}
				}
			},
			error: function(retour){
				CJInfo(retour.responseText,"error");
			},		
		});
		// Affiche la page
		$("body").show();
	}
	
	// JQuery-UI Datepicker
	$(".CJDateEN").datepicker($.datepicker.regional['en']); 
	$(".CJDateFR").datepicker($.datepicker.regional['fr']); 
	
	// Affichage des labels dans la langue choisie
	switch($("#CJLang").val()){
		case "en" : var CJLang=CJLangEN; $(".CJDateFR").hide(); $(".CJDateEN").show(); $(".CJFlagFR").show(); $(".CJFlagEN").hide();	break;
		case "fr" : var CJLang=CJLangFR;  $(".CJDateEN").hide(); $(".CJDateFR").show(); $(".CJFlagEN").show(); $(".CJFlagFR").hide();	break;
		default : var CJLang=CJLangEN;  $(".CJDateFR").hide(); $(".CJDateEN").show(); $(".CJFlagFR").show(); $(".CJFlagEN").hide();		break;
	}


	$(".CJLabel").each(function(){
		var text=CJLang[$(this).attr("data-label")];
		
		if($(this).is("input")){
			$(this).val(text);
		} else if($(this).is("img")){
			$(this).attr("alt",text);
			$(this).attr("title",text);
		} else if($(this).is("title")){
			$(this).text(text.substring(0,text.indexOf("<")));
		} else {
			$(this).html(text);
		}
	});


	
});


function CJSubmitForm(){

	// Variable submit = true si des champs sont visibles et si un enregistrement dans la BDD doit avoir lieu
	var submit=false;
	// Variable valid valable pour tout l'article affiché
	var valid=true;
	
	// Valide tous les élements visibles
	$(".CJField:visible").each(function(){
		submit=true;
		
		// Variables pour le champ en cours
		var valid2=true;
		var mustBeValidate=false;

		// Trim des valeurs
		if($(this).val()){
			$(this).val($(this).val().trim());
		}

		// Simple champ required
		if($(this).hasClass("required")){
			mustBeValidate=true;
			if(!$(this).val()){
				valid=false;
				valid2=false;
			}
		}
				
		// Champs "Others" visibles ne doivent jamais être vides
		if($(this).hasClass("CJOther")){
			mustBeValidate=true;
			if(!$(this).val()){
				valid=false;
				valid2=false;
			}
		}
			
		// Champ e-mail
		if($(this).hasClass("CJMail") && !CJValidMail($(this).val())){
			mustBeValidate=true;
			valid=false;					
			valid2=false;
		}

		// Champ date EN
		else if($(this).hasClass("CJDateEN") && !CJValidDateEN($(this).val())){
			mustBeValidate=true;
			valid=false;					
			valid2=false;
		}

		// Champ date FR
		else if($(this).hasClass("CJDateFR") && !CJValidDateFR($(this).val())){
			mustBeValidate=true;
			valid=false;					
			valid2=false;
		}
	
		// Champs horaires
		// Si requis, tous les champs de la ligne doivent être remplis
		// Si non requis, les champs de la lignes doivent être tous remplis ou tous vides
		if($(this).hasClass("CJFieldHours")){
		 	if($(this).val()){
				 mustBeValidate=true;

				// Si le 1er est supérieur ou égal au 2nd
				if($(this).closest("td").find(".CJFieldHour1").val() >= $(this).closest("td").find(".CJFieldHour2").val()){
					valid=false;
					valid2=false;
				 }

			 	$(this).closest("td").find(".CJField").each(function(){
			 		if(!$(this).val()){
						valid=false;
						valid2=false;
					}
				});
			} else {
			 	$(this).closest("td").find(".CJField").each(function(){
			 		if($(this).val()){
			 			mustBeValidate=true;
						valid=false;
						valid2=false;
					}
				});
			}
			
			
			
			// Champs horaires avec date FR
			 $(this).closest("td").find(".CJDateFR").each(function(){
			 	if(!CJValidDateFR($(this).val())){
			 		valid=false;
			 		valid2=false;
			 	}
			 });
			 
			// Champs horaires avec date EN
			 $(this).closest("td").find(".CJDateEN").each(function(){
			 	if(!CJValidDateEN($(this).val())){
			 		valid=false;
			 		valid2=false;
			 	}
			 });
		}

		
		// Si ce sont des boutons radio requis
		// 1 bouton du groupe doit être coché
		if($(this).attr("type")=="radio" && $(this).hasClass("required")){
			valid2=false;
			$(this).closest("td").find("input").each(function(){
			 	if($(this).prop("checked")){
					valid2=true;
				}
			});
			if(!valid2){
				valid=false;
			}
		}
			
		if(mustBeValidate){
			if(valid2){
				// Affichage des icônes OK
				$(this).closest("td").removeClass("CJFieldError");
				$(this).closest("td").addClass("CJFieldOK");
			} else {
				// Affichage des icônes error
				$(this).closest("td").removeClass("CJFieldOK");
				$(this).closest("td").addClass("CJFieldError");
			}
		}
	});
	
	if(valid){
		// Enregistrement dans la BDD
		if(submit){
			// Token et lang créés au chargement de la page (hidden au début du formulaire)
			var lang=$("#CJLang").val();
			var token=$("#CJToken").val();
			
			// Data : noms et valeurs des champs visibles + langage
			var data=[{field: "CJLang", value: lang }];
			
			// Tous les éléments de l'article courant sont envoyés, qu'ils soient visibles ou non
			$(".CJArticle:visible").find(".CJField").each(function(){
				if(($(this).attr("type")=="radio" && !$(this).prop("checked")) || ($(this).attr("type")=="checkbox" && !$(this).prop("checked"))){
					data.push({field: $(this).attr("id"), value: null});
				} else {
					data.push({field: $(this).attr("id"), value: $(this).val()});
				}
			});
			
			// PostData : token + data + lang
			var postData={token: token, data: data};
			
			$.ajax({
				url: $(".CJForm").attr("action"),
				type: $(".CJForm").attr("method"),
				dataType: "json",
  			// Async =false sinon ne récupère pas la valeur de valid
        // Mais async=true sinon validation trop longue entre chaque étape  			
        async: true,
				data: postData,
				success: function(retour){
				},
				error: function(retour){
					CJInfo(retour.responseText,"error");
					valid=false;
				},
			});
		}
	}	
	return valid;
}

function CJValidMail(string){
	return string.trim()=="" || string.match(/^[A-Z0-9._%-\+\-]+@(?:[A-Z0-9\-]+\.)+[A-Z]{2,4}$/i);
}

function CJValidDateEN(string){
	return string.trim()=="" || string.match(/^(0?[1-9]|1[012])[\- \/.](0?[1-9]|[12][0-9]|3[01])[\- \/.](19|20)[0-9]{2}$/);
}

function CJValidDateFR(string){
	return string.trim()=="" || string.match(/^(0?[1-9]|[12][0-9]|3[01])[\- \/.](0?[1-9]|1[012])[\- \/.](19|20)[0-9]{2}$/);
}

