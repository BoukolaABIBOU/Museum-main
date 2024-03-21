<?php 
    require '../database.php'; 
    require '../class.php';
    
    $a = null;
    $b = null;
    $c = null;  
    if (!empty($_GET['a'])) 
    { 
        $a = $_REQUEST['a'];
    }
    if (!empty($_GET['b'])) 
    { 
        $b = $_REQUEST['b'];
    }
    if (!empty($_GET['c'])) 
    { 
        $c = $_REQUEST['c'];
    }
    if (null == $b or null == $a or null == $c) 
    {    
        header("location:Bibliothèque.php"); 
    }
    

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    {  
        //on initialise nos messages d'erreurs; 
        $numMusError=''; 
        $ISBNError=''; 
        $dateAchatError =''; 
        // on recupère nos valeurs 
        $numMus = htmlentities(trim($_POST['numMus'])); 
        $ISBN = htmlentities(trim($_POST['ISBN'])); 
        $dateAchat = htmlentities(trim($_POST['dateAchat'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($numMus < 0)
        {
            $numMusError = "Entrez une valeur supérieure à 0";
            $valid=false;
        }  
        if ($ISBN < 0)
        {
            $nbvisiteursError = "Entrez une valeur supérieure à 0";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid)
         {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Insertion des données dans la base
            $sql = "UPDATE Bibliothèque SET numMus = ?,ISBN = ?,dateAchat = ? WHERE numMus = ? and ISBN =? and dateAchat =?";
            $q = $pdo->prepare($sql);
            //Gestion du DAO
            $bb = new Bibliothèque();
            $bb -> hydrate($_POST);
            $q->execute(array($bb -> getNumMus(),$bb -> getISBN(),$bb -> getDateAchat(),$a,$b,$c));
            Database::disconnect();
            header("Location: Bibliothèque.php");
        }
    }
    else 
    {
       $numMus = $a;
       $ISBN  = $b;
       $dateAchat = $c;
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour une bibliothèque</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
    </head>
    <body>



<br />
<div class="container">
<br />
<div class="row">
<h3>Mettre à jour une bibliothèque</h3>
</div>
<br />
<form method="POST" action="updateBibliothèque.php?a=<?php echo $a ;?>&b=<?php echo $b ;?>&c=<?php echo $c ;?>">

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
                        <label class="control-label">Date Achat</label>

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