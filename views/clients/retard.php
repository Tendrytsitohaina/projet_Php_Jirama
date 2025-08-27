<?php

    $data = $data ?? [];
    $errors = $errors ?? [];

    $data['nom'] = $data['nom'] ?? "";
    $data['prenom'] = $data['prenom'] ?? "";

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
                <h2 class="titre2"><strong> Retard de paiement d'un client:</strong></h2>
                <form onsubmit="return verifyDate2(event)" action=" <?php echo 'deb.php?controller=customer&action=afficheRetard' ?>" method="POST">
                    <!-- <input type="hidden" value="<?php echo $codeCli;?>" name="codeCli"> -->
                    <p class="alert alert-warning">
                        Veuillez entrez le mois pour voir les client qui n'ont pas encore payer ses factures <br>
                    </p>
                    <div class="form-group">
                        <select name="mois" id="mois" class="form-control" >
                            <option value="1">Janvier</option>
                            <option value="2">Fevrier</option>
                            <option value="3">Mars</option>
                            <option value="4">Avril</option>
                            <option value="5">Mai</option>
                            <option value="6">Juin</option>
                            <option value="7">Juillet</option>
                            <option value="8">Aout</option>
                            <option value="9">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Decembre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="an" class="form-control" style="margin-bottom: 10px;" placeholder="Entrez l'année actuelle..." id="annee">
                        <p style="color:red;" id="errorRes"></p>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger" > Voir </button>
                        <a href="deb.php?controller=customer&action=index2" class="btn btn-default"> Retour </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        
        window.onload = function(){  
            const daty = new Date().getFullYear();

            document.getElementById("annee").value = daty;
        }
        
        }
    </script>
</body>