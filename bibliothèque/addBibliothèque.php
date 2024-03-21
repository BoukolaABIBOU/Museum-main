<?php 
    require '../database.php'; 
    require '../class.php';

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $numMusError=''; 
        $ISBNError=''; 
        $dateAchatError =''; 
        // on recupère nos valeurs 
        $numMus=htmlentities(trim($_POST['numMus'])); 
        $ISBN = htmlentities(trim($_POST['ISBN'])); 
        $dateAchat=htmlentities(trim($_POST['dateAchat'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($numMus < 0)
        {
            $numMusError = "Entrez une valeur supérieure à 0";
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
			$req = $conn -> prepare('INSERT INTO Bibliothèque (numMus, ISBN, dateAchat) VALUES (:nM, :I, :dA)');
            $b =  new Bibliothèque();
            $b -> hydrate($_POST);

			$req ->execute(array(
			'nM' => $b -> getNumMus(),
			'I' => $b -> getISBN(),
			'dA' => $b -> getDateAchat() 
		));
            Database::disconnect();
            header("Location: Bibliothèque.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajouter une Bibliothèque</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Ajouter une Bibliothèque</h3>
<p>

</div>
<p>

<br />
<form method="post" action="addBibliothèque.php">


<br />
<div class="control-group<?php echo !empty($numMusError)?'error':'';?>">
                    <label class="control-label">NumMus</label>

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
<div class="control-group <?php echo !empty($dateAchatError)?'error':'';?>">
                        <label class="control-label">dateAchat</label>

<br />
<div class="controls">
                            <input name="dateAchat" type="date"  value="<?php echo !empty($dateAchat)?$dateAchat:'';?>" required>
                            <?php if (!empty($dateAchatError)): ?>
                                <span class="help-inline"><?php echo $dateAchatError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>

<br />
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Bibliothèque.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>