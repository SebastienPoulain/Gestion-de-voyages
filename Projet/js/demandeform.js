var page;
var ctr = 1;

function display_question(data_id_question, question, data_id_categorie, data_input_option, data_affichage, data_info_sup, required) {
  var requis = "";

  if (required == 1 || required == "1") {
    requis = " required";
  }

  var div = $('<div data-id-question="' + data_id_question + '" data-affichage="' + data_affichage + '" class="form-group question"></div>');

  var label = $('<label for="question_' + data_id_question + '" class="white">' + question + '</label>');
  var small = $('<small id="info_' + data_id_question + '" class="form-text text-muted">' + data_info_sup + '</small>');

  switch (data_affichage) {
    case "mention":
      var p = $('<p id="question_' + data_id_question + '" class="white font-weight-bold" aria-describedby="info_' + data_id_question + '">' + question + '</p>');
      div.append(p, small);
      break;
    case "download":
      var a = $('<a id="question_' + data_id_question + '" href="' + data_input_option + '" target="_blank" download></a>');
      var input = $('<input type="button" class="btn btn-primary form-control" value="Télécharger" aria-describedby="info_' + data_id_question + '">');
      a.append(input);
      div.append(label, a, small);
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
      div.append(small);
      break;
    case "number":
      var options = data_input_option.split(";");
      var input = $('<input id="question_' + data_id_question + '" type="number" min="' + options[0] + '" max="' + options[1] + '" step="' + options[2] + '" class="form-control" aria-describedby="info_' + data_id_question + '"' + requis + '>');
      div.append(label, input, small);
      break;
    case "date":
      var input = $('<input id="question_' + data_id_question + '" type="date" class="form-control" aria-describedby="info_' + data_id_question + '"' + requis + '>');
      div.append(label, input, small);
      break;
    case "select":
      var options = data_input_option.split(";");
      var select = $('<select class="form-control" id="question_' + data_id_question + '" aria-describedby="info_' + data_id_question + '"' + requis + '>');
      for (var i = 0; i < options.length; i++) {
        var option = $('<option>' + options[i] + '</option>');
        select.append(option);
      }
      div.append(label, select, small);
      break;
    case "upload":
      if (page == "viewdemande") {
        var a = $('<a id="question_' + data_id_question + '" href="" target="_blank" download></a>');
        var input = $('<input type="button" class="btn btn-primary form-control" value="Télécharger le fichier remis" aria-describedby="info_' + data_id_question + '">');
        a.append(input);
        div.append(label, a, small);
      } else {
        var input = $('<input id="question_' + data_id_question + '" type="file" class="form-control" aria-describedby="info_' + data_id_question + '"' + requis + '>');
        div.append(label, input, small);
      }
      break;
    case "slider":
      var options = data_input_option.split(";");
      var input = $('<input id="question_' + data_id_question + '" type="range" min="' + options[0] + '" max="' + options[1] + '" step="' + options[2] + '" class="custom-range form-control" aria-describedby="info_' + data_id_question + '"' + requis + '>');
      var span = $('<span class="slider_val" style="font-weight: bold; margin-left:2vw;">' + Math.ceil(options[1] / 2) + '</span>');
      label.append(span);
      div.append(label, input, small);
      break;
    case "texteCourt":
      var input = $('<input id="question_' + data_id_question + '" type="text" class="form-control" maxlength="200" aria-describedby="info_' + data_id_question + '"' + requis + '>');
      div.append(label, input, small);
      break;
    case "texteLong":
      var input = $('<textarea id="question_' + data_id_question + '" class="form-control" rows="3" maxlength="200" aria-describedby="info_' + data_id_question + '"' + requis + '></textarea>');
      div.append(label, input, small);
      break;
    case "choixMultiple":
      var options = data_input_option.split(";");
      div.append(label);
      for (var i = 0; i < options.length; i++) {
        var div_check = $('<div id="question_' + data_id_question + '" class="form-check"></div>');
        var input = $('<input class="form-check-input" type="radio" value="' + i + '" id="' + data_id_question + options[i] + '" name="' + data_id_question + '"' + requis + '>');
        var label1 = $('<label class="form-check-label white" for="' + data_id_question + options[i] + '">' + options[i] + '</label>');
        div_check.append(input, label1);
        div.append(div_check);
      }
      div.append(small);
      break;
    case "couleur":
      var input = $('<input id="question_' + data_id_question + '" type="color" class="form-control" aria-describedby="info_' + data_id_question + '"' + requis + '>');
      div.append(label, input, small);
      break;
  }

  return div;

}

function pullform() {
  $('.form_content').html("");

  $.ajax({
    url: 'php/demandedyn/pullform.php',
    type: 'POST',
    data: {
      page: page
    },
    success: function(data) {
      var arr_questions = $.parseJSON(data);

      for (var i = 0; i < arr_questions.length; i++) {
        $('.form_content').append(display_question(arr_questions[i].id, arr_questions[i].question, arr_questions[i].id_categorie, arr_questions[i].input_option, arr_questions[i].affichage, arr_questions[i].info_sup, arr_questions[i].required));
      }
      /*
            if (page == "viewdemande") {
              $(".form_content").find('input').prop('disabled', true);
              $(".form_content").find('input[type="button"]').prop('disabled', false);
              $(".form_content").find('textarea').prop('disabled', true);
              $(".form_content").find('select').prop('disabled', true);
            }*/

      //pullresponses();
    }
  });
}

function pushform(arr_responses) {
  $.ajax({
    url: 'php/formulaire/pushdemanderesponses.php',
    type: 'POST',
    data: {
      responses: arr_responses
    },
    success: function(data) {
      var response = $.parseJSON(data);

      alert(response.message);
    }
  });

}

function getArrResponses() {
  var arr_reponses = [];
  var arr_activites = [];
  var arr_datesactivites = [];
  var reponse;

  reponse = {
    title: $("#proj_title").val(),
    destination: $("#proj_dest option:selected").text(),
    precisions: $("#proj_precdest").val(),
    programme: $("#proj_prog option:selected").val(),
    dateD: $("#proj_dated").val(),
    dateR: $("#proj_dater").val()
  };

  arr_reponses.push(reponse);

  $('.activites').find('input').each(function(index, el) {
    var id = $(el).attr('id').replace("activite", "");

    arr_activites.push($(el).val());
    arr_datesactivites.push($('#date_activite' + id).val());
  });

  reponse = {
    activites: arr_activites,
    dates_activites: arr_datesactivites
  };

  arr_reponses.push(reponse);

  $(".question").each(function(index, el) {
    switch ($(el).attr('data-affichage')) {
      case "checkbox":
        var arr_check = [];
        $(el).find('.form-check').each(function(index, el) {
          var input = $(el).find('.form-check-input');
          if (input.is(':checked')) {
            arr_check.push(input.val());
          }
        });
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: arr_check.join(';')
        };
        arr_reponses.push(reponse);
        break;

      case "number":
        var nb = $(el).find('input[type=number]');
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: nb.val()
        };
        arr_reponses.push(reponse);
        break;

      case "date":
        var date = $(el).find('input[type=date]');
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: date.val()
        };
        arr_reponses.push(reponse);
        break;

      case "select":
        var selection = $(el).find('select');
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: selection.val()
        };
        arr_reponses.push(reponse);
        break;

      case "upload":
        if (page == "viewdemande") {
          var date = new Date();
          var strDate = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate() + ' ' + date.getHours() + date.getMinutes() + date.getSeconds() + date.getMilliseconds();

          var fd = new FormData();
          fd.append("file", $(el).find('input').prop('files')[0]);
          fd.append("date", strDate);

          $.ajax({
            url: 'php/upload.php',
            processData: false,
            contentType: false,
            cache: false,
            type: 'POST',
            data: fd,
            success: function(data) {
              alert(data)
            }
          });

          reponse = {
            question: $(el).attr('data-id-question'),
            reponse: strDate + " " + $(el).find('input').prop('files')[0].name
          };

          arr_reponses.push(reponse);
        }
        break;

      case "slider":
        var nb = $(el).find('input[type=range]');
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: nb.val()
        };
        arr_reponses.push(reponse);
        break;

      case "texteCourt":
        var text = $(el).find('input[type=text]');
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: text.val()
        };
        arr_reponses.push(reponse);
        break;

      case "texteLong":
        var textarea = $(el).find('input[type=textarea]');
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: textarea.val()
        };
        arr_reponses.push(reponse);
        break;

      case "choixMultiple":
        var choice = $('input[name="' + $(el).attr('data-id-question') + '"]:checked').val();
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: choice
        };
        arr_reponses.push(reponse);
        break;

      case "couleur":
        var color = $(el).find('input[type=color]');
        reponse = {
          question: $(el).attr('data-id-question'),
          reponse: color.val()
        };
        arr_reponses.push(reponse);
        break;
    }
  });
  return JSON.stringify(arr_reponses);
}

function pullresponses() {
  $.ajax({
    url: 'php/formulaire/pulldemanderesponses.php',
    type: 'POST',
    success: function(data) {
      var msg = $.parseJSON(data);

      if (msg[0].state == "success") {

        setresponses(msg);

      } else {
        alert(msg[0].message);
      }
    }
  });
}

function setresponses(msg) {

  $("#proj_title").val(msg[1].titre);
  $("#proj_dest option:contains('" + msg[1].destination + "')").attr('selected', 'selected');
  $("#proj_precdest").val(msg[1].precisionDestination);
  $("#proj_dest option[value='" + msg[1].programme + "']").attr('selected', 'selected');
  $("#proj_dated").val(msg[1].dateD);
  $("#proj_dater").val(msg[1].dateR);

  for (var i = 0; i < msg[3].length; i++) {
    if (i > 0) {
      addActivite();
    }
    $('#activite' + i).val(msg[3][i].activites);
    $('#date_activite' + i).val(msg[3][i].dates);
  }

  var responses = msg[2];
  for (var i = 0; i < responses.length; i++) {
    var question = $("div[data-id-question='" + responses[i].questionID + "']");
    switch (question.attr('data-affichage')) {

      case "checkbox":
        var rep = responses[i].reponse.split(";");
        for (var ctr = 0; ctr < rep.length; ctr++) {
          question.find("input[value='" + rep[ctr] + "']").prop('checked', true);
        }
        break;

      case "number":
        question.find('input').val(responses[i].reponse);
        break;

      case "date":
        question.find('input').val(responses[i].reponse);
        break;

      case "select":
        question.find('select').val(responses[i].reponse);
        break;

      case "slider":
        question.find('input').val(responses[i].reponse);
        question.find('.slider_val').html(responses[i].reponse);
        break;

      case "texteCourt":
        question.find('input').val(responses[i].reponse);
        break;

      case "texteLong":
        question.find('textarea').val(responses[i].reponse);
        break;

      case "choixMultiple":
        question.find("input[value='" + responses[i].reponse + "']").prop('checked', true);
        break;

      case "couleur":
        question.find('textarea').val(responses[i].reponse);
        break;

      case "upload":
        if (page == "viewdemande") {
          question.find('a').attr('href', responses[i].reponse);
        }
        break;

    }
  }
}

function pullpays() {
  $.ajax({
    url: 'php/pullPays.php',
    type: 'POST',
    success: function(data) {
      var responses = $.parseJSON(data);

      for (var i = 0; i < responses.id_pays.length; i++) {
        if (responses.actif[i] == "1") {
          var option = $("<option value='" + responses.id_pays[i] + "'>" + responses.fr[i] + "</option>");
          $("#proj_dest").append(option);
        }
      }

      pullprogrammes();
    }
  });
}

function pullprogrammes() {
  $.ajax({
    url: 'php/pullProg.php',
    type: 'POST',
    success: function(data) {
      var responses = $.parseJSON(data);

      for (var i = 0; i < responses.id.length; i++) {
        if (responses.actif[i] == "1") {
          var option = $("<option value='" + responses.id[i] + "'>" + responses.prog[i] + "</option>");
          $("#proj_prog").append(option);
        }
      }

      pullresponses();
    }
  });
}

function addActivite() {
  var input = $('<input id="activite' + ctr + '" class="form-control" type="text" style="margin-bottom: 10px;" required>');
  var input_date = $('<input id="date_activite' + ctr + '" class="form-control" type="date" style="margin-bottom: 10px;" required>');

  $('.activites').append(input);
  $('.dates-activites').append(input_date);

  ctr++;
}

function delActivite() {
  ctr--;
  $('#activite' + ctr).remove();
  $('#date_activite' + ctr).remove();
}

$(document).ready(function() {
  $('#save_form').click(function(event) {
    var stop = false;
    $('input').each(function(index, el) {
      if ($(el).attr('required') && $(el).val().trim() == "") {
        $(el).addClass('is-invalid');
        stop = true;
      }
    });

    if (!stop) {
      pushform(getArrResponses());
    } else {
      alert("Veuillez compléter tous les champs obligatoires");
    }
  });

  $('.midSection').delegate('input', 'change', function(event) {
    $(event.target).removeClass('is-invalid');
  });

  $(".form_content").delegate('input[type=range]', 'change', function(event) {
    $(event.target).parent('div').find('.slider_val').text($(event.target).val());
  });

  $('#addActivite').click(function(event) {
    addActivite();
  });

  $('#delActivite').click(function(event) {
    delActivite();
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

  $("#proj_dated").attr('min', today);
  $("#proj_dated").attr('max', troisAns);
  $("#proj_dater").attr('min', today);
  $("#proj_dater").attr('max', troisAns);

  $(".dates-activites").delegate('input', 'click', function(event) {
    $(".dates-activites").find("input").attr('min', $("#proj_dated").val());
    $(".dates-activites").find("input").attr('max', $("#proj_dater").val());
  });

  $("#proj_dated").change(function(event) {
    var startDt = document.getElementById("proj_dated").value;
    var endDt = document.getElementById("proj_dater").value;

    if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {
      $("#proj_dated").val("");
    }
  });

  $("#proj_dater").change(function(event) {
    var startDt = document.getElementById("proj_dated").value;
    var endDt = document.getElementById("proj_dater").value;

    if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {
      $("#proj_dated").val("");
    }
  });

  pullpays();

});
