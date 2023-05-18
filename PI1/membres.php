<?php session_start(); include_once "header.php"; ?>

<!-- Formulaire rechercher un document -->

    <div class='container bg-info text-white rounded p-3'>
     
    <form method='post'>
        <h3 class='text-center'>Rechercher un document</h3><hr>

       <div class="input-group p-2">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input type="text" class="form-control" placeholder="Titre ou auteur..." name='recherche' >
       </div>

      <div class='text-center'>
        <input type='submit' value='Rechercher' class="btn btn-primary px-5" name='rechercher'>
      </div>
    </form><hr>

    <form method='post'>

       <div class="input-group p-2">
          <span class="input-group-text"><i class="bi bi-funnel"></i></span> 
          <select name='genre' class="form-select text-center">
          <option disabled selected class='text-info'>Genre</option>
          <option>Drame</option>
          <option>Romance</option>
          <option>Humoristique</option>
          <option>Comédie</option>
          <option>Fantastique</option>
          <option>Science fiction</option>
          <option>Surnaturel</option>
          <option>Policier</option>
          <option>Horreur</option>
          <option>Psychologique</option>
          <option>Philosophique</option>
          <option>Société</option>
          <option>Autobiographique</option>
      </select>
       </div>

      <div class='text-center'>
        <input type='submit' value='Filtrer' class="btn btn-primary px-5" name='filtrer'>
      </div>
    </form><hr> 
    <a class="nav-link" href="documents.php">Tous nos documents</a>
  </div><br>
 
<?php

include_once "fonctions.php";

include_once "footer.php";
?>
