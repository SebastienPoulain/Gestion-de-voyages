var access = 0;

function display_question(data_id_question, question, data_id_categorie, data_input_option, data_affichage, data_info_sup, pouretu, pourprof, required) {

  var checkedetu = "";
  var checkedprof = "";
  var requis = "";
  if (pouretu == 1 || pouretu == "1") {
    checkedetu = " checked";
  }
  if (pourprof == 1 || pourprof == "1") {
    checkedprof = " checked";
  }
  if (required == 1 || required == "1") {
    requis = " checked";
  }

  var div = $('<div data-id-question="' + data_id_question + '" class="form-group question"></div>');

  var div_check_etu = $('<div class="form-check pouretu"></div>');
  var input_etu = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'pouretu"' + checkedetu + '>');
  var label_etu = $('<label class="form-check-label white" for="' + data_id_question + 'pouretu">pour étudiant</label>');
  div_check_etu.append(input_etu, label_etu);

  var div_check_prof = $('<div class="form-check pourprof"></div>');
  var input_prof = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'pourprof"' + checkedprof + '>');
  var label_prof = $('<label class="form-check-label white" for="' + data_id_question + 'pourprof">pour accompagnateur</label>');
  div_check_prof.append(input_prof, label_prof);

  var close_bt = $('<button data-id-question="' + data_id_question + '" type="button" class="close white" aria-label="Close"></button>');
  var close_span = $('<span aria-hidden="true">&times;</span>');
  close_bt.append(close_span);
  div.append(close_bt);

  var label = $('<label for="question_' + data_id_question + '" class="white">' + question + '</label>');
  var small = $('<small id="info_' + data_id_question + '" class="form-text text-muted">' + data_info_sup + '</small>');

  switch (data_affichage) {
    case "mention":
      var p = $('<p id="question_' + data_id_question + '" class="white font-weight-bold" aria-describedby="info_' + data_id_question + '">' + question + '</p>');

      var div_check_req = $('<div class="form-check req"></div>');
      div.append(p, small, div_check_req);
      break;
    case "download":
      var a = $('<a id="question_' + data_id_question + '" href="' + data_input_option + '" target="_blank" download></a>');
      var input = $('<input type="button" class="btn btn-primary form-control" value="Télécharger" aria-describedby="info_' + data_id_question + '">');
      a.append(input);

      var div_check_req = $('<div class="form-check req"></div>');
      div.append(label, a, small, div_check_req);
      break;
    case "checkbox":
      var options = data_input_option.split(";");
      div.append(label);
      for (var i = 0; i < options.length; i++) {
        var div_check = $('<div id="question_' + data_id_question + '" class="form-check"></div>');
        var input = $('<input class="form-check-input" type="checkbox" value="' + i + '" id="' + data_id_question + options[i] + '">');
        var label1 = $('<label class="form-check-label white" for="' + data_id_question + options[i] + '">' + options[i] + '</label>');
        div_check.append(input, label1);
        div.append(div_check);
      }
      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(small, div_check_req);
      break;
    case "number":
      var options = data_input_option.split(";");
      var input = $('<input id="question_' + data_id_question + '" type="number" min="' + options[0] + '" max="' + options[1] + '" step="' + options[2] + '" class="form-control" aria-describedby="info_' + data_id_question + '">');


      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, input, small, div_check_req);
      break;
    case "date":
      var input = $('<input id="question_' + data_id_question + '" type="date" class="form-control" aria-describedby="info_' + data_id_question + '">');

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, input, small, div_check_req);
      break;
    case "select":
      var options = data_input_option.split(";");
      var select = $('<select class="form-control" id="question_' + data_id_question + '" aria-describedby="info_' + data_id_question + '">');
      for (var i = 0; i < options.length; i++) {
        var option = $('<option>' + options[i] + '</option>');
        select.append(option);
      }

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, select, small, div_check_req);
      break;
    case "upload":
      var input = $('<input id="question_' + data_id_question + '" type="file" class="form-control" aria-describedby="info_' + data_id_question + '">');

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, input, small, div_check_req);
      break;
    case "slider":
      var options = data_input_option.split(";");
      var input = $('<input id="question_' + data_id_question + '" type="range" min="' + options[0] + '" max="' + options[1] + '" step="' + options[2] + '" class="custom-range form-control" aria-describedby="info_' + data_id_question + '">');
      var span = $('<span class="slider_val" style="font-weight: bold; margin-left:2vw;">' + Math.ceil(options[1] / 2) + '</span>');
      label.append(span);

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, input, small, div_check_req);
      break;
    case "texteCourt":
      var input = $('<input id="question_' + data_id_question + '" type="text" class="form-control" maxlength="200" aria-describedby="info_' + data_id_question + '">');

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, input, small, div_check_req);
      break;
    case "texteLong":
      var input = $('<textarea id="question_' + data_id_question + '" class="form-control" rows="3" maxlength="200" aria-describedby="info_' + data_id_question + '"></textarea>');

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, input, small, div_check_req);
      break;
    case "choixMultiple":
      var options = data_input_option.split(";");
      div.append(label);
      for (var i = 0; i < options.length; i++) {
        var div_check = $('<div id="question_' + data_id_question + '" class="form-check"></div>');
        var input = $('<input class="form-check-input" type="radio" value="' + i + '" id="' + data_id_question + options[i] + '" name="' + data_id_question + '">');
        var label1 = $('<label class="form-check-label white" for="' + data_id_question + options[i] + '">' + options[i] + '</label>');
        div_check.append(input, label1);
        div.append(div_check);
      }

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(small, div_check_req);
      break;
    case "couleur":
      var input = $('<input id="question_' + data_id_question + '" type="color" class="form-control" aria-describedby="info_' + data_id_question + '">');

      var div_check_req = $('<div class="form-check req"></div>');
      var input_req = $('<input class="form-check-input" type="checkbox" id="' + data_id_question + 'req"' + requis + '>');
      var label_req = $('<label class="form-check-label white" for="' + data_id_question + 'req">Réponse obligatoire</label>');
      div_check_req.append(input_req, label_req);
      div.append(label, input, small, div_check_req);
      break;
  }
  div.append(div_check_prof, div_check_etu);

  return div;

}

function pullform() {
  $(".formdyn_content").html("Glissez les question ici pour créer le formulaire.");

  $.ajax({
    url: 'php/bilandyn/pullform.php',
    type: 'POST',
    data: {
      page: "appreciation_admin"
    },
    success: function(data) {
      var arr_questions = $.parseJSON(data);

      for (var i = 0; i < arr_questions.length; i++) {
        var question = $('#' + arr_questions[i].questionID);
        question.hide();
        $('.formdyn_content').append(display_question(question.attr("id"), question.text(), question.attr("data-id-categorie"), question.attr("data-input-option"), question.attr("data-affichage"), question.attr("data-info-sup"), arr_questions[i].pouretu, arr_questions[i].pourprof, arr_questions[i].required));
      }

      $(".sortable").sortable({
        containment: "parent",
        tolerance: "pointer",
        scroll: false,
        stop: function(event, ui) {
          var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
          window.scrollTo(0, 0);
          window.scrollTo(scrollLeft, scrollTop);
        }
      });
    }
  });

}

$(document).ready(function() {

  var create_alert = $("#create_alert");
  var alert_message = $("#alert_message");
  create_alert.hide();

  $("#customRange1").change(function() {
    $("#rangeVal").html($("#customRange1").val());
  });

  $('#form_question').change(function() {
    valeur = $("input[name='option']:checked").val();
    if (valeur == 'slider' || valeur == 'number') {
      $("#optionBorder").css("display", "block");
      $("#value_min").css("display", "block");
      $("#value_max").css("display", "block");
      $("#value_step").css("display", "block");
      $("#list_option").css("display", "none");
      $("#fileDiv").css("display", "none");
    }
    if (valeur == 'download') {
      $("#optionBorder").css("display", "block");
      $("#value_min").css("display", "none");
      $("#value_max").css("display", "none");
      $("#value_step").css("display", "none");
      $("#list_option").css("display", "none");
      $("#fileDiv").css("display", "block");
    }
    if (valeur == 'select' || valeur == 'choixMultiple' || valeur == 'checkbox') {
      $("#optionBorder").css("display", "block");
      $("#list_option").css("display", "block");
      $("#fileDiv").css("display", "none");
      $("#value_min").css("display", "none");
      $("#value_max").css("display", "none");
      $("#value_step").css("display", "none");
    }
    if (valeur != 'select' && valeur != 'download' && valeur != 'slider' && valeur != 'number' && valeur != 'choixMultiple' && valeur != 'checkbox') {
      $("#optionBorder").css("display", "none");
      $("#list_option").css("display", "none");
      $("#fileDiv").css("display", "none");
      $("#value_min").css("display", "none");
      $("#value_max").css("display", "none");
      $("#value_step").css("display", "none");
    }
  });

  $(".nouvelleQuestion").hide();
  $(".divModifQuestion").hide();


  $("#mod_form").click(function(event) {
    $("#add_question").removeClass('active');
    $("#modif_question").removeClass('active');
    $(this).addClass('active');
    $(".nouvelleQuestion").hide();
    $(".formdyn_content").show();
    $(".divModifQuestion").hide();
    $("#create_alert").hide();
    $("#laquestion2").hide();
    $("#info_supp2").hide();
    $("#laquestion").hide();
    $("#typeQuestion").hide();
    $("#info_supp").hide();
    $(".menu").show();
    $("#save_form").show();
    $("#statutQuestion").hide();
    pullquestions();
  });

  $("#add_question").click(function(event) {
    $("#mod_form").removeClass('active');
    $("#modif_question").removeClass('active');
    $(this).addClass('active');
    $(".nouvelleQuestion").show();
    $("#laquestion2").hide();
    $('#typeQuestion').find("option").removeAttr("selected");
    $("#info_supp2").hide();
    $("#laquestion").show();
    $("#typeQuestion").show();
    $("#info_supp").show();
    $(".formdyn_content").hide();
    $("#btAjoutQuestion").val("Ajouter");
    $(".menu").hide();
    $(".divModifQuestion").hide();
    $("#save_form").hide();
    $("#statutQuestion").hide();
  });

  $("#modif_question").click(function(event) {
    $('#typeQuestion option:first').prop('selected', true);
    $("#mod_form").removeClass('active');
    $("#add_question").removeClass('active');
    $(this).addClass('active');
    $(".nouvelleQuestion").show();
    $(".newQuestion").hide();
    $("#create_alert").hide();
    $(".formdyn_content").hide();
    $(".menu").show();
    $("#actif").prop("checked", false);
    $("#inactif").prop("checked", false);
    $("#laquestion").hide();
    $("#typeQuestion").hide();
    $("#info_supp").hide();
    $("#laquestion2").show();
    $("#typeQuestion").show();
    $("#info_supp2").show();
    $(".divModifQuestion").show();
    $("#btAjoutQuestion").val("Modifier");
    $("#laquestion2").val("");
    $("#info_supp2").val("");
    $("#texteQuestion").text("Glissez la question à modifier ici");
    $("#options").hide();
    $("#save_form").hide();
    $("#statutQuestion").show();
    pullAllquestions();
  });

  $(".divModifQuestion").droppable({
    accept: ".drag",
    classes: {
      "ui-droppable-active": "ui-state-active",
    },
    drop: function(event, ui) {
      $("#texteQuestion").text(ui.draggable.text());
      $("#laquestion2").val(ui.draggable.text());
      $("#idModif").val(ui.draggable.attr("id"));
      if (ui.draggable.attr("data-statut") == 1) {
        $("#actif").prop("checked", true);
      } else {
        $("#inactif").prop("checked", true);
      }
      $('#typeQuestion').find("option").removeAttr("selected");
      $('#typeQuestion option[value="' + ui.draggable.attr("data-id-categorie") + '"]').attr("selected", "selected");
      $("#info_supp2").val(ui.draggable.attr("data-info-sup"));
    }
  });

  $(document).on('submit', '#form_question', function() {

    if ($("#btAjoutQuestion").val() == "Ajouter") {

      var cat = $('#typeQuestion option:selected').val();
      var question = $("#laquestion").val();
      var option = $("input:radio[name ='option']:checked").val();
      if (question == "") {
        create_alert.show();
        alert_message.text("Vous devez entrer une question");
        event.preventDefault()
        return false;
      }
      if (!$("input:radio[name='option']").is(":checked")) {
        create_alert.show();
        alert_message.text("Vous devez choisir le mode d'affichage");
        event.preventDefault()
        return false;
      }
      var info_supp = $("#info_supp").val();

      if (option == 'download') {
        var file = $('#file').val();
        if ($('#file').get(0).files.length === 0) {
          create_alert.show();
          alert_message.text("Vous devez choisir un document");
          event.preventDefault()
          return false;
        }
      }

      if (option == 'select' || option == "choixMultiple" || option == "checkbox") {
        var listeOption = $('#list-option').val();
        if ($('#list-option').val() == "") {
          create_alert.show();
          alert_message.text("Vous devez entrer au moins une option");
          event.preventDefault()
          return false;
        }
      }

      if (option == 'slider' || option == "number") {
        var valMin = $('#value-min').val();
        var valMax = $('#value-max').val();
        var valStep = $('#value-step').val();
        if ($('#value-min').val() == "") {
          create_alert.show();
          alert_message.text("Vous devez entrer la valeur minimale");
          event.preventDefault()
          return false;
        }
        if ($('#value-min').val() < 0) {
          create_alert.show();
          alert_message.text("Vous devez entrer une valeur minimale de 0 et plus");
          event.preventDefault()
          return false;
        }
        if ($('#value-max').val() == "") {
          create_alert.show();
          alert_message.text("Vous devez entrer la valeur maximale");
          event.preventDefault()
          return false;
        }
        if ($('#value-max').val() <= 0) {
          create_alert.show();
          alert_message.text("Vous devez entrer une valeur maximale supérieure à 0");
          event.preventDefault()
          return false;
        }
        if ($('#value-step').val() == "") {
          create_alert.show();
          alert_message.text("Vous devez entrer l'interval entre deux valeurs");
          event.preventDefault()
          return false;
        }
        if ($('#value-step').val() <= 0) {
          create_alert.show();
          alert_message.text("Vous devez entrer un interval supérieur à 0");
          event.preventDefault()
          return false;
        }
        if ($('#value-min').val() > $('#value-max').val()) {
          create_alert.show();
          alert_message.text("La valeur minimum doit être inférieure à la valeur maximale");
          event.preventDefault()
          return false;
        }

      }
      $.ajax({
        url: "php/bilandyn/addquestion.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          create_alert.show();
          alert_message.text(data);
          if (data == "La question a été ajouté avec succès") {
            $("#laquestion").val("");
            $("#info_supp").val("");
            $('#file').val("");
            $('#list-option').val("");
            $('#value-min').val("0");
            $('#value-max').val("100");
            $('#value-step').val("1");
            $("#optionBorder").css("display", "none");
            $("#list_option").css("display", "none");
            $("#fileDiv").css("display", "none");
            $("#value_min").css("display", "none");
            $("#value_max").css("display", "none");
            $("#value_step").css("display", "none");
            $('#typeQuestion option:first').prop('selected', true);
            $('input[name="option"]').prop('checked', false);
            setTimeout(function() {
              create_alert.hide();
              alert_message.text("");
            }, 4000);
          }
        }
      });
      return false;
    } else if ($("#btAjoutQuestion").val() == "Modifier") {

      if ($('#laquestion2').val() == "") {
        alert("Vous devez entrer une question");
        event.preventDefault()
        return false;
      }
      if (!$("input:radio[name='statut']").is(":checked")) {
        alert("Vous devez choisir le statut de la question");
        event.preventDefault()
        return false;
      }
      var q = $('#laquestion2').val();
      var info = $("#info_supp2").val();
      var id = $("#idModif").val();
      var cat = $('#typeQuestion option:selected').val();
      var statut = $("input:radio[name ='statut']:checked").val();
      var ancienq = $("#texteQuestion").text();

      $.ajax({
        url: "php/bilandyn/modifquestion.php",
        type: "POST",
        data: {
          info: info,
          id: id,
          q: q,
          statut: statut,
          cat: cat,
          ancienq: ancienq
        },
        success: function(data) {
          if (data == "La question a été modifiée avec succès") {
            $("#laquestion2").val("");
            $("#info_supp2").val("");
            $("#texteQuestion").text("Glissez la question à modifier ici");
            $('#typeQuestion option:first').prop('selected', true);
            $('input[name="statut"]').prop('checked', false);
            pullAllquestions();
          }
          alert(data);
        }
      });

      return false;
    }
  });

  function pullquestions() {

    $("#ls_cat").html("");

    $.ajax({
      url: 'php/bilandyn/pullcat.php',
      type: 'POST',
      success: function(data) {
        data = $.parseJSON(data);
        var ls_cat = $("#ls_cat");

        for (var i = 0; i < data.length; i++) {
          var a = $('<a data-toggle="collapse" href="#collapseCat' + data[i].id + '" role="button" aria-expanded="false" aria-controls="collapseCat' + data[i].id + '">' + data[i].categorie + '</a>');
          var li = $('<li class="list-group-item"></li>');
          var div = $('<div class="collapse" id="collapseCat' + data[i].id + '"></div>');
          var ul = $('<ul data-id-categorie="' + data[i].id + '" class="list-group">');

          li.append(a);
          ls_cat.append(li);
          div.append(ul);
          ls_cat.append(div);
        }

        $.ajax({
          url: 'php/bilandyn/pullquestions.php',
          type: 'POST',
          success: function(data1) {
            data = $.parseJSON(data1);

            for (var i = 0; i < data.length; i++) {
              var li = $('<li id="' + data[i].id + '" data-id-categorie="' + data[i].id_categorie + '" data-input-option="' + data[i].input_option + '" data-affichage="' + data[i].affichage + '" data-info-sup="' + data[i].info_sup + '" class="list-group-item drag">' + data[i].question + '</li>');

              $('ul[data-id-categorie="' + data[i].id_categorie + '"]').append(li);
            }

            $(".drag").draggable({
              revert: "invalid",
              cursor: "grabbing",
              drag: function(event, ui) {
                $(event.target).css('cursor', '-webkit-grabbing');
                $(event.target).css('cursor', 'grabbing');
              },
              stop: function(event, ui) {
                $(event.target).css('-webkit-grab', 'grab');
                $(event.target).css('cursor', 'grab');
              },
              appendTo: 'body',
              helper: 'clone'
            });
            if (access == 1) {
              pullform();
            }
          }
        });
      }
    });
  }

  function pullAllquestions() {

    $("#ls_cat").html("");

    $.ajax({
      url: 'php/bilandyn/pullallcat.php',
      type: 'POST',
      success: function(data) {
        data = $.parseJSON(data);
        var ls_cat = $("#ls_cat");

        for (var i = 0; i < data.length; i++) {
          var a = $('<a data-toggle="collapse" href="#collapseCat' + data[i].id + '" role="button" aria-expanded="false" aria-controls="collapseCat' + data[i].id + '">' + data[i].categorie + '</a>');
          var li = $('<li class="list-group-item"></li>');
          var div = $('<div class="collapse" id="collapseCat' + data[i].id + '"></div>');
          var ul = $('<ul data-id-categorie="' + data[i].id + '" class="list-group">');

          li.append(a);
          ls_cat.append(li);
          div.append(ul);
          ls_cat.append(div);
        }

        $.ajax({
          url: 'php/bilandyn/pullallquestions.php',
          type: 'POST',
          success: function(data1) {
            data = $.parseJSON(data1);

            for (var i = 0; i < data.length; i++) {
              var li = $('<li id="' + data[i].id + '" data-id-categorie="' + data[i].id_categorie + '" data-input-option="' + data[i].input_option + '" data-affichage="' + data[i].affichage + '" data-statut="' + data[i].actif + '" data-info-sup="' + data[i].info_sup + '" class="list-group-item drag">' + data[i].question + '</li>');

              $('ul[data-id-categorie="' + data[i].id_categorie + '"]').append(li);
            }

            $(".drag").draggable({
              revert: "invalid",
              cursor: "grabbing",
              drag: function(event, ui) {
                $(event.target).css('cursor', '-webkit-grabbing');
                $(event.target).css('cursor', 'grabbing');
              },
              stop: function(event, ui) {
                $(event.target).css('-webkit-grab', 'grab');
                $(event.target).css('cursor', 'grab');
              },
              appendTo: 'body',
              helper: 'clone'
            });
          }
        });
      }
    });
  }

  $(".formdyn_content").delegate('input[type=range]', 'change', function(event) {
    $(event.target).parent('div').find('.slider_val').text($(event.target).val());
  });

  $(".formdyn_content").delegate('.close', 'click', function(event) {
    var id = $(this).attr('data-id-question');
    $(this).parent("div").remove();
    $('#' + id).show();
  });

  $(".formdyn_content").droppable({
    accept: ".drag",
    classes: {
      "ui-droppable-active": "ui-state-active",
      //"ui-droppable-hover": "ui-state-hover"
    },
    drop: function(event, ui) {
      ui.draggable.hide();
      $('.formdyn_content').append(display_question(ui.draggable.attr("id"), ui.draggable.text(), ui.draggable.attr("data-id-categorie"), ui.draggable.attr("data-input-option"), ui.draggable.attr("data-affichage"), ui.draggable.attr("data-info-sup"), 1, 1, 0));
      $(".sortable").sortable({
        containment: "parent",
        tolerance: "pointer",
        scroll: false,
        stop: function(event, ui) {
          var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
          window.scrollTo(0, 0);
          window.scrollTo(scrollLeft, scrollTop);
        }
      });
    }
  });

  function save_form(json_questions) {
    $.ajax({
      url: 'php/bilandyn/saveform.php',
      type: 'POST',
      data: {
        questions: json_questions
      },
      success: function(data) {

        if (data == "success") {
          alert("Formulaire sauvegardé pour ce projet");
        } else {
          alert("Erreur, impossible de détecter le projet sélectionné");
        }
      }
    });
  }

  $("#save_form").click(function(event) {
    var id_questions = [];

    $('.question').each(function(index, el) {
      var pouretu = 0;
      var pourprof = 0;
      var required = 0;

      if ($(el).find('.pouretu').find('input[type=checkbox]').is(':checked')) {
        pouretu = 1;
      }

      if ($(el).find('.pourprof').find('input[type=checkbox]').is(':checked')) {
        pourprof = 1;
      }

      if ($(el).find('.req').find('input[type=checkbox]').is(':checked')) {
        required = 1;
      }

      var question = {
        id_question: $(el).attr('data-id-question'),
        pouretu: pouretu,
        pourprof: pourprof,
        required: required
      };

      id_questions.push(question);
    });

    save_form(JSON.stringify(id_questions));
  });

  pullquestions();

});