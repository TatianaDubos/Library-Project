<?php session_start(); include_once "fonctions.php"; include_once "header.php";

if($_SESSION['utilisateur'] == "Membre") // Membres : Voir tous nos documents
{   echo "<script> document.getElementById('page1').href = 'membres.php'; document.getElementById('page1').innerHTML = 'Acceuil' ; document.getElementById('page1').className = 'nav-link btn btn-sm btn-outline-info px-1 m-1 w-100';</script>";

    $result = sql("SELECT * FROM documents ORDER BY titre");

    //Afficher les résultats
    echo "<h1 class='display-5 text-center text-info m-3'>Tous nos documents</h1><br>";

    afficher_membre($result);

}
else // Équipe : Voir tous nos documents
{

    echo "<script>document.getElementById('home').innerHTML = '<a href=\'equipe.php\' title=\'Acceuil\'><i class=\'bi bi-house\'></i></a>' ; </script>";

    $result = sql("SELECT * FROM documents ORDER BY titre");

    //Afficher les résultats
    echo "<h1 class='display-5 text-center text-info m-3'>Tous nos documents</h1><br>";

    afficher_equipe($result);
}








include_once "footer.php";
?>