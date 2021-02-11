$(document).ready(function(){

    $.ajax({
        url: 'php/getbilantext.php',
        method: "POST",
        success: function(data) {
          if (data != null ) {
            $("#infoText").text(data) ;
          }
          else{
              alert("Erreur lors du select du text survenu");
          }
        }
      });
    });
