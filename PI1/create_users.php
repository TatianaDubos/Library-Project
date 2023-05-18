<?php session_start();  include_once "header.php"; ?>
<script>document.getElementById('home').innerHTML = '<a href=\'equipe.php\' title=\'Acceuil\'><i class=\'bi bi-house\'></i></a>' ; </script>

<div class='container'>


     <form method='post' class='bg-info text-white rounded my-5 p-5'>
      <h3 class='text-center'>Créer des Employés</h3>

      <?php include_once "fonctions.php"; ?>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-person"></i></span>
           <input type="text" class="form-control" placeholder="Prénom et Nom" name="nom">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-envelope"></i></span>
           <input type="email" class="form-control" placeholder="Email" name="courriel">
        </div>
   
       <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-key"></i></span>
           <input type="password" class="form-control" placeholder="Mot de passe" name="mdp">
       </div>
  
       <div class='text-center'>
         <input type='submit' value="Créer" class="btn btn-primary px-5" name='creer'>
         <input type="reset" value="Effacer" class="btn btn-primary px-5">
       </div>

      </form>

<hr>
     
     <form method='post' class='bg-info text-white rounded my-5 p-5'>
      <h3 class='text-center'>Créer des Membres</h3>

         <?php include_once "verif.php"; ?>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-person"></i></span>
           <input type="text" class="form-control" placeholder="Prénom et Nom" name="nom" value="<?php echo $nom ;?>">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
           <input type="text" class="form-control" placeholder="Adresse, Ville, Province" name="adresse" value="<?php echo $adresse ;?>">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-telephone"></i></span>
           <input type="tel" class="form-control" placeholder="Téléphone" name="tel" value="<?php echo $tel ;?>">
        </div>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-envelope"></i></span>
           <input type="email" class="form-control" placeholder="Email" name="courriel" value="<?php echo $courriel ;?>">
        </div>
   
       <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-key"></i></span>
           <input type="password" class="form-control" placeholder="Mot de passe" name="motdepasse" value="<?php echo $motdepasse ;?>">
       </div>
  
       <div class='text-center'>
         <input type='submit' value="Créer" class="btn btn-primary px-5" name='sinscrire'>
         <form method='post'><input type="submit" value="Effacer" name='effacer' class="btn btn-primary px-5"></form>
       </div>

      </form>

</div>


<?php
include_once "footer.php"; 
?>