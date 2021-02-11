<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION["type"] != "A") {
    header('Location: main.php?page=404');
} else {
    require "php/BD.inc.php";
    $actif = 1;
    $stmt = $conn->prepare("SELECT * FROM categories where actif = :actif ORDER BY categorie");
    $stmt->execute(array(':actif' => $actif));
    $cats = $stmt->fetchAll(); ?>
<link rel="stylesheet" href="css/formulairedyn.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" charset="utf-8"></script>
<script src="js/demandedyn.js" charset="utf-8"></script>

<div class="container midSection container-fluid">
  <br>
  <h2 class="text-center h1">Modification du formulaire</h2>
  <br><br>

  <ul class="nav nav-pills nav-justified">
    <li class="nav-item">
      <a id="mod_form" class="nav-link active" href="#">Formulaire du projet</a>
    </li>
    <li class="nav-item">
      <a id="add_question" class="nav-link" href="#">Ajouter une nouvelle question</a>
    </li>
    <li class="nav-item">
      <a id="modif_question" class="nav-link" href="#">Modifier une question</a>
    </li>
  </ul>
  <br><br>

  <div class="content container-fluid">

    <div id="create_alert" class="alert alert-danger" role="alert">
      <div style="text-align:center;color:black;" id="alert_message">

      </div>
    </div>

    <div class=" form-group divModifQuestion container-fluid">
<p id="texteQuestion" style="color:white !important;">Glissez la question à modifier ici</p>
    </div>

    <form id="form_question" method="POST">

      <div class="form-group nouvelleQuestion container-fluid">
        <label class="text-blanc" for="typeQuestion">Choisissez la catégorie de la question</label>
        <select name="cat" class="form-control" id="typeQuestion"><?php foreach ($cats as $cat): ?>
          <option value="<?=$cat["id"];?>"><?=$cat["categorie"];?></option><?php endforeach ?>
        </select>
      </div>

      <div class="form-group nouvelleQuestion container-fluid">
        <label class="text-blanc" for="laquestion">Question</label> <span class="text-blanc"> *</span>
        <textarea name="question" class="form-control" rows="5" id="laquestion"></textarea>
        <textarea name="question2" class="form-control" rows="5" id="laquestion2"></textarea>
      </div>

      <div class="row form-group newQuestion nouvelleQuestion container-fluid">

        <div class="col-sm-3 Controloptions container-fluid">
          <label>Mention</label>
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="mention">
          </div>
        </div>

        <div class="col-sm-3 Controloptions container-fluid">
          <label>Documents à télécharger</label>
          <a href="exemple.txt" download><button class="btn"><i class="fa fa-download">Télécharger</i></button></a>
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="download">
          </div>
        </div>

        <div class="col-sm-3 Controloptions container-fluid">
          <div class="checkbox container-fluid">
            <label>Case à cocher</label> <br>
            <input type="checkbox" value="checkbox">
          </div>
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="checkbox">
          </div>
        </div>
        <div class="col-sm-3 Controloptions container-fluid">
          <label>Nombre</label>
          <div class="number container-fluid">
            <input type="number" name="">
          </div>
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="number">
          </div>
        </div>
      </div>
      <div class="row form-group newQuestion nouvelleQuestion container-fluid">

        <div class="col-sm-3 Controloptions container-fluid">
          <label>Date</label>
          <input type="date" name="" value="">
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="date">
          </div>
        </div>

        <div class="col-sm-3 Controloptions container-fluid">
          <label>Liste déroulante</label>
          <select class="" name="">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
          </select>
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="select">
          </div>
        </div>

        <div class="col-sm-3 Controloptions container-fluid">

          <label>Téléverser un document</label> <br>
          <input style="margin:0 auto;" type="file">
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="upload">
          </div>
        </div>
        <div class="col-sm-3 Controloptions container-fluid">
          <label for="customRange1">Slider</label> <br>
          <span id="rangeVal">1</span>
          <input value="1" type="range" class="custom-range" id="customRange1">
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="slider">
          </div>
        </div>
      </div>
      <div class="row form-group newQuestion nouvelleQuestion container-fluid">

        <div class="col-sm-3 Controloptions container-fluid">
          <label>Réponse courte</label>
          <input type="text" name="" value="">
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio"> <br>
            <input type="radio" name="option" value="texteCourt">
          </div>
        </div>

        <div class="col-sm-3 Controloptions container-fluid">
          <label>Zone de texte</label> <br>
          <textarea name="name" rows="2" cols="15"></textarea>
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio"> <br>
            <input type="radio" name="option" value="texteLong">
          </div>
        </div>

        <div class="col-sm-3 Controloptions container-fluid">

          <label>Choix multiples</label> <br>

          <div class="radio container-fluid">
            <input disabled type="radio">
          </div>
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="choixMultiple">
          </div>
        </div>
        <div class="col-sm-3 Controloptions container-fluid">
          <label>Couleur</label>
          <input type="color" name="">
          <div style="position: absolute;
bottom:0;
left: 0;
right: 0;" class="radio">
            <input type="radio" name="option" value="couleur">
          </div>
        </div>
      </div>
      <br>

      <div class="form-group nouvelleQuestion container-fluid">

        <label id="options" style="">Options d'affichage</label>

        <div id="optionBorder" style="display:none">

          <div id="list_option" style="display: none;">
            <div class="input text container-fluid"><label style="display:block" for="list-option">Entrez les options séparées de point-virgule. Ex.: «Option 1;Option 2;Option 3»</label><input style="width:100%" type="text" name="list-option" pattern=".*\S.*"
                title="Le champ de peut pas être vide" id="list-option"></div>
          </div>

          <div id="value_min" style="display: none;">
            <div class="input number container-fluid"><label style="display:block" for="value-min">Valeur minimum autorisée</label><input style="width:100%" type="number" name="value-min" id="value-min" value="0"></div>
          </div>

          <div id="value_max" style="display: none;">
            <div class="input number container-fluid"><label style="display:block" for="value-max">Valeur maximum autorisée</label><input style="width:100%" type="number" name="value-max" id="value-max" value="100"></div>
          </div>

          <div id="value_step" style="display: none;">
            <div class="input number container-fluid"><label style="display:block" for="value-step">Interval entre deux valeurs autorisé</label><input style="width:100%" type="number" name="value-step" step="0.001" id="value-step" value="1"></div>
          </div>

          <div id="fileDiv" style="display: none;">
            <div class="input file container-fluid"><label style="display:block" for="file">Document</label><input style="width:100%" type="file" name="file" id="file"></div>
          </div>

        </div>

        <label class="text-blanc" style="margin-top:2%" for="info_supp">Informations supplémentaires</label>
        <textarea id="info_supp" name="info_supp" style="width:100%;" rows="5"></textarea>
        <textarea id="info_supp2" name="info_supp2" style="width:100%;" rows="5"></textarea>
        <input type="hidden" id="idModif" name="" value="">
        <div id="statutQuestion" class="form-group">
          <p class="text-blanc">Choisissez le statut de la question</p>
          <input style="margin-left:1%" class="form-check-input" type="radio" name="statut" id="actif" value="1">
          <label style="margin-left:4%" class="form-check-label white" for="actif">Actif</label>
          <input style="margin-left:1%" class="form-check-input" type="radio" name="statut" id="inactif" value="0">
          <label style="margin-left:4%" class="form-check-label white" for="inactif">Inactif</label>
        </div>
        <input style="float:right;margin-top:2%;" type="submit" id="btAjoutQuestion" class="btn btn-secondary" name="" value="Ajouter">
    </form>

  </div>

  <div class="formdyn_content sortable container-fluid">

<script type="text/javascript">
$(document).ready(function() {
  access = 1;
  $("#modif_question").show();
});
</script>
  </div>

</div>
  <input id="save_form" type="button" class="btn btn-primary btn-block" name="" value="Enregistrer">

</div>

<br><br>
</div>

<div class="menu container-fluid">
  <h4>Questions</h4>
  <ul id="ls_cat" class="list-group">
  </ul>
</div><?php
} ?>
