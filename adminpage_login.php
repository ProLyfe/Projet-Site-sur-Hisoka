<!-- Début connexion à la Base de donnée -->
<?php
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO:: MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
?>
<!-- Fin connexion à la Base de donnée -->


<!-- Début Doctype -->
<?php require_once('inc/doctype.inc.php'); ?>
<!-- Fin Doctype -->


<!-- Header -->
<?php require_once('inc/header.inc.php'); ?>
<!-- Fin Header -->
        
<br><br><br><br>
        
    
<?php
 
//On déclare nos variables : le nom d'utilisateur et le mdp.
                    
    $utilisateur = "Rayane";
    $motdepasse = "123456789";
                    
//On vérifie si les champs input qu'on mettra plus tard son vide si ils sont vides,  on charge la page, si non on vérifie les logins et on affiche les données
                    
//Si les id sont correctes ou interdit l'accès si login incorrecte
                    
            if(empty($_POST['utilisateur']) && empty($_POST['motdepasse'])) {
                      
            //affiche Le formulaire si les champs sont vides.  
             
?>
                    
                    
<div class="contenant">
    <div class="boite">
            <h2>Connexion admin</h2>
            <br>
            <form method="post" action="#"> 
                <input type="text" name="utilisateur" placeholder="Identifiant"> 
                <input type="password" name="motdepasse" placeholder="Mot de passe"> 
                <input type="submit" value="Connexion..."> 
            </form>
    </div>
</div>
                    
                    
                    
<?php
      
        }
       // Si il y a quelque choses on vérifie que les logins  sont correctes ou pas.             
            else{
                if($_POST['utilisateur'] == $utilisateur && $_POST['motdepasse'] == $motdepasse) {
                    header("Location: adminpage.php");
   exit;
                        }
            else{
                echo"identifiant incorrectes"; }
                    
                    }
?>
                    
 

                   
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

   
    
        
<!-- Footer -->
    <?php require_once('inc/footer.inc.php'); ?>
<!-- Fin Footer -->

<!-- Début fin html -->
    <?php require_once('inc/endhtml.inc.php'); ?>
<!-- Fin fin html -->