<?php 
        require '../database.php';
        require '../class.php'; 
        $id=0; 
        if(!empty($_GET['id']))
        { 
            $id=$_REQUEST['id']; 
        } 
        if(!empty($_POST))
        { 
            $id= $_POST['id']; 
            $pdo=Database::connect(); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM Musée  WHERE numMus = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            Database::disconnect();
            header("Location: Musée.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
<h3>Supprimer un musée</h3>
<p>

</div>
<p>

                     
<br />
<form class="form-horizontal" action="deleteMusée.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      
Êtes vous sur de vouloir supprimer ?

<br />
<div class="form-actions">
                          <button type="submit" class="btn btn-danger">Oui</button>
                          <a class="btn btn-success" href="Musée.php">Non</a>
</div>
<p>

                    </form>
<p>
</div>
<p>

                 
</div>
<p>
<script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script> 
  </body>
</html>