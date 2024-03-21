<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestion Musée</title>
        <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/gestion.css">
    </head>
    <body>

<br />
<div class="container">

<br />
<div class="row">
                        <div class="form-actions">      
                            <a class="btn btn-dark" href="../index.php">Retourner à la page principale</a>
                        </div>
                        <br>
                        <br>
<br />
<h2>Gestion Musée</h2>
<p>

</div>
<p>


<br />
<div class="row">
                
                    <a href="addMusée.php" class="btn btn-secondary">Ajouter un Musée</a>

<div class="table-responsive">

<table class="table table-hover table-bordered">

<thead>


<th>NumMus</th>
<p>



<th>NomMus</th>
<p>



<th>Nblivres</th>
<p>



<th>CodePays</th>
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
                         $request = $pdo->query('SELECT numMus , nomMus , nblivres , codePays FROM Musée ORDER BY numMus DESC');
                         
                         //on formule notre requete 
                         while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) 
                         { //on cree les lignes du tableau avec chaque valeur retournée
                           
                            $mus = new Musee;
                            $mus -> hydrate($donnees);

                           
                            echo '
<br />
<tr>';
                            echo'

<td>' . $mus -> getNumMus() . '</td>
<p>
';
                            echo'

<td>' . $mus -> getNomMus() . '</td>
<p>
';
                            echo'

<td>' . $mus -> getNblivres() . '</td>
<p>
';
                            echo'

<td>' . $mus -> getCodePays() . '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-light" href="readMusée.php?id=' . $mus -> getNumMus() . '">Read</a>';// un autre td pour le bouton d'edition
                            echo '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-success" href="updateMusée.php?id=' . $mus -> getNumMus() . '">Update</a>';// un autre td pour le bouton d'update
                            echo '</td>
<p>
';
                            echo'

<td>';
                            echo '<a class="btn btn-danger" href="deleteMusée.php?id=' . $mus -> getNumMus() . ' ">Delete</a>';// un autre td pour le bouton de suppression
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

<script src="../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>