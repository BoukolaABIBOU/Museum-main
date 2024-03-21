<?php 
    require '../database.php'; 
    require '../class.php';

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $numMusError=''; 
        $jourError=''; 
        $nbvisiteursError =''; 
        // on recupère nos valeurs 
        $numMus=htmlentities(trim($_POST['numMus'])); 
        $jour = htmlentities(trim($_POST['jour'])); 
        $nbvisiteurs=htmlentities(trim($_POST['nbvisiteurs'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($numMus < 0)
        {
            $numMusError = "Entrez une valeur supérieure à 0";
            $valid=false;
        }
        if ($jour < 0 and $jour > 31)
        {
            $jourError = "Entrez un jour adéquat(entre 0 et 31)";
            $valid=false;
        }  
        if ($nbvisiteurs < 0)
        {
            $nbvisiteursError = "Entrez une valeur supérieure à 0";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid) 
         { 
            $conn = Database::connect();
            // Insertion des données dans la base
			$req = $conn -> prepare('INSERT INTO Visiter (numMus, jour, nbvisiteurs) VALUES (:nM, :jj, :nV)');

			$req ->execute(array(
			'nM' => $_POST['numMus'],
			'jj' => $_POST['jour'],
			'nV' => $_POST['nbvisiteurs']  
		                   ));
            Database::disconnect();
            header("Location: Visiter.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajouter une Visite</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Ajouter une visite</h3>
<p>

</div>
<p>

<br />
<form method="post" action="addVisiter.php">


<br />
<div class="control-group<?php echo !empty($numMusError)?'error':'';?>">
                    <label class="control-label">numMus</label>

<br />
<div class="controls">
                            <input type="number" name="numMus" value="<?php echo !empty($numMus)?$numMus:''; ?>" required>
                            <?php if(!empty($numMusError)):?>
                            <span class="help-inline"><?php echo $numMusError ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>

<br />
<div class="control-group <?php echo !empty($jourError)?'error':'';?>">
                        <label class="control-label">Jour</label>

<br />
<div class="controls">
                            <input name="jour" type="number"  value="<?php echo !empty($jour)?$jour:'';?>" required>
                            <?php if (!empty($jourError)): ?>
                                <span class="help-inline"><?php echo $jourError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>                                               

<br />
<div class="control-group <?php echo !empty($nbvisiteursError)?'error':'';?>">
                        <label class="control-label">Nbvisiteurs</label>

<br />
<div class="controls">
                            <input name="nbvisiteurs" type="number"  value="<?php echo !empty($nbvisiteurs)?$nbvisiteurs:'';?>" required>
                            <?php if (!empty($nbvisiteursError)): ?>
                                <span class="help-inline"><?php echo $nbvisiteursError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>

<br />
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Visiter.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>