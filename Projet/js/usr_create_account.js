var create_alert = $("#create_alert");
var alert_message = $("#alert_message");
create_alert.hide();

var tbCode = $('#tbCode');
tbCode.mask('CCCC-CCCC', {
  'translation': {
    C: {
      pattern: /[A-Za-z0-9]/
    },
  },
  placeholder: "ex: 12AB-CD3E"
});
var tbUsername = $('#tbUsername');
var tbPassword = $('#tbPassword');
var tbNom = $('#tbNom');
var tbPrenom = $('#tbPrenom');
var tbEmail = $('#tbEmail');
var tbConfirmPassword = $('#tbConfirmPassword');
var btCreateAccount = $('#btCreateAccount');
var form = $('frm_register');
var tbSexe = $('#tbSexe');
var tbTel = $('#tbTel');
tbTel.mask('(CCC) CCC-CCCC', {
  'translation': {
    C: {
      pattern: /[0-9]/
    },
  },
  placeholder: "ex: (819) 345-1854"
});

$("#tbCode").blur(function() {
  tbCode.val(tbCode.val().toUpperCase());
});

//TODO
//FAIRE LA VALIDATION QUE LE CODE DE VALIDATION ENTRER EXISTE


$('#frm_register').submit(function(event) {
  var username = Fonction.escapeHtml($('#tbUsername').val());
  var passwd = Fonction.escapeHtml($('#tbPassword').val());
  var passConf = Fonction.escapeHtml($('#tbConfirmPassword').val());
  var code = $('#tbCode').cleanVal();
  var email = $('#tbEmail').val();
  var tel = $('#tbTel').val();
  var prog = $('#tbProg').val();
  var nom = $('#tbNom').val();
  var prenom = $('#tbPrenom').val();
  var sexe = $("input[name='sexe']:checked").val();
  var ok = false;
  var pat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (code == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre code de projet");
    event.preventDefault()
    return false;
  }
  if (prog == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre nom de programme");
    event.preventDefault()
    return false;
  }
  if (prenom == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre prénom");
    event.preventDefault()
    return false;
  }
  if (nom == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre nom");
    event.preventDefault()
    return false;
  }
  if ($("#tbHomme").prop("checked") || $("#tbFemme").prop("checked") || $("#tbAutre").prop("checked")) {
    ok = true;
  } else {
    create_alert.show();
    alert_message.text("Vous devez choisir votre sexe");
    event.preventDefault()
    return false;
  }
  if (username == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre nom d'utilisateur");
    event.preventDefault()
    return false;
  }
  if (email == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre adresse courriel");
    event.preventDefault()
    return false;
  }
  if (!pat.test(email)) {
    create_alert.show();
    alert_message.text("Veuillez entrer une adresse courriel valide");
    event.preventDefault()
    return false;
  }
  if (tel == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre numéro de téléphone");
    event.preventDefault()
    return false;
  }
  if (tel.length != 14) {
    create_alert.show();
    alert_message.text("Format du numéro de téléphone incorrect");
    event.preventDefault()
    return false;
  }
  if (passwd == "") {
    create_alert.show();
    alert_message.text("Vous devez entrer votre mot de passe");
    event.preventDefault()
    return false;
  }
  if (passConf == "") {
    create_alert.show();
    alert_message.text("Vous devez confirmer votre mot de passe");
    event.preventDefault()
    return false;
  }
  if (passConf != passwd) {
    create_alert.show();
    alert_message.text("Vous devez entrer le même mot de passe");
    event.preventDefault()
    return false;
  }
  $.post('php/register.php', {
    usr: username,
    prog: prog,
    prenom: prenom,
    nom: nom,
    sexe: sexe,
    tel: tel,
    passwd: passwd,
    passConf: passConf,
    email: email,
    code: code
  }, function(data) {
    if (data == "success") {
      create_alert.show();
      alert_message.text("Votre compte a été créé avec succès");
      setTimeout(function() {
        window.location = "connection.php";
      }, 4000);
    } else if (data == "errorBD") {
      alert_message.text("Erreur de base de données");
      create_alert.show();
    } else {
      create_alert.show();
      alert_message.text(data);
    }
  });
  return false;
});