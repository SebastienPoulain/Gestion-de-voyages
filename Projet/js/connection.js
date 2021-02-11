var connexion_alert = $('#connexion_alert');
connexion_alert.hide();
var alert_message = $('#alert_message');
var username = $('#tbUsername');
var password = $('#tbPassword');

var btConnexion = $('#btConnexion');

username.change(function() {
  checkUsername();
});

password.change(function() {
  checkPassword();
})

btConnexion.click(function() {
  checkFields();
})

function checkFields() {
  checkUsername();
  checkPassword();
}

function checkUsername() {
  if ((username.val().trim() != "")) {
    username.removeClass("is-invalid");
    username.addClass("is-valid");
    return true;
  }

  username.removeClass("is-valid");
  username.addClass("is-invalid");
  showErrorMessage();
  return false;
}

function checkPassword() {
  if ((password.val().trim() != "") && (password.val() != null)) {
    password.removeClass("is-invalid");
    password.addClass("is-valid");
    return true;
  }

  password.removeClass("is-valid");
  password.addClass("is-invalid");
  showErrorMessage();
  return false;
}


function showErrorMessage() {
  alert_message.text("Veuillez remplir tous les champs");
  connexion_alert.show();
}

function hideErrorMessage() {
  connexion_alert.hide();
}

$('#frm_connexion').submit(function() {
  var username = Fonction.escapeHtml($('#tbUsername').val());
  var passwd = Fonction.escapeHtml($('#tbPassword').val());

  if (checkUsername() && checkPassword()) {
    $.post('php/login.php', {
      usr: username,
      passwd: passwd
    }, function(data) {
      if (data == "success") {
        window.location = "main.php?page=projets";
      } else if (data == "error") {
        showErrorMessage();
        alert_message.text("Nom d'utilisateur ou mot de passe invalide");
      } else {
        showErrorMessage();
        alert_message.text("Erreur de connexion à la base de donnée");
      }
    });
  }
  return false;
});