<?php 
    require('../database.php'); 
    require('../class.php');
    
    $id = null; 
    if (!empty($_GET['id'])) 
    { 
        $id = $_REQUEST['id']; 
    } 
    if (null == $id) 
    { 
        header("location:Musée.php"); 
    } 
    else 
    {
     //on lance la connection et la requete 
        $pdo = Database ::connect(); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Musée where numMus =?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
     //Gestion du DAO
        $mus = new Musee();
        $mus -> hydrate($data);
        Database::disconnect();
    }



/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Musée Read</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    </head>

    <body>

<br />
<div class="container">


<br />
<div class="span10 offset1">

<br />
<div class="row">

<br />
<h3>Read</h3>
<p>

</div>
<p>



<br />
<div class="form-horizontal" >

<br />
<div class="control-group">
                        <label class="control-label">NumMus</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $mus -> getNumMus(); ?>
                            </label>
</div>
<p>

</div>

</br>
<div class="control-group">
                        <label class="control-label">NomMus</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $mus -> getNomMus(); ?>
                            </label>
</div>
<p>

</div>

</br>
<div class="control-group">
                        <label class="control-label">Nblivres</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $mus -> getNblivres(); ?>
                            </label>
</div>
<p>

</div>

</br>
<div class="control-group">
                        <label class="control-label">Code Pays</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $mus -> getCodePays(); ?>
                            </label>
</div>
<p>

</div>

<br />
<div class="form-actions">
                        <a class="btn btn-success" href="Musée.php">Retour</a>
</div>
<p>



</div>
<p>

</div>
<p>


</div>
<p>
<!-- /container -->
<script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>