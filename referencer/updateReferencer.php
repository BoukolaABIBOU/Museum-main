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
        header("location:Referencer.php"); 
    }
    

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    {  
        //on initialise nos messages d'erreurs; 
        $nomSiteError=''; 
        $numeroPageError=''; 
        $ISBNError =''; 
        // on recupère nos valeurs 
        $nomSite = htmlentities(trim($_POST['nomSite'])); 
        $numeroPage = htmlentities(trim($_POST['numeroPage'])); 
        $ISBN = htmlentities(trim($_POST['ISBN'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($numeroPage < 0)
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
            $sql = "UPDATE Referencer SET nomSite = ?,numeroPage = ?,ISBN = ? WHERE nomSite = ? and numeroPage =? and ISBN =?";
            $q = $pdo->prepare($sql);
            //Gestion du DAO
            $r = new Referencer();
            $r -> hydrate($_POST);
            $q->execute(array($r -> getNomSite(),$r -> getNumeroPage(),$r -> getISBN(),$a,$b,$c));
            Database::disconnect();
            header("Location: Referencer.php");
        }
    }
    else 
    {
       $nomSite = $a;
       $numeroPage  = $b;
       $ISBN = $c;
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour un référencement</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">
<br />
<div class="row">
<h3>Mettre à jour un référencement</h3>
</div>
<br />
<form method="POST" action="updateReferencer.php?a=<?php echo $a ;?>&b=<?php echo $b ;?>&c=<?php echo $c ;?>">

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
<div class="control-group <?php echo !empty($numeroPageError)?'error':'';?>">
                        <label class="control-label">NumeroPage</label>

<br />
<div class="controls">
                            <input name="numeroPage" type="number"  value="<?php echo !empty($numeroPage)?$numeroPage:'';?>" required>
                            <?php if (!empty($numeroPageError)): ?>
                                <span class="help-inline"><?php echo $numeroPageError;?></span>
                            <?php endif; ?>
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