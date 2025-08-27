<?php


require 'models/dashModel.php';

class dash{
    private $dashModel;

    public function __construct(){
        $this->dashModel = new dashModel();
    }

    public function show(){
        $client = $this->dashModel->clientDash();
        $compteur = $this->dashModel->compteurDash();
        $facture = $this->dashModel->factureDash();
        $retard = $this->dashModel->retardDash();



        $client['nb'] = $client['nb'];
        $compteur['nb'] = $compteur['nb'];
        $facture['nb'] = $facture['nb'];
        $retard['nb'] = $retard['nb'];

        require 'dash.php';

    }
}

?>