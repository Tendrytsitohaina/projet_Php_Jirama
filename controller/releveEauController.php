<?php

    require 'models/releveEauModel.php';
    class EauController{

        private $EauModel;

        public function __construct(){
            $this->EauModel = new EauModel();
        }
        public function index(){
            $item = $this->EauModel->getAllEau();
            require 'views/releveEau/index.php';
        }

        public function create(){
            require 'views/releveEau/create.php';
        }
    
        public function store($data){
            $data = $this->EauModel->addEau();
            if($data){
                header("Location: deb.php?controller=Eau&action=index");
            }
        }

        public function createUpdate($codeEau){
            $client = $this->EauModel->viewUpdate($codeEau);
        }
    
        public function update($data , $codeEau){
            $data = $this->EauModel->updateEau($data, $codeEau);
            if($data){
                header("Location: deb.php?controller=Eau&action=index");
            }
        }
    
        public function createDelete($codeEau){
            // $client = $this->EauModel->viewDelete($codeEau);
            require 'views/releveEau/delete.php';

        }
    
        public function delete($codeEau){
            $data = $this->EauModel->deleteEau($codeEau);
            if($data){
                header("Location: deb.php?controller=Eau&action=index");
            }
    
        }
        
    }  
?>