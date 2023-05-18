<?php include_once "fonctions.php";

// Décrarer nos variables
$mail = $mdp = $utilisateur = "";
$nom = $adresse = $tel = $courriel = $motdepasse = $erreurs = "";

if(isset($_POST["seconnecter"])) {  // Si formulaire d'identification soumis
// Extraire les données
$mail = sanitize($_POST["mail"]);
$mdp = sanitize($_POST["mdp"]);
$utilisateur = $_POST["utilisateur"];


if($mail == '' || $mdp == '' ) {
    echo "<p class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> <strong>Veuillez renseigner tous les champs</strong></p>" ;
}
else { // Vérification des données 

    switch ($utilisateur) {
        case 'Membre':
            $result = sql("SELECT * FROM membres WHERE courriel='$mail'");

            if($result->num_rows < 1) {
                echo "<p class='alert alert-warning'><i class='bi bi-x-octagon'></i> <strong>Informations invalides</strong></p>";
            } 
            else { 
        
                $row = $result->fetch_array(MYSQLI_ASSOC);
        
                if($row['mdp'] == $mdp)
                {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['nom'] = $row['nom'];
                    $_SESSION['utilisateur'] = $utilisateur;

                    echo "<script> window.location.replace('http://localhost/PI1/membres.php');</script>";
                }
                else {
                    echo "<p class='alert alert-warning'><i class='bi bi-x-octagon'></i> <strong>Informations invalides</strong></p>";
                }
            }
            $result->close();
            break;
        
        case 'Employé':
        case 'Administrateur': 
            $result = sql("SELECT * FROM equipe WHERE courriel='$mail'");

            if($result->num_rows < 1) {
                echo "<p class='alert alert-warning'><i class='bi bi-x-octagon'></i> <strong>Informations invalides</strong></p>";
            } 
            else { 
        
                $row = $result->fetch_array(MYSQLI_ASSOC);
        
                if($row['mdp'] == $mdp)
                {

                    if($row['role'] == $utilisateur)
                    {
                        session_start();
                        $_SESSION['nom'] = $row['nom'];
                        $_SESSION['utilisateur'] = $utilisateur;
                        
                        echo "<script> window.location.replace('http://localhost/PI1/equipe.php');</script>";
                    }
                    else {
                        echo "<p class='alert alert-warning'><i class='bi bi-x-octagon'></i> <strong>Le type d'utilisateur '$utilisateur' n'est pas le votre</strong></p>";
                    }
                }
                else {
                    echo "<p class='alert alert-warning'><i class='bi bi-x-octagon'></i> <strong>Informations invalides</strong></p>";
                }
            }
            $result->close();
            break;
    }
}
}



if(isset($_POST["sinscrire"])) { // Si formulaire d'inscription soumis
//Extraire les données
$nom = sanitize($_POST["nom"]);
$adresse = sanitize($_POST["adresse"]);
$tel = sanitize($_POST["tel"]);
$courriel = sanitize($_POST["courriel"]);
$motdepasse = sanitize($_POST["motdepasse"]);
// Valider les champs
$erreurs .= validNom($nom);
$erreurs .= validAdresse($adresse);
$erreurs .= validTel($tel);
$erreurs .= validCourriel($courriel);
$erreurs .= validMdp($motdepasse);

if($erreurs == "") { // Si le formulaire est validé
    //Enregister le membre dans la base de données
    
    $instruction = $conn->prepare("INSERT INTO membres VALUES(?,?,?,?,?,?)");
    $instruction->bind_param('isssss', $id, $nom, $adresse, $tel, $courriel, $motdepasse);

    $id = '';

    $instruction->execute();
    $rows = $instruction->affected_rows;

    if($rows == 1) {

        if(isset($_SESSION['utilisateur']))
        {
            echo "<p class='alert alert-success'><i class='bi bi-check-circle'></i><strong> Le membre a été créé</strong></p>";
        }
        else 
        {
            echo "<p class='alert alert-success'><i class='bi bi-check-circle'></i> <strong>Votre inscription a été confirmée</strong><br>
                <a href='connexion.php'>Cliquez ici pour se connecter</a></p>";
        }
    }
    else { echo "<p class='alert alert-warning'><i class='bi bi-x-octagon'></i> <strong>L'inscription n'a pas pu être traitée</strong></p>"; }

    $instruction->close();
}
else { // Afficher les erreurs
    echo "<p class='alert alert-danger'><i class='bi bi-exclamation-triangle'></i> <strong>Les erreurs suivantes ont été détectées :</strong> <br> $erreurs </p>" ;
}

}

// Fonctions de validation des champs

function validNom($champ) {

    if($champ == "")
    {
        return "Aucun nom entré. <br>" ;
    } 
    else if(preg_match("/[0-9]/ ", $champ))
    {
        return "Seulement les lettres sont permise dans le nom. <br>" ;
    } 
    else { return ""; }

}

function validAdresse($champ) {

    if($champ == "")
    {
        return "Aucune adresse entrée. <br>" ;
    } 
    else { return ""; }

}

function validTel($champ) {

    if($champ == "")
    {
        return "Aucun numéro de téléphone entrée. <br>" ;
    } 
    elseif(!preg_match("/\D\d\d\d\D+\d\d\d\D\d\d\d\d/ ", $champ)) 
    {
        return "Le numéro de téléphone dois être entré dans le format suivant : (000)000-0000 <br>" ;
    }
    else { return ""; }
}

function validCourriel($champ) {

    global $conn;
    $result = $conn->query("SELECT courriel FROM membres WHERE courriel='$champ' ");
    $rows = $result->num_rows ;

    if($champ == "")
    {
        return "Aucune adresse courriel entrée. <br>" ;
    }
    else if(!preg_match("/[0-9A-Z]\./i ", $champ))
    {
        return "Adresse courriel invalide. <br>";
    }
    elseif(!$rows == 0) 
    {
        return "Un membre utilise déjà cette adresse courriel. <br>";
    }
    else { return ""; }

}

function validMdp($champ) {

    if($champ == "")
    {
        return "Aucun mot de passe entré. <br>" ;
    } 
    else { return ""; }

}


?>
