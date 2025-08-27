<?php
require 'models/compteurModel.php';

// Controller pour l' affichage des liste ++++++++++++++++++++++++++++++++++++++++++++ ??
class CompteurController {
    private $compteurModel;

    public function __construct(){
        $this->compteurModel = new CompteurModel();
    }

    public function index(){
        $itemCompteur = $this->compteurModel->getAllCompteur();
        require 'views/compteurs/index.php';
    }

    public function show($codeComp){
        $client = $this->compteurModel->getIDCompteur();
        require 'views/compteurs/show.php';
    }

    public function create(){
        require 'views/compteurs/create.php';
    }

    public function store($data){
        $data = $this->compteurModel->addCompteur();
        if($data){
            header("Location: deb.php?controller=Compteur&action=index");
        }
    }

    public function createUpdate($codeComp){
        $client = $this->compteurModel->viewUpdate($codeComp);
    }

    public function update($codeComp, $data){
        $data = $this->compteurModel->updateCompteur($codeComp, $data);
        if($data){
            header("Location: deb.php?controller=Compteur&action=index");
        }
    }

    public function createDelete($codeComp){
        $client = $this->compteurModel->viewDelete($codeComp);
    }

    public function delete($codeComp){
        $data = $this->compteurModel->deleteCompteur($codeComp);
        if($data){
            header("Location: deb.php?controller=Compteur&action=index");
        }

    }

}

?>