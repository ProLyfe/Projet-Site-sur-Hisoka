<!-- Début connexion à la BDD -->
<?php
$bdd = new PDO('mysql:host=localhost;dbname=articles', 'root', '', array(PDO:: MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));

$articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_publication DESC')
?>
<!-- Fin connexion à la BDD -->
     


<!-- Début Doctype -->
<?php require_once('inc/doctype.inc.php'); ?>
<!-- Fin Doctype -->


<!-- Header -->
<?php require_once('inc/header.inc.php'); ?>
<!-- Fin Header -->
        
<br><br>
       
 <div class="contenant">
    <div class="boite">
        <h2>Blog</h2>
        <br>
           <?php while($a = $articles->fetch()) { ?> <!-- On met les articles sous forme de tableau-->
                <div class="boiteBlog"> <a href="article.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a> <br><br></div>
            <?php } ?>
    </div>
</div>    


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


        
<!-- Footer -->
    <?php require_once('inc/footer.inc.php'); ?>
<!-- Fin Footer -->
      

<!-- Début fin html -->
    <?php require_once('inc/endhtml.inc.php'); ?>
<!-- Fin fin html -->