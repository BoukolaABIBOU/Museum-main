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
        header("location:Relier.php"); 
    }
    

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    {  
        //on initialise nos messages d'erreurs; 
        $nomSite1Error=''; 
        $nomSite2Error=''; 
        $distanceError =''; 
        // on recupère nos valeurs 
        $nomSite1 = htmlentities(trim($_POST['nomSite1'])); 
        $nomSite2 = htmlentities(trim($_POST['InomSite2'])); 
        $distance = htmlentities(trim($_POST['distance'])); 
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
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Insertion des données dans la base
            $sql = "UPDATE Relier SET nomSite1 = ?,nomSite2 = ?,distance = ? WHERE nomSite1 = ? and nomSite2 =? and distance =?";
            $q = $pdo->prepare($sql);
            //Gestion du DAO
            $r = new Relier();
            $r -> hydrate($_POST);
            $q->execute(array($r -> getNomSite1(),$r -> getNomSite2(),$r -> getDistance(),$a,$b,$c));
            Database::disconnect();
            header("Location: Relier.php");
        }
    }
    else 
    {
       $nomSite1 = $a;
       $nomSite2  = $b;
       $distance = $c;
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour une liaison</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">
<br />
<div class="row">
<h3>Mettre à jour une liaison</h3>
</div>
<br />
<form method="POST" action="updateRelier.php?a=<?php echo $a ;?>&b=<?php echo $b ;?>&c=<?php echo $c ;?>">

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