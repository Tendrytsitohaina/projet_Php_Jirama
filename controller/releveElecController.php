<?php

    require 'models/releveElecModel.php';
    class ElecController{

        private $ElecModel;

        public function __construct(){
            $this->ElecModel = new ElecModel();
        }
        public function index(){
            $item = $this->ElecModel->getAllElec();
            require 'views/releveElec/index.php';
        }

        public function create(){
            require 'views/releveElec/create.php';
        }
    
        public function store($data){
            $data = $this->ElecModel->addElec();
            if($data){
                header("Location: deb.php?controller=Elec&action=index");
            }
        }

        public function createUpdate($codeElec){
            $client = $this->ElecModel->viewUpdate($codeElec);
        }
    
        public function update($data , $codeElec){
            $data = $this->ElecModel->updateElec($data, $codeElec);
            if($data){
                header("Location: deb.php?controller=Elec&action=index");
            }
        }
    
        public function createDelete($codeElec){
            // $client = $this->ElecModel->viewDelete($codeElec);
            require 'views/releveElec/delete.php';

        }
    
        public function delete($codeElec){
            $data = $this->ElecModel->deleteElec($codeElec);
            if($data){
                header("Location: deb.php?controller=Elec&action=index");
            }
    
        }
        
    }  
?>