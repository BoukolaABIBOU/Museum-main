<?php 
    require '../database.php'; 
    require '../class.php';

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $nomSite1Error=''; 
        $numeroPageError=''; 
        $ISBNError =''; 
        // on recupère nos valeurs 
        $nomSite=htmlentities(trim($_POST['nomSite'])); 
        $numeroPage = htmlentities(trim($_POST['numeroPage'])); 
        $ISBN=htmlentities(trim($_POST['ISBN'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($numeroPage < 0)
        {
            $numeroPageError = "Entrez une valeur supérieure à 0";
            $valid=false;
        } 
        if ($ISBN < 0)
        {
            $ISBNError = "Entrez une valeur supérieure à 0";
            $valid=false;
        }
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid) 
         { 
            $conn = Database::connect();
            // Insertion des données dans la base
			$req = $conn -> prepare('INSERT INTO Referencer (nomSite, numeroPage, ISBN) VALUES (:nS, :nP, :I)');
            $r =  new Referencer();
            $r -> hydrate($_POST);

			$req ->execute(array(
			'nS' => $r -> getNomSite(),
			'nP' => $r -> getNumeroPage(),
			'I' => $r -> getISBN() 
		));
            Database::disconnect();
            header("Location: Referencer.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Referencer un site</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Referencer un site</h3>
<p>

</div>
<p>

<br />
<form method="post" action="addReferencer.php">


<br />
<div class="control-group<?php echo !empty($nomSiteError)?'error':'';?>">
                    <label class="control-label">NomSite</label>

<br />
<div class="controls">
                            <input type="text" name="nomSite" value="<?php echo !empty($nomSite)?$nomSite:''; ?>" required>
                            <?php if(!empty($nomSiteError)):?>
                            <span class="help-inline"><?php echo $nomSiteError ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>

<br />
<div class="control-group<?php echo !empty($numeroPageError)?'error':'';?>">
                    <label class="control-label">NumeroPage</label>

<br />
<div class="controls">
                            <input type="text" name="numeroPage" value="<?php echo !empty($numeroPage)?$numeroPage:''; ?>" required>
                            <?php if(!empty($numeroPageError)):?>
                            <span class="help-inline"><?php echo $numeroPageError ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>

<br />
<div class="control-group <?php echo !empty($ISBNError)?'error':'';?>">
                        <label class="control-label">ISBN</label>

<br />
<div class="controls">
                            <input name="ISBN" type="number"  value="<?php echo !empty($ISBN)?$ISBN:'';?>" required>
                            <?php if (!empty($ISBNError)): ?>
                                <span class="help-inline"><?php echo $ISBNError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>                                               


<br />
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Referencer.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>