<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['demandeID'] = -1;?>
<link rel="stylesheet" href="css/gestion_demandes.css">
<script src="js/gestion_demandes.js" charset="utf-8"></script><?php
if (isset($_SESSION['type']) && ($_SESSION['type'] == "A") || ($_SESSION['type'] == "P")) { ?>
    <div class="w3-quarter">
        <p></p>
    </div>
    <div>
        <br>
        <br>
        <h1>Gestion des demandes</h1>
        <br><br><?php
        if ($_SESSION['type'] == "A") {?>
            <a href="?page=formdemande">
                <input id="bt_form_demande" class="btn btn-primary btn-block btn-lg" type="button" name=""
                       value="Modifier le formulaire des demandes">
            </a><br><?php }
        if ($_SESSION['type'] == 'P') {?>
            <a href="?page=demande&option=new" style="text-decoration:none;">
                <input id="btCreerDemande" class="btn btn-primary btn-block btn-lg" type="button" name=""
                       value="Créer une demande">
            </a>
            <br><?php
        } ?>

        <table id="tblDemandes" class="table table-striped">
            <thead class="thead-dark">
            <th class="no-sort" scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Date de Remise</th>
            <th scope="col">État</th>
            <th class="no-sort" scope="col">Actions</th>
            </thead>
            <tbody class="table-light">
            </tbody>
        </table>

        <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acceptModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" " data-dismiss="modal">Annuler</button>
                        <button id="acceptBt" type="button" class=" btn-success" data-dismiss="modal">Accepter</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="refuseModal" role="dialog">
            <form id="refuseForm" method="post" entype="multipart/form-data">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="refuseModalLabel" style="color:black">Refuser la demande</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <p>Veuillez entrer la raison du refus de la demande (Optionnel)</p>
                            <textarea name="msgRefus" id="msgRefus" rows="7" cols="42" ></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="idRefus" name="idRefus" value="">
                            <input id="btnUpload" class="btn-block" type="file" name="file" style="color:black">
                            <button id="btRefCancel" type="button" class=" " data-dismiss="modal">Annuler</button>
                            <button id="refuseBt" type="submit" class="btn2 btn-danger" name="idRefu">Refuser</button>
                        </div>
                    </div>
            </form>
        </div>


    </div>
    <div class="modal fade" id="raisonrefuseModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="raisonrefuseModalLabel" style="color:black">Refuser la demande</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a id="lienFile" href="" download>
                        <button type="button" class="btn btn-secondary ">Télécharger le fichier</button>
                    </a>
                    <button id="btRefCancel" type="button" class="btn btn-primary " data-dismiss="modal">Retour</button>
                </div>
            </div>
        </div>
    </div><?php
} else {
    echo "<br><br><h3>Vous n'avez pas les autorisations nécessaires pour accéder à cette page.</h3>";
} ?>
