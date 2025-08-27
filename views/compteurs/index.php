<?php
    $search['search'] = $search['search'] ?? "";
    $search['typeSearch'] = $search['typeSearch'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrapVrai.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="bootstrap/bootstrapVrai.min.js"></script>
    <script src="bootstrap/Jquery/vraiJquery.min.js"></script>
    <title>Jirama Ofisialy</title>
    <link rel="shortcut icon" href="image/téléchargement.png" type="image/x-icon">
</head>
<body>
    <div class="dashboard">
        <div class="left_panel"> 
            <div class="row">
                <div class="left_content col-md-12">
                    <h2><span class="point">.</span>Jirama</h2>
                    <img src="image/téléchargement.png" class="img-circle" alt="">
                    <div class="navigation">
                        <ul>
                            <li><a href="deb.php?controller=customer&action=index2" class="btn btn-danger">Clients</a></li>
                            <li><a href="#" class="btn btn-danger" id="active">Compteurs</a></li>
                            <li><a href="deb.php?controller=Eau&action=index" class="btn btn-danger">Rélévé d' eau</a></li>
                            <li><a href="deb.php?controller=Elec&action=index" class="btn btn-danger">Rélévé d' éléc</a></li>
                            <!-- <li><a href="deb.php?controller=Paie&action=index" class="btn btn-danger">Paiements</a></li>
                            <li><a href="deb.php?controller=Autre&action=index" class="btn btn-danger">Autres</a></li> -->
                            <li style="margin-top:6vh"><a href="index.php" class="btn btn-primary">Retour</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="right_panel">
            <header class="loha"> 
                <h2>Les Compteurs  <a href="deb.php?controller=Compteur&action=create" class="btn btn-success" id="ajouter"><img src="image/icons8_create_50px.png" alt="" class="icon"> Ajouter</a></h2>
                <div class="search">
                    <form action="deb.php?controller=search&action=searchCompteur" method="POST">
                        <select name="typeSearch" class="form-control2" id="sexe">
                            <option value="codeComp" <?= ($search['typeSearch'] == "codeComp") ? 'selected' : ''?>>Code Compteur</option>
                            <option value="pu" <?= ($search['typeSearch'] == "pu") ? 'selected' : ''?>>Prix Unitaire</option>
                            <option value="type" <?= ($search['typeSearch'] == "type") ? 'selected' : ''?>>Type</option>
                            <option value="nom" <?= ($search['typeSearch'] == "nom") ? 'selected' : ''?>>Nom titulaire</option>
                            <option value="prenom" <?= ($search['typeSearch'] == "prenom") ? 'selected' : ''?>>Prénom titulaire</option>
                        </select>
                        <input type="text" class="form-control2" name="search" value="<?php echo $search['search']?>">
                        <button class="btn btn-primary" type="submit"><img src="image/search_50px.png" alt="" class="icon"></button>
                        <a href="deb.php?controller=Compteur&action=index" class="btn btn-default">Refresh</a>
                    </form>
                </div>
            </header>
            <div class="right_content">
                <div class="containerPers admin" style="overflow-x:auto; >
                    <div class="row">
                        <h3><strong>Liste des Compteurs</strong></h3>

                        <table class=" table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Code Compteur</th>
                                    <th>Nom Titulaire</th>
                                    <th>Prénom Titulaire</th>
                                    <th>PU(Ar)</th>
                                    <th>Type</th>
                                    <th>Actions</th>                                                                                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($itemCompteur) {
                                        foreach($itemCompteur as $item){
                                            echo '<tr>';
                                            echo        '<td>' . $item['codeCompteur'] . '</td>';
                                            echo        '<td>' . $item['nom']. '</td>';
                                            echo        '<td>' . $item['prenom']. '</td>';
                                            echo        '<td>'. $item['pu'] . '</td>';
                                            echo        '<td>' . $item['type']. '</td>';
                                            echo        '<td width=150>';
                                            echo            '<a href="deb.php?controller=Compteur&action=createUpdate&codeComp='.$item['codeCompteur'].'" class="btn btn-primary"><img src="image/icons8_edit_50px.png" class="icon"></a>';
                                            echo ' ';
                                            echo            '<a href="deb.php?controller=Compteur&action=createDelete&codeComp='.$item['codeCompteur'].'" class="btn btn-danger"><img src="image/icons8_trash_can_50px.png" alt="" class="icon"></a>';
                                            echo        '</td>';
                                            echo '</tr>';
                                        }
                                    }else {
                                        ?>
                                            <tr style="color:red">
                                                <td colspan =6 style="text-align: center"> Aucun données trouvé! </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>