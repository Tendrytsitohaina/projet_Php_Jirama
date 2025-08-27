<?php

    $data = $data ?? [];
    $errors = $errors ?? [];
    
    $data['dateReleve1'] = $data['dateReleve1'] ?? "";
    $data['valeur1'] = $data['valeur1'] ?? "";
    $data['date_presentation'] = $data['date_presentation'] ?? "";
    $data['date_limite'] = $data['date_limite'] ?? "";

   
    $errors['dateError1'] = $errors['dateError1'] ?? "";
    $errors['dateError2'] = $errors['dateError2'] ?? "";
    $errors['dateError3'] = $errors['dateError3'] ?? "";
    $errors['valeurError'] = $errors['valeurError'] ?? "";

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
                <h2 class="titre2"><strong> Ajouter nouvElec rélévé</strong></h2>
                <form action="<?php echo 'deb.php?controller=Elec&action=store'?>" method="post">
                    <div class="containerPers">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valeur1">Valeur de l'Index:</label>
                                    <input type="number" name="valeur1" class="form-control" id="nom" placeholder="Entrer le valeur..." value="<?php echo $data['valeur1']; ?>">
                                    <span class="help-inline"><?php echo $errors["valeurError"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="dateReleve1">Date du rélévé:</label>
                                    <input type="date" name="dateReleve1" class="form-control" id="prenom" value="<?php echo $data['dateReleve1']; ?>">
                                    <span class="help-inline"><?php echo $errors["dateError1"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="codeCompteur">Code Compteur</label>
                                    <select type="" name="codeCompteur" class="form-control" id="sexe">
                                        <?php
                                            require_once 'config/connexion.php';
                                            $db = Database::connect();
                                            foreach($db->query('SELECT codeCompteur,type from compteur WHERE type = "elec" ') as $item){
                                                if ($data['codeCompteur'] == $item['codeCompteur']) {
                                                    echo '<option selected="selected" value=" '.$item['codeCompteur']. '"> '.$item['codeCompteur']. ' (' . $item['type'] . ')</option>'; 
                                                }else{
                                                    echo '<option value=" '.$item['codeCompteur']. '"> '.$item['codeCompteur']. ' (' . $item['type'] . ')</option>'; 
                                                }
                                            }
                                            Database::disconnect();

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_presentation">Date presentation:</label>
                                    <input type="date" name="date_presentation" class="form-control" id="quartier" value="<?php echo $data['date_presentation']; ?>">
                                    <span class="help-inline"><?php echo $errors["dateError2"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="date_limite">Date limite paiement:</label>
                                    <input type="date" name="date_limite" class="form-control" id="mail" value="<?php echo $data['date_limite']; ?>">
                                    <span class="help-inline"><?php echo $errors["dateError3"]; ?></span>
                                </div> 
                            </div> 
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" > Ajouter </button>
                            <a href="deb.php?controller=Elec&action=index" class="btn btn-primary"> Retour </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>