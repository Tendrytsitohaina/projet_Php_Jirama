<?php

    require 'models/factureModel.php';
   
    class factureController{
        private $factureModel;

        public function __construct(){
            $this->factureModel = new factureModel();
        }

        public function genFact($data){
            $item = $data;
            require 'views/facture/facturePDF.php';

        }

        public function historique($data){
            $res = $this->factureModel->historiqueFacture($data);
            $montantEau = $this->factureModel->getMontantFactEau($data);
            $montantElec = $this->factureModel->getMontantFactElec($data);

            $montantTotal = $montantEau + $montantElec;
            // var_dump($montantTotal);
            // die();

            if ($montantTotal) {
                require 'views/facture/historiqueFacture.php';
            }else {
                require 'views/facture/errorRes2.php';
            }
           
        }

        public function viewThreeFactHistorique($codeCli){

            // $mois = $data["mois"];
            // var_dump($mois);
            // die();
            $eau = $this->factureModel->getInfoFactureEau($codeCli);
            $elec = $this->factureModel->getInfoFactureElec($codeCli); 
            $client = $this->factureModel->getClientFact($codeCli);
            $compEau = $this->factureModel->getClientCompteurEau($codeCli);
            $compElec = $this->factureModel->getClientCompteurElec($codeCli);
            
    
            // $moisNoms = [
            //     '01'=> 'Janvier', '02'=> 'Février','03'=> 'Mars', '04'=> 'Avril', '05'=> 'Mai', '06'=> 'Juin',
            //     '07'=> 'Juillet', '08'=> 'Aout', '09'=> 'Septembre','10'=> 'Octobre','11'=> 'Novembre', '12'=> 'Décembre'
            // ];
            // $nomMois = $moisNoms[$mois];
    
            if( $client ){
                // $res = $eau + $elec + $client + $compEau + $compElec + $montantEau + $montantElec;

                // var_dump($res);
                // die();
                require 'views/facture/historiqueFacture.php';
    
            }else {
                require 'views/facture/errorRes.php';
            }
        }
    }
?>