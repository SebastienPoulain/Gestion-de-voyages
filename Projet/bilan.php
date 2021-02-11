<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<link rel="stylesheet" href="css/formulairedyn.css">
<script src="js/bilan_etudiant.js" charset="utf-8"></script>
<div class="container midSection">
  <br>
    <h2 class="text-center h1">Bilan de voyage</h2>
  <br><br>

<?php
      if (empty($_SESSION["idprojet"])) {
          echo "Veuillez sélectionner un projet pour pouvoir compléter son formulaire."; ?>
  <script type="text/javascript">
  $(document).ready(function() {
  });
  </script>
  <a href="?page=projets"><input type="button" class="btn btn-primary" name="" value="Cliquez ici pour sélectionner un projet"></a>
<?php
      } else {?>
  <script type="text/javascript">
  $(document).ready(function() {
    page = "<?= $_GET['page'] ?>";
    pullform();
  });
  </script>

  <div class="form_content">

  </div>
<?php if ($_GET['page'] != "viewBilan") { ?>
  <input id="save_form" type="button" class="btn btn-primary btn-block" name="" value="Enregistrer et envoyer le formulaire">
<?php } ?>
<?php
      } ?>
</div>
