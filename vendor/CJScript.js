//function to create error and alert dialogs
function CJErrorHighlight(e, type, icon) {
    if (!icon) {
        if (type === 'highlight') {
            icon = 'ui-icon-info';
        } else {
            icon = 'ui-icon-alert';
        }
    }
    return e.each(function() {
        $(this).addClass('ui-widget');
        var alertHtml = '<div class="ui-state-' + type + ' ui-corner-all" style="padding:0 .7em;">';
        alertHtml += '<p style="text-align:center;">';
        alertHtml += '<span class="ui-icon ' + icon + '" style="float:left;margin-right: .3em;"></span>';
        alertHtml += $(this).html();
        alertHtml += '</p>';
        alertHtml += '</div>';

        $(this).html(alertHtml);
    });
}

function CJInfo(message,type,top,time){
  if(top==undefined){
    top=60;
  }
  
  if(time==undefined){
    time=5000;
  }

  if(typeof(timeoutJSInfo)!== "undefined"){
    window.clearTimeout(timeoutCJInfo);
  }

	var id=1;
	$(".CJInfo").each(function(){
		id=$(this).attr("data-id")>=id?($(this).attr("data-id")+1):id;
		top=$(this).position().top+$(this).height();
	});

  $("body").append("<div class='CJInfo' id='CJInfo"+id+"' data-id='"+id+"'>"+message+"</div>");
  CJErrorHighlight($("#CJInfo"+id),type);
  CJPosition($("#CJInfo"+id),top,"center");
  timeoutCJInfo=window.setTimeout(function(){
  		var height=$("#CJInfo"+id).height();
  		$("#CJInfo"+id).remove();
  		$(".CJInfo").each(function(){
  			var top=$(this).position().top-height;
  			$(this).css("top",top);
  		});
  	},time);
}

function CJPosition(object,top,left){
  if(left=="center"){
    left=($(document).width()-object.width())/2;
  }
  object.css("position","absolute");
  object.css("z-index",10);
  object.css("top",top);
  object.css("margin-left","auto");
}
