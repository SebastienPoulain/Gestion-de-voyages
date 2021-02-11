<!Doctype html>
<html lang="fr">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/stat_admin.css">
<body>
 <br>
 <br>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>

#cache { position: absolute; top: 200px; z-index: 10; visibility: hidden; width: 100px; height: 100px; }


.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
}

.pagination a.active {
  background-color: dodgerblue;
  color: white;

}

.pagination a:hover:not(.active) {background-color: #ddd;}

</style><?php
include "php/BD.inc.php";?>


<div class="w3-rest"  >
<div style=" with:100%;">

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<div class="w3-main" style="margin:100px;margin-top:43px;">

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="	fas fa-plane w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
       $sql = "SELECT COUNT(ID)  FROM projets WHERE actif = 0";
        $test= $conn->query($sql);
        $donnees = $test->fetch();
        echo "<h3> $donnees[0] </h3> ";?>

        </div>
        <div class="w3-clear"></div>
        <h4>Voyages en cours</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="	fas fa-globe-asia w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
       $sql = "SELECT COUNT(ID)  FROM projets WHERE actif = 1";
        $test= $conn->query($sql);
        $donnees = $test->fetch();
        echo "<h3> $donnees[0] </h3> ";?>
        </div>
        <div class="w3-clear"></div>
        <h4>Voyages terminés</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="	fas fa-poll-h w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
       $sql = "SELECT COUNT(ID)  FROM demandes";
        $test= $conn->query($sql);
        $donnees = $test->fetch();
        echo "<h3> $donnees[0] </h3> ";?>

        </div>
        <div class="w3-clear"></div>
        <h4>Demandes</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-cyan w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
       $sql = "SELECT COUNT(ID)  FROM  utilisateurs";
        $test= $conn->query($sql);
        $donnees = $test->fetch();
        echo "<h3> $donnees[0] </h3> ";?>

        </div>
        <div class="w3-clear"></div>
        <h4>Utilisateurs</h4>
      </div>
    </div>

  </div>


  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-padding-16">
        <div class="w3-left"><i class="fas fa-book w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
       $sql = "SELECT COUNT(ID)  FROM demandes WHERE etat = 2";
        $test= $conn->query($sql);
        $donnees = $test->fetch();
        echo "<h3> $donnees[0] </h3> ";?>

        </div>
        <div class="w3-clear"></div>
        <h4>Nombre de projets refusés</h4>
      </div>
    </div>

    <div class="w3-quarter">
      <div class="w3-container w3-blue-gray w3-padding-16">
        <div class="w3-left"><i class="	fas fa-route w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
        $sql = "SELECT COUNT(destination) FROM demandes";

        $nbPay = $conn->query($sql);
          $nbPays = $nbPay->fetch();
        echo "<h3> $nbPays[0] </h3> ";?>

        </div>
        <div class="w3-clear"></div>
        <h4>Nombre de pays voyagés</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-light-blue w3-padding-16">
        <div class="w3-left"><i class="	fas fa-user-tie w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
       $sql = "SELECT COUNT(ID)  FROM utilisateurs WHERE type = 'P'";
        $test= $conn->query($sql);
        $donnees = $test->fetch();
        echo "<h3> $donnees[0] </h3> ";?>

        </div>
        <div class="w3-clear"></div>
        <h4>Nombre d'accompagnateurs</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-lime w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fas fa-graduation-cap w3-xxxlarge"></i></div>
        <div class="w3-right"><?php
       $sql = "SELECT COUNT(ID)  FROM utilisateurs WHERE type = 'E'";
        $test= $conn->query($sql);
        $donnees = $test->fetch();
        echo "<h3> $donnees[0] </h3> ";?>

        </div>
        <div class="w3-clear"></div>
        <h4>Nombre d'étudiants</h4>
      </div>
    </div>

  <div class="w3-panel">

<br>
<br>
      <div class="w3-container 	w3-light-grey">
        <h3 style="color:black">Nombre d'étudiants par programme</h3>
           <div class="divTab2" style="overflow-x:auto;"><?php

        echo "<table class=tabGrap>
        <tr class='tabGrap'>";

         $sql3 = "SELECT COUNT(programme) as nbProgramme , programme  FROM utilisateurs
                  GROUP BY programme
                  ORDER BY nbProgramme DESC";

                 $nbEtu = $conn->query($sql3);

          while($nbEtuPro = $nbEtu->fetch())
       {

            /* $hauteurGraphpx ="";
            $hauteurGraph = $nbEtuPro[0] * 50;
            $hauteurGraphpx = $hauteurGraph."px";*/

           echo "<td class='tdGrap' style='width:200px';>
                  <div style='text-align:center; width:200px;' class='divBandeGraphe'; >
                  <b> $nbEtuPro[1] </b>
                  <br>
                  <b <i class='fa fa-users w3-xlarge'></i> $nbEtuPro[0] </b>
                  </div>
                 </td>";
          }


        echo "</tr>
        </table>";?>

          </div>
      </div>
      <br>




  <div class="w3-container 	w3-light-grey ">
    <h3  style="color:black">Genre des Étudiants</h3><?php
    //nombre total d'étudiant'

      $sql = "SELECT COUNT(ID) FROM utilisateurs WHERE type = 'E'";
        $total= $conn->query($sql);
        $totalEtu1 = $total->fetch();

       $sql = "SELECT COUNT(genre), genre FROM utilisateurs
               WHERE type = 'E'
               GROUP BY genre";

        $test= $conn->query($sql);

    //nombre total de femme étudiante
    while( $donnees = $test->fetch())
       {

        $TotalEtu = ($donnees[0] * 100) / $totalEtu1[0];
        $TotalEtu = round($TotalEtu);

        echo "<div class = w3-white>
        <p>Nombre: $donnees[0] </p>
      <div class= 'w3-container w3-center w3-padding w3-blue' style= width:$TotalEtu% >  $TotalEtu% $donnees[1]</div>
      <br>
    </div>";
       }?>

<hr>
  <div class="w3-container">
    <h3  style="color:black">Genre des Professeurs/Accompagnateurs </h3><?php
    //nombre total d'étudiant'
      $sql = "SELECT COUNT(ID) FROM utilisateurs WHERE type = 'P'";
        $total= $conn->query($sql);
        $totalEtu1 = $total->fetch();

       $sql = "SELECT COUNT(genre), genre FROM utilisateurs
               WHERE type = 'P'
               GROUP BY genre";

        $test= $conn->query($sql);

    //nombre total de femme étudiante
    while( $donnees = $test->fetch())
       {

        $TotalEtu = ($donnees[0] * 100) / $totalEtu1[0];
        $TotalEtu = round($TotalEtu);

        echo "<div class= 'w3-white'>
         <p>Nombre: $donnees[0] </p>
      <div class= 'w3-container w3-center w3-padding w3-light-blue' style= width:$TotalEtu% >  $TotalEtu% $donnees[1]</div>
      <br>
    </div>";
       }?>

  <br>
  <div class="w3-container">
    <h3 style="color:black">Pays</h3>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white"><?php
    //rajouter le cout en moyen pour un voyage dans un pays

      $sql2 = "SELECT fr, COUNT(up.userID) FROM pays p
               INNER JOIN demandes d ON d.destination = p.fr
               INNER JOIN projets pr ON pr.id_demande = d.ID
               INNER JOIN usr_projet_info up ON up.projetID = pr.ID
               WHERE fr = destination
               GROUP BY fr";

      $nbVoyage = $conn->query($sql2);

echo   "<tr>
        <th>Pays</th>

        <th>nombre de participation</th>
        </tr>";

    while ($nbVoyages = $nbVoyage->fetch())
{
echo "   <tr>
        <td>$nbVoyages[0]</td>

        <td>$nbVoyages[1]</td>
        </tr>";
}?>

  </table>
<br>
  </div>
  <hr>

</div>
 </div>
</div>


</body>
