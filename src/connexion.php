<?php include_once "header.php"; ?>
<script>   document.getElementById('Connexion').href = 'index.php'; document.getElementById('Connexion').innerHTML = 'Acceuil' ;  </script>

<!-- Formulaire d'Identification -->

<div class='container'>
     
     <form method='post' class='bg-info text-white rounded my-5 p-5'>
         <h3 class='text-center'>Identifiez-vous</h3>

        <?php include_once "verif.php"; ?>

        <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-envelope"></i></span>
           <input type="email" class="form-control" placeholder="Email" name="mail" value="<?php echo $mail; ?>">
        </div>
   
       <div class="input-group p-2">
           <span class="input-group-text"><i class="bi bi-key"></i></span>
           <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" value="<?php echo $mdp; ?>">
       </div>

       <div class="input-group p-2">
         <span class="input-group-text"><i class="bi bi-people"> Se connecter en tant que </i></span>
            <select name='utilisateur'>
                <option>Membre</option>
                <option <?php if($utilisateur == 'Employé') echo "selected" ;?> >Employé</option>
                <option <?php if($utilisateur == 'Administrateur') echo "selected" ;?> >Administrateur</option>
             </select>
        </div>

       <div class='text-center'>
         <input type='submit' value='Se connecter' class="btn btn-primary px-5" name='seconnecter'>
       </div>
     </form>
   </div>

<?php include_once "footer.php"; ?>