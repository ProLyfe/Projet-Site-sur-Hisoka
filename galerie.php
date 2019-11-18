<!-- Début Doctype -->
<?php require_once('inc/doctype.inc.php'); ?>
<!-- Fin Doctype -->

<!-- Header -->
<?php require_once('inc/header.inc.php'); ?>
<!-- Fin Header -->
        
<br><br>
               
<div class="ban">
    <section class="container-fluid about">
        <div class="container">
            <div class="row"> 
                <article class="col-md-20 col-lg-12 col-xs-12 col-sm-12">
        
                    <h2>Galerie </h2>
                    <br>
                    <br>
                    <?php
                        $dossier = "photo/"; // On créé une variable $dossier qui correspond au dossier photo.
                        $ouverture = opendir($dossier);
                    
                        while($photo = readdir($ouverture))
                        {
                            if(!is_dir($dossier.$photo) && $photo != "." && $photo != "..") //On prends tout les types d'images : donc des . et des .. //is_dir indique si le fichier est un dossier.
                            {
                                echo '<a href="'.$dossier.$photo.'">'; //On rend la photo cliquable.
                                echo '<img src="'.$dossier.$photo.'" title="'.$photo.'" alt="Image" class="imgGal" />'; // On affiche toutes les images présentent dans le dossier.
                                echo '</a>'; 
                                echo '<br>';
                                echo '<br>';
                                echo '<br>';
                            }
                        }
                            
                        closedir($ouverture);    
                            
                    ?>
                      
                </article> 
            </div>
        </div>    
    </section>
</div>
    
        
<!-- Footer -->
    <?php require_once('inc/footer.inc.php'); ?>
<!-- Fin Footer -->
        
<!-- Début fin html -->
    <?php require_once('inc/endhtml.inc.php'); ?>
<!-- Fin fin html -->