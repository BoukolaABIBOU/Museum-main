<?php 
    require '../database.php'; 
    require '../class.php';
    
    $id = null; 
    if ( !empty($_GET['id'])) 
    { 
        $id = $_REQUEST['id']; 
    } 
    if ( null==$id ) 
    {
         header("Location: Musée.php"); 
    }

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $nomMusError=''; 
        $nblivresError=''; 
        $codePaysError =''; 
        // on recupère nos valeurs 
        $nomMus=htmlentities(trim($_POST['nomMus'])); 
        $nblivres = htmlentities(trim($_POST['nblivres'])); 
        $codePays=htmlentities(trim($_POST['codePays'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($nblivres < 0)
        {
            $nblivresError = "Entrez une valeur supérieure à 0";
            $valid=false;
        }  
        if ($codePays < 0)
        {
            $codePaysError = "Entrez une valeur supérieure à 0";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid)
         {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Insertion des données dans la base
            $sql = "UPDATE Musée SET nomMus = ?,nblivres = ?,codePays = ? WHERE numMus = ?";
            $q = $pdo->prepare($sql);
            $mus = new Musee();
            $mus -> hydrate($_POST);
            $q->execute(array($mus -> getNomMus(),$mus -> getNblivres(), $mus -> getCodePays(),$id));
            Database::disconnect();
            header("Location: Musée.php");
        }
    }
    else 
    {

       $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM Musée where numMus = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       $mus = new Musee();
       $mus -> hydrate($data);
       $nomMus = $mus -> getNomMus();
       $nblivres = $mus -> getNblivres();
       $codePays = $mus -> getCodePays();
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour un Musée</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">   
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Mettre à jour un Musée</h3>
<p>

</div>
<p>

<br />
<form method="POST" action="updateMusée.php?id=<?php echo $id ;?>">


<br />
<div class="control-group<?php echo !empty($nomMusError)?'error':'';?>">
                    <label class="control-label">nomMus</label>

<br />
<div class="controls">
                            <input type="text" name="nomMus" value="<?php echo !empty($nomMus)?$nomMus:''; ?>" required>
                            <?php if(!empty($nomMusError)):?>
                            <span class="help-inline"><?php echo $nomMusError ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>

<br />
<div class="control-group <?php echo !empty($nblivresError)?'error':'';?>">
                        <label class="control-label">Nblivres</label>

<br />
<div class="controls">
                            <input name="nblivres" type="number"  value="<?php echo !empty($nblivres)?$nblivres:'';?>" required>
                            <?php if (!empty($nblivresError)): ?>
                                <span class="help-inline"><?php echo $nblivresError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>                                               

<br />
<div class="control-group <?php echo !empty($codePaysError)?'error':'';?>">
                        <label class="control-label">CodePays</label>

<br />
<div class="controls">
                            <input name="codePays" type="number"  value="<?php echo !empty($codePays)?$codePays:'';?>" required>
                            <?php if (!empty($codePaysError)): ?>
                                <span class="help-inline"><?php echo $codePaysError;?></span>
                            <?php endif; ?>
</div>
<p>

</div>
<p>

<br />
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Musée.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

<script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>        
    </body>
</html>