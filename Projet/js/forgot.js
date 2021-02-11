var forgot_alert = $('#forgot_alert');
forgot_alert.hide();
var alert_message = $('#alert_message');



$('#frm_forgot').submit(function() {

  var email = $('#email').val();
  var pat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (email == "") {
    forgot_alert.show();
    alert_message.text("Vous devez entrer une adresse courriel");
    event.preventDefault()
    return false;
  }
  if (!pat.test(email)) {
    forgot_alert.show();
    alert_message.text("Veuillez entrer une adresse courriel valide");
    event.preventDefault()
    return false;
  }

  $.post('php/forgot.php', {
    email: email
  }, function(data) {
    if (data == "Un mot de passe temporaire vous a été envoyé par courriel") {
      alert_message.text("Un mot de passe temporaire vous a été envoyé par courriel");
      forgot_alert.show();
      setTimeout(function() {
        window.location = "connection.php";
      }, 4000);
    } else {
      alert_message.text(data);
      forgot_alert.show();
    }
  });
  return false;
});