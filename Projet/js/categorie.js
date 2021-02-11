$(document).ready(function() {

  var ancienNomCat = "";

  function remplirTbl(arr) {
    $("#tblCat tbody").html("");

    if (!$.fn.DataTable.isDataTable('#tblCat')) {
      table = $("#tblCat").DataTable({
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
      var th = $("<td scope='row' class='text-center' colspan='8'></th>").text("Aucune catégorie trouvée.");

      tr.append(th);

      //  $("#tblCat tbody").append(tr);

    } else {

      for (var ctr = 0; ctr < arr.id.length; ctr++) {
        var statut = "";
        var tr = $("<tr></tr>");
        var th = $("<th scope='row' class=\"text-center\"></th>").text(ctr + 1);
        var td = $("<td style='width: 40%' class=\"text-center nomCat\"></td>").text(arr.categorie[ctr]);
        if (arr.actif[ctr] == 1) {
          statut = "Actif";
        } else {
          statut = "Inactif";
        }
        var td2 = $("<td style='width: 30%' class=\"text-center statut\"></td>").text(statut);
        var td3 = $("<td id=" + arr.id[ctr] + "style='width: 3%' class=\"text-center\"></td>").attr("id", arr.id[ctr]);
        var bt = $("<input class='btn btn-primary BTModif' style='margin-right:5px;' type='button' value='Modifier le statut'>");
        var bt2 = $("<input class='btn btn-secondary BTModifCat' data-toggle='modal' data-target='#modifCatModal' type='button' value='Modifier la catégorie'>");

        td3.append(bt, bt2);

        tr.append(th, td, td2, td3);
        //  $("#tblCat tbody").append(tr);
        table.rows.add(tr).draw();
      }
    }
  }


  function pullCategories() {
    $.ajax({
      url: 'php/pullCategories.php',
      type: 'POST',
      success: function(data) {
        var reponse = $.parseJSON(data);
        remplirTbl(reponse);
      }
    });
  }

  pullCategories();

  $(document).on('submit', '#form_addCat', function() {

    var nomCat = $("#nomCat").val();

    if (nomCat == "") {
      alert("Vous devez entrer le nom de la catégorie");
      event.preventDefault()
      return false;
    }

    $.ajax({
      url: "php/addCategorie.php",
      type: "POST",
      data: {
        nomCat: nomCat
      },
      success: function(data) {
        if (data == "success") {
          alert("La catégorie a été ajoutée avec succès");
          $("#nomCat").val("");
          $('#addCatModal').modal('hide');
          pullCategories();
        } else if (data == "error_user_exists") {
          alert("La catégorie existe déjà");
        } else {
          alert("erreur");
        }
      }
    });
    return false;
  });


  $(document).on('click', '.BTModif', function() {

    if (confirm("Êtes-vous certain de vouloir modifier le statut de la catégorie ?")) {
      var id = $(this).parent().attr("id");

      var statut = $(event.target)
        .closest("tr").find(".statut")
        .text();

      $.ajax({
        url: "php/modifStatutCategorie.php",
        type: "POST",
        data: {
          id: id,
          statut: statut
        },
        success: function(data) {
          alert(data);
          pullCategories();
        }
      });
      return false;
    }
  });

  $(document).on('submit', '#form_modifCat', function() {

    var nomCat = $("#nomCatmod").val();

    if (nomCat == "") {
      alert("Vous devez entrer le nom de la catégorie");
      event.preventDefault()
      return false;
    }

    $.ajax({
      url: "php/modifCategorie.php",
      type: "POST",
      data: {
        nomCat: nomCat,
        ancienNomCat: ancienNomCat
      },
      success: function(data) {
        if (data == "success") {
          alert("La catégorie a été modifiée avec succès");
          $('#modifCatModal').modal('hide');
          pullCategories();
        } else if (data == "error_user_exists") {
          alert("La catégorie existe déjà");
        } else {
          alert("erreur");
        }
      }
    });
    return false;
  });

  $(document).on('click', '.BTModifCat', function() {

    var nomCat = $(event.target)
      .closest("tr").find(".nomCat")
      .text();
    ancienNomCat = $(event.target)
      .closest("tr").find(".nomCat")
      .text();
    $("#nomCatmod").val(nomCat);

  });


});