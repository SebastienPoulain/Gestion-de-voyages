var page;

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
      if (page == "viewBilan") {
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
    url: 'php/bilandyn/pullform.php',
    type: 'POST',
    data: {
      page: page
    },
    success: function(data) {
      var arr_questions = $.parseJSON(data);

      for (var i = 0; i < arr_questions.length; i++) {
        $('.form_content').append(display_question(arr_questions[i].id, arr_questions[i].question, arr_questions[i].id_categorie, arr_questions[i].input_option, arr_questions[i].affichage, arr_questions[i].info_sup, arr_questions[i].required));
      }

      if (page == "viewBilan") {
        $(".form_content").find('input').attr('readonly', true);
        $(".form_content").find('input[type="button"]').attr('readonly', false);
        $(".form_content").find('textarea').attr('readonly', true);
        $(".form_content").find('select').attr('readonly', true);
      }

      pullresponses();
    }
  });
}

function pushform(arr_responses) {
  $.ajax({
    url: 'php/formulaire/pushformbilanresponses.php',
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
  var reponse;
  $(".question").each(function(index, el) {
    switch ($(el).attr('data-affichage')) {
      case "checkbox":
        var arr_check = [];
        $(el).find('.form-check').each(function(index, el) {
          var input = $(el).find('.form-check-input');
          if (input.is(":checked")) {
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
        if (page == "viewBilan") {
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
    url: 'php/formulaire/pullbilanresponses.php',
    type: 'POST',
    data: {
      page: page
    },
    success: function(data) {
      var msg = $.parseJSON(data);
      var responses = msg[1];

      if (msg[0].state == "success") {

        setresponses(responses);
      } else {
        alert(msg[0].message);
      }
    }
  });
}

function setresponses(responses) {
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
        if (page == "viewBilan") {
          question.find('a').attr('href', responses[i].reponse);
        }
        break;

    }
  }
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

});
