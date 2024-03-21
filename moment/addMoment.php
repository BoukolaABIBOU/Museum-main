<?php 
    require '../database.php'; 
    require '../class.php';

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $jourError='';  
        // on recupère nos valeurs 
        $jour=htmlentities(trim($_POST['jour'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($jour < 0 and $jour > 31)
        {
            $jourError = "Entrez un jour valide";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid) 
         { 
            $conn = Database::connect();
            // Insertion des données dans la base
			$req = $conn -> prepare('INSERT INTO Moment (jour) VALUES (:jj)');
            $m =  new Moment();
            $m -> hydrate($_POST);

			$req ->execute(array(
			'jj' => $m -> getJour()
		));
            Database::disconnect();
            header("Location: Moment.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajouter un Moment</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Ajouter un Moment</h3>
<p>

</div>
<p>

<br />
<form method="post" action="addMoment.php">



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
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Moment.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>