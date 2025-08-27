<?php 

    require 'vendor/vendor/autoload.php';
            
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nomMois = checkInput($item['1']);
        $nom = checkInput($item['2']);
        $prenom = checkInput($item['3']);
        $codeCli = checkInput($item['4']);
        $quartier = checkInput($item['5']);
        $codeCompElec = checkInput($item['6']);
        $codeCompEau = checkInput($item['7']);
        $datePres = checkInput($item['8']);
        $dateLimite = checkInput($item['9']);
        $puElec = checkInput($item['10']);
        $puEau = checkInput($item['11']);
        $valeurElec = checkInput($item['12']);
        $valeurEau = checkInput($item['13']);
        $montantElec = checkInput($item['14']);
        $montantEau = checkInput($item['15']);
        $montantTotal = checkInput($item['16']);

        

        $dir = __DIR__ . "/factures/{$codeCli}_$nom/";
        $pdfFilename = "facture_{$codeCli}_{$nom}_{$datePres}.pdf";
        $pdfPath = $dir . $pdfFilename;

        if(!is_dir($dir)){
            mkdir($dir, 0777, true);
        }

        $mpdf = new \Mpdf\Mpdf();
        
        $html = '
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
                <style>
                    .sary2{
                        position: fixed;
                        margin-left: 5vw;
                        width:20%;
                        height: auto;
                    }

                    .ajout3{
                        margin: 0.2vw;
                        margin-top: 7vh;
                        width: 100%;
                        margin-left: auto;
                        margin-right: auto;
                        border: 1px solid white;
                        color: #002b64;
                    }
                    .header{
                        height:10vh;
                        width: 100%;
                    }

                    li{
                        list-style: none;
                    }

                    .myTable{
                        width: 80%;
                        margin: 0 10%;
                        text-align: center;
                    }
                    td, th{
                        padding:5px;
                    }
                    

                </style>
            </head>
            <body>
                
               
            <div class="ajout3 admin3">
                <div class="header"></div>
                <div class="factureContent">
                    
                    <h2 class="jirama"> <img src="image/téléchargement.png" alt="" class="img-circle sary2">JIRO SY RANO MALAGASY</h2>
                    <h4 class="maintso"> Votre Facture Mois de '.$nomMois.'</h4><br>
                    <p>-----------------------------------------------------------------------------------------------------------------------------------------------------</p>
                    <br>
                    <ul>
                        <li>Titulaire de compte : '.$nom.' '.$prenom.'</li>
                        <li>Référence Client : '.$codeCli.'</li>
                        <li>Adresse installation : '.$quartier.' </li><br>
                        <li>N° compteur électricité : '. $codeCompElec .'</li>
                        <li>N° compteur eau : '.$codeCompEau.'</li>
                    </ul><br>
                    
    
                    
                
                    <h3 style="margin-left:27%;">Voici votre Facture en details:</h3>
                    <table class="table table-striped table-bordered myTable">
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
                                <td> '.$puElec.' </td>
                                <td> '.$puEau.'</td>
                            </tr>
                            <tr>
                                <td>Valeur</td>
                                <td> '.$valeurElec.' </td>
                                <td> '.$valeurEau.' </td>
                            </tr>
                            <tr>
                                <td>Total(Ar)</td>
                                <td> '.$montantElec.' </td>
                                <td> '.$montantEau.' </td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="margin-left:5%; margin-top:4%;">NET A PAYER: '.$montantTotal.' Ar</p><br>
                    <p>-----------------------------------------------------------------------------------------------------------------------------------------------------</p>
                    <br>
                    <ul>
                        <li>Date de présentation : '.$datePres.'</li>
                        <li>Date limite paiement : '.$dateLimite.'</li>
                    </ul>
                </div>
            </div>

            </body>
            </html>

        ';



        $mpdf->WriteHTML($html);

        $mpdf->Output($pdfPath, 'F');

        require 'views/facture/successFacture.php';

        
        
    }else{
        echo 'Erreur d\' accès pour la génération du facture';
    }                                                                       


    function checkInput($item){
        $item = trim($item);
        $item = htmlspecialchars($item);
        $item = stripslashes($item);
        return $item;
    }

?>