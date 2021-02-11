var selectedProject = "";
var titreProj = "";
var userType = "";

$(document).ready(function() {

  $.ajax({
    url: 'php/gestion_demandes/getusertype.php',
    type: 'POST',
    success: function(data) {
      userType = data;
    }
  });

  function remplirTbl(arr) {
    $("#tblDemandes tbody").html("");

    if (arr.titre.length == 0) {
      var tr = $("<tr></tr>");
      var th = $("<td scope='row' class='text-center' colspan='8'></th>").text("Aucune demande trouvé.");

      tr.append(th);

      $("#tblDemandes tbody").append(tr);

    } else {
      for (var ctr = 0; ctr < arr.titre.length; ctr++) {
        var th = $("<th scope='row'></th>").text(ctr + 1);
        var td4 = $("<td style='width: 20%'></td>").text(arr.date_remise[ctr]);
        var td = $("<td style='width: 20%'></td>").text(arr.titre[ctr]);
        var td2 = $("<td style='width: 50%'></td>").attr('id', arr.id[ctr]).attr('class', arr.titre[ctr]);
        var td3 = $("<td style='width: 10%'></td>");
        td3.css("text-align", "center");

        switch (arr.etat[ctr]) {
          case '0':
            img = $('<img src="img/decision.png" alt="choix" width="35vw">');
            td3.append(img);
            break;
          case '1':
            img = $('<img src="img/vert.png" alt="accepter" width="30vw">');
            td3.append(img);
            break;
          case '2':
            img = $('<img src="img/rouge.png" alt="refuser" width="30vw">');
            td3.append(img);

            break;
          case '3':
            td3.text("Non-envoyé");
            break;
          default:
            td3.text("État de la demande inconnu");
            break;

        }


        var bt0 = $("<input class='btn btn-primary BTview' type='button' value='Voir/Modifier la demande'>");

        if (userType == "A") {
          var bt = $("<input id='butAccept" + ctr + "' class='btn btn-success BTacccept' type='button' value='Accepter la demande' data-toggle='modal' data-target='#acceptModal'>");
          if (arr.etat[ctr] == 0) {
            var bt1 = $("<input id='butRefus" + ctr + "' class='btn btn-danger BTrefuse' type='button' value='Refuser la demande' data-toggle='modal' data-target='#refuseModal'>");
            var tr = $("<tr style='background-color: #F3EC7D'></tr>");
          } else if (arr.etat[ctr] != 2) {
            var tr = $("<tr></tr>");
            var bt1 = $("<input id='butRefus" + ctr + "' class='btn btn-danger BTrefuse' type='button' value='Refuser la demande'>");
          } else if (arr.etat[ctr] == 2) {
            var tr = $("<tr></tr>");
            var bt1 = $("<input id='butRaisonRefus" + ctr + "' class='btn btn-danger BTraisonrefuse' type='button' value='Raison de refus' data-toggle='modal' data-target='#raisonrefuseModal'>");
          }
          if (arr.dateR[ctr]) {
            td2.append(bt0, bt, bt1);
          } else {
            td2.append(bt0);
          }

          tr.append(th, td, td4, td3, td2);
          $("#tblDemandes tbody").append(tr);

          if (arr.etat[ctr] == 1) {
            $("#butAccept" + ctr).hide();
          }


        } else if (userType == "P") {
          var tr = $("<tr></tr>");

          if (arr.etat[ctr] == 2) {
            var bt = $("<input id='butRaisonRefus" + ctr + "' class='btn btn-danger BTraisonrefuse' type='button' value='Raison de refus' data-toggle='modal' data-target='#raisonrefuseModal'>");
            td2.append(bt0, bt);
          } else {
            td2.append(bt0);
          }

          tr.append(th, td, td4, td3, td2);
          $("#tblDemandes tbody").append(tr);

        }
      }
      if (!$.fn.DataTable.isDataTable('#tblDemandes')) {
        $('#tblDemandes').DataTable({
          "order": [
            [2, "desc"]
          ],
          "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
            "searchable": false
          }, {
            "type": "alt-string",
            targets: 3
          }],
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
          }
        });
      }
    }
  }

  function pulldemandes() {
    $.ajax({
      url: 'php/gestion_demandes/pulldemande.php',
      type: 'POST',
      success: function(data) {
        var reponse = $.parseJSON(data);
        remplirTbl(reponse);
      }
    });
  }

  pulldemandes();
  $("#acceptBt").click(function(event) {
    acceptDemande();
  });

  $(document).on('click', '.BTrefuse', function() {
    $("#refuseModal").modal("show");
  });

  $('#btRefCancel').click(function() {
    $('#msgRefus').val("");
    $("#btnUpload").val("");
  });

  function acceptDemande() {
    var codeProj = Fonction.activation_code_generate();
    $.ajax({
      url: 'php/gestion_demandes/acceptdemande.php',
      type: 'POST',
      data: {
        id: selectedProject,
        codeProj: codeProj
      },
      success: function(data) {
        if (data == "success") {
          pulldemandes();
          alert("Le projet a été accepté");
        } else {
          alert("erreur lors de l'acceptation de la demande " + data);
        }
      }
    });
  }

  $("#refuseForm").submit(function(event) {
    event.preventDefault();
    var file_name = $("#image").val();
    var refus_message = $('#msgRefus').val();
    var idRefus = $("#idRefus").val();

    $.ajax({
      url: 'php/gestion_demandes/refusdemande.php',
      type: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function(data) {
        if (data == "success") {
          alert("Le projet a été refusé");
          pulldemandes();
          $('#msgRefus').val("");
          $("#btnUpload").val("");
          $("#refuseModal").modal("hide");
          $(".modal-backdrop").remove();
        } else {
          $('#msgRefus').val("");
          $("#btnUpload").val("");
          $("#refuseModal").modal("hide");
          alert(data);
        }
      }
    });
  });

  function voirDemande() {
    $.ajax({
      url: 'php/gestion_demandes/voirdemande.php',
      type: 'POST',
      data: {
        id: selectedProject
      },
      success: function(data) {
        if (data != "error") {
          window.location.href = '?page=viewdemande';
        } else {
          alert("Erreur survenu lors de la visualisation de la demande.");
        }
      }
    });
  }

  function setReason() {
    $.ajax({
      url: 'php/gestion_demandes/getraison.php',
      type: 'POST',
      data: {
        id: selectedProject
      },
      success: function(data) {

        if (data != "error") {
          var reponse = $.parseJSON(data);

          $('#raisonrefuseModal').find(".modal-body").html("<textarea readonly id='msgRefus' rows='7' cols='42'>" + reponse[0].raison_refus + "</textarea>");
          if (reponse[0].file_path != null) {
            $("#lienFile").show();
            $("#lienFile").attr("href", "../../uploads/" + reponse[0].file_path);
          } else {
            $("#lienFile").hide();
          }
        } else {
          alert("Erreur survenu lors de la visualisation de la demande.");
        }
      }
    });
  }

  $("tbody").delegate('.BTview', 'click', function(event) {
    selectedProject = $(event.target).parent("td").attr('id');
    voirDemande();
  });


  $("tbody").delegate('.BTacccept', 'click', function(event) {
    selectedProject = $(event.target).parent("td").attr('id');
    titreProj = $(event.target).parent("td").attr('class');
    iddemande =
      $('#acceptModalLabel').text("Accepter la demande");
    $('#acceptModal').find(".modal-body").html("<p>Voulez-vouz vraiment accepter la demande '" + titreProj + "' ?</p>");
  });

  $("tbody").delegate('.BTrefuse', 'click', function(event) {
    selectedProject = $(event.target).parent("td").attr('id');
    $("#idRefus").val(selectedProject);
    $('#refuseModalLabel').text("Refuser la demande");
  });

  $("tbody").delegate('.BTraisonrefuse', 'click', function(event) {
    selectedProject = $(event.target).parent("td").attr('id');
    $('#raisonrefuseModalLabel').text("Raison du refus de la demande");
    setReason();
  });

});
