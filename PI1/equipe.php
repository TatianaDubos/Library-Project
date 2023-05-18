<?php session_start();  include_once "header.php"; ?>

<!-- Formulaire rechercher un document -->

        <div class='container bg-info text-white rounded p-4 mt-4'>
         
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
        <a class="nav-link" href="documents.php">Tous nos documents</a>
      </div><br>

<?php
include_once "fonctions.php";


include_once "footer.php"; 
?>


