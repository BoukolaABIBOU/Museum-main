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
         header("Location: Pays.php"); 
    }

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
            $$nbhabitantError = "Entrez une valeur supérieure à 0";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid)
         {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Insertion des données dans la base
            $sql = "UPDATE Pays SET nbhabitant = ? WHERE codePays = ?";
            $q = $pdo->prepare($sql);
            $pays = new Pays();
            $pays -> hydrate($_POST);
            $q->execute(array($pays -> getNbhabitant(),$id));
            Database::disconnect();
            header("Location: Pays.php");
        }
    }
    else 
    {

       $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM Pays where codePays = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       $pays = new Pays();
       $pays -> hydrate($data);
       $nbhabitant = $pays -> getNbhabitant();
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour un Pays</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Mettre à jour un Pays</h3>
<p>

</div>
<p>

<br />
<form method="POST" action="updatePays.php?id=<?php echo $id ;?>">


<br />
<div class="control-group<?php echo !empty($nbhabitant)?'error':'';?>">
                    <label class="control-label">nbhabitant</label>

<br />
<div class="controls">
                            <input type="text" name="nbhabitant" value="<?php echo !empty($nbhabitant)?$nbhabitant:''; ?>" required>
                            <?php if(!empty($nbhabitantError)):?>
                            <span class="help-inline"><?php echo $nbhabitantError ;?></span>
                            <?php endif;?>
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