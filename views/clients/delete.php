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
                <h2 class="titre2"><strong> Supprimer un client</strong></h2>
                <form action=" <?php echo 'deb.php?controller=customer&action=delete&codeCli=' .$codeCli.'' ?>" method="POST">
                    <input type="hidden" value="<?php echo $codeCli;?>" name="codeCli">
                    <p class="alert alert-warning">
                        Voulez-vous vraiment supprimer le client: <br>
                        Code Client: <?php echo $codeCli; ?> <br>
                        Nom  Client: <?php echo $data['nom'] . ' ' . $data['prenom'];?>
                    </p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger" > Oui </button>
                        <a href="deb.php?controller=customer&action=index" class="btn btn-default"> Non </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>