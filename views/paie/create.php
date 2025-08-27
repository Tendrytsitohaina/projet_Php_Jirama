<?php

    $data = $data ?? [];
    $errors = $errors ?? [];
    
    $data['codePaie'] = $data['codePaie'] ?? "";
    $codeCli = $data['codeCli'] = $data['codeCli'] ?? "";
    $data['datePaie'] = $data['datePaie'] ?? "";
    $errors['dateError'] = $errors['dateError'] ?? "";
    $errors['montantError'] = $errors['montantError'] ?? "";
    $code = $code ?? "";

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
                <h2 class="titre2"><strong> Ajouter nouveau paiement</strong></h2>
                <form action="<?php echo 'deb.php?controller=Paie&action=store'?>" method="post">
                    <div class="containerPers">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codeCli">Code client titulaire</label>
                                    <!-- <select type="" name="codeCli" class="form-control" id="codeCli">
                                        <?php 
                                            require_once 'config/connexion.php';
                                            $db = Database::connect();

                                            foreach($db->query('select nom, prenom, codeCli from clients') as $item){
                                                if ($data['codeCli'] == $item['codeCli']) {
                                                    echo '<option selected= "selected" value=" '.$item['codeCli']. '"> '.$item['nom']. ' ' . $item['prenom'] . ' ' . $item['codeCli'].'</option>'; 
                                                }else{
                                                    echo '<option value=" '.$item['codeCli']. '"> '.$item['nom']. ' ' . $item['prenom'] . ' ' . $item['codeCli'].'</option>'; 
                                                }
                                            }
                                            Database::disconnect();
                                        ?>
                                    </select> -->
                                    <input type="text" name="codeCli" value="<?php echo $code ?>" class="form-control"> 
                                </div>
                                <div class="form-group"> 
                                    <label for="datePaie">Date de paiement</label>
                                    <input type="date" name="datePaie" class="form-control">
                                    <span class="help-inline"><?php echo $errors['dateError']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="montant">Montant(en Ariary):</label>
                                   
                                    <input type="number" name="montant" class="form-control" id="prix" placeholder="Entrer le prix Unitaire..." value="<?php echo $res;?>">
                                    <span class="help-inline"><?php echo $errors['montantError']; ?></span>
                                </div>
                                
                            </div>
                            <div class="col-md-6">

                                <img src="image/lake-6481492_1920.jpg" alt="" style="widht: 10vw;" class="img-thumbnail">
                                
                            </div> 
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" > Ajouter </button>
                            <a href="deb.php?controller=Paie&action=index" class="btn btn-primary"> Retour </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>