<?php

    require 'models/paieModel.php';
    class PaieController{

        private $PaieModel;

        public function __construct(){
            $this->PaieModel = new PaieModel();
        }
        public function index(){
            $item = $this->PaieModel->getAllPaie();
            require 'views/paie/index.php';
        }

        public function create($codeCli){
            $code = $codeCli['codeCli'];
        
            $res = $this->PaieModel->getMontantTotal($codeCli['codeCli']);
        
            require 'views/paie/create.php';
        }
    
        public function store($data){
            $data = $this->PaieModel->addPaie($data);
            if($data){
                header("Location: deb.php?controller=Paie&action=index");
            }
        }

        public function createUpdate($codePaie){
            $client = $this->PaieModel->viewUpdate($codePaie);
        }
    
        public function update($data , $codePaie){
            $data = $this->PaieModel->updatePaie($data, $codePaie);
            if($data){
                header("Location: deb.php?controller=Paie&action=index");
            }
        }
    
        public function createDelete($codePaie){
            // $client = $this->PaieModel->viewDelete($codePaie);
            require 'views/paie/delete.php';

        }
    
        public function delete($codePaie){
            $data = $this->PaieModel->deletePaie($codePaie);
            if($data){
                header("Location: deb.php?controller=Paie&action=index");
            }
    
        }
        
    }  
?>