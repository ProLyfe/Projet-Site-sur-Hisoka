<?php

// On se connecte à la BDD
$bdd = new PDO('mysql:host=localhost;dbname=articles', 'root', '', array(PDO:: MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));



if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']); // On sécurise les variables.
    
    $article = $bdd->prepare('SELECT * FROM articles WHERE id = ?'); // Le "?" va contenir le $get_id.
    $article->execute(array($get_id));
    
    if($article->rowCount() == 1) { // Si l'article existe alors...
       $article = $article->fetch(); // On va chercher nos articles dans la BDD.
       $titre = $article['titre']; // On défini la variable "titre".
       $contenu = $article['contenu']; // On défini la variable "contenu".     
        
    } else {
       die('Cet article n\'existe pas !'); // Si l'article n'existe pas, on affiche ce message.
    }
    
} else {
    die('Erreur');  // Si ça ne marche pas, on affiche erreur.
    
}
?>
     



<!-- Début Doctype -->
<?php require_once('inc/doctype.inc.php'); ?>
<!-- Fin Doctype -->



<!-- Header -->
    <?php require_once('inc/header.inc.php'); ?>
<!-- Fin Header -->
        
<br><br>
       
<div class="contenant">
    <div class="boite">
        
       <h1><?= $titre ?></h1> <!-- On affiche le titre de l'article -->
        <p><?= $contenu ?></p> <!-- On affiche le contenu de l'article -->
                   
    </div>
</div>    


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 
        
<!-- Footer -->
    <?php require_once('inc/footer.inc.php'); ?>
<!-- Fin Footer -->
        

<!-- Début fin html -->
    <?php require_once('inc/endhtml.inc.php'); ?>
<!-- Fin fin html -->