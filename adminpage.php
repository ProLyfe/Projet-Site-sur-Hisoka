<!-- Début connexion aux Bases de donnée -->
<?php 
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO:: MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
?>

<?php 
$bdd = new PDO('mysql:host=localhost;dbname=articles', 'root', '', array(PDO:: MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
?>
<!-- Début connexion aux Bases de donnée -->


<!doctype html>
<html lang="fr">
    <head>
        <!-- Configuration du code -->
        <link rel="icon" type="image/x-icon" href="img/hisokathena.png"/>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/burger.css">
       


        <script src="js/main.js"></script>
        <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});</script>
        <title>Hisoka</title>
    </head>
    <body>
<!-- Header -->
<?php require_once('inc/header.inc.php'); ?>
<!-- Fin Header -->
        
<br><br>
        
    
 <div class="contenant">
     
     <div class="boite">
        <h2>Espace Admin</h2>
         
        <br><br><br>
        
         <hr class="separateur">
     </div>
     
     
     
     
     <div class="boite">
        <br>
        <h2>Envoi d'articles</h2>
        <br>
                <?php
                    if(isset($_POST['article_titre'], $_POST['article_contenu'])) { // On vient récupérer le titre et le contenu
                       if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {

                          $article_titre = htmlspecialchars($_POST['article_titre']);
                          $article_contenu = ($_POST['article_contenu']);
                          $ins = $bdd->prepare('INSERT INTO articles (titre, contenu, date_time_publication) VALUES (?, ?, NOW())'); // On envoi les articles dans la BDD.
                          $ins->execute(array($article_titre, $article_contenu));
                          $message = 'Votre article a bien été posté';
                       } else {
                          $message = 'Veuillez remplir tous les champs';
                       }
                    }
                ?>
<form method="POST">
    <input type="text" name="article_titre" placeholder="Titre" /><br><br>
    <textarea name="article_contenu" id="myTextarea"placeholder="Contenu de l'article"></textarea><br><br> 
    <input type="submit" value="Envoyer l'article" />
</form>
                    <br>
               
                    <?php if(isset($message)) { echo $message; } // On écrit un message s'il y a qqchose dans le champs de texte?> 
                   
                    
                    
<br><br><br><br><br>                   
                    
        <hr class="separateur">
        <br>
     </div>
     
     
     
     
     <div class="boite">
        <h2>Envoi d'images</h2>
        <br><br><br>
                     
            <form action="adminpage.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file_img" /><br>
                <input type="submit" name="btn_upload" value="Upload">	
            </form>

<?php
         
if(isset($_POST['btn_upload'])) // btn_upload est le nom du bouton.
{
	$filetmp = $_FILES["file_img"]["tmp_name"];
	$filename = $_FILES["file_img"]["name"];
	$filetype = $_FILES["file_img"]["type"];
	$filepath = "photo/".$filename;
	
	move_uploaded_file($filetmp,$filepath);
	
	$sql = "INSERT INTO upload_img (img_name,img_path,img_type) VALUES ('$filename','$filepath','$filetype')"; 
    // On mets nos images dans la BDD.
	$result = $pdo->prepare($sql);
    $result->execute();
}
         
?>

                
        <br>
        <hr class="separateur">
     </div>
    <div class="boite">
        <h2>Les membres</h2>
            <br><br>
        

<?php 
     
// On envoi dans la BDD les éléments de la page contact.    

if(isset($_POST['pseudo']) ) {
        echo '<br>Pseudo posté : ' . $_POST['pseudo'] . '<br>';
        echo '<br>Message posté : ' . $_POST['message'] . '<br>';
        
        $pdostatment = $pdo->query("INSERT INTO commentaire(pseudo, message, mail)
            VALUES('$_POST[pseudo]', '$_POST[message]', NOW() )" );
    }
    
        
//On affiches les messages de la table "commentaire" et on les tri par "id".
$pdostatement = $pdo->query('SELECT * FROM commentaire ORDER BY id DESC');

    while( $commentaire = $pdostatement->fetch(PDO::FETCH_ASSOC)) { //On prends tout les éléments présents dans la table commentaire.
        
        // On affiche le tout sous forme de tableau.
        echo '<div style="border: 1px solid;">';
            echo "<p>".$commentaire['pseudo']."</p>";
            echo "<p> ".$commentaire['message'] ."</p>";
            echo "<p> ".$commentaire['mail'] ."</p>";
        echo '</div>';
        
        
    }                
?>                             
     </div>          
</div>
        
  

<br><br><br><br><br><br><br><br><br><br><br><br><br>



   
        
<!-- Footer -->
    <?php require_once('inc/footer.inc.php'); ?>
<!-- Fin Footer -->
        
<!-- Début fin html -->
    <?php require_once('inc/endhtml.inc.php'); ?>
<!-- Fin fin html -->