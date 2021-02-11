var userType = "";

function pullProjets(pulltype) {
  $.ajax({
    url: 'php/gestion_projets/pullprojets.php',
    type: 'POST',
    data: {
      pulltype: pulltype
    },
    success: function(data) {
      var reponse = $.parseJSON(data);
      remplirTbl(reponse, pulltype);
    }
  });
}

function checkProjet() {
  $.ajax({
    url: 'php/gestion_projets/checkprojets.php',
    type: 'POST',
    success: function(data) {
      if (data != "empty") {
        $("#" + data).children("span").show();

      }

    }
  });
}

function remplirTbl(arr, pulltype) {
  $("#tblProjets tbody").html("");
  if (!$.fn.DataTable.isDataTable('#tblProjets')) {
    table = $("#tblProjets").DataTable({
      "order": [
        [4, "desc"]
      ],
      "columnDefs": [{
        "targets": 'no-sort',
        "orderable": false,
        "searchable": false
      }],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
      }
    });
  }
  table.clear();
  if (arr.nom.length == 0) {
    table.destroy();
    if (!$.fn.DataTable.isDataTable('#tblProjets')) {
      table = $("#tblProjets").DataTable({
        "order": [
          [3, "desc"]
        ],
        "columnDefs": [{
          "targets": 'no-sort',
          "orderable": false,
          "searchable": false
        }],
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
        }
      });
    }
    table.rows.add().draw();
    //  $("#tblProjets tbody").append(tr);

  } else {
    for (var ctr = 0; ctr < arr.id.length; ctr++) {
      var tr = $("<tr></tr>");
      var th = $("<th scope='row' class=\"text-center\"></th>").text(ctr + 1);
      var td = $("<td style='width: 8%' class=\"text-center\"></td>").text(arr.nom[ctr]);
      var td2 = $("<td style='width: 8%' class=\"text-center\"></td>").text(arr.code[ctr]);
      var td4 = $("<td style='width: 8%' class=\"text-center\"></td>").text(arr.destination[ctr]);
      var td5 = $("<td style='width: 8%' class=\"text-center\"></td>").text(arr.dateD[ctr]);
      var td6 = $("<td style='width: 8%' class=\"text-center\"></td>").text(arr.dateR[ctr]);
      var td3 = $("<td id=" + arr.id[ctr] + "style='width: 25%' class=\"text-center\"></td>").attr('nom', arr.nom[ctr]).attr("id", arr.id[ctr]);
      var bt = $("<input class='btn btn-primary BTselection' style='margin-right: 3%' type='button' value='Sélectionner le projet'>&nbsp;");
      if (userType != "E") {
        var bt1 = $("<input class='btn btn-secondary BTview' type='button' value='Visualiser le projet'> ");
        var bt2 = $("<input class='btn btn-info BTviewParticipant' type='button' value='Voir les participants'>");
      }
      var bt4 = $("<input class='btn btn-info BTCopieCOLI' type='button' value='Copier le projet' data-toggle='modal' data-target='#copiModal'>");
      var icon = $("<span  class='fas fa-check text-center fa-2x' aria-hidden='true' style='color:green; margin-left:1vw;'></span>");


      if (pulltype == "désactivé") {
        td3.append(bt1, bt4, bt2, bt, icon);
      } else {
        td3.append(bt1, bt2, bt, icon);
      }

      tr.append(th, td, td2, td4, td5, td6, td3);
      table.rows.add(tr).draw();
      // $("#tblProjets tbody").append(tr);
      $("span").hide();
      $("#iRetour").show();

    }
    checkProjet();
  }
}

$(document).ready(function() {
  var selectedProjet = "";
  var idProjet = -1;

  $.ajax({
    url: 'php/gestion_demandes/getusertype.php',
    type: 'POST',
    success: function(data) {
      userType = data;
    }
  });

  var today = new Date();
  var troisAns = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();
  var yyyy2 = today.getFullYear() + 3;
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }

  today = yyyy + '-' + mm + '-' + dd;
  troisAns = yyyy2 + '-' + mm + '-' + dd;

  document.getElementById("tbNewDateDepart").setAttribute("min", today);
  document.getElementById("tbNewDateDepart").setAttribute("max", troisAns);
  document.getElementById("tbNewDateRetour").setAttribute("min", today);
  document.getElementById("tbNewDateRetour").setAttribute("max", troisAns);

  $('#tbNewDateRetour').change(function(event) {
    var startDt = document.getElementById("tbNewDateDepart").value;
    var endDt = document.getElementById("tbNewDateRetour").value;

    if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {
      $("#tbNewDateDepart").val("");
    }
  });

  $('#tbNewDateDepart').change(function(event) {
    var startDt = document.getElementById("tbNewDateDepart").value;
    var endDt = document.getElementById("tbNewDateRetour").value;

    if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {
      $("#tbNewDateDepart").val("");
    }
  });

  var tbCode = $('#codeVoyage');
  tbCode.mask('CCCC-CCCC', {
    'translation': {
      C: {
        pattern: /[A-Za-z0-9]/
      },
    },
    placeholder: "ex: 12AB-CD3E"
  });

  pullProjets('actif');

  function eventFire(el, etype) {
    if (el.fireEvent) {
      el.fireEvent('on' + etype);
    } else {
      var evObj = document.createEvent('Events');
      evObj.initEvent(etype, true, false);
      el.dispatchEvent(evObj);
    }
  }

  $("tbody").delegate('.BTview', 'click', function(event) {
    selectedProj = $(event.target).parent("td").attr('id');
    $.ajax({
      url: 'php/gestion_projets/voirprojets.php',
      type: 'POST',
      data: {
        id: selectedProj
      },
      success: function(data) {
        if (data == "success") {
          window.location.href = '?page=viewdemande';
        } else {
          alert(data);
        }
      }
    });
  });

  $("tbody").delegate('.BTCopieCOLI', 'click', function(event) {
    selectedProjet = $(event.target).parent("td").attr('nom');
    idProjet = $(event.target).parent("td").attr("id");
    $("span").hide();

    $("#copiModal").show();

  });

  $('#btAjoutVoyage').click(function(event) {

    var codeProjet = $("#codeVoyage").cleanVal();
    $("#codeVoyage").cleanVal("");
    addVoyage(codeProjet);
    pullProjets('actif');
    $("#codeVoyage").val("");
  });

  function addVoyage(codeProjet) {
    $.ajax({
      url: 'php/addCodeProjet.php',
      type: 'POST',
      data: {
        codeVoyage: codeProjet
      },
      success: function(data) {
        if (data === "success") {
          alert("Vous avez bien rejoint le voyage");
        } else if (data === "errorvide") {
          alert("Vous devez inscrire un code de projet");
        } else if (data === "errorAlready") {
          alert("Vous faites déjà partie de ce projet");
        } else if ("invalidCode") {
          alert("Le code de projet entré est invalide");
        }
      }
    });
  }

  $("tbody").delegate('.BTviewParticipant', 'click', function(event) {
    selectedProjet = $(event.target).parent("td").attr('nom');
    idProjet = $(event.target).parent("td").attr("id");
    $("span").hide();
    $("#iRetour").show();
    /*        $("input").prop("disabled", false);
            $(event.target).prop("disabled", true);*/
    $(event.target).parent("td").children("span").show();
    $('#selectModalLabel').text("Sélection de projet");
    $('#selectModal').find(".modal-body").html("<p>Projet ''" + selectedProjet + "'' a été sélectionné !</p>");
    $('#selectModal').modal('toggle');
    $("#projetTitle").text(selectedProjet);
    selectProject(selectedProjet, idProjet);
    window.location.href = '?page=gestion_users'
  });

  function selectProject(selectedProjet, idProjet) {
    $.ajax({
      url: 'php/gestion_projets/setprojetname.php',
      type: 'POST',
      data: {
        nom: selectedProjet,
        idProjet: idProjet
      },
      success: function(data) {
        if (data == "error") {
          alert("Une erreur est survenu.");
        }
      }
    });
  }


  $("tbody").delegate('.BTselection', 'click', function(event) {
    selectedProjet = $(event.target).parent("td").attr('nom');
    idProjet = $(event.target).parent("td").attr("id");
    $("span").hide();
    $("#iRetour").show();
    /*        $("input").prop("disabled", false);
            $(event.target).prop("disabled", true);*/
    $(event.target).parent("td").children("span").show();
    $('#selectModalLabel').text("Sélection de projet");
    $('#selectModal').find(".modal-body").html("<p>Projet ''" + selectedProjet + "'' a été sélectionné !</p>");
    $('#selectModal').modal('toggle');
    $("#projetTitle").text(selectedProjet);
    selectProject(selectedProjet, idProjet);
  });

  $("#form_copieCOLI").submit(function(event) {
    var NewNom = $("#tbNewNom").val();
    var NewDateDebut = $("#tbNewDateDepart").val();
    var NewDateFin = $("#tbNewDateRetour").val();
    if (NewDateDebut < DNewDateFinate) {
      $.ajax({
        url: "php/gestion_demandes/copieCOLIDemande.php",
        type: "POST",
        data: {
          NewNom: NewNom,
          NewDateDebut: NewDateDebut,
          NewDateFin: NewDateFin,
          idProjet: idProjet
        },

        success: function(data) {
          if (data == "success") {
            alert("Nouvelle demande ajouté");
            $('#copiModal').modal("hide");
          } else {
            alert(data);
          }
        }
      });
    }
    return false;
  });
});