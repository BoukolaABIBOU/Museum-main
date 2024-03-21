<?php 
    require('../database.php'); 
    require('../class.php');
    
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

    if (null == $a or null == $b or null == $c) 
    { 
        header("location:Referencer.php"); 
    } 
    else 
    {
     //on lance la connection et la requete 
        $pdo = Database ::connect(); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Referencer where nomSite =? and numeroPage =? and ISBN =?";
        $q = $pdo->prepare($sql);
        $q->execute(array($a , $b , $c));
        $data = $q->fetch(PDO::FETCH_ASSOC);
     //Gestion du DAO
        $r = new Referencer();
        $r -> hydrate($data);
        Database::disconnect();
    }



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Read Referencer</title>
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
                        <label class="control-label">NomSite</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $r -> getNomSite(); ?>
                            </label>
</div>
<p>

</div>

</br>
<div class="control-group">
                        <label class="control-label">Numero Page</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $r -> getNumeroPage(); ?>
                            </label>
</div>
<p>

</div>

</br>
<div class="control-group">
                        <label class="control-label">ISBN</label>

<br />
<div class="controls">
                            <label class="checkbox">
                                <?php echo $r -> getISBN(); ?>
                            </label>
</div>
<p>

</div>

<br />
<div class="form-actions">
                        <a class="btn btn-success" href="Referencer.php">Retour</a>
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