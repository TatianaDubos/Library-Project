<?php session_start(); include_once "header.php"; ?>
<script>document.getElementById('home').innerHTML = '<a href=\'equipe.php\' title=\'Acceuil\'><i class=\'bi bi-house\'></i></a>' ; </script>


<div class='container'>
     <form method='post' class='bg-info text-white rounded mt-4 p-4'>
         <h3 class='text-center'>Retour de documents</h3><hr>

         <?php include_once "fonctions.php"; ?>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-book"></i></span>
           <input type="text" class="form-control" placeholder="Titre du document" name="titre" value="<?php echo $titre;?>">
       </div>

       <div class='text-center'>
         <input type='submit' value='Retourner' class="btn btn-primary px-5" name='retour'>
       </div>
    </form>

</div>


<?php
include_once "footer.php";
?>