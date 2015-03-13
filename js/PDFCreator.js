function generatePDF(){
  // Affiche un message pour faire patienter
  // A Faire : Utilser les fichiers lang/xx.js
  CJInfo("Veuillez patienter pendant la génération du fichier PDF","highlight",80,100000,"CJPdfWait");

  // Génératon du PDF
  var token = $("#CJToken").val();
  var fname = "data/"+token+".pdf";

  $.ajax({
    url: "PDFCreator.php",
    dataType: "json",
    type: "post",
    data: {token: token, fname: fname},
    async: false,
    success: function(retour){
      $(".CJPdfWait").remove();
//      if(CJFileExists(fname)==true){
        window.open(fname);
//      } else {
//        CJInfo("Impossible d'ouvrir le fichier "+fname,"error");
//      }
    },
    error: function(retour){
      $(".CJPdfWait").remove();
      CJInfo(retour.responseText,"error");
    }

  });


  // Lorsque le PDF est prêt, supprimer le message est télécharger le fichier
  // $(".CJPdfWait").remove();

  // 3 Lignes suivantes à supprimer : test  
  setTimeout(function(){
    $(".CJPdfWait").remove();
    }, 5000);
}
