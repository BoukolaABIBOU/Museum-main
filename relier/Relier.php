<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestion Relier</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
    </head>
    <body>

<br />
<div class="container">

<br />
<div class="row">

<br />
                        <div class="form-actions">      
                            <a class="btn btn-dark" href="../index.php">Retourner à la page principale</a>
                        </div>
                        <br>
                        <br>
<h2>Gestion Relier</h2>
<p>

</div>
<p>

<br />
<div class="row">
                    <a href="addRelier.php" class="btn btn-secondary">Relier deux sites</a>
                

<br />
<div class="table-responsive">

<br />
<table class="table table-hover table-bordered">

<br />
<thead>


<th>NomSite1</th>
<p>



<th>NomSite2</th>
<p>



<th>Distance</th>
<p>




</thead>
<p>


<br />
<tbody>
                        <?php include '../database.php';
                        include '../class.php';
                         //on inclut notre fichier de connection 
                         $pdo = Database::connect(); 
                         //on se connecte à la base 
                         $request = $pdo->query('SELECT nomSite1 , nomSite2 , distance FROM Relier ORDER BY distance DESC');
                         
                         //on formule notre requete 
                         while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) 
                         { //on cree les lignes du tableau avec chaque valeur retournée
                           
                            $r = new Relier;
                            $r -> hydrate($donnees);

                           
                            echo '
<br />
<tr>';
                            echo'

<td>' . $r -> getNomSite1() . '</td>
<p>
';
                            echo'

<td>' . $r -> getNomSite2() . '</td>
<p>
';
                            echo'

<td>' . $r -> getDistance() .' km'. '</td>
<p>
';
                           
                            echo '

<td>';
                            echo '<a class="btn btn-light" href="readRelier.php?a=' . $r -> getNomSite1() . '&b=' . $r -> getNomSite2() . '&c=' . $r -> getDistance() . '">Read</a>';// un autre td pour le bouton d'edition
                            echo '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-success" href="updateRelier.php?a=' . $r -> getNomSite1() . '&b=' . $r -> getNomSite2() . '&c=' . $r -> getDistance() . '">Update</a>';// un autre td pour le bouton d'update
                            echo '</td>
<p>
';
                            echo'

<td>';
                            echo '<a class="btn btn-danger" href="deleteRelier.php?a=' . $r -> getNomSite1() . '&b=' . $r -> getNomSite2() . '&c=' . $r -> getDistance() . ' ">Delete</a>';// un autre td pour le bouton de suppression
                            echo '</td>
<p>
';
                            echo '</tr>
<p>
';
                         }
                                                Database::disconnect(); //on se deconnecte de la base
                        ;
                        ?>    
</tbody>
<p>

</table>
<p>

</div>
<p>


</div>
<p>


</div>
<p>

    </body>
</html>