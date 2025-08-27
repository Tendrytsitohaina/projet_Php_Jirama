<?php

    require 'models/searchModel.php';

    class searchController{
        private $searchModel;

        public function __construct(){
            $this->searchModel = new searchModel();
        }

        public function searchClient($search){
            $item = $this->searchModel->searchClient($search);
            require 'views/clients/index.php';
        }

        public function searchCompteur($search){
            $itemCompteur = $this->searchModel->searchCompteur($search);
            require 'views/compteurs/index.php';
        }

        public function searchEau($search){
            $item = $this->searchModel->searchEau($search);
            require 'views/releveEau/index.php';
        }

        public function searchElec($search){
            $item = $this->searchModel->searchElec($search);
            require 'views/releveElec/index.php';
        }

        public function searchPaie($search){
            $item = $this->searchModel->searchPaie($search);
            require 'views/paie/index.php';
        }


    }

?>