<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/stylesheet.css">
    <!-- CDN jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> 
    <!-- CDN bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>Bibliothèque municipale Port-Cartier</title>
</head>
<body>

<?php 

if(isset($_SESSION['utilisateur'])) {

    if($_SESSION['utilisateur'] == "Membre"){
      // Barre de navigation pour les membres
    echo <<<_END
    <nav class="navbar navbar-expand-md  bg-light navbar-light">
        <div class="container-fluid flex-nowrap text-center">

            <img src="Images/logo.png" style="width:100px;">
            <p class="display-5 mx-3 text-info"><small>Bibliothèque Le Manuscrit</small></p>
            
            <ul class="navbar-nav">

                <li class="nav-item mx-1" > 
                    <a href="" id="page1"></a>
                </li>

                <li class="nav-item mx-1"> 
                    <a class="nav-link btn btn-sm btn-outline-info px-1 m-1 w-100" href="emprunts.php" id='page2'>Mes emprunts et réservations</a>
                </li>

               
                    

                <li class="nav-item mx-1">
                    <form method="post">
                        <input class="nav-link btn btn-sm btn-outline-info px-1 m-1 w-100" type="submit" name='Deconnexion' value='Deconnexion' id='Deconnexion'>
                    </form>
                </li>       

                    
            

            </ul>
        </div>
    </nav> <main>

    <p class='text-info'>Connecté en tant que '$_SESSION[utilisateur]' - $_SESSION[nom]</p> 

_END;
  
} else if($_SESSION['utilisateur'] == "Employé") {
    // Barre de navigation pour les employés
    echo <<<_END
    <nav class="navbar navbar-expand-md  bg-light navbar-light">
        <div class="container-fluid flex-nowrap text-center">

            <img src="Images/logo.png" style="width:100px;">
            <p class="display-5 mx-3 text-info"><small>Bibliothèque Le Manuscrit</small></p>

            <ul class="navbar-nav">
                <li class="nav-item dropdown dropstart">
                    <button class="nav-link dropdown-toggle btn btn-sm btn-outline-info px-1 m-1" role="button" data-bs-toggle="dropdown" aria-expanded="false">Documents</button>
                    <ul class="dropdown-menu" style='position:absolute;'>
                        <li><a class="dropdown-item" href="actions.php">Effectuez des emprunts et des réservations</a></li>
                        <li><a class="dropdown-item" href="emprunts.php">Voir tous les emprunts et les réservations</a></li>
                        <li><a class="dropdown-item" href="retours.php">Effectuer des retours</a></li>
                    </ul>
                </li>

                <li class="nav-item"> 
                    <a class="nav-link btn btn-sm btn-outline-info px-1 m-1" href="profils.php">Membres</a>
                </li> 

                <li class="nav-item">
                    <form method="post">
                        <input class="nav-link btn btn-sm btn-outline-info px-1 m-1" type="submit" name='Deconnexion' value='Deconnexion'>
                    </form>
                </li>

            </ul>
        </div>
    </nav> <main>
    <span id='home'></span>
    <p class='text-info'>Connecté en tant que '$_SESSION[utilisateur]' - $_SESSION[nom]</p> 

_END;

} else if($_SESSION['utilisateur'] == "Administrateur"){
    // Barre de navigation pour les administrateurs
    echo <<<_END
    <nav class="navbar navbar-expand-md  bg-light navbar-light">
        <div class="container-fluid flex-nowrap text-center">

            <img src="Images/logo.png" style="width:100px;">
            <p class="display-5 mx-3 text-info"><small>Bibliothèque Le Manuscrit</small></p>

            <ul class="navbar-nav">
                <li class="nav-item dropdown dropstart">
                    <button class="nav-link dropdown-toggle btn btn-sm btn-outline-info px-1 m-1" role="button" data-bs-toggle="dropdown" aria-expanded="false">Documents</button>
                    <ul class="dropdown-menu" style='position:absolute;'>
                        <li><a class="dropdown-item" href="create_docs.php">Ajouter des nouveaux documents</a></li>
                        <li><a class="dropdown-item" href="actions.php">Effectuez des emprunts et des réservations</a></li>
                        <li><a class="dropdown-item" href="emprunts.php">Voir tous les emprunts et les réservations</a></li>
                        <li><a class="dropdown-item" href="retours.php">Effectuer des retours</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown dropstart">
                    <button class="nav-link dropdown-toggle btn btn-sm btn-outline-info px-1 m-1" role="button" data-bs-toggle="dropdown" aria-expanded="false">Utilisateurs</button>
                    <ul class="dropdown-menu" style='position:absolute;'>
                        <li><a class="dropdown-item" href="profils.php">Profils des membres</a></li>
                        <li><a class="dropdown-item"  href="create_users.php">Créer des nouveaux utilisateurs</a></li> 
                    </ul>
                </li>

                <li class="nav-item">
                    <form method="post">
                        <input class="nav-link btn btn-sm btn-outline-info px-1 m-1" type="submit" name='Deconnexion' value='Deconnexion'>
                    </form>
                </li>

            </ul>
        </div>
    </nav> <main>
    <span id='home'></span>
    <p class='text-info'>Connecté en tant que '$_SESSION[utilisateur]' - $_SESSION[nom]</p> 

_END;

}
} else { // Barre de navigation de la page d'acceuil
    echo <<<_END
    <nav class="navbar navbar-expand-md  bg-light navbar-light">
        <div class="container-fluid flex-nowrap text-center">

            <img src="Images/logo.png" style="width:100px;">

            <p class="display-5 mx-3 text-info" >Bibliothèque Le Manuscrit</p>

            <ul class="navbar-nav">
                <li class="nav-item" > 
                    <a href='connexion.php' class="nav-link btn btn-outline-info px-3 m-2" id='Connexion' name='Connexion'>Connexion</a>
                </li>

                <li class="nav-item">
                    <a href='inscription.php' class="nav-link btn btn-outline-info px-3 m-2" id='Inscription' name='Inscription'/>Inscription</a>
                </li>
            </ul>
        </div>
    </nav> <main>

_END;

}

?>
