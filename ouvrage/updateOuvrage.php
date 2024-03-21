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
         header("Location: Ouvrage.php"); 
    }

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $nbPageError=''; 
        $titreError=''; 
        $codePaysError =''; 
        // on recupère nos valeurs 
        $nbPage=htmlentities(trim($_POST['nbPage'])); 
        $titre = htmlentities(trim($_POST['titre'])); 
        $codePays=htmlentities(trim($_POST['codePays'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($nbPage < 0)
        {
            $nbPageError = "Entrez une valeur supérieure à 0";
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
            $sql = "UPDATE Ouvrage SET nbPage = ?,titre = ?,codePays = ? WHERE ISBN = ?";
            $q = $pdo->prepare($sql);
            $o = new Ouvrage();
            $o -> hydrate($_POST);
            $q->execute(array($o -> getNbPage(),$o -> getTitre(), $o -> getCodePays(),$id));
            Database::disconnect();
            header("Location: Ouvrage.php");
        }
    }
    else 
    {

       $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM Ouvrage where ISBN = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       $o = new Ouvrage();
       $o -> hydrate($data);
       $nbPage = $o -> getNbPage();
       $titre = $o -> getTitre();
       $codePays = $o -> getCodePays();
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour un Ouvrage</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Mettre à jour un Ouvrage</h3>
<p>

</div>
<p>

<br />
<form method="POST" action="updateOuvrage.php?id=<?php echo $id ;?>">


<br />
<div class="control-group<?php echo !empty($nbPageError)?'error':'';?>">
                    <label class="control-label">NbPage</label>

<br />
<div class="controls">
                            <input type="number" name="nbPage" value="<?php echo !empty($nbPage)?$nbPage:''; ?>" required>
                            <?php if(!empty($nbPageError)):?>
                            <span class="help-inline"><?php echo $nbPageError ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>

<br />
<div class="control-group <?php echo !empty($titreError)?'error':'';?>">
                        <label class="control-label">Titre</label>

<br />
<div class="controls">
                            <input name="titre" type="text"  value="<?php echo !empty($titre)?$titre:'';?>" required>
                            <?php if (!empty($titreError)): ?>
                                <span class="help-inline"><?php echo $titreError;?></span>
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
                 <a class="btn btn-light" href="Ouvrage.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>