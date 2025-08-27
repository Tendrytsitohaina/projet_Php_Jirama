<?php

    $data = $data ?? [];
    $errors = $errors ?? [];

    $data['dateReleve2'] = $data['dateReleve2'] ?? "";
    $data['valeur2'] = $data['valeur2'] ?? "";
    $data['date_presentation2'] = $data['date_presentation2'] ?? "";
    $data['date_limite2'] = $data['date_limite2'] ?? "";

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
                <h2 class="titre2"><strong> Modifier un Rélévé d' eau</strong></h2>
                <form action="<?php echo 'deb.php?controller=Eau&action=update&codeEau='.$codeEau.''?>" method="post">
                    <div class="containerPers">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valeur2">Valeur de l'Index:</label>
                                    <input type="number" name="valeur2" class="form-control" id="nom" placeholder="Entrer le valeur..." value="<?php echo $data['valeur2']; ?>">
                                    <span class="help-inline"><?php echo $errors["valeurError"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="dateReleve2">Date du rélévé:</label>
                                    <input type="date" name="dateReleve2" class="form-control" id="prenom" value="<?php echo $data['dateReleve2']; ?>">
                                    <span class="help-inline"><?php echo $errors["dateError1"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="codeCompteur">Code Compteur</label>
                                    <select type="" name="codeCompteur" class="form-control" id="sexe">
                                        <?php
                                             require_once 'config/connexion.php';
                                             $db = Database::connect();
                                             foreach($db->query('SELECT codeCompteur,type from compteur WHERE type = "eau" ') as $item){
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
                                    <label for="date_presentation2">Date presentation:</label>
                                    <input type="date" name="date_presentation2" class="form-control" id="quartier" value="<?php echo $data['date_presentation2']; ?>">
                                    <span class="help-inline"><?php echo $errors["dateError2"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="date_limite2">Date limite paiement:</label>
                                    <input type="date" name="date_limite2" class="form-control" id="mail" value="<?php echo $data['date_limite2']; ?>">
                                    <span class="help-inline"><?php echo $errors["dateError3"]; ?></span>
                                </div> 
                                <div class="form-group">
                                    <label for="codeComp">Code Eau</label>
                                    <input type="text" name="codeComp" class="form-control" id="codeComp" placeholder="Entrer le code Compteur..." value="<?php echo $codeEau?>" disabled>
                                </div>
                            </div> 
                        </div>
                        
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" > Modifier </button>
                            <a href="deb.php?controller=Eau&action=index" class="btn btn-primary"> Retour </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>