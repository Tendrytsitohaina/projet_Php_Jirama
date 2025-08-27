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
                <h2 class="titre2"><strong> Historique Facture</strong></h2>
                <form action="<?php echo 'deb.php?controller=Facture&action=historique'?>" method="POST">
                    <p class="alert alert-warning">
                        Veuillez entrez le client pour rechercher ses trois derniers factures: <br>
                    </p>
                    <div class="form-group">
                        <label for="moi">Le client:</label>
                        <input type="text" class="form-control" placeholder="Entrez le code du client pour commencer..." name="codeCli">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger" > Voir </button>
                        <a href="deb.php?controller=customer&action=index2" class="btn btn-default"> Retour </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>