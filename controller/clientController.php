<?php
require 'models/clientModel.php';

// Controller pour l' affichage des liste ++++++++++++++++++++++++++++++++++++++++++++ ??
class CustomerController {
    private $clientModel;

    public function __construct(){
        $this->clientModel = new clientModel();
    }

    public function index(){
        $item = $this->clientModel->getAllCustomer();
        require 'views/clients/index.php';
    }

    public function indexCli(){
        $item = $this->clientModel->getAllCustomer2();
        require 'views/clients/index.php';
    }

    public function index2(){
        require 'views/clients/dash.html';
    }

    public function retard(){
        require 'views/clients/retard.php';
    }

    public function afficheRetard($data){
        $item = $this->clientModel->getRetard($data);
        // $res = $this->clientModel->getRetardAvertir($data);
        require 'views/clients/viewRetard.php';
    }

    public function mailWarning($data){
        $item = $this->clientModel->getUserMail($data);
        require 'views/mail/mail.php';
    }
    

    public function historique(){
        require 'views/clients/historique.php';
    }

    public function create(){
        require 'views/clients/create.php';
    }

    public function store($data){
        $data = $this->clientModel->addCustomer();
        if($data){
            header("Location: deb.php?controller=customer&action=index");
        }
    }

    public function createFacture($codeCli){
        $data = $this->clientModel->getClientCompteur($codeCli);
        $data2 = $this->clientModel->getNomClientCompteur($codeCli);
        require 'views/facture/viewClientCompteur.php';
    }

    public function viewGenFact($codeCli, $data){

        $mois = $data["mois"];
        // var_dump($mois);
        // die();
        $eau = $this->clientModel->getInfoFactureEau($codeCli, $data);
        $elec = $this->clientModel->getInfoFactureElec($codeCli, $data); 
        $client = $this->clientModel->getClientFact($codeCli);
        $compEau = $this->clientModel->getClientCompteurEau($codeCli);
        $compElec = $this->clientModel->getClientCompteurElec($codeCli);
        $montantEau = $this->clientModel->getMontantFactEau($codeCli);
        $montantElec = $this->clientModel->getMontantFactElec($codeCli);


        $moisNoms = [
            '01'=> 'Janvier', '02'=> 'Février','03'=> 'Mars', '04'=> 'Avril', '05'=> 'Mai', '06'=> 'Juin',
            '07'=> 'Juillet', '08'=> 'Aout', '09'=> 'Septembre','10'=> 'Octobre','11'=> 'Novembre', '12'=> 'Décembre'
        ];
        $nomMois = $moisNoms[$mois];

        if( $client ){
            
                require 'views/facture/modelFacture.php';

        }else {
            require 'views/facture/errorRes.php';
        }
    }

    public function createUpdate($codeCli){
        $client = $this->clientModel->viewUpdate($codeCli);
    }

    public function update($codeCli, $data){
        $data = $this->clientModel->updateCustomer($codeCli, $data);
        if($data){
            header("Location: deb.php?controller=customer&action=index");
        }
    }

    public function createDelete($codeCli){
        $client = $this->clientModel->viewDelete($codeCli);
    }

    public function delete($codeCli){
        $data = $this->clientModel->deleteCustomer($codeCli);
        if($data){
            header("Location: deb.php?controller=customer&action=index");
        }

    }

}

?>