var pullType2 = "";

function pullusers(pulltype) {
  $.ajax({
    url: 'php/gestion_users/pulluser.php',
    type: 'POST',
    data: {
      pulltype: pulltype
    },
    success: function(data) {
      var reponse = $.parseJSON(data);

      if (pulltype == "all") {
        pullType2 = "all";
        $("#affProjet").removeClass("btSelectAffichage");
        $("#affProjet").addClass("btAffichage");
        $("#affTous").removeClass("btAffichage");
        $("#affTous").addClass("btSelectAffichage");
        $("#affdisable").removeClass("btSelectAffichage");
        $("#affdisable").addClass("btAffichage");

      } else if (pulltype == "projet") {
        pullType2 = "projet";
        $("#affProjet").removeClass("btAffichage");
        $("#affProjet").addClass("btSelectAffichage");
        $("#affTous").removeClass("btSelectAffichage");
        $("#affTous").addClass("btAffichage");
        $("#affdisable").removeClass("btSelectAffichage");
        $("#affdisable").addClass("btAffichage");

      } else if (pulltype == "disable") {
        pullType2 = "disable";
        $("#affProjet").removeClass("btSelectAffichage");
        $("#affProjet").addClass("btAffichage");
        $("#affTous").removeClass("btSelectAffichage");
        $("#affTous").addClass("btAffichage");
        $("#affdisable").removeClass("btAffichage");
        $("#affdisable").addClass("btSelectAffichage");
      }
      remplirTbl(reponse, pulltype);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert("Status: " + textStatus);
      alert("Error: " + errorThrown);
    }
  });
}


function remplirTbl(arr, pulltype) {
  $("#tblUsers tbody").html("");


  if (!$.fn.DataTable.isDataTable('#tblUsers')) {
    table = $("#tblUsers").DataTable({
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
  table.clear();


  if (arr.nom.length == 0) {
    //var tr = $("<tr></tr>");
    //  var th = $("<td scope='row' class='text-center' colspan='8'></th>").text("Aucun utilisateur trouvé.");

    //  tr.append(th);
    table.destroy();
    if (!$.fn.DataTable.isDataTable('#tblUsers')) {
      table = $("#tblUsers").DataTable({
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

    //  $("#tblUsers tbody").append(tr);
  } else {
    for (var ctr = 0; ctr < arr.nom.length; ctr++) {
      var tr = $("<tr></tr>");
      var th = $("<th scope='row'></th>").text(ctr + 1);
      var td = $("<td style='width: 30%'></td>").text(arr.nom[ctr]);
      var td3 = $("<td style='width: 30%'></td>").text(arr.prenom[ctr]);
      var td1 = $("<td></td>").text(arr.type[ctr]);
      var td2 = $("<td style='width: 20%'></td>").attr('id', arr.username[ctr]);

      if (arr.nom[ctr] != arr.currentUser) {
        var bt = $("<input class='btn btn-primary BTreset' type='button' value='Réinitialiser mot de passe' data-toggle='modal' data-target='#confirmModal'>");
        var bt1 = $("<input class='btn btn-danger BTsuppr' type='button' value='Désactivé' data-toggle='modal' data-target='#confirmModal'>");
        var bt2 = $("<input class='btn btn-success BTview' type='button' value='Voir le formulaire'>");
        var bt4 = $("<input class='btn btn-secondary BTviewBilan' type='button' value='Voir le bilan'>");
        var bt3 = $("<input class='btn btn-success BTactivate' type='button' value='Activer' data-toggle='modal' data-target='#confirmModal'>");

        if (pulltype == "projet") {
          td2.append(bt, bt1, bt2, bt4);
        } else if (pulltype == "all") {
          td2.append(bt, bt1);
        } else {
          td2.append(bt3);
        }

      }

      tr.append(th, td, td3, td1, td2);
      //  $("#tblUsers tbody").append(tr);

      table.rows.add(tr).draw();
    }
  }
}

$(document).ready(function() {
  var selectedUser = "";
  var reset = true;
  var sup = true;


  pullusers('projet');


  function resetUser(username) {
    var tempPass = Fonction.random_password_generate(8, 12);

    $.ajax({
      url: 'php/gestion_users/resetuser.php',
      type: 'POST',
      data: {
        username: username,
        tempPass: tempPass
      },
      success: function(data) {
        if (data == "success") {
          $("#userReset").text(selectedUser);
          $("#tempPass").text(tempPass);

          $("#resetModal").modal('show');
        } else {
          $("#successerrorModalLabel").text("Erreur");
          $("#successerrorModal").find(".modal-body").html("<p>erreur lors de la réinitialisation du mot de passe de l'utilisateur ''" + selectedUser + "''</p>");
          $("#successerrorModal").modal('show');
        }
      }
    });
  }

  function delUser(username) {
    $.ajax({
      url: 'php/gestion_users/deluser.php',
      type: 'POST',
      data: {
        username: username
      },
      success: function(data) {
        if (data == "success") {
          $("#successerrorModalLabel").text("Succès");
          $("#successerrorModal").find(".modal-body").html("<p>utilisateur " + selectedUser + " supprimé avec succès</p>");
          $("#successerrorModal").modal('show');
          if (pullType2 == "projet") {
            pullusers("projet");
          } else if (pullType2 == "all") {
            pullusers("all");
          }
        } else {
          $("#successerrorModalLabel").text("Erreur");
          $("#successerrorModal").find(".modal-body").html("<p>Erreur lors de la suppression de l'utilisateur ''" + selectedUser + "''</p>");
          $("#successerrorModal").modal('show');
        }
      }
    });
  }

  function activateUser(username) {
    $.ajax({
      url: 'php/gestion_users/activateUser.php',
      type: 'POST',
      data: {
        username: username
      },
      success: function(data) {
        if (data == "success") {
          $("#successerrorModalLabel").text("Succès");
          $("#successerrorModal").find(".modal-body").html("<p>utilisateur " + selectedUser + " activé avec succès</p>");
          $("#successerrorModal").modal('show');
          pullusers("disable");
        } else {
          $("#successerrorModalLabel").text("Erreur");
          $("#successerrorModal").find(".modal-body").html("<p>Erreur lors de l'activation de l'utilisateur ''" + selectedUser + "''</p>");
          $("#successerrorModal").modal('show');
        }
      }
    });
  }

  function voirFormulaire() {
    $.ajax({
      url: 'php/gestion_users/selectviewformetu.php',
      type: 'POST',
      data: {
        id: selectedUser
      },
      success: function(data) {
        window.location.href = '?page=viewformulaire';
      }
    });
  }

  function voirBilan() {
    $.ajax({
      url: 'php/gestion_users/selectviewformbilan.php',
      type: 'POST',
      data: {
        id: selectedUser
      },
      success: function(data) {
        window.location.href = '?page=viewBilan';
      }
    });
  }

  // ancienne fonction
  /*function fillForm(response) {
      localStorage.setItem("formNom", response.nom);
      localStorage.setItem("formPrenom", response.prenom);
      localStorage.setItem("formCourriel", response.courriel);
      localStorage.setItem("formSexe", response.sexe);
      localStorage.setItem("formDateN", response.datenaissance);
      localStorage.setItem("formEtuDu", response.form_coor_etuDu.join());
      localStorage.setItem("formEtuAu", response.form_coor_etuAu.join());
      localStorage.setItem("formEtuAd", response.form_coor_etuAd.join());
      localStorage.setItem("formEtuTel", response.form_coor_etuTel.join());
      localStorage.setItem("formResDu", response.form_coor_resDu.join());
      localStorage.setItem("formResAu", response.form_coor_resAu.join());
      localStorage.setItem("formResAd", response.form_coor_resAd.join());
      localStorage.setItem("formResTel", response.form_coor_resTel.join());
      localStorage.setItem("formProDu", response.form_coor_proDu.join());
      localStorage.setItem("formProAu", response.form_coor_proAu.join());
      localStorage.setItem("formProAd", response.form_coor_proAd.join());
      localStorage.setItem("formProTel", response.form_coor_proTel.join());
      localStorage.setItem("formAssMalNom", response.form_ass_malNom);
      localStorage.setItem("formAssMalNum", response.form_ass_malNum);
      localStorage.setItem("formAssMalAd", response.form_ass_malAd);
      localStorage.setItem("formAssMalTel", response.form_ass_malTel);
      localStorage.setItem("formAssMalTelU", response.form_ass_malTelU);
      localStorage.setItem("formAssMalCourriel", response.form_ass_malCourriel);
      localStorage.setItem("formAssBagNom", response.form_ass_bagNom);
      localStorage.setItem("formAssBagNum", response.form_ass_bagNum);
      localStorage.setItem("formAssBagAd", response.form_ass_bagAd);
      localStorage.setItem("formAssBagTel", response.form_ass_bagTel);
      localStorage.setItem("formAssBagCourriel", response.form_ass_bagCourriel);
      localStorage.setItem("formAmbAd", response.form_ambAd);
      localStorage.setItem("formAmbTel", response.form_ambTel);
      localStorage.setItem("formAmbCourriel", response.form_ambCourriel);
      localStorage.setItem("formSanteEtat", response.form_santeEtat);
      localStorage.setItem("formSanteMed", response.form_santeMed);
      localStorage.setItem("formSanteAl", response.form_santeAl);
      localStorage.setItem("formVaccinsId", response.form_vaccinsId.join());
      localStorage.setItem("formVaccinsVal", response.form_vaccinsVal.join());

  }*/

  $("#confirmBT").click(function(event) {
    if (reset)
      resetUser(selectedUser);
    else if (sup) {
      delUser(selectedUser);
    } else
      activateUser(selectedUser);
  });

  $('#resetModal').on('hidden.bs.modal', function() {
    selectedUser = "";
  })

  $('#successerrorModal').on('hidden.bs.modal', function() {
    selectedUser = "";
  })

  $('#resetModal').on('hidden.bs.modal', function() {
    $("#userReset").text("");
    $("#tempPass").text("");
  })

  $("tbody").delegate('.BTreset', 'click', function(event) {
    selectedUser = $(event.target).parent("td").attr('id');
    reset = true;
    sup = false
    $('#confirmModalLabel').text("Confirmer la réinitialisation");
    $('#confirmModal').find(".modal-body").html("<p>Voulez-vous vraiment réinitialiser le mot de passe de l'utilisateur ''" + selectedUser + "'' ?</p>");
  });

  $("tbody").delegate('.BTsuppr', 'click', function(event) {
    selectedUser = $(event.target).parent("td").attr('id');
    reset = false;
    sup = true;
    $('#confirmModalLabel').text("Confirmer la suppression");
    $('#confirmModal').find(".modal-body").html("<p>Voulez-vous vraiment supprimer l'utilisateur ''" + selectedUser + "'' ?</p>");
  });

  $("tbody").delegate('.BTactivate', 'click', function(event) {
    selectedUser = $(event.target).parent("td").attr('id');
    reset = false;
    sup = false;
    $('#confirmModalLabel').text("Confirmer l'activation");
    $('#confirmModal').find(".modal-body").html("<p>Voulez-vous vraiment activé l'utilisateur ''" + selectedUser + "'' ?</p>");
  });

  $("tbody").delegate('.BTview', 'click', function(event) {
    selectedUser = $(event.target).parent("td").attr('id');
    voirFormulaire();
  });

  $("tbody").delegate('.BTviewBilan', 'click', function(event) {
    selectedUser = $(event.target).parent("td").attr('id');
    voirBilan();
  });


  $("#generate").click(function(event) {
    var pass = Fonction.random_password_generate(8, 10);

    $("#password").val(pass);

  });


  $("#form_adduser").submit(function(event) {
    var pass = $("#password").val();
    var username = $("#username").val();
    var type = $("#type option:selected").val();

    if (username.trim() == "") {
      $("#successerrorModalLabel").text("Erreur");
      $("#successerrorModal").find(".modal-body").html("<p>Veuillez entrer un nom d'utilisateur</p>");
      $("#successerrorModal").modal('show');

      event.preventDefault();
      event.stopPropagation();
      return false;
    } else if (pass.trim() == "") {
      $("#successerrorModalLabel").text("Erreur");
      $("#successerrorModal").find(".modal-body").html("<p>Veuillez générer un mot de passe</p>");
      $("#successerrorModal").modal('show');

      event.preventDefault();
      event.stopPropagation();
      return false;
    } else {

      $.ajax({
        url: 'php/gestion_users/adduser.php',
        type: 'POST',
        data: {
          username: username,
          pass: pass,
          type: type
        },
        success: function(data) {
          if (data == "success") {
            $("#addUserModal").modal('hide');
            $("#password").val("");
            $("#username").val("");
            $("#type").val($("#type option:first").val());
            $("#successerrorModalLabel").text("Succès");
            $("#successerrorModal").find(".modal-body").html("<p>L'utilisateur a été créé</p>");
            $("#successerrorModal").modal('show');

            if (pullType2 == "projet") {
              pullusers("projet");
            } else if (pullType2 == "all") {
              pullusers("all");
            } else if (pullType2 == "disable") {
              pullusers("disable");
            }
          } else if (data == "error_user_exists") {
            $("#successerrorModalLabel").text("Erreur");
            $("#successerrorModal").find(".modal-body").html("<p>Ce nom d'utilisateur a déjà été attribué, veuillez réessayer</p>");
            $("#successerrorModal").modal('show');

          } else {
            $("#addUserModal").modal('toggle');
            $("#successerrorModalLabel").text("Erreur");
            $("#successerrorModal").find(".modal-body").html("<p>Erreur lors de l'ajout de l'utilisateur</p>");
            $("#successerrorModal").modal('show');
          }
        }
      });

    }

    return false;
  });


});
