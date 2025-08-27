<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrapVrai.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="bootstrap/bootstrapVrai.min.js"></script>
    <script src="bootstrap/Jquery/vraiJquery.min.js"></script>
    <title>Jirama Ofisialy</title>
    <link rel="shortcut icon" href="image/téléchargement.png" type="image/x-icon">
    <style>
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
    <img src="image/téléchargement.png" alt="" class="img-circle sary2">
    <img src="image/hero-bg.png" alt="" class="sary">
    <div class="container">
        <div class="row">
            <div class="content">
                <h1 class="titre"><span class="point">.</span>Jirama</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="show1">
                <div class="col-lg-3">
                    <img src="image/client-1295901_1920.png" alt="Avatar" class="image" style="max-width:70%">
                </div>
                <div class="col-lg-9">
                    <p>Voici les compteurs de <strong><?php echo $data2['nom']. ' '  .$data2['prenom']; ?></strong> </p>
                    <table class=" table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Code Compteur</th>
                                <th>Code Client</th>
                                <th>PU(Ar)</th>
                                <th>Type</th>                                                                                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($data) {
                                    foreach($data as $item){
                                        echo '<tr>';
                                        echo        '<td>' . $item['codeCompteur'] . '</td>';
                                        echo        '<td>' . $item['codeCli']. '</td>';
                                        echo        '<td>' . $item['pu'] . '</td>';
                                        echo        '<td>' . $item['type']. '</td>';
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
                    <div class="factureButton">
                        <button class="btn btn-success retour1" onclick="<?php if($data){ echo "dateFacture()";}else{ echo "dateVide()";}?>">Générer</button>
                        <a href="deb.php?controller=customer&action=index" class="btn btn-primary retour2" >Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div id="facture1"></div>
    <div class="popup">
        <div id="facture">
            <img src="image/delete_50px.png" alt="" id="coin" onclick="closeFact()">
            <form onsubmit=" return verifyDate(event)" action="<?php echo 'deb.php?controller=customer&action=viewGenFact&codeCli='.$item['codeCli'].''?>" method="POST">
                <h3>Veuillez entrez la date de présentation:</h3>
                <label for="mois">Mois de presentation:</label>
                <div class="dateFacture" style="display:flex; margin-bottom: 10px;">
                    <select name="mois" id="mois" class="form-control">
                        <option value="01">Janvier</option>
                        <option value="02">Fevrier</option>
                        <option value="03">Mars</option>
                        <option value="04">Avril</option>
                        <option value="05">Mai</option>
                        <option value="06">Juin</option>
                        <option value="07">Juillet</option>
                        <option value="08">Aout</option>
                        <option value="09">Septembre</option>
                        <option value="10">Octobre</option>
                        <option value="11">Novembre</option>
                        <option value="12">Decembre</option>
                    </select>
                    <input type="text" name="an" class="form-control" style="margin-bottom: 10px;" placeholder="Entrez l'année actuelle..." id="annee">
                </div>
                <p style="color:red;" id="errorRes"></p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Voir l' extrait du facture</button>
                </div>
            </form>
        </div>
    </div>

   <script>
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