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
    <style>
        .icon{
            width: 20px;
            height: auto;
            margin-top: -4px;
        }
        .box1{
            margin-top: 3vh;
            height: auto;
            width: auto;
            display: flex;
            justify-content: flex-start;
            gap: 2.5vw;
        }
        .box2{
            margin-top: 10vh;
            height: auto;
            width: auto;
            display: flex;
            justify-content: flex-start;
            gap: 15vw;
        }
        .show1{
            background: white;
            height: 50vh;
            width: 100%;
            box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
            color: #00204a;
            padding: 8vh 5%;
            margin-top: 7vh;
        }

        .show1 p{
            padding: 10px 0;
        }
        
        .image {
            height: auto;
            margin-bottom: 20px;
           
        }

        .retour2{
            margin: 3vh 10%;
            width: 50%;
        }
        
        .retour1{
            margin: 3vh 10%;
            width: 50%;
        }
        th, td{
            text-align:center;
        }

        .factureButton{
            display:flex;
        }

        .popup{
            width: 50%;
            margin-left: 25%;
            margin-right: 25%;
            z-index: 1000;
        }

        #facture1{
            top: 0;
            left: 0;
            position: absolute;
            margin-top: -100vh;
            transition: all 1s ;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
        }
        .popup{
            top:25vh;
            left:50;
            position: absolute;
            width:50%;
            margin-left: 25%;
            margin-rigth: 22%;
            z-index: 1000;
            
        }
        #facture{
            z-index: 1000;
            background: white;
            border-radius: 10px;
            /* width: 60%; */
            margin-top: -90vh;
            padding: 4%;
            transition: all 1.3s;
            z-index: 99;
            overflow: hidden;
        }

        #coin{
            z-index: 1000;
            /* position: absolute; */
            background: #00204a;
            margin-left: 44.4vw;
            margin-top: -5vh;
            border-bottom-left-radius: 10px;
            z-index: 1;
            cursor: pointer;
        }
        .dateFacture select{
            width: 25%;
        }
        .dateFacture input{
            width: 25%;
            margin-left: 10px;
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
                            <li><a href="deb.php?controller=customer&action=index" class="btn btn-danger">Clients</a></li>
                            <!-- <li><a href="#" class="btn btn-danger">Compteurs</a></li>
                            <li><a href="deb.php?controller=Eau&action=index" class="btn btn-danger">Rélévé d' eau</a></li>
                            <li><a href="deb.php?controller=Elec&action=index" class="btn btn-danger">Rélévé d' éléc</a></li> -->
                            <li><a href="deb.php?controller=Paie&action=index" class="btn btn-danger" id="active">Paiements</a></li>
                            <li><a href="deb.php?controller=customer&action=historique" class="btn btn-danger">Historique facture</a></li>
                            <li><a href="deb.php?controller=customer&action=retard" class="btn btn-danger">Paiement en retard</a></li>
                            <li style="margin-top:6vh"><a href="index.php" class="btn btn-primary">Retour</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- href="deb.php?controller=Paie&action=create" -->
        <div class="right_panel">
            <header class="loha"> 
                <h2>Les Paiements  <a  href="#" onclick="dateFacture()" class="btn btn-success" id="ajouter"><img src="image/icons8_create_50px.png" alt="" class="icon"> Ajouter</a></h2>
                <div class="search">
                    <form action="deb.php?controller=search&action=searchPaie" method="POST">
                        <select name="typeSearch" class="form-control2" id="sexe">
                            <option value="codePaie" <?= ($search['typeSearch'] == "codePaie") ? 'selected' : ''?>>Code paie</option>
                            <option value="codeCli" <?= ($search['typeSearch'] == "codeCli") ? 'selected' : ''?>>Code Client</option>
                            <option value="datePaie" <?= ($search['typeSearch'] == "datePaie") ? 'selected' : ''?>>Date de paiement</option>
                            <option value="montant" <?= ($search['typeSearch'] == "montant") ? 'selected' : ''?>>Montant</option>
                            <!-- <option value="prenom" <?= ($search['typeSearch'] == "prenom") ? 'selected' : ''?>>Prenom titulaire</option> -->
                        </select>
                        <input type="text" class="form-control2" name="search" value="<?php echo $search['search']?>">
                        <button class="btn btn-primary" type="submit"><img src="image/search_50px.png" alt="" class="icon"></button>
                        <a href="deb.php?controller=Paie&action=index" class="btn btn-default">Refresh</a>
                    </form>
                </div>
            </header>
            <div class="right_content">
                <div class="containerPers admin">
                    <div class="row">
                        <h3><strong>Liste des Paiements</strong></h3>

                        <table class=" table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Code Paie</th>
                                    <th>Code Client</th>
                                    <th>Date de Paiement</th>
                                    <th>Montant(Ar)</th>
                                    <th>Actions</th>                                                                                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($item) {
                                        foreach($item as $item){
                                            echo '<tr>';
                                            echo        '<td>' . $item['codePaie'] . '</td>';
                                            echo        '<td>' . $item['codeCli']. '</td>';
                                            echo        '<td>' . $item['datePaie']. '</td>';
                                            echo        '<td>' . $item['montant'] . '</td>';
                                            echo        '<td>';
                                            echo            '<a href="deb.php?controller=Paie&action=createUpdate&codePaie='.$item['codePaie'].'" class="btn btn-primary"><img src="image/icons8_edit_50px.png" class="icon"></a>';
                                            echo ' ';
                                            echo            '<a href="deb.php?controller=Paie&action=createDelete&codePaie='.$item['codePaie'].'" class="btn btn-danger"><img src="image/icons8_trash_can_50px.png" alt="" class="icon"></a>';
                                            echo        '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        ?>
                                            <tr style="color:red">
                                                <td colspan = 6 style="text-align: center"> Aucun données trouvé! </td>
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
    <div id="facture1"></div>
    <div class="popup">
        <div id="facture">
            <img src="image/delete_50px.png" alt="" id="coin" onclick="closeFact()">
            <form onsubmit=" return verifyDate(event)" action="<?php echo 'deb.php?controller=Paie&action=create'?>" method="POST">
                <h3>Veuillez entrez le code du client:</h3>
                <label for="codeCli">CodeCli:</label>
                <input type="text" class="form-control" name="codeCli" placeholder="Code here...">
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Payer</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function dateFacture(){
            document.getElementById("facture1").style.marginTop = '0'; 
            document.getElementById("facture").style.marginTop = '0'; 
        }
        function closeFact(){
            document.getElementById("facture1").style.marginTop = '-100vh'; 
            document.getElementById("facture").style.marginTop = '-90vh'; 

            
        }
        function dateVide(){
            alert("Ce client n' a pas encore du compteur!");
        }
   </script>
</body>
</html>