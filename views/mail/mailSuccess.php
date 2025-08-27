
<?php

    $data = $data ?? [];
    $errors = $errors ?? [];

    // $data['codePaie'] = $data['codePaie'] ?? "";
    

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
                <h2 class="titre2"><strong> Mail envoyée avec succès</strong></h2>
                <p class="alert alert-info">
                    <?php echo 'Mail envoyée avec succès à '. $item['mail']; ?>
                </p>
                <div class="form-actions">
                    <a href="deb.php?controller=customer&action=retard" class="btn btn-default"> Retour </a>
                </div>
            </div>
        </div>
    </div>
</body>