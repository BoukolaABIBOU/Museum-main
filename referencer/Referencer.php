<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestion Referencer</title>
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
<h2>Gestion Référencement</h2>
<p>

</div>
<p>

<br />
<div class="row">
                    <a href="addReferencer.php" class="btn btn-secondary">Ajouter une reference</a>
                

<br />
<div class="table-responsive">

<br />
<table class="table table-hover table-bordered">

<br />
<thead>


<th>NomSite</th>
<p>



<th>NumeroPage</th>
<p>


<th>ISBN</th>
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
                         $request = $pdo->query('SELECT nomSite , numeroPage , ISBN FROM Referencer ORDER BY ISBN DESC');
                         
                         //on formule notre requete 
                         while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) 
                         { //on cree les lignes du tableau avec chaque valeur retournée
                           
                            $r = new Referencer;
                            $r -> hydrate($donnees);

                           
                            echo '
<br />
<tr>';
                            echo'

<td>' . $r -> getNomSite() . '</td>
<p>
';
                            echo'

<td>' . $r -> getNumeroPage() . '</td>
<p>
';
                            echo'

<td>' . $r -> getISBN()  . '</td>
<p>
';
                           
                            echo '

<td>';
                            echo '<a class="btn btn-light" href="readReferencer.php?a=' . $r -> getNomSite() . '&b=' . $r -> getNumeroPage() . '&c=' . $r -> getISBN() . '">Read</a>';// un autre td pour le bouton d'edition
                            echo '</td>
<p>
';
                            echo '

<td>';
                            echo '<a class="btn btn-success" href="updateReferencer.php?a=' . $r -> getNomSite() . '&b=' . $r -> getNumeroPage() . '&c=' . $r -> getISBN() . '">Update</a>';// un autre td pour le bouton d'update
                            echo '</td>
<p>
';
                            echo'

<td>';
                            echo '<a class="btn btn-danger" href="deleteReferencer.php?a=' . $r -> getNomSite() . '&b=' . $r -> getNumeroPage() . '&c=' . $r -> getISBN() . ' ">Delete</a>';// un autre td pour le bouton de suppression
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