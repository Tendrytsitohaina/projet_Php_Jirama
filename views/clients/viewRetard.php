<?php


?>


<?php

    $data = $data ?? [];
    $errors = $errors ?? [];

    $data['codePaie'] = $data['codePaie'] ?? "";
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrapVrai.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/script.js"></script>
    <script src="bootstrap/bootstrapVrai.min.js"></script>
    <script src="bootstrap/Jquery/vraiJquery.min.js"></script>
    <title>Jirama Ofisialy</title>
    <link rel="shortcut icon" href="image/téléchargement.png" type="image/x-icon">
    <style>
        th{
            text-align: center;
        }
    </style>
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
                <h2 class="titre2"><strong>Voici les clients qui n' ont pas encore payées</strong></h2>
                <table class=" table table-striped" style="overflow-x:auto">
                            <thead>
                                <tr>
                                    <th>CodeCli</th>
                                    <th>Nom</th>
                                    <th>Quartier</th>
                                    <th>Mail</th>
                                    <th>Actions</th>                                                                                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $dateActuelle = date('Y-m-d');
                                   
                                    if ($item) {
                                        foreach($item as $item){
                                                echo '<tr style="text-align: center">';
                                                echo        '<td>' . $item['codeCli']. '</td>';
                                                echo        '<td>' . $item['nom']. '</td>';
                                                echo        '<td>' . $item['quartier'] . '</td>';
                                                echo        '<td>' . $item['mail'] .'</td>';
                                                echo        '<td width=230>';
                                                // var_dump($item['warning']);
                                                // var_dump($dateActuelle);
                                                
                                                if($item['warning'] <= $dateActuelle){
                                                    echo            '<a href="deb.php?controller=customer&action=mailWarning&codeCli='. $item['codeCli'] .'" class="btn btn-danger"><img src="image/expired_50px.png" alt="" class="icon"></a>';
                                                    echo ' ';
                                                    echo            '<a href="deb.php?controller=customer&action=createFacture&codeCli='. $item['codeCli'] .'" class="btn btn-warning"><img src="image/receipt_declined_50px.png" alt="" class="icon"></a>';
                                                    echo ' ';
                                                    echo            '<a href="deb.php?controller=customer&action=createUpdate&codeCli='. $item['codeCli'] .'" class="btn btn-primary"><img src="image/icons8_edit_50px.png" class="icon"> </a>';
                                                    echo ' ';
                                                    echo            '<a href="deb.php?controller=customer&action=createDelete&codeCli='. $item['codeCli'] .'" class="btn btn-danger"><img src="image/icons8_trash_can_50px.png" alt="" class="icon"></a>';
                                                    echo        '</td>';
                                                    echo '</tr>'; 
                                                }else {
                                                    echo            '<a href="deb.php?controller=customer&action=createFacture&codeCli='. $item['codeCli'] .'" class="btn btn-warning"><img src="image/receipt_declined_50px.png" alt="" class="icon"></a>';
                                                    echo ' ';
                                                    echo            '<a href="deb.php?controller=customer&action=createUpdate&codeCli='. $item['codeCli'] .'" class="btn btn-primary"><img src="image/icons8_edit_50px.png" class="icon"> </a>';
                                                    echo ' ';
                                                    echo            '<a href="deb.php?controller=customer&action=createDelete&codeCli='. $item['codeCli'] .'" class="btn btn-danger"><img src="image/icons8_trash_can_50px.png" alt="" class="icon"></a>';
                                                    echo        '</td>';
                                                    echo '</tr>'; 
                                                }
                                                 
                                        }
                                    }
                                    else {
                                        ?>
                                            <tr style=" color:red">
                                                <td colspan = 8  style="text-align: center"> Aucun données trouvé! </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                
                <div class="form-actions">
                    <a href=" <?php echo 'deb.php?controller=customer&action=retard'?>" class="btn btn-default"> Retour </a>
                </div>
            </div>
        </div>
    </div>
</body>