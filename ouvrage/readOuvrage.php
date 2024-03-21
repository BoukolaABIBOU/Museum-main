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
        header("location:Ouvrage.php"); 
    } 
    else 
    {
     //on lance la connection et la requete 
        $pdo = Database ::connect(); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Ouvrage where ISBN =?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
     //Gestion du DAO
        $o= new Ouvrage();
        $o -> hydrate($data);
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
        <title>Ouvrage Read</title>
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                        <label class="control-label">ISBN</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $o -> getISBN(); ?>
                            </label>
</div>
<p>

</div>

</br>
<div class="control-group">
                        <label class="control-label">NbPage</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $o -> getNbPage(); ?>
                            </label>
</div>
<p>

</div>

</br>
<div class="control-group">
                        <label class="control-label">Titre</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $o -> getTitre(); ?>
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
                                <?php echo $o -> getCodePays(); ?>
                            </label>
</div>
<p>

</div>

<br />
<div class="form-actions">
                        <a class="btn btn-success" href="Ouvrage.php">Retour</a>
</div>
<p>



</div>
<p>

</div>
<p>


</div>
<p>
<!-- /container -->
    </body>
</html>