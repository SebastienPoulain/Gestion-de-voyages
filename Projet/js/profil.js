$(document).ready(function() {

  $("#form_changepass").submit(function(event) {

    var oldpass = $("#oldPass").val();
    var newPass = $("#newPass").val();
    var newPass1 = $("#newPass1").val();

    if (!(oldPass == "" || newPass == "" || newPass1 == "")) {
      if (newPass == newPass1) {
        $.ajax({
          url: '/php/profil/checkoldpass.php',
          type: 'POST',
          data: {
            oldpass: oldpass
          },
          success: function(data) {
            if (data == "success") {
              $.ajax({
                url: '/php/profil/changepass.php',
                type: 'POST',
                data: {
                  newpass: newPass
                },
                success: function(data) {
                  if (data == "success") {
                    alert("Votre mot de passe a bien été changé");
                    $("#oldPass").val("");
                    $("#newPass").val("");
                    $("#newPass1").val("");
                    $('#resetModal').modal('hide');
                  } else {
                    alert("Erreur lors du changement de mot de passe");
                  }
                }
              });
            } else if (data == "error_user_notfound") {
              alert("Erreur: ancien mot de passe invalide");
            } else {
              alert("Erreur lors du changement de mot de passe");
            }
          }
        });
      } else {
        alert("Les deux champs du nouveau mot de passe doivent correspondre");
      }
    } else {
      alert("Veuillez remplir tous les champs");
    }

    return false;

  });



  $("#form_changeuser").submit(function(event) {
    var newUsername = $("#newUsername").val();
    var confirmUsername = $("#confirmUsername").val();
    var password = $("#password").val();

    if (newUsername.trim() != "" && confirmUsername.trim() != "" && password.trim() != "") {
      if (newUsername == confirmUsername) {
        $.ajax({
          type: 'POST',
          url: '/php/profil/changeuser.php',
          data: {
            newusername: newUsername,
            password: password
          },
          success: function(data) {
            if (data == "success") {
              alert("Votre nom d'utilisateur a bien été changé");
              $('#resetUserModal').modal('hide');
            } else {
              alert(data);
            }
          }
        });
      } else {
        alert("Les deux champs avec le nouveau nom d'utilisateur ne sont pas égaux.")
      }
    } else {
      alert("Veuillez remplir tous les champs!")
    }

    return false;

  });

  var tbTel = $('#tbTel');
  tbTel.mask('(CCC)CCC-CCCC', {
    'translation': {
      C: {
        pattern: /[0-9]/
      },
    },
    placeholder: "ex: (819)345-1854"
  });


  $("#form_changeImg").submit(function(event) {

    if (!$("input:radio[name='img']").is(":checked")) {
      alert("Vous devez choisir une image");
      event.preventDefault()
      return false;
    }
    var img = $("input:radio[name ='img']:checked").val();
    $.ajax({
      url: "php/profil/changerimg.php",
      type: "POST",
      data: {
        img: img
      },
      success: function(data) {
        if (data == "success") {
          alert("Votre image a été changée");
          $("#ChangerImg").modal("hide");
          $('body').css('background-image', 'url(' + img + ')');
        }
      }
    });
    return false;
  });




  $("#frm_register").submit(function(event) {

    var pat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var programme = $("#tbProg").val();
    var prenom = $("#tbPrenom").val();
    var nom = $("#tbNom").val();
    var username = $("#tbUserName").val();
    var email = $("#tbEmail").val();
    var tel = $("#tbTel").val();

    if (programme == "" || prenom == "" || nom == "" || username == "" || email == "" || tel == "") {
      alert("Vous devez remplir tout les champs");
      event.preventDefault()
      return false;
    }

    if (tel.length != 13) {
      alert("numero de téléphone invalide");
      event.preventDefault()
      return false;
    }

    if (!pat.test(email)) {
      alert("Votre adresse courriel est invalide");
      event.preventDefault()
      return false;
    }


    $.ajax({
      url: "php/profil/changeuser.php",
      type: "POST",
      data: {
        programme: programme,
        prenom: prenom,
        nom: nom,
        username: username,
        email: email,
        tel: tel
      },
      success: function(data) {
        if (data == "success") {
          alert("Votre profil a été modifié");

          $('#hello').parent().append('<p style="position: absolute; color: white;right: 7vw; top: 1vh;" class="text-nowrap text-center">Bonjour  ' + username + '</p>');
          $('#hello').remove();
        }
        if (data == "emailExiste") {
          alert("L'adresse courriel existe déjà");
        }
        if (data == "userExiste") {
          alert("L'utilisateur existe déjà");
        }

      }
    });
    return false;

  });
});
