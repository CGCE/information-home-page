$(function(){
  $(".CJArticle input").focus(function(){
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

});
