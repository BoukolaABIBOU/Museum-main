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
         header("Location: Site.php"); 
    }

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $nomSiteError=''; 
        $anneedecouvError=''; 
        $codePaysError =''; 
        // on recupère nos valeurs 
        $nomSite=htmlentities(trim($_POST['nomSite'])); 
        $anneedecouv = htmlentities(trim($_POST['anneedecouv'])); 
        $codePays=htmlentities(trim($_POST['codePays'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($anneedecouv < 0)
        {
            $anneedecouvError = "Entrez une valeur supérieure à 0";
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
            $sql = "UPDATE Site SET nomSite = ?,anneedecouv = ?,codePays = ? WHERE nomSite = ?";
            $q = $pdo->prepare($sql);
            $s = new Site();
            $s -> hydrate($_POST);
            $q->execute(array($s -> getNomSite(),$s -> getAnneedecouv(), $s -> getCodePays(),$id));
            Database::disconnect();
            header("Location: Site.php");
        }
    }
    else 
    {

       $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM Site where nomSite = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       $s = new Site();
       $s -> hydrate($data);
       $nomSite = $s -> getNomSite();
       $anneedecouv = $s -> getAnneedecouv();
       $codePays = $s -> getCodePays();
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour un Site</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Mettre à jour un Site</h3>
<p>

</div>
<p>

<br />
<form method="POST" action="updateSite.php?id=<?php echo $id ;?>">


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
<div class="control-group <?php echo !empty($anneedecouvError)?'error':'';?>">
                        <label class="control-label">Anneedecouv</label>

<br />
<div class="controls">
                            <input name="anneedecouv" type="number"  value="<?php echo !empty($anneedecouv)?$anneedecouv:'';?>" required>
                            <?php if (!empty($anneedecouvError)): ?>
                                <span class="help-inline"><?php echo $anneedecouvError;?></span>
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
                 <a class="btn btn-light" href="Site.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>