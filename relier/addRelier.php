<?php 
    require '../database.php'; 
    require '../class.php';

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $nomSite1Error=''; 
        $nomSite2Error=''; 
        $distanceError =''; 
        // on recupère nos valeurs 
        $nomSite1=htmlentities(trim($_POST['nomSite1'])); 
        $nomSite2 = htmlentities(trim($_POST['nomSite1'])); 
        $distance=htmlentities(trim($_POST['distance'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($distance < 0)
        {
            $numMusError = "Entrez une valeur supérieure à 0";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid) 
         { 
            $conn = Database::connect();
            // Insertion des données dans la base
			$req = $conn -> prepare('INSERT INTO Relier (nomSite1, nomSite2, distance) VALUES (:nM, :nnM, :dC)');
            $r =  new Relier();
            $r -> hydrate($_POST);

			$req ->execute(array(
			'nM' => $r -> getNomSite1(),
			'nnM' => $r -> getNomSite2(),
			'dC' => $r -> getDistance() 
		));
            Database::disconnect();
            header("Location: Relier.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Relier deux sites</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Relier  deux sites</h3>
<p>

</div>
<p>

<br />
<form method="post" action="addRelier.php">


<br />
<div class="control-group<?php echo !empty($nomSite1Error)?'error':'';?>">
                    <label class="control-label">NomSite1</label>

<br />
<div class="controls">
                            <input type="text" name="nomSite1" value="<?php echo !empty($nomSite1)?$nomSite1:''; ?>" required>
                            <?php if(!empty($nomSite1Error)):?>
                            <span class="help-inline"><?php echo $nomSite1Error ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>

<br />
<div class="control-group<?php echo !empty($nomSite2Error)?'error':'';?>">
                    <label class="control-label">NomSite2</label>

<br />
<div class="controls">
                            <input type="text" name="nomSite2" value="<?php echo !empty($nomSite2)?$nomSite2:''; ?>" required>
                            <?php if(!empty($nomSite2Error)):?>
                            <span class="help-inline"><?php echo $nomSite2Error ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>

<br />
<div class="control-group <?php echo !empty($distanceError)?'error':'';?>">
                        <label class="control-label">Distance</label>

<br />
<div class="controls">
                            <input name="distance" type="number"  value="<?php echo !empty($distance)?$distance:'';?>" required>
                            <?php if (!empty($distanceError)): ?>
                                <span class="help-inline"><?php echo $distanceError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>                                               


<br />
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Relier.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>