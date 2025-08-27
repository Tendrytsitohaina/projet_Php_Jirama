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
    <!-- <link rel="stylesheet" href="../../css/style2.css"> -->
    <script src="js/script.js"></script>
    <script src="bootstrap/bootstrapVrai.min.js"></script>
    <script src="bootstrap/Jquery/vraiJquery.min.js"></script>
    <title>Jirama Ofisialy</title>
    <link rel="shortcut icon" href="../../../image/téléchargement.png" type="image/x-icon">
    <style>
        th{
            text-align: center;
        }
    </style>
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
                            <li><a href="deb.php?controller=Compteur&action=index" class="btn btn-danger">Compteurs</a></li>
                            <li><a href="#" class="btn btn-danger" id="active">Rélévé d' eau</a></li>
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
            <header class="loha1"> 
                <h2>Eau <a href="deb.php?controller=Eau&action=create" class="btn btn-success" id="ajouter"><img src="image/icons8_create_50px.png" alt="" class="icon"> Ajouter</a></h2>
                <div class="search">
                    <form action="deb.php?controller=search&action=searchEau" method="POST">
                        <select name="typeSearch" class="form-control2" id="sexe">
                            <option value="codeEau" <?= ($search['typeSearch'] == "codeEau") ? 'selected' : ''?>>Code Eau</option>
                            <option value="dateReleve" <?= ($search['typeSearch'] == "dateReleve") ? 'selected' : ''?>>Date Rélévé</option>
                            <option value="valeur" <?= ($search['typeSearch'] == "valeur") ? 'selected' : ''?>>Valeur de l'index</option>
                            <option value="dateLimite" <?= ($search['typeSearch'] == "dateLimite") ? 'selected' : ''?>>Date limite</option>
                            <option value="datePres" <?= ($search['typeSearch'] == "datePres") ? 'selected' : ''?>>Date présentation</option>
                            <option value="codeComp" <?= ($search['typeSearch'] == "codeComp") ? 'selected' : ''?>>Code Compteur</option>
                            
                        </select>
                        <input type="text" class="form-control2" name="search" value="<?php echo $search['search']?>">
                        <button class="btn btn-primary" type="submit"><img src="image/search_50px.png" alt="" class="icon"></button>
                        <a href="deb.php?controller=Eau&action=index" class="btn btn-default">Refresh</a>
                    </form>
                </div>
            </header>
            <div class="right_content">
                <div class="containerPers admin">
                    <div class="row">
                        <h3><strong>Liste des rélevés d'Eau</strong></h3>
                        <table class=" table table-striped" style="overflow-x:auto">
                            <thead>
                                <tr>
                                    <th>CodeEau</th>
                                    <th>date du rélévé</th>
                                    <th>Valeur(m<sup>3</sup>)</th>
                                    <th>Date presentation</th>
                                    <th>Date Limite</th>
                                    <th>CodeCompteur</th>
                                    <th>Actions</th>                                                                                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($item) {
                                        foreach($item as $item){
                                            echo '<tr style="text-align: center">';
                                            echo        '<td>' . $item['codeEau']. '</td>';
                                            echo        '<td>' . $item['dateReleve2']. '</td>';
                                            echo        '<td>' . $item['valeur2']. '</td>';
                                            echo        '<td>' .$item['date_presentation2'] . '</td>';
                                            echo        '<td>'.$item['date_limite2'] . '</td>';
                                            echo        '<td>' .$item['codeCompteur']. '</td>';
                                            echo        '<td>';
                                            echo            '<a href="deb.php?controller=Eau&action=createUpdate&codeEau='. $item['codeEau'] .'" class="btn btn-primary"><img src="image/icons8_edit_50px.png" class="icon"></a>';
                                            echo ' ';
                                            echo            '<a href="deb.php?controller=Eau&action=createDelete&codeEau='. $item['codeEau'] .'" class="btn btn-danger"><img src="image/icons8_trash_can_50px.png" alt="" class="icon"></a>';
                                            echo        '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        ?>
                                            <tr style=" color:red">
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
    <script>
        const moisNoms = [
            "Janvier","Février","Mars","Avril","Mais","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"
        ];

        const date = new Date();
        const moisActuel = moisNoms[date.getMonth()];

        document.getElementById("Mois").innerHTML = moisActuel;
    </script>
</body>
</html>