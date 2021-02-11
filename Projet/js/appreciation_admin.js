
$(document).ready(
    function(){

        $("#save").click(function() {
            var infoText = $("#txtInfo").val();
        
            var file = $("#fileUpload");
            var fileFormData = new FormData();
            fileFormData.append("file", file.prop('files')[0]);
            fileFormData.append("text", infoText);
            
            if(file.val() == "" )
            {
                alert("Veuillez entrez un fichier")
            }
            else{
                $.ajax({
                    url: 'php/uploadbilanfile.php',
                    method: "POST",
                    data: fileFormData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                      if (data == "-1") {
                        projID = -1;
                      }
                      else if (data.indexOf("error") >= 0) {
                        alert(data);
                        projID = -1;
                      } else if(data == "success"){
                        alert("Le nouveau contenu de la section appréciation a été modifié pour tous les étudiants!")
                      }
                      else{
                          alert("Erreur survenu");
                      }
                    }
                  });
            
                
            }
        });


        $.ajax({
            url: 'php/getbilantext.php',
            method: "POST",
            success: function(data) {
              if (data != null ) {
                $("#txtInfo").text(data) ;
              }
              else{
                  alert("Erreur lors du select du text survenu");
              }
            }
          });

            
    }
);