<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestion Ouvrage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
<h2>Gestion Ouvrage</h2>
<p>

</div>
<p>


<br />
<div class="row">
                
                    <a href="addOuvrage.php" class="btn btn-secondary">Ajouter un Ouvrage</a>
                

<br />
<div class="table-responsive">

<br />
<table class="table table-hover table-bordered">

<br />
<thead>


<th>ISBN</th>
<p>



<th>NbPages</th>
<p>



<th>Titre</th>
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
                         $request = $pdo->query('SELECT ISBN , nbPage , titre , codePays FROM Ouvrage ORDER BY ISBN DESC');
                         
                         //on formule notre requete 
                         while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) 
                         { //on cree les lignes du tableau avec chaque valeur retournée
                           
                            $o = new Ouvrage;
                            $o -> hydrate($donnees);

                           
                            echo '
<br />
<tr>';
                            echo'

<td>' . $o -> getISBN() . '</td>
<p>
';
                            echo'

<td>' . $o -> getNbPage() . '</td>
<p>
';
                            echo'

<td>' . $o -> getTitre() . '</td>
<p>
';
                            echo'

<td>' . $o -> getCodePays() . '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-light" href="readOuvrage.php?id=' . $o -> getISBN() . '">Read</a>';// un autre td pour le bouton d'edition
                            echo '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-success" href="updateOuvrage.php?id=' . $o -> getISBN() . '">Update</a>';// un autre td pour le bouton d'update
                            echo '</td>
<p>
';
                            echo'

<td>';
                            echo '<a class="btn btn-danger" href="deleteOuvrage.php?id=' . $o -> getISBN() . ' ">Delete</a>';// un autre td pour le bouton de suppression
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