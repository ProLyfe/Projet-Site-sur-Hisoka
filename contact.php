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
        
<br><br>
        
        
            <?php 
    //5 - Insertion en BDD des messages postés 
    
    if(isset($_POST['pseudo']) ) {
               
        $pdostatment = $pdo->query("INSERT INTO commentaire(pseudo, message, mail)
            VALUES('$_POST[pseudo]', '$_POST[message]', NOW() )" );
    }
    
    //6 - Affichages des messages
    $pdostatement = $pdo->query('SELECT * FROM commentaire ORDER BY id DESC');
        
            ?>
        
        
<!--Début envoi par mail -->

<?php
if(isset($_POST['mailform']))
{
	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
	{
		$header="MIME-Version: 1.0\r\n";
		$header.='From:"SiteHisoka"<support@prolyfe.000webhostapp.com>'."\n"; 
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';

		$message='
<!DOCTYPE html>
<html>
	<body>
    	<style>
        	div {
  				 background-color: #663399;
                 color: white;
				}
            			
        </style>
        
				<div align="center" class="back">
					<img src="https://prolyfe.000webhostapp.com/imgban1.png"/>
					<br />
                    <br />
                    <br />
                    <br />
					<u>Nom de l\'expéditeur :</u>'.$_POST['pseudo'].'<br />
					<u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
					<br />
					'.nl2br($_POST['message']).' 
					<br />
                    <br />
                    <br />
                    <br />
                    <br />
					<img src="https://prolyfe.000webhostapp.com/img2mail.png"/>
                    <br />
                    <br />
				</div>
	</body>
</html>
		';

		mail("rayane.prolyfe@gmail.com", "CONTACT - Monsite.com", $message, $header); //Adresse de destination du message.
		$msg="Votre message a bien été envoyé !"; 
	}
	else
	{
		$msg="Tous les champs doivent être complétés !";
	}
}
?>        

<!--Fin envoi par mail -->


<!-- Début formulaire de contact -->

<div class="contenant">
    <div class="boite">
        <h2>Formulaire de contact </h2>
        <br>
        <form method="POST" action="">
            <input type="text" name="pseudo" placeholder="Votre nom" value="<?php if(isset($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>" /><br /><br />
            
            <input type="email" name="mail" placeholder="Votre email" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
            
            <textarea name="message" placeholder="Votre message"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
            <input type="submit" value="Envoyer !" name="mailform"/>
        </form>
    </div>
</div> 

<!-- Fin formulaire de contact -->        
        
        
    <?php
    if(isset($msg))
        {
            echo $msg; // Si les champs sont remplies, dit que le message a bien été envoyé.
        }
    ?>



<br><br><br><br><br><br><br><br><br><br><br><br>
    
        
<!-- Footer -->
    <?php require_once('inc/footer.inc.php'); ?>
<!-- Fin Footer -->
        
<!-- Début fin html -->
    <?php require_once('inc/endhtml.inc.php'); ?>
<!-- Fin fin html -->