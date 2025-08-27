<?php 

    foreach($res as $res){
        $nom = $res['nom'];
        $codeCli = $res['codeCli'];
    }

    function getTreeLastInvoices( $codeCli, $nom){

    
        $directory = "views/facture/factures/".$codeCli. "_".$nom;
        // var_dump($directory);
        // die();

        $folders = glob($directory, GLOB_ONLYDIR);

        if (empty($folders)) {
            return[];
        }

        $clientFolder = $folders[0];

        $files = glob($clientFolder . "/*.pdf");

        if (empty($files)) {
            return[];
        }

        usort($files, function($a, $b){
            return filemtime($b) - filemtime($a);
        });

        return array_slice($files, 0, 3);

    }

    $factures = getTreeLastInvoices($codeCli, $nom);

            // var_dump($factures);
            //         die();

        //    
        //     foreach($factures as $factures){
        //         echo "<a href='$factures' target='_blank' class='btn btn-success'> Voir la facture </a></br>";
        //     }
        // 
    
?>


<?php

    $data = $data ?? [];
    $errors = $errors ?? [];

    $data['codePaie'] = $data['codePaie'] ?? "";
    
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrapVrai.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/script.js"></script>
    <script src="bootstrap/bootstrapVrai.min.js"></script>
    <script src="bootstrap/Jquery/vraiJquery.min.js"></script>
    <title>Jirama Ofisialy</title>
    <link rel="shortcut icon" href="image/téléchargement.png" type="image/x-icon">
    <style>
        .facture{
            display: none;
            margin-top:10px;
        }
        .admin{
            overflow-x: hidden;
        }
        .ratio{
            position: relative;
            width: 100%;
            height: 80%;
        }

        .ratio iframe{
            position: absolute;
            top: 0;
            left: 0;
            width:100%;
            height: 100%;
            border: 0;

        }
        .sary{
            position: fixed;
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
            <div class="ajout admin2">
                <h3 class="titre2"><strong> Historique du trois dernier facture du: <?php echo $nom ?></strong></h3>
                <h3>Montant Total de ces factures: <?php echo $montantTotal.' Ar'?></h3>
                <p class="alert alert-success">
                    <button onclick="afficheFacture()" class="btn btn-success">Voir les factures</button>
                </p>
                <div id="factures">
                    <?php
                        foreach($factures as $factures){
                            echo "<iframe src='$factures' target='_blank' class='facture' height='600px' width='480px'></iframe>";
                        }
                    ?>
                </div>
                <div class="form-actions">
                    <a href=" <?php echo 'deb.php?controller=customer&action=historique'?>" class="btn btn-default"> Retour </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function afficheFacture(){
            let factures = document.querySelectorAll('.facture');
            factures.forEach(facture => {
                facture.style.display = 'block';
            })
        }
    </script>
</body>
