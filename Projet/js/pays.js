$(document).ready(function() {

  var ancienNomPays = "";

  function remplirTbl(arr) {
    $("#tblPays tbody").html("");

    if (!$.fn.DataTable.isDataTable('#tblPays')) {
      table = $("#tblPays").DataTable({
        "order": [
          [1, "asc"]
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

    if (arr.id_pays.length == 0) {
      var tr = $("<tr></tr>");
      var th = $("<td scope='row' class='text-center' colspan='8'></th>").text("Aucun pays trouvé.");

      tr.append(th);

      //  $("#tblPays tbody").append(tr);

    } else {

      for (var ctr = 0; ctr < arr.id_pays.length; ctr++) {
        var statut = "";
        var tr = $("<tr></tr>");
        var th = $("<th scope='row' class=\"text-center\"></th>").text(ctr + 1);
        var td = $("<td style='width: 40%' class=\"text-center nomPays\"></td>").text(arr.fr[ctr]);
        if (arr.actif[ctr] == 1) {
          statut = "Actif";
        } else {
          statut = "Inactif";
        }
        var td2 = $("<td style='width: 30%' class=\"text-center statut\"></td>").text(statut);
        var td3 = $("<td id=" + arr.id_pays[ctr] + "style='width: 3%' class=\"text-center\"></td>").attr("id", arr.id_pays[ctr]);
        var bt = $("<input class='btn btn-primary BTModif' type='button' style='margin-right:5px;' value='Modifier le statut'>");
        var bt2 = $("<input class='btn btn-secondary BTModifPays' data-toggle='modal' data-target='#modifPaysModal' type='button' value='Modifier le pays'>");

        td3.append(bt, bt2);

        tr.append(th, td, td2, td3);
        //  $("#tblPays tbody").append(tr);
        table.rows.add(tr).draw();
      }
    }
  }

  function pullPays() {
    $.ajax({
      url: 'php/pullPays.php',
      type: 'POST',
      success: function(data) {
        var reponse = $.parseJSON(data);
        remplirTbl(reponse);
      }
    });
  }

  pullPays();

  $(document).on('submit', '#form_addPays', function() {

    var nomPays = $("#nomPays").val();

    if (nomPays == "") {
      alert("Vous devez entrer le nom du pays");
      event.preventDefault()
      return false;
    }

    $.ajax({
      url: "php/addPays.php",
      type: "POST",
      data: {
        nomPays: nomPays
      },
      success: function(data) {
        if (data == "success") {
          alert("Le pays a été ajouté avec succès");
          $("#nomPays").val("");
          $('#addPaysModal').modal('hide');
          pullPays();
        } else if (data == "error_user_exists") {
          alert("Le pays existe déjà");
        } else {
          alert("erreur");
        }
      }
    });
    return false;
  });


  $(document).on('click', '.BTModif', function() {


    if (confirm("Êtes-vous certain de vouloir modifier le statut du pays ?")) {

      var id = $(this).parent().attr("id");

      var statut = $(event.target)
        .closest("tr").find(".statut")
        .text();

      $.ajax({
        url: "php/modifStatutPays.php",
        type: "POST",
        data: {
          id: id,
          statut: statut
        },
        success: function(data) {
          alert(data);
          pullPays();
        }
      });
      return false;
    }
  });

  $(document).on('submit', '#form_modifPays', function() {

    var nomPays = $("#nomPaysmod").val();

    if (nomPays == "") {
      alert("Vous devez entrer le nom du pays");
      event.preventDefault()
      return false;
    }

    $.ajax({
      url: "php/modifPays.php",
      type: "POST",
      data: {
        nomPays: nomPays,
        ancienNomPays: ancienNomPays
      },
      success: function(data) {
        if (data == "success") {
          alert("Le pays a été modifié avec succès");
          $('#modifPaysModal').modal('hide');
          pullPays();
        } else if (data == "error_user_exists") {
          alert("Le pays existe déjà");
        } else {
          alert("erreur");
        }
      }
    });
    return false;
  });

  $(document).on('click', '.BTModifPays', function() {

    var nomPays = $(event.target)
      .closest("tr").find(".nomPays")
      .text();
    ancienNomPays = $(event.target)
      .closest("tr").find(".nomPays")
      .text();
    $("#nomPaysmod").val(nomPays);

  });


});