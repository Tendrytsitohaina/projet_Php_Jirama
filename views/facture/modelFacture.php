<?php

    $data = $data ?? [];
    $errors = $errors ?? [];

    $client['nom'] = $client['nom'] ?? "";
    $client['prenom'] = $client['prenom'] ?? "";
    $client['quartier'] = $client['quartier'] ?? "";
    $elec['codeCompteur'] = $elec['codeCompteur'] ?? "";
    $elec['date_presentation'] = $elec['date_presentation'] ?? "";
    $elec['date_limite'] = $elec['date_limite'] ?? "";
    $elec['valeur1'] = $elec['valeur1'] ?? "";
    $eau['codeCompteur'] = $eau['codeCompteur'] ?? "";
    $eau['date_presentation2'] = $eau['date_presentation2'] ?? "";
    $eau['date_limite2'] = $eau['date_limite2'] ?? "";
    $eau['valeur2'] = $eau['valeur2'] ?? "";
    $compEau['pu'] = $compEau['pu'] ?? "";
    $compElec['pu'] = $compElec['pu'] ?? "";
    $montantElec['montant'] = $montantElec['montant'] ?? "";
    $montantEau['montant'] = $montantEau['montant'] ?? "";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrapVrai.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/style3.css">
    <script src="js/script.js"></script>
    <script src="bootstrap/bootstrapVrai.min.js"></script>
    <script src="bootstrap/Jquery/vraiJquery.min.js"></script>
    <title>Jirama Ofisialy</title>
    <link rel="shortcut icon" href="image/téléchargement.png" type="image/x-icon">
    
</head>
<body>
    <!-- <img src="image/téléchargement.png" alt="" class="img-circle sary2"> -->
    <img src="image/hero-bg.png" alt="" class="sary">
    
    <div class="container">
        <div class="row">
            <div class="ajout2 admin2">
                
                <div class="factureContent">
                    <h3 class="jirama">JIRO SY RANO MALAGASY</h3>
                    <p class="alert alert-success p">Votre Facture Mois de: <?php echo $nomMois?></p>
                    <div class="division">
                        <div class="left">
                            <ul>
                                <li>Titulaire de compte : <?php echo $client['nom'] . ' ' . $client['prenom']?></li>
                                <li>Référence Client : <?php echo $client['codeCli']?></li>
                                <li>Adresse installation : <?php echo $client['quartier']?></li>
                                <li>N° compteur électricité : <?php echo $elec['codeCompteur']; ?></li>
                                <li>N° compteur eau : <?php echo $eau['codeCompteur']; ?></li>
                            </ul>
                        </div>
                        <div class="right">
                            <ul>
                                <li>Date de présentation : <?php if($eau['date_presentation2']){echo $eau['date_presentation2'];}else{ echo $elec['date_presentation'];}  ?></li>
                                <li>Date limite paiement : <?php if($elec){echo $elec['date_limite']; }else{echo $eau['date_limite2'];}?></li>
                            </ul>
                        </div>
                    </div>
                    <p style="margin: 0.7vh 26vw;">Votre Facture en details:</p>
                    <table class="table table-striped myTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Eléctricité (en Kwh)</th>
                                <th>Eau (en m<sup>3</sup>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PU(Ar)</td>
                                <td> <?php echo $compElec['pu']; ?></td>
                                <td> <?php echo $compEau['pu']; ?></td>
                            </tr>
                            <tr>
                                <td>Valeur</td>
                                <td> <?php echo $elec['valeur1']; ?></td>
                                <td> <?php echo $eau['valeur2'];?></td>
                            </tr>
                            <tr>
                                <td>Total(Ar)</td>
                                <td><?php echo $montantElec['montant']; ?></td>
                                <td><?php echo $montantEau['montant']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php $res = (int)$montantElec['montant'] + (int)$montantEau['montant'];?>
                    <p style="margin-left:15%; margin-top:4%;">NET A PAYER: <?php if($res){
                                                                                        echo $res.' Ar';

                                                                                    }elseif($montantElec['montant']){

                                                                                        echo $montantElec['montant'] .' Ar';

                                                                                    }else{ 
                                                                                        echo $montantEau['montant'].' Ar'; 
                                                                                    } 
                                                                            ?></p>
                    <form action="<?php echo 'deb.php?controller=Facture&action=genFact' ?>" method="POST">
                        <input type="hidden" name="1" value="<?php echo $nomMois;?>">
                        <input type="hidden" name="2" value="<?php echo $client['nom']?>">
                        <input type="hidden" name="3" value="<?php echo $client['prenom']?>">
                        <input type="hidden" name="4" value="<?php echo $client['codeCli']?>">
                        <input type="hidden" name="5" value="<?php echo $client['quartier']?>">
                        <input type="hidden" name="6" value="<?php echo $elec['codeCompteur']; ?>">
                        <input type="hidden" name="7" value="<?php echo $eau['codeCompteur']; ?>">
                        <input type="hidden" name="8" value="<?php if($eau['date_presentation2']){echo $eau['date_presentation2'];}else{ echo $elec['date_presentation'];}  ?>">
                        <input type="hidden" name="9" value="<?php if($elec){echo $elec['date_limite']; }else{echo $eau['date_limite2'];} ?>">
                        <input type="hidden" name="10" value="<?php echo $compElec['pu']; ?>">
                        <input type="hidden" name="11" value="<?php echo $compEau['pu']; ?>">
                        <input type="hidden" name="12" value="<?php echo $elec['valeur1']; ?>">
                        <input type="hidden" name="13" value="<?php echo $eau['valeur2']; ?>">
                        <input type="hidden" name="14" value="<?php echo $montantElec['montant']; ?>">
                        <input type="hidden" name="15" value="<?php echo $montantEau['montant']; ?>">
                        <input type="hidden" name="16" value="<?php echo $res; ?>">

                        <div class="form-actions" style="margin-left: 40%">
                            <a href=" <?php echo "deb.php?controller=customer&action=createFacture&codeCli=". $client['codeCli'] ?> " class="btn btn-primary">Annuler</a>
                            <button type="submit" class="btn btn-success">Générer</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>