$(function(){
/*  $(".CJArticle input").focus(function(){
    var scroll=$(this).closest("article").position().top;
    $(document).scrollTop(scroll);
  });

  $(".CJArticle select").focus(function(){
    var scroll=$(this).closest("article").position().top;
    $(document).scrollTop(scroll);
  });

  $(".CJArticle textarea").focus(function(){
    var scroll=$(this).closest("article").position().top;
    $(document).scrollTop(scroll);
  });
*/
	$(".CJButton").button();
	
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
	
	$(".CJCheckboxesSelect").change(function(){
		var id=$(this).attr("data-id");
		if($(this).val()){
			$("#"+id).prop("checked",true);
		} else {
			$("#"+id).prop("checked",false);
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
