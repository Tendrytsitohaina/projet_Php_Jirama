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
        .right_content{
            color: #00204a;
        }
        .loha{
            position: fixed;
            z-index: 100;
            backdrop-filter: blur(20px);
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
                            <li><a href="deb.php?controller=Eau&action=index" class="btn btn-danger">Rélévé d' eau</a></li>
                            <li><a href="deb.php?controller=Elec&action=index" class="btn btn-danger">Rélévé d' éléc</a></li>
                            <!-- <li><a href="deb.php?controller=Paie&action=index" class="btn btn-danger">Paiements</a></li>
                            <li><a href="deb.php?controller=Autre&action=index" class="btn btn-danger">Autres</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="right_panel">
            <header class="loha"> 
                <h2>Tableau de bord</h2>
                <div class="search">
                    <h2><span id="datetime"></span></h2>
                </div>
            </header>
            <div class="right_content">
                <div class="divider"></div>
                <h2 style="text-align: center; color: #00204a;">Nos Statistiques du jour</h2>
                <div class="divider" id="divider"></div>
                <div class="box">
                    <div class="row">
                        <div class="col-md-3 col-md-6 show">
                            <h4>Clients(s)</h4>
                            <p><?php echo $client['nb']; ?></p>
                        </div>
                        <div class="col-md-3 col-sm-6 show">
                            <h4>Compteur(s)</h4>
                            <p><?php echo $compteur['nb']; ?></p>
                        </div>
                        <div class="col-md-3 col-sm-6 show">
                            <h4>Paiements en attente</h4>
                            <p><?php echo $facture['nb']; ?></p>
                        </div>
                        <div class=" col-md-3 col-sm-6 show">
                            <h4>Paiements en retard</h4>
                            <p><?php echo $retard['nb']; ?></p>
                        </div>
                    </div>
                </div><br>
                <div class="box2">
                    <div class="show">
                        <h4>Paiements en attente</h4>
                        <p>0</p>
                    </div>
                    <div class="show">
                        <h4>Paiements en attente</h4>
                        <p>0</p>
                    </div>
                    <div class="show">
                        <h4>Paiements en attente</h4>
                        <p>0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>