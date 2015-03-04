$(function(){
	// Boutons JQuery-UI
	$(".CJButton").button();
	
	// Clic sur Previous
	$(".CJButtonPrevious").click(function(){
		var sectionId=$(this).attr("data-sectionId");
		var PreviousSectionId=parseInt(sectionId)-1;
		// Navigation
		$(".CJNavLi").removeClass("current");
		$("#CJNavLi_"+PreviousSectionId).addClass("current");
		// Article
		$("#CJArticle_"+sectionId).hide("slide",{direction:"right"},500,function(){
			$("#CJArticle_"+PreviousSectionId).show("slide",{direction:"left"},500);
		});
	});
	
	// Clic sur Next
	$(".CJButtonNext").click(function(){
		var sectionId=$(this).attr("data-sectionId");
		var nextSectionId=parseInt(sectionId)+1;
		// Navigation
		$(".CJNavLi").removeClass("current");
		$("#CJNavLi_"+sectionId).addClass("done");
		$("#CJNavLi_"+nextSectionId).addClass("current");
		
		// Article
		$("#CJArticle_"+sectionId).hide("slide",{direction:"left"},500,function(){
			$("#CJArticle_"+nextSectionId).show("slide",{direction:"right"},500);
		});
	});
	
	// Clic sur un item du menu de navigation
	$(".CJNavLi").click(function(){
		if($(this).hasClass("done")){
			var current = $(".CJNavLi.current").attr("data-id");
			var newId=$(this).attr("data-id");
			
			// Navigation
			$("#CJNavLi_"+current).removeClass("current");	
			$("#CJNavLi_"+newId).addClass("current");
		
			var direction1=current>newId?"right":"left";
			var direction2=current<newId?"right":"left";
			
			// Article
			$(".CJArticle:visible").hide("slide",{direction:direction1},500,function(){
				$("#CJArticle_"+newId).show("slide",{direction:direction2},500);
			});
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
	maxTop+=60;
	$("footer").css("top",maxTop);
	
	// Navigation
	// Recherche de l'article affiché
	var id=$(".CJArticle:visible").attr("data-id");
	$("#CJNavLi_"+id).addClass("current");


});
