<?php
    $data = $data ?? [];
    $errors = $errors ?? [];
    
    $data['nom'] = $data['nom'] ?? "";
    $data['prenom'] = $data['prenom'] ?? "";
    $data['sexe'] = $data['sexe'] ?? "";
    $data['quartier'] = $data['quartier'] ?? "";
    $data['mail'] = $data['mail'] ?? "";
    $data['niveau'] = $data['niveau'] ?? "";
    $errors['nameError'] = $errors['nameError'] ?? "";
    $errors['firstnameError'] = $errors['firstnameError'] ?? "";
    $errors['quartierError'] =  $errors['quartierError'] ?? "";
    $errors['mailError'] = $errors['mailError'] ?? "";

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
                <h2 class="titre2"><strong> Ajouter du nouveau client</strong></h2>
                <form action="<?php echo 'deb.php?controller=customer&action=store' ?>" method="post">
                    <div class="containerPers">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Entrer le nom..." value="<?php echo $data['nom']; ?>">
                                    <span class="help-inline"><?php echo $errors["nameError"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Entrer le prenom..." value="<?php echo $data['prenom']; ?>">
                                    <span class="help-inline"><?php echo $errors["firstnameError"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="sexe">sexe: masculin(M) ou féminin(F)</label>
                                    <select type="" name="sexe" class="form-control" id="sexe">
                                        <option value="M" <?= ($data['sexe'] == "M") ? 'selected' : ''?>>M</option>
                                        <option value="F" <?= ($data['sexe'] == "F") ? 'selected' : ''?>>F</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quartier">Quartier:</label>
                                    <input type="text" name="quartier" class="form-control" id="quartier" placeholder="Entrer le quartier..." value="<?php echo $data['quartier']; ?>">
                                    <span class="help-inline"><?php echo $errors["quartierError"]; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="mail">Mail:</label>
                                    <input type="mail" name="mail" class="form-control" id="mail" placeholder="Entrer le Mail..." value="<?php echo $data['mail']; ?>">
                                    <span class="help-inline"><?php echo $errors["mailError"]; ?></span>
                                </div> 
                                <div class="form-group">
                                    <label for="niveau">Niveau: A , B ou C</label>
                                    <select type="" name="niveau" class="form-control" id="sexe">
                                        <option value="A" <?= ($data['niveau'] == "A") ? 'selected' : ''?>>A</option>
                                        <option value="B" <?= ($data['niveau'] == "B") ? 'selected' : ''?>>B</option>
                                        <option value="C" <?= ($data['niveau'] == "C") ? 'selected' : ''?>>C</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" > Ajouter </button>
                            <a href="deb.php?controller=customer&action=index" class="btn btn-primary"> Retour </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>