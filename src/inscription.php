<?php include_once "header.php"; ?>
<script>   document.getElementById('Inscription').href = 'index.php'; document.getElementById('Inscription').innerHTML = 'Acceuil' ;  </script>

<!-- Formulaire d'Inscription -->

<div class='container'>
     
     <form method='post' class='bg-info text-white rounded my-5 p-5'>
      <h3 class='text-center'>Inscription </h3>

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
         <input type='submit' value="S'inscrire" class="btn btn-primary px-5" name='sinscrire'>
       </div>

      </form>
</div>

<?php include_once "footer.php";  ?>