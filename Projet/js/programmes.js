$(document).ready(function() {

  var ancienNomProg = "";

  function remplirTbl(arr) {
    $("#tblProg tbody").html("");

    if (!$.fn.DataTable.isDataTable('#tblProg')) {
      table = $("#tblProg").DataTable({
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


    if (arr.id.length == 0) {
      var tr = $("<tr></tr>");
      var th = $("<td scope='row' class='text-center' colspan='8'></th>").text("Aucun programme trouvé.");

      tr.append(th);


    } else {

      for (var ctr = 0; ctr < arr.id.length; ctr++) {
        var statut = "";
        var tr = $("<tr></tr>");
        var th = $("<th scope='row' class=\"text-center\"></th>").text(ctr + 1);
        var td = $("<td style='width: 40%' class=\"text-center nomProg\"></td>").text(arr.prog[ctr]);
        if (arr.actif[ctr] == 1) {
          statut = "Actif";
        } else {
          statut = "Inactif";
        }
        var td2 = $("<td style='width: 30%' class=\"text-center statut\"></td>").text(statut);
        var td3 = $("<td id=" + arr.id[ctr] + "style='width: 3%' class=\"text-center\"></td>").attr("id", arr.id[ctr]);
        var bt = $("<input class='btn btn-primary BTModif' style='margin-right:5px;' type='button' value='Modifier le statut'>");
        var bt2 = $("<input class='btn btn-secondary BTModifProg' data-toggle='modal' data-target='#modifProgModal' type='button' value='Modifier le programme'>");

        td3.append(bt, bt2);

        tr.append(th, td, td2, td3);
        //  $("#tblProg tbody").append(tr);
        table.rows.add(tr).draw();
      }
    }
  }

  function pullProg() {
    $.ajax({
      url: 'php/pullProg.php',
      type: 'POST',
      success: function(data) {
        var reponse = $.parseJSON(data);
        remplirTbl(reponse);
      }
    });
  }

  pullProg();

  $(document).on('submit', '#form_addProg', function() {

    var nomProg = $("#nomProg").val();

    if (nomProg == "") {
      alert("Vous devez entrer le nom du programme");
      event.preventDefault()
      return false;
    }

    $.ajax({
      url: "php/addProg.php",
      type: "POST",
      data: {
        nomProg: nomProg
      },
      success: function(data) {
        if (data == "success") {
          alert("Le programme a été ajouté avec succès");
          $("#nomProg").val("");
          $('#addProgModal').modal('hide');
          pullProg();
        } else if (data == "error_user_exists") {
          alert("Le programme existe déjà");
        } else {
          alert("erreur");
        }
      }
    });
    return false;
  });


  $(document).on('click', '.BTModif', function() {


    if (confirm("Êtes-vous certain de vouloir modifier le statut du programme ?")) {

      var id = $(this).parent().attr("id");

      var statut = $(event.target)
        .closest("tr").find(".statut")
        .text();

      $.ajax({
        url: "php/modifStatutProg.php",
        type: "POST",
        data: {
          id: id,
          statut: statut
        },
        success: function(data) {
          alert(data);
          pullProg();
        }
      });
      return false;
    }
  });

  $(document).on('submit', '#form_modifProg', function() {

    var nomProg = $("#nomProgmod").val();

    if (nomProg == "") {
      alert("Vous devez entrer le nom du programme");
      event.preventDefault()
      return false;
    }

    $.ajax({
      url: "php/modifProg.php",
      type: "POST",
      data: {
        nomProg: nomProg,
        ancienNomProg: ancienNomProg
      },
      success: function(data) {
        if (data == "success") {
          alert("Le programme a été modifié avec succès");
          $('#modifProgModal').modal('hide');
          pullProg();
        } else if (data == "error_user_exists") {
          alert("Le programme existe déjà");
        } else {
          alert("erreur");
        }
      }
    });
    return false;
  });

  $(document).on('click', '.BTModifProg', function() {

    var nomProg = $(event.target)
      .closest("tr").find(".nomProg")
      .text();
    ancienNomProg = $(event.target)
      .closest("tr").find(".nomProg")
      .text();
    $("#nomProgmod").val(nomProg);

  });


});