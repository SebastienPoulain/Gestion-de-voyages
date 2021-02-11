<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<link rel="stylesheet" href="css/formulairedyn.css">
<script src="js/demandeform.js" charset="utf-8"></script>
<div class="container midSection">
  <br>
  <h2 class="text-center h1">Formulaire de demande de projet</h2>
  <br><br>

  <script type="text/javascript">
  $(document).ready(function() {
    page = "<?= $_GET['page'] ?>";
    pullform();
  });
  </script>

  <div class="form_content_hardcode">
    <div class="form-group">
      <label class="white" for="proj_title">Intitulé de votre projet</label>
      <input id="proj_title" class="form-control" type="text" value="" maxlength="50" aria-describedby="info_title" required>
      <small id="info_title" class="form-text text-muted">Cet intitulé peut contenir le pays ou un lieu de la destination et la date ; par exemple "Voyage Paris 2021 - Étudiants en diététique"</small>
    </div>
    <div class="form-group">
      <label class="white" for="proj_dest">Pays de destination</label>
      <select id="proj_dest" class="form-control" required>

      </select>
    </div>
    <div class="form-group">
      <label class="white" for="proj_precdest">Précisions sur la destination</label>
      <input id="proj_precdest" class="form-control" type="text" value="" maxlength="50" aria-describedby="info_precdest" required>
      <small id="info_precdest" class="form-text text-muted">Exemple: villes, régions...</small>
    </div>
    <div class="form-group">
      <label class="white" for="proj_prog">Programme d'étude des participants</label>
      <select id="proj_prog" class="form-control" required>

      </select>
    </div>
    <div class="form-group row">
      <div class="col-sm-6">
        <label class="white" for="proj_dated">Date de départ</label>
        <input id="proj_dated" class="form-control" type="date" required>
      </div>
      <div class="col-sm-6">
        <label class="white" for="proj_dater">Date de retour</label>
        <input id="proj_dater" class="form-control" type="date" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-9 activites">
        <label class="white" for="activite0">Nom de l'activité</label>
        <input id="activite0" class="form-control" type="text" style="margin-bottom: 10px;" required>
      </div>
      <div class="col-sm-3 dates-activites">
        <label class="white" for="date_activite0">Date de l'activité</label>
        <input id="date_activite0" class="form-control" type="date" style="margin-bottom: 10px;" required>
      </div>
      <input id="addActivite" class="btn btn-primary col-sm-6" type="button" value="+">
      <input id="delActivite" class="btn btn-primary col-sm-6" type="button" value="-">
    </div>
  </div>
  <div class="form_content">

  </div>
<?php if($_GET['page'] != "viewformulaire"){ ?>
  <input id="save_form" type="button" class="btn btn-primary btn-block" name="" value="Enregistrer<?php if (isset($_GET['option']) && $_GET['option'] == "new") echo " et envoyer"; ?> la demande">
<?php } ?>
</div>
