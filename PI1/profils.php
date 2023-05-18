<?php session_start(); 
include_once "header.php"; 
include_once "fonctions.php"; ?>

<script>document.getElementById('home').innerHTML = '<a href=\'equipe.php\' title=\'Acceuil\'><i class=\'bi bi-house\'></i></a>' ; </script>
<div class='container'>

<!-- Formulaire rechercher un membre -->
<div class='bg-info text-white rounded p-4 my-4'>
<form method='post'>
<h3 class='text-center'>Rechercher un membre</h3><hr>
    
    <div class="input-group p-2">
       <span class="input-group-text"><i class="bi bi-search"></i></span>
       <input type="text" class="form-control" placeholder="Nom du membre" name='nom_membre' >
    </div>

   <div class='text-center'>
     <input type='submit' value='Rechercher' class="btn btn-primary px-5" name='rechercher_membre'>
   </div>

</form></div>


<?php

if(isset($_POST['rechercher_membre']))
{
    $recherche = $_POST['nom_membre'];
    if($recherche != '')
    {
       $result = sql("SELECT * FROM membres WHERE nom LIKE '%$recherche%'");
       afficher_profil($result);
    }
}

// Voir tous les membres 
echo "<br><hr><h1 class='display-5 text-center text-info m-3'>Tous les membres</h1><br>"; 
$result = sql("SELECT * FROM membres ORDER BY nom");

if($result->num_rows == 0)
{
    echo "<div class='alert alert-info'><strong>Aucun membre à afficher pour le moment</strong></div>";
}
else 
{
    echo "<div class='alert alert-info'><strong>Total :</strong> $result->num_rows membres</div>";

   afficher_profil($result);
}

echo "</div>";

include_once "footer.php";
?>