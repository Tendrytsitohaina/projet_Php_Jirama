<?php

    $data = $data ?? [];
    $errors = $errors ?? [];
    
    $data['codeComp'] = $data['codeComp'] ?? "";
    $data['codeCli'] = $data['CodeCli'] ?? "";
    $data['pu'] = $data['pu'] ?? "";
    $data['type'] = $data['type'] ?? "";
    $errors['codeCompError'] = $errors['codeCompError'] ?? "";
    $errors['puError'] = $errors['puError'] ?? "";

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
                <h2 class="titre2"><strong> Modifier l'enregistrement compteur</strong></h2>
                <form action="<?php echo 'deb.php?controller=Compteur&action=update&codeComp='.$codeComp.''?>" method="post">
                    <div class="containerPers">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codeComp">Code du Compteur(E0123... ou C0123...)</label>
                                    <input type="text" name="codeComp" class="form-control" id="codeComp" placeholder="Entrer le code Compteur..." value="<?php echo $codeComp?>" disabled>
                                </div>
                                <div class="form-group"> 
                                    <label for="type">Type: Eau ou Eléctricité</label>
                                    <select type="" name="type" class="form-control" id="type">
                                        <option value="eau" <?= ($data['type'] == "eau") ? 'selected' : ''?> >Eau (E)</option>
                                        <option value="elec" <?= ($data['type'] == "elec") ? 'selected' : ''?>>Elec (C)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prix">Prix Unitaire(PU en Ariary):</label>
                                    <input type="number" name="pu" class="form-control" id="prix" placeholder="Entrer le prix Unitaire..." value="<?php echo $data['pu']; ?>">
                                    <span class="help-inline"><?php echo $errors['puError']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="codeCli">Code et nom du client titulaire</label>
                                    <select type="" name="codeCli" class="form-control" id="codeCli">
                                        <?php 
                                            require_once 'config/connexion.php';
                                            $db = Database::connect();

                                            foreach($db->query('select nom, prenom, codeCli from clients') as $item){
                                                if($data['codeClient'] == $item['codeCli']){
                                                    echo '<option selected="selected" value="'.$item['codeCli'].'">'.$item['nom']. ' ' . $item['prenom'].' '.$item['codeCli'] .'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$item['codeCli'].'">'.$item['nom']. ' ' . $item['prenom'].' '.$item['codeCli'] .'</option>';
                                                }
                                            }
                                            Database::disconnect();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <img src="image/lake-6481492_1920.jpg" alt="" style="widht: 10vw;" class="img-thumbnail">
                                <!-- <div class="form-group">
                                    <label for="quartier">Quartier:</label>
                                    <input type="text" name="quartier" class="form-control" id="quartier" placeholder="Entrer le quartier..." value="<?php echo $data['quartier']; ?>">
                                    <span class="help-inline"><?php echo $errors['quartierError']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="mail">Mail:</label>
                                    <input type="mail" name="mail" class="form-control" id="mail" placeholder="Entrer le Mail..." value="<?php echo $data['mail']; ?>">
                                    <span class="help-inline"><?php echo $errors['mailError']; ?></span>
                                </div> 
                                <div class="form-group"> po987                                    <label for="niveau">Niveau: A , B ou C</label>
                                    <select type="" name="niveau" class="form-control" id="niveau">
                                        
                                        <option value="A" <?= ($data['niveau'] == "A") ? 'selected' : ''?>>A</option>
                                        <option value="B" <?= ($data['niveau'] == "B") ? 'selected' : ''?>>B</option>
                                        <option value="C" <?= ($data['niveau'] == "C") ? 'selected' : ''?>>C</option>
                                    </select>
                                </div> -->
                            </div> 
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" > Modifier </button>
                            <a href="deb.php?controller=Compteur&action=index" class="btn btn-primary"> Retour </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>