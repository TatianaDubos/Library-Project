<?php session_start(); include_once "fonctions.php"; include_once "header.php";

if($_SESSION['utilisateur'] == "Membre")  // Membres : Voir emprunts et réservations 
{
    echo "<script> document.getElementById('page2').href = 'membres.php'; document.getElementById('page2').innerHTML = 'Acceuil' ;</script>";

    $result = sql("SELECT * FROM prets NATURAL JOIN documents WHERE id='$_SESSION[id]' ORDER BY datePret");

    echo "<div class='container'><hr><h1 class='display-5 text-center text-info m-3'>Mes emprunts</h1>";

    if($result->num_rows == 0)
    {
     echo "<div class='alert alert-info'><strong>Aucun document emprunté pour le moment</strong></div>";
    }
    else 
    { //Afficher les emprunts
      echo "<div class='alert alert-info'><strong>$result->num_rows document(s) emprunté(s)</strong></div>";
      while($row = $result->fetch_assoc()) {

        if(date("Y-m-d", time()) > $row['dateRetourPrevu'])
        {
            $date = "<td style='color:red;'>$row[dateRetourPrevu] &emsp;<i class='bi bi-exclamation-circle-fill'></i> En retard</td>";
        }
        else $date = "<td>$row[dateRetourPrevu]</td>";

        echo "<div class='table-responsive'>
        <table class='table table-bordered table-hover mb-4'>
        <thead><tr scope='row' class='bg-info text-white'><th scope='col'>Titre du document</th><td>$row[titre], par $row[auteur]</td></tr></thead>
        <tr scope='row'><th scope='col'>Date de l'emprunt</th><td>$row[datePret]</td></tr>
        <tr scope='row'><th scope='col'>Date de retour prévu</th>$date</tr></table></div>";
      }
    }

  $result = sql("SELECT * FROM reservations NATURAL JOIN documents WHERE id='$_SESSION[id]' ORDER BY dateReservation");

  echo "<hr><h1 class='display-5 text-center text-info m-3'>Mes Réservations</h1>";

  if( $result->num_rows == 0)
  {
   echo "<div class='alert alert-info'><strong>Aucun document réservé pour le moment</strong></div>";
  }
  else 
  { //Afficher les réservations
    echo "<div class='alert alert-info'><strong>$result->num_rows document(s) réservé(s)</strong></div>";
    
    while($row = $result->fetch_assoc())
    {
      echo "<div class='table-responsive'>
      <table class='table table-bordered table-hover mb-4'>
      <thead><tr scope='row' class='bg-info text-white'><th scope='col'>Titre du document</th><td>$row[titre], par $row[auteur]</td></tr></thead>
      <tr scope='row'><th scope='col'>Date de la réservation</th><td>$row[dateReservation]</td></tr></table></div>";
    }
  }

  echo "</div>";

} // Employé : Voir emprunts et réservations 
else 
{ echo "<script>document.getElementById('home').innerHTML = '<a href=\'equipe.php\' title=\'Acceuil\'><i class=\'bi bi-house\'></i></a>' ; </script>";

  echo "<div class='container'><div class='d-grid gap-2'>
        <a href='#emprunts' class='btn btn- btn-outline-secondary px-1 m-1'>Voir les emprunts</a>
        <a href='#réservations' class='btn btn-block btn-outline-secondary px-1 m-1'>Voir les réservations</a>
        <a href='#retards' class='btn btn-block btn-outline-secondary px-1 m-1'>Voir les retards</a></div><hr>
        <h1 class='display-5 text-center text-info m-3' id='emprunts'>Emprunts</h1>";

  $result = sql("SELECT * FROM prets NATURAL JOIN documents NATURAL JOIN membres ORDER BY datePret");

  if($result->num_rows == 0)
    {
     echo "<div class='alert alert-info'><strong>Aucun document emprunté pour le moment</strong></div>";
    }
    else 
    { //Afficher les emprunts
      echo "<div class='alert alert-info'><strong>$result->num_rows document(s) emprunté(s)</strong></div>";
      while($row = $result->fetch_assoc()) {

        if(date("Y-m-d", time()) > $row['dateRetourPrevu'])
        {
            $date = "<td style='color:red;'>$row[dateRetourPrevu] &emsp;<i class='bi bi-exclamation-circle-fill'></i> En retard</td>";
        }
        else $date = "<td>$row[dateRetourPrevu]</td>";

        echo "<div class='table-responsive'>
        <table class='table table-bordered table-hover mb-4'>
        <thead><tr scope='row' class='bg-info text-white'><th scope='col'>Titre du document</th><td>$row[titre], par $row[auteur]</td></tr></thead>
        <tr scope='row'><th scope='col'>Emprunté par</th><td>$row[nom]</td></tr>
        <tr scope='row'><th scope='col'>Informations suppémentaires</th><td><ul><li>Courriel :<a href='mailto:$row[courriel]'> $row[courriel]</a></li><br><li>Téléphone :<a href='tel:+1$row[telephone]'> $row[telephone]</a></li></ul></td></tr>
        <tr scope='row'><th scope='col'>Date de l'emprunt</th><td>$row[datePret]</td></tr>
        <tr scope='row'><th scope='col'>Date de retour prévu</th>$date</tr>
        </table></div>";
      }

    }
  
  echo "<hr><h1 class='display-5 text-center text-info m-3' id='réservations'>Réservations</h1>";

  $result = sql("SELECT * FROM reservations NATURAL JOIN documents NATURAL JOIN membres ORDER BY dateReservation");

  if( $result->num_rows == 0)
  {
   echo "<div class='alert alert-info'><strong>Aucun document réservé pour le moment</strong></div>";
  }
  else 
  { //Afficher les réservations
    echo "<div class='alert alert-info'><strong>$result->num_rows document(s) réservé(s)</strong></div>";

    while($row = $result->fetch_assoc())
    {
      echo "<div class='table-responsive'>
      <table class='table table-bordered table-hover mb-4'>
      <thead><tr scope='row' class='bg-info text-white'><th scope='col'>Titre du document</th><td>$row[titre], par $row[auteur]</td></tr></thead>
      <tr scope='row'><th scope='col'>Réservé par</th><td>$row[nom]</td></tr>
      <tr scope='row'><th scope='col'>Informations suppémentaires</th><td><ul><li>Courriel :<a href='mailto:$row[courriel]'> $row[courriel]</a></li><br><li>Téléphone :<a href='tel:+1$row[telephone]'> $row[telephone]</a></li></ul></td></tr>
      <tr scope='row'><th scope='col'>Date de la réservation</th><td>$row[dateReservation]</td></tr>
      <form method='post'>
        <input type='hidden' value='$row[code]' name='code'>
        <input type='hidden' value='$row[id]' name='id'>
        <tr scope='row'><th scope='col'>Annuler la réservation</th><td><input class='btn btn-info' type='submit' value='Annuler' name='annuler'></td></tr>
      </form></table></div>";
    }

  }

  echo "<hr><h1 class='display-5 text-center text-info m-3' id='retards'>Retards</h1>";

  $date = date("Y-m-d", time());

  $result = sql("SELECT * FROM prets NATURAL JOIN documents NATURAL JOIN membres WHERE dateRetourPrevu < '$date' ORDER BY datePret");

  //Afficher les retards
  if( $result->num_rows > 0)
  {
    echo "<div class='alert alert-info'><strong>$result->num_rows document(s) en retard</strong></div>";

    while($row = $result->fetch_assoc()) 
    {
          echo "<div class='table-responsive'>
          <table class='table table-bordered table-hover mb-4'>
          <thead><tr scope='row' class='bg-info text-white'><th scope='col'>Titre du document</th><td>$row[titre], par $row[auteur]</td></tr></thead>
          <tr scope='row'><th scope='col'>Emprunté par</th><td>$row[nom]</td></tr>
          <tr scope='row'><th scope='col'>Informations suppémentaires</th><td><ul><li>Courriel :<a href='mailto:$row[courriel]'> $row[courriel]</a></li><br><li>Téléphone :<a href='tel:+1$row[telephone]'> $row[telephone]</a></li></ul></td></tr>
          <tr scope='row'><th scope='col'>Date de l'emprunt</th><td>$row[datePret]</td></tr>
          <tr scope='row'><th scope='col'>Date de retour prévu</th><td style='color:red;'>$row[dateRetourPrevu] &emsp;<i class='bi bi-exclamation-circle-fill'></i> En retard</td></tr>
          </table></div>";
    }
  }
  else 
  {
    echo "<div class='alert alert-info'><strong>Aucun document en retard pour le moment</strong></div>";
  }

echo "</div>";
}


include_once "footer.php";
?>