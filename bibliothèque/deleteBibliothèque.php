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
        if(!empty($_GET))
        {
            $pdo=Database::connect(); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM Bibliothèque  WHERE numMus =? and  ISBN =? and dateAchat =?";
            $q = $pdo->prepare($sql);
            $q->execute(array($_REQUEST['a'] ,$_REQUEST['b'] , $_REQUEST['c'] ));
            Database::disconnect();
            header("Location: Bibliothèque.php");
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Supprimer une bibliothèque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/gestion.css">
</head>
 
<body>

<br />
<div class="container">
     

<br />
<div class="span10 offset1">

<br />
<div class="row">

<br />
<h3>Supprimer une bibliothèque</h3>
<p>

</div>
<p>

                     
<br />
<form class="form-horizontal" action="deleteBibliothèque.php?a=<?php echo $a ;?>&b=<?php echo $b ;?>&c=<?php echo $c ;?>" method="GET">
<input type="hidden" name="id" value="<?php echo 5 ;?>"/>
Êtes vous sur de vouloir supprimer ? 
<br /> 
<div class="form-actions">
                          <button type="submit" class="btn btn-danger">Oui</button>
                          <a class="btn btn-success" href="Bibliothèque.php">Non</a>
</div>
<p>

                    </form>
<p>
</div>
<p>

                 
</div>
<p>
  </body>
</html>