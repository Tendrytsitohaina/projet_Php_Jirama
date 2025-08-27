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
    <!-- <link rel="stylesheet" href="css/style2.css"> -->
    <script src="js/script.js"></script>
    <script src="bootstrap/bootstrapVrai.min.js"></script>
    <script src="bootstrap/Jquery/vraiJquery.min.js"></script>
    <title>Jirama Ofisialy</title>
    <link rel="shortcut icon" href="image/téléchargement.png" type="image/x-icon">
    <style>
        th{
            text-align: center;
        }

        .icon{
            width:20px;
            margin-top: -3px;
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
        th{
            text-align:center;
        }

        .factureButton{
            display:flex;
        }

        .popup{
            width: 50%;
            margin-left: 25%;
            margin-right: 25%;
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
        }
        .popup{
            top:25vh;
            left:50;
            position: absolute;
            width:50%;
            margin-left: 25%;
            margin-rigth: 22%;
            
        }
        #facture{
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
                            <li><a href="#" class="btn btn-danger" id="active">Clients</a></li>
                            <!-- <li><a href="deb.php?controller=Compteur&action=index" class="btn btn-danger">Compteurs</a></li>
                            <li><a href="deb.php?controller=Eau&action=index" class="btn btn-danger">Rélévé d' eau</a></li>
                            <li><a href="deb.php?controller=Elec&action=index" class="btn btn-danger">Rélévé d' éléc</a></li> -->
                            <li><a href="deb.php?controller=Paie&action=index" class="btn btn-danger">Paiements</a></li>
                            <li><a href="deb.php?controller=customer&action=historique" class="btn btn-danger">Historique facture</a></li>
                            <li><a href="deb.php?controller=customer&action=retard" class="btn btn-danger">Paiement en retard</a></li>
                            <li style="margin-top:6vh"><a href="index.php" class="btn btn-primary">Retour</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="right_panel">
            <header class="loha1"> 
                <h2>Les clients <a href="deb.php?controller=customer&action=create" class="btn btn-success" id="ajouter"><img src="image/icons8_create_50px.png" alt="" class="icon"> Ajouter</a><a href="deb.php?controller=customer&action=indexCli" onclick="dateFacture()" class="btn btn-success" id="ajouter">Client Par quartier</a></h2>
                <div class="search">
                    <form action="deb.php?controller=search&action=searchClient" method="POST">
                        <select name="typeSearch" class="form-control2" id="sexe">
                            <option value="CodeCli" <?= ($search['typeSearch'] == "CodeCli") ? 'selected' : ''?>>CodeCli</option>
                            <option value="Nom" <?= ($search['typeSearch'] == "Nom") ? 'selected' : ''?>>Nom</option>
                            <option value="Prenom" <?= ($search['typeSearch'] == "Prenom") ? 'selected' : ''?>>Prénom</option>
                            <option value="Sexe" <?= ($search['typeSearch'] == "Sexe") ? 'selected' : ''?>>Sexe</option>
                            <option value="Quartier" <?= ($search['typeSearch'] == "Quartier") ? 'selected' : ''?>>Quartier</option>
                            <option value="Niveau" <?= ($search['typeSearch'] == "Niveau") ? 'selected' : ''?>>Niveau</option>
                            <option value="Mail" <?= ($search['typeSearch'] == "Mail") ? 'selected' : ''?>>Mail</option>
                        </select>
                        <input type="text" class="form-control2" name="search" value="<?php echo $search['search']?>">
                        <button class="btn btn-primary" type="submit"><img src="image/search_50px.png" alt="" class="icon"></button>
                        <a href="deb.php?controller=customer&action=index" class="btn btn-default">Refresh</a>
                    </form>
                </div>
            </header>
            <div class="right_content" id='test'>
                <div class="containerPers admin" style="overflow-x:auto; ">
                    <div class="row">
                        <h3><strong>Liste des clients</strong></h3>
                        <table class=" table table-striped" >
                            <thead>
                                <tr>
                                    <th>CodeCli</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Sexe</th>
                                    <th>Quartier</th>
                                    <th>Niveau</th>
                                    <th>Mail</th>
                                    <th>Actions</th>                                                                                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($item) {
                                        foreach($item as $item){
                                            echo '<tr style="text-align: center">';
                                            echo        '<td>' . $item['codeCli']. '</td>';
                                            echo        '<td>' . $item['nom']. '</td>';
                                            echo        '<td>' . $item['prenom']. '</td>';
                                            echo        '<td>' . $item['sexe'] . '</td>';
                                            echo        '<td>' . $item['quartier'] . '</td>';
                                            echo        '<td>' . $item['niveau']. '</td>';
                                            echo        '<td widht=20>' . $item['mail'] .'</td>';
                                            echo        '<td>';
                                            echo            '<a href="deb.php?controller=customer&action=createFacture&codeCli='. $item['codeCli'] .'" class="btn btn-warning"><img src="image/receipt_declined_50px.png" alt="" class="icon"></a>';
                                            echo ' ';
                                            echo            '<a href="deb.php?controller=customer&action=createUpdate&codeCli='. $item['codeCli'] .'" class="btn btn-primary"><img src="image/icons8_edit_50px.png" class="icon"> </a>';
                                            echo ' ';
                                            echo            '<a href="deb.php?controller=customer&action=createDelete&codeCli='. $item['codeCli'] .'" class="btn btn-danger"><img src="image/icons8_trash_can_50px.png" alt="" class="icon"></a>';
                                            echo        '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        ?>
                                            <tr style=" color:red">
                                                <td colspan =8  style="text-align: center"> Aucun données trouvé! </td>
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
    <div class="containerPers admin" style="overflow-x:auto; ">
        <div id="facture1"></div>
        <div class="popup">
            <div id="facture">
                
                    <div class="row">
                        <img src="image/delete_50px.png" alt="" id="coin" onclick="closeFact()">
                        <h3><strong>Liste des clients</strong></h3>
                        <table class=" table table-striped" >
                            <thead>
                                <tr>
                                    <th>CodeCli</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Quartier</th>                   
                                    <th>Actions</th>                                                                                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($item) {
                                        foreach($item as $item){
                                            echo '<tr style="text-align: center">';
                                            echo        '<td>' . $item['codeCli']. '</td>';
                                            echo        '<td>' . $item['nom']. '</td>';
                                            echo        '<td>' . $item['prenom']. '</td>';
                                            echo        '<td>' . $item['quartier'] . '</td>';
                                            echo        '<td>';
                                            echo            '<a href="deb.php?controller=customer&action=createFacture&codeCli='. $item['codeCli'] .'" class="btn btn-warning"><img src="image/receipt_declined_50px.png" alt="" class="icon"></a>';
                                            echo ' ';
                                            echo            '<a href="deb.php?controller=customer&action=createUpdate&codeCli='. $item['codeCli'] .'" class="btn btn-primary"><img src="image/icons8_edit_50px.png" class="icon"> </a>';
                                            echo ' ';
                                            echo            '<a href="deb.php?controller=customer&action=createDelete&codeCli='. $item['codeCli'] .'" class="btn btn-danger"><img src="image/icons8_trash_can_50px.png" alt="" class="icon"></a>';
                                            echo        '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        ?>
                                            <tr style=" color:red">
                                                <td colspan =8  style="text-align: center"> Aucun données trouvé! </td>
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
    <script>
        function prepare(){
            document.getElementsById('test').style.display = "none";
        }

        function dateFacture(){
            document.getElementById("facture1").style.marginTop = '0'; 
            document.getElementById("facture").style.marginTop = '0'; 
            
            const daty = new Date().getFullYear();

            document.getElementById("annee").value = daty;
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