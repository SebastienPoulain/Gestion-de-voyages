<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/gestion_projets.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<script src="js/gestion_projets.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" charset="utf-8"></script><?php
if (isset($_SESSION['type']) && ($_SESSION['type'] == "A") || ($_SESSION['type'] == "P") || ($_SESSION['type'] == "E")) { ?>
    <br>
    <br>
    <h1>Gestion des projets</h1>
    <br><br><?php
    if (isset($_SESSION['type']) && ($_SESSION['type'] == "A")) { ?>
        <input type="button" id="affProjet" class="btAffichage btn btn-secondary" value="Afficher les projets actif"
               onclick="pullProjets('actif')"/>
        <input type="button" id="affTous" class="btSelectAffichage btn btn-secondary"
               value="Afficher les projets désactivé" onclick="pullProjets('désactivé')"/><?php } ?>
    <table id="tblProjets" class="table table-striped">
        <thead class="thead-dark">
        <th class="text-center no-sort" scope="col">#</th>
        <th class="text-center" scope="col">Nom</th>
        <th class="text-center" scope="col">Code de Projet</th>
        <th class="text-center" scope="col">Destination</th>
        <th class="text-center" scope="col">Date départ</th>
        <th class="text-center" scope="col">Date retour</th>
        <th class="text-center no-sort" scope="col">Actions</th>
        </thead>
        <tbody class="table-light">
        </tbody>
    </table><?php if (($_SESSION['type'] == "P") || ($_SESSION['type'] == "E")) { ?>
        <input type="text" id="codeVoyage" required name="codeVoyage">
        <br>
        <br>
        <input class='btn btn-primary BTAjoutVoyage' id="btAjoutVoyage" type='button' value='Rejoindre un voyage'><?php } ?><?php
} else {
    echo "<br><br><h3>Vous n'avez pas les autorisations nécessaires pour accéder à cette page.</h3>";
} ?>


<div class="modal fade" id="copiModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_copieCOLI">
                <div class="modal-header">
                    <h5 class="modal-title" id="copiModalLabel" style="color:black">Copier le projet pour faire une
                        demande</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label id="lbNewNom" style="color:black">Nom du nouveau projet </label>
                    <input type="text" class="form-control" id="tbNewNom" name="tbNewNom">
                    <label id="lbNewDateDebut" style="color:black">Date de début </label>
                    <input type="date" class="form-control" id="tbNewDateDepart" max="" min="" name="tbNewDateDepart">
                    <label id="lbNewDateRetour" style="color:black">date de retour </label>
                    <input type="date" class="form-control" id="tbNewDateRetour" name="tbNewDateRetour" max="" min="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button id="confirmCopiBT" type="submit" class="btn btn-success">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
