<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestion Musée</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
    </head>
    <body>

<br />
<div class="container">
                        <div class="form-actions">      
                            <a class="btn btn-dark" href="../index.php">Retourner à la page principale</a>
                        </div>
                        <br>
                        <br>
<br />
<div class="row">

<br />
<h2>Gestion Visiter</h2>
<p>

</div>
<p>


<br />
<div class="row">
                
                    <a href="addVisiter.php" class="btn btn-secondary">Ajouter une Visite</a>
                

<br />
<div class="table-responsive">

<br />
<table class="table table-hover table-bordered">

<br />
<thead>


<th>NumMus</th>
<p>



<th>Jour</th>
<p>



<th>Nbvisiteurs</th>
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
                         $request = $pdo->query('SELECT numMus , jour , nbvisiteurs FROM Visiter ORDER BY nbvisiteurs DESC');
                         
                         //on formule notre requete 
                         while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) 
                         { //on cree les lignes du tableau avec chaque valeur retournée

                            echo '
<br />
<tr>';
                            echo'

<td>' . $donnees['numMus'] . '</td>
<p>
';
                            echo'

<td>' . $donnees['jour'] . '</td>
<p>
';
                            echo'

<td>' . $donnees['nbvisiteurs'] . '</td>
<p>
';
            
                            echo '

<td>';
                            echo '<a class="btn btn-light" href="readVisiter.php?a=' . $donnees['numMus'] . '&b=' . $donnees['jour'] . '&c=' . $donnees['nbvisiteurs'] . '">Read</a>';// un autre td pour le bouton d'edition
                            echo '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-success" href="updateVisiter.php?a=' . $donnees['numMus'] . '&b=' . $donnees['jour'] . '&c=' . $donnees['nbvisiteurs'] . '">Update</a>';// un autre td pour le bouton d'update
                            echo '</td>
<p>
';
                            echo'

<td>';
                            echo '<a class="btn btn-danger" href="deleteVisiter.php?a=' . $donnees['numMus'] . '&b=' . $donnees['jour'] . '&c=' . $donnees['nbvisiteurs'] . ' ">Delete</a>';// un autre td pour le bouton de suppression
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