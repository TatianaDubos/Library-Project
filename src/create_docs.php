<?php session_start();  include_once "header.php"; ?>
<script>document.getElementById('home').innerHTML = '<a href=\'equipe.php\' title=\'Acceuil\'><i class=\'bi bi-house\'></i></a>' ; </script>
<div class= 'container'>

<form method='post' class='bg-info text-white rounded my-5 p-5'>
      <h3 class='text-center'>Ajouter des documents</h3>

         <?php include_once "fonctions.php"; ?>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-book"></i></span>
           <input type="text" class="form-control" placeholder="Titre" name="titre" value="<?php echo $titre ;?>">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-person"></i></span>
           <input type="text" class="form-control" placeholder="Auteur" name="auteur" value="<?php echo $auteur ;?>">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-calendar4-week"></i></span>
           <input type="text" class="form-control" placeholder="Année de publication" name="annee" value="<?php echo $annee ;?>">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
           <input type="text" class="form-control" placeholder="Catégorie" name="categorie" value="<?php echo $categorie ;?>">
        </div>
   
       <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-people"></i></span>
           <input type="text" class="form-control" placeholder="Type" name="type" value="<?php echo $type ;?>">
       </div>

       <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-journal-bookmark-fill"></i></span>
           <input type="text" class="form-control" placeholder="Genre" name="genre" value="<?php echo $genre ;?>">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-justify-left"></i></span>
           <textarea class="form-control" placeholder="Description" name="description"><?php echo $description ;?></textarea>
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-bookmark"></i></span>
           <input type="text" class="form-control" placeholder="ISBN" name="isbn" value="<?php echo $isbn ;?>">
        </div>
  
       <div class='text-center'>
         <input type='submit' value="Créer" class="btn btn-primary px-5" name='creerDocs'>
         <form method='post'>
            <input type="hidden" name='docs'>
            <input type="submit" value="Effacer" name='effacer' class="btn btn-primary px-5">
         </form>
         
       </div>

      </form>

</div>

<?php
include_once "footer.php"; 
?>