<?php 
    require '../database.php'; 
    require '../class.php';

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $nbhabitantError='';  
        // on recupère nos valeurs 
        $nbhabitant=htmlentities(trim($_POST['nbhabitant'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($nbhabitant < 0)
        {
            $nbhabitantError = "Entrez une valeur supérieure à 0";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid) 
         { 
            $conn = Database::connect();
            // Insertion des données dans la base
			$req = $conn -> prepare('INSERT INTO Pays (nbhabitant) VALUES (:nH)');
            $pays =  new Pays();
            $pays -> hydrate($_POST);

			$req ->execute(array(
			'nH' => $pays -> getNbhabitant()
		));
            Database::disconnect();
            header("Location: Pays.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajouter un Pays</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Ajouter un Pays</h3>
<p>

</div>
<p>

<br />
<form method="post" action="addPays.php">



<br />
<div class="control-group <?php echo !empty($nbhabitantError)?'error':'';?>">
                        <label class="control-label">Nbhabitant</label>

<br />
<div class="controls">
                            <input name="nbhabitant" type="number"  value="<?php echo !empty($nbhabitant)?$nbhabitant:'';?>" required>
                            <?php if (!empty($nbhabitantError)): ?>
                                <span class="help-inline"><?php echo $nbhabitantError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>                                               


<br />
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Pays.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>