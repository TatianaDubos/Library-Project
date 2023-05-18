<?php session_start(); include_once "header.php"; ?>
<script>document.getElementById('home').innerHTML = '<a href=\'equipe.php\' title=\'Acceuil\'><i class=\'bi bi-house\'></i></a>' ; </script>


<div class='container'>
     <form method='post' class='bg-info text-white rounded p-4 mt-4'>
         <h3 class='text-center'>Emprunts et réservations</h3><hr>

         <?php include_once "fonctions.php"; ?>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-person"></i></span>
           <input type="text" class="form-control" placeholder="Nom du membre" name="name" value="<?php echo $name; ?>">
       </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-book"></i></span>
           <input type="text" class="form-control" placeholder="Titre du document" name="title" value="<?php echo $title; ?>">
        </div>
   
       <div class="input-group p-2">
         <span class="input-group-text"><i class="bi bi-bookmark-plus"> Action</i></span>
            <select name='action'>
                <option <?php if($action == 'Prêt') echo "selected" ;?> >Prêt</option>
                <option <?php if($action == 'Réservation') echo "selected" ;?> >Réservation</option>
             </select>
        </div>

       <div class='text-center'>
         <input type='submit' value='Exécuter' class="btn btn-primary px-5" name='execute'>
       </div>
    </form>

</div>


<?php
include_once "footer.php";
?>