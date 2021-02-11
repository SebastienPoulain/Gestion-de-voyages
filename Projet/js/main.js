$(document).ready(function() {

  $("#btDeconnexion").click(function(event) {
    //sessionStorage.removeItem("user");
    //sessionStorage.removeItem("type");
    $.ajax({
      type: "POST",
      url: "php/disconnect.php"
    }).done(function() {
      window.location = "connection.php";
    });
  });

});
