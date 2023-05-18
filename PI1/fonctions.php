<?php
// Connection à la base de données
$dbhost  = 'localhost'; 
$dbname  = 'bibliotheque';   
$dbuser  = 'Tatiana';   
$dbpass  = 'mysql';  

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) die("Erreur fatale");

$query = 'SET NAMES utf8';
$result = $conn->query($query);
if (!$result) die("Erreur : n'a pas pu se connecter à la base de donnée");

function createTable($name, $query)
{ 
  sql("CREATE TABLE IF NOT EXISTS $name($query) CHARSET utf8");
  echo "Table '$name' créée ou existe déjà.<br>";
}

function sql($query)
{
    global $conn;
    $result = $conn->query($query);
    if (!$result) die("Erreur fatale");
    return $result;
}

function sanitize($var)
{
    global $conn;
    $var = strip_tags($var);
    $var = htmlspecialchars($var);
    return $conn->real_escape_string($var);
}

//Bouton Deconnexion
if(isset($_POST['Deconnexion'])) {

  $conn->close();
  session_destroy();
  echo "<script> window.location.replace('http://localhost/PI1/index.php');</script>";
  
}

//Bouton Réserver le document
if(isset($_POST['reserver'])) {

  $result = sql("SELECT code FROM reservations WHERE id='$_SESSION[id]' AND code='$_POST[code]'"); // Vérifier que la réservation n'existe pas déjà
  
  if($result->num_rows == 0)
  {
    $date = date("Y-m-d", time()) ;

    sql("INSERT INTO reservations VALUES('$_SESSION[id]', '$_POST[code]', '$date')"); // Insérer les information dans la table réservations

    echo "<script> alert('Votre réservation a été confirmé') ; </script>";
  }
  else {
    echo "<script> alert('Vous aviez déjà réservé ce document') ; </script>";
  }
}

//Bouton Annuler la réservation
if(isset($_POST['annuler'])) {

  $result = sql("SELECT * FROM reservations WHERE id='$_POST[id]' AND code='$_POST[code]'"); // Vérifier que la réservation existe

  if($result->num_rows == 0)
  {
    echo "<script> alert('La réservation a déjà été annulé') ; </script>";
  }
  else 
  { 
    sql("DELETE FROM reservations WHERE id='$_POST[id]' AND code='$_POST[code]' "); // Supprimer la réservation

    echo "<script> alert('Une réservation a été annulé') ; </script>";
  }
  
}

//Afficher les résultats d'une recherche pour les membres
function afficher_membre($result){ 
  echo "<div class='container'><div class='alert alert-info'><strong>Résultat :</strong> $result->num_rows document(s)</div>";

  while($row = $result->fetch_assoc()) {
    echo "<div class='table-responsive'>
    <table class='table table-bordered table-hover mb-4'>
    <thead><tr scope='row' class='bg-info text-white'><th scope='col' class='col-2'>Titre</th><td>$row[titre]</td></tr> </thead>
    <tr scope='row'><th scope='col'>Auteur</th><td>$row[auteur]</td></tr>
    <tr scope='row'><th scope='col'>Année de publication</th><td>$row[annee]</td></tr>
    <tr scope='row'><th scope='col'>Catégorie</th><td>$row[categorie]</td></tr>
    <tr scope='row'><th scope='col'>Type</th><td>$row[type]</td></tr>
    <tr scope='row'><th scope='col'>Genre</th><td>$row[genre]</td></tr>
    <tr scope='row'> <th scope='col'>Résumé</th>
    <td>
        <button class='btn btn-outline-success' type='button' data-bs-toggle='collapse' data-bs-target='#resume' aria-expanded='false' aria-controls='resume' style='border-radius: 60px;'><i class='bi bi-eye'></i></button>
        <div class='collapse' id='resume'><div class='card card-body'>$row[description]</div></div>
    </td></tr>
    <tr scope='row'><th scope='col'>ISBN</th><td>$row[isbn]
    </td></tr>
    <form method='post'>
    <input type='hidden' value='$row[code]' name='code'>
    <tr scope='row'><th scope='col'>Réserver le document</th><td><input class='btn btn-info' type='submit' value='Réserver' name='reserver'></td></tr>
    </form></table></div>";
  }
  echo "</div>";
}


//Afficher les résultats d'une recherche pour les employé
function afficher_equipe($result) {

    echo "<div class='container'><div class='alert alert-info'><strong>Résultat :</strong> $result->num_rows document(s)</div>";
    
    while($row = $result->fetch_assoc()) {
      echo "<div class='table-responsive'>
      <table class='table table-bordered table-hover mb-4'>
      <thead><tr scope='row' class='bg-info text-white'><th scope='col' class='col-2'>Titre</th><td>$row[titre]</td></tr> </thead>
      <tr scope='row'><th scope='col'>Auteur</th><td>$row[auteur]</td></tr>
      <tr scope='row'><th scope='col'>Année de publication</th><td>$row[annee]</td></tr>
      <tr scope='row'><th scope='col'>Catégorie</th><td>$row[categorie]</td></tr>
      <tr scope='row'><th scope='col'>Type</th><td>$row[type]</td></tr>
      <tr scope='row'><th scope='col'>Genre</th><td>$row[genre]</td></tr>
      <tr scope='row'> <th scope='col'>Résumé</th>
      <td>
        <button class='btn btn-outline-success' type='button' data-bs-toggle='collapse' data-bs-target='#resume' aria-expanded='false' aria-controls='resume' style='border-radius: 60px;'><i class='bi bi-eye'></i></button>
        <div class='collapse' id='resume'><div class='card card-body'>$row[description]</div></div>
      </td></tr>
      <tr scope='row'><th scope='col'>ISBN</th><td>$row[isbn]</td></tr>";

      //Historique des emprunts
      $result_hist = sql("SELECT * FROM historique NATURAL JOIN membres WHERE code='$row[code]' ORDER BY datePret");
      if($result_hist->num_rows == 0)
      {
        echo "<tr scope='row'><th scope='col'>Historique des emprunts</th><td>Historique vide</td></tr>";
      }
      else
      {
        $hist= '';

        while($subrow = $result_hist->fetch_assoc()) {
          $hist .= "A été emprunté par <strong>$subrow[nom]</strong> le $subrow[datePret] jusqu'au $subrow[dateRetour]. <br>";
        }

        echo "<tr scope='row'><th scope='col'>Historique des emprunts</th><td>$hist</td></tr>";
      }
      //Emprunté par
      $result_pret = sql("SELECT * FROM prets NATURAL JOIN membres WHERE code='$row[code]' ");
      if($result_pret->num_rows == 0)
      {
        echo "<tr scope='row'><th scope='col'>Emprunté par</th><td>Personne</td></tr>";
      }
      else 
      {
        $subrow = $result_pret->fetch_assoc();

        echo "<tr scope='row'><th scope='col'>Emprunté par</th><td>Emprunté par <strong>$subrow[nom]</strong> le $subrow[datePret], doit être retourné le $subrow[dateRetourPrevu].</td></tr>";
      }
      //Réservé par
      $result_reserv = sql("SELECT * FROM reservations NATURAL JOIN membres WHERE code='$row[code]' ORDER BY dateReservation");
      if($result_reserv->num_rows == 0) 
      {
        echo "<tr scope='row'><th scope='col'>Réservé par</th><td>Personne</td></tr>";
      }
      else 
      {
        $reserv = '';

        while($subrow = $result_reserv->fetch_assoc()) {
          $reserv .= "A été réservé par <strong>$subrow[nom]</strong> le $subrow[dateReservation]. <br>";
        }
        echo "<tr scope='row'><th scope='col'>Réservé par</th><td>$reserv</td></tr>";
      }

      echo "</table></div>";
    }
    echo "</div>";
} 

// Afficher le profil des membres
function afficher_profil($result){ 

  while($row = $result->fetch_assoc()) {
    echo "<div class='table-responsive'>
    <table class='table table-hover' >
    <tr scope='row' class='bg-light'>
    <th scope='col' class='text-center p-4 bg-info w-25'><img src='Images/user.png' style='width:120px;'></th>
    <td scope='col'>   
        <ul>
            <li><strong>Nom :</strong> $row[nom]</li><br>
            <li><strong>Adresse :</strong> $row[adresse]</li><br>
            <li><strong>Téléphone :</strong><a href='tel:+1$row[telephone]'> $row[telephone]</a></li><br>
            <li><strong>Courriel :</strong><a href='mailto:$row[courriel]'> $row[courriel]</a></li>
        </ul>
    </td></tr>";

    // Afficher les emprunts
    $result_pret = sql("SELECT * FROM prets NATURAL JOIN documents WHERE id='$row[id]' ORDER BY datePret"); 

    if($result_pret->num_rows > 0)
    {
      $emprunts = '';
      while($subrow = $result_pret->fetch_assoc())
      {
        if(date("Y-m-d", time()) > $subrow['dateRetourPrevu'])
        {
            $date_retour = "<span style='color:red;'>$subrow[dateRetourPrevu] &emsp;<i class='bi bi-exclamation-circle-fill'></i> En retard</span>";
        }
        else $date_retour = "$subrow[dateRetourPrevu]";

        $emprunts .= "<strong>'$subrow[titre]'</strong> : emprunté le $subrow[datePret], doit être retourné le $date_retour. <br>" ;
      }

      echo "<tr scope='row' class='bg-light'><th scope='col' class='text-center text-white bg-info w-25'>Emprunt(s)</th>
      <td scope='col'>$emprunts</td>";

    }
    // Afficher les réservations
    $result_reserv = sql("SELECT * FROM reservations NATURAL JOIN documents WHERE id='$row[id]' ORDER BY dateReservation"); 

    if($result_reserv->num_rows > 0)
    {
      $reservations = '';
      while($subrow = $result_reserv->fetch_assoc())
      {
        $reservations .= "<strong>'$subrow[titre]'</strong> : réservé le le $subrow[dateReservation].<br>" ;
      }

      echo "<tr scope='row' class='bg-light'><th scope='col' class='text-center text-white bg-info w-25'>Réservation(s)</th>
      <td scope='col'>$reservations</td>";
    }
    echo "</table></div>";
}

}


//Bouton rechercher un document
if(isset($_POST['rechercher'])){
      
  if(!$_POST['recherche'] == '')
  {
      $recherche = sanitize($_POST['recherche']);
  
      $result = sql("SELECT * FROM documents WHERE titre LIKE '%$recherche%' "); // Rechercher le titre
  
      if($result->num_rows == 0)
      {
        $result = sql("SELECT * FROM documents WHERE auteur LIKE '%$recherche%' "); // Rechercher l'auteur
  
        if($result->num_rows == 0)
        {
          echo "<div class='container alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Aucune correspondance n'a été trouvé pour '$recherche'</strong></div>";
        }
        else
        { //Afficher les résultats
          if($_SESSION['utilisateur'] == 'Membre'){ afficher_membre($result); }
          else { afficher_equipe($result); }
        }
      }
      else 
      {//Afficher les résultats
        if($_SESSION['utilisateur'] == 'Membre'){ afficher_membre($result); }
        else { afficher_equipe($result); }
      } 
  }
}

//Bouton filtrer les documents par genre
if(isset($_POST['filtrer'])){
  if(isset($_POST['genre']))
  {
    $recherche = $_POST['genre'];

    $result = sql("SELECT * FROM documents WHERE genre LIKE '%$recherche%' "); // Rechercher le genre

    if($result->num_rows == 0)
    {
        echo "<div class='container alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Aucun document correspond au genre '$recherche'</strong></div>";
    }
    else
    { //Afficher les résultats
      afficher_membre($result);
    }
  }
}


//Formulaire : Effectuer des emprunts et réservations

$title = $action = $name = '';

if(isset($_POST['execute']))
{
  $title = sanitize($_POST['title']);
  $name = sanitize($_POST['name']);
  $action = sanitize($_POST['action']);

  if($title == '' || $name == '') // Si les saisies ne sont pas vide
  {
    echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Veuillez renseigner tous les champs</strong></div>";
  }
  else 
  { 
    $result = sql("SELECT id FROM membres WHERE nom='$name'"); // Rechercher le membre

    if($result->num_rows == 0)
    {
      echo "<div class='alert alert-danger'><i class='bi bi-x-octagon'></i><strong> Aucun membre ne correspond à se nom</strong></div>";
    }
    else 
    {
      $row = $result->fetch_assoc();
      $id = $row['id']; 

      $result = sql("SELECT code FROM documents WHERE titre LIKE '%$title%'"); // Rechercher le document

      if($result->num_rows == 0)
      {
       echo "<div class='alert alert-danger'><i class='bi bi-x-octagon'></i><strong> Aucun document ne correspond à se titre</strong></div>";
      }
      else 
      {
        $row = $result->fetch_assoc();
        $code = $row['code'];

        if($action == 'Prêt') // Pour effectuer un prêt
        {
          $date = date("Y-m-d", time()) ;
          $dateRetour = date("Y-m-d", strtotime('+1 month')) ;

          $result = sql("SELECT * FROM prets WHERE code='$code'"); // Vérifier que le document est disponible 
          if($result->num_rows == 0)
          {
            $result = sql("SELECT * FROM reservations WHERE code='$code' ORDER BY dateReservation"); // Vérifier si le document a été réservé

            if($result->num_rows == 0)
            { //Insérer le prêt dans la base de données
              sql("INSERT INTO prets VALUES('$id', '$code', '$date', '$dateRetour')");
    
              echo "<div class='alert alert-success'><i class='bi bi-check-circle'></i><strong> Emprunt confirmé</strong></div>";
            }
            else 
            {
              $row = $result->fetch_assoc();

              if($row['id'] == $id)
              { //Insérer le prêt dans la base de données et supprimer la réservation

                sql("DELETE FROM reservations WHERE id='$id' AND code='$code'");
                sql("INSERT INTO prets VALUES('$id', '$code', '$date', '$dateRetour')");
    
                 echo "<div class='alert alert-success'><i class='bi bi-check-circle'></i><strong> Emprunt confirmé</strong></div>";

              }
              else 
              {
                echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Ce document a été réservé par un autre membre</strong></div>";
              }
            }
          }
          else 
          {
            echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Ce document a déjà été emprunté</strong></div>";
          }
        }
        else if($action == 'Réservation') // Pour effectuer une réservation
        {
          $result = sql("SELECT * FROM reservations WHERE id='$id' AND code='$code'"); 

          if($result->num_rows == 0) // Insérer la réservation dans la base de données
          {
            $date = date("Y-m-d", time()) ;

            sql("INSERT INTO reservations VALUES('$id', '$code', '$date')"); // Insérer la réservation dans la base de données
    
            echo "<div class='alert alert-success'><i class='bi bi-check-circle'></i><strong> Réservation confirmée</strong></div>";
          }
          else 
          {
            echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Ce membre a déjà réservé ce document</strong></div>";
          }
        }
      }
    }
  }
}

// Formulaire : Effectuer des retours

$titre = '';

if(isset($_POST['retour'])) 
{
  $titre = sanitize($_POST['titre']);

  if($titre != '') //Vérifier que la saisie n'est pas vide
  {
    $result = sql("SELECT code FROM documents WHERE titre LIKE '%$titre%'"); // Vérifier que le document existe

    if($result->num_rows != 0)
    {
      $row = $result->fetch_assoc(); // Extraire le code du document
      $code = $row['code'];
      
      $result = sql("SELECT * FROM prets WHERE code='$code'"); // Vérifier que le prêt existe

      if($result->num_rows != 0)
      {
        $row = $result->fetch_assoc(); // Extraire le id du membre et la date du prêt
        $id = $row['id'];
        $date_pret = $row['datePret'];
        $date = date("Y-m-d", time()) ;

        sql("DELETE FROM prets WHERE code='$code'"); // Supprimer le prêt
        sql("INSERT INTO historique VALUES('$id', '$code', '$date_pret', '$date')"); // Insérer les informations dans l'historique des prêts

        $result = sql("SELECT nom FROM reservations NATURAL JOIN membres WHERE code='$code' ORDER BY dateReservation"); // Vérifier si quelqu'un a réservé le document

        if($result->num_rows == 0)
        {
          echo "<div class='alert alert-success'><i class='bi bi-check-circle'></i><strong> Le document a été retourné avec succès</strong></div>"; 
        }
        else 
        {
          $row = $result->fetch_assoc();
          $nom = $row['nom']; // Extraire le nom du membre qui a réservé le document

          echo "<div class='alert alert-success'><i class='bi bi-check-circle'></i><strong> Le document a été retourné avec succès</strong></div>"; 
          echo "<div class='alert alert-primary'><i class='bi bi-info-circle'></i> Le membre <strong>$nom</strong> a réservé le document</div>"; 
        }
      }
      else 
      {
        echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Ce document avait déjà été retourné</strong></div>";
      }
    }
    else 
    {
      echo "<div class='alert alert-danger'><i class='bi bi-x-octagon'></i><strong> Aucun document ne correspond à se titre</strong></div>";
    }
  }
  else 
  {
    echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Veuillez saisir le titre du document</strong></div>";
  }
}

// Formulaire : Créer des employés

if(isset($_POST['creer']))
{
  $nom = sanitize($_POST['nom']);
  $courriel = sanitize($_POST['courriel']);
  $mdp = sanitize($_POST['mdp']);

  if($nom == '' || $courriel == '' || $mdp == '')
  {
    echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Veuillez renseigner tous les champs</strong></div>";
  }
  else 
  {
    $result = sql("SELECT * FROM equipe WHERE courriel='$courriel'");

    if($result->num_rows == 0)
    {
      sql("INSERT INTO equipe VALUES('$nom', '$courriel', '$mdp', 'Employé')"); // Insérer l'employé dans la base de données

      echo "<div class='alert alert-success'><i class='bi bi-check-circle'></i><strong> L'employé a été créé</strong></div>"; 

    }
    else 
    {
      echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Un employé utilise déjà cette adresse courriel</strong></div>";
    }
  }
}

// Bonton Effacer dans le formulaire Créer des membres et des documents
if(isset($_POST['effacer'])){
  if(isset($_POST['docs']))
  {
    $titre = $auteur = $annee = $categorie = $type = $genre = $description = $isbn = "";
  }
  else 
  {
    $nom = $adresse = $tel = $courriel = $motdepasse =  "";
  }
  
  
}


// Formulaire : Creer des documents
$titre = $auteur = $annee = $categorie = $type = $genre = $description = $isbn = "";

if(isset($_POST['creerDocs']))
{
  $titre = sanitize($_POST['titre']);
  $auteur = sanitize($_POST['auteur']);
  $annee = sanitize($_POST['annee']);
  $categorie = sanitize($_POST['categorie']);
  $type = sanitize($_POST['type']);
  $genre = sanitize($_POST['genre']);
  $description = sanitize($_POST['description']);
  $isbn = sanitize($_POST['isbn']);

  if($titre == "" || $auteur == ""  || $annee == "" || $categorie == "" || $type == "" || $genre == "" || $description == "" || $isbn == "") // Vérifier que les entrées ne sont pas vide
  { 
    echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i><strong> Veuillez renseigner tous les champs</strong></div>";
  }
  else 
  {
    $result = sql("SELECT titre FROM documents WHERE titre='$titre'");  // Vérifier que le document n'existe pas déjà
    if($result->num_rows > 0)
    {
      echo "<div class='alert alert-danger'><i class='bi bi-x-octagon'></i><strong> Ce document existe déjè</strong></div>";
    }
    else 
    { //Insérer le document dans la base de données

      $instruction = $conn->prepare("INSERT INTO documents VALUES(?,?,?,?,?,?,?,?,?)");
      $instruction->bind_param('issssssss', $code, $titre, $auteur, $annee, $categorie, $type, $genre, $description, $isbn);
  
      $code = '';
  
      $instruction->execute();
      $rows = $instruction->affected_rows;

      if($rows == 1) 
      {
        echo "<p class='alert alert-success'><i class='bi bi-check-circle'></i><strong> Le document a été ajouté</strong></p>";
      }
      else { echo "<p class='alert alert-danger'><i class='bi bi-x-octagon'></i><strong> Le document n'a pas pu être enregistré</strong></p>"; }
    }
  }
}
?>