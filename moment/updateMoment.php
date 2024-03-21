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
         header("Location: Moment.php"); 
    }

    if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST))
    { 
        //on initialise nos messages d'erreurs; 
        $jourError=''; 
        // on recupère nos valeurs 
        $jour=htmlentities(trim($_POST['jour'])); 
        // on vérifie nos champs 
        $valid = true; 
        if ($jour < 0 and $jour > 31)
        {
            $jourError = "Entrez un jour adéquat";
            $valid=false;
        } 
         // si les données sont présentes et bonnes, on se connecte à la base 
         if ($valid)
         {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Insertion des données dans la base
            $sql = "UPDATE Moment SET jour = ? WHERE jour = ?";
            $q = $pdo->prepare($sql);
            $m = new Moment();
            $m -> hydrate($_POST);
            $q->execute(array($m -> getJour(),$id));
            Database::disconnect();
            header("Location: Moment.php");
        }
    }
    else 
    {

       $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM Moment where jour = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       $m = new Moment();
       $m -> hydrate($data);
       $jour = $m -> getJour();
       Database::disconnect();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mettre à jour un Moment</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>



<br />
<div class="container">

<br />
<div class="row">

<br />
<h3>Mettre à jour un Moment</h3>
<p>

</div>
<p>

<br />
<form method="POST" action="updateMoment.php?id=<?php echo $id ;?>">


<br />
<div class="control-group<?php echo !empty($jour)?'error':'';?>">
                    <label class="control-label">Jour</label>

<br />
<div class="controls">
                            <input type="text" name="jour" value="<?php echo !empty($jour)?$jour:''; ?>" required>
                            <?php if(!empty($jourError)):?>
                            <span class="help-inline"><?php echo $jourError ;?></span>
                            <?php endif;?>
</div>
<p>

</div>
<p>
                                          

<br />
<div class="form-actions">
                 <input type="submit" class="btn btn-success" name="submit" value="submit">
                 <a class="btn btn-light" href="Moment.php">Retour</a>
</div>
<p>

            </form>
<p>
            
            
            
</div>
<p>

        
    </body>
</html>