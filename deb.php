<?php
session_start();

require 'controller/clientController.php';
require 'controller/compteurController.php';
require 'controller/releveEauController.php';
require 'controller/releveElecController.php';
require 'controller/searchController.php';
require 'controller/paieController.php';

require 'controller/factureController.php';

$controller = isset($_GET['controller'])? $_GET['controller'] : 'home';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$codeCli = isset($_GET['codeCli']) ? $_GET['codeCli'] : 'codeCli';

$codeComp = isset($_GET['codeComp']) ? $_GET['codeComp'] : 'codeComp';

$codeEau = isset($_GET['codeEau']) ? $_GET['codeEau'] : 'codeEau';

$codeElec = isset($_GET['codeElec']) ? $_GET['codeElec'] : 'codeElec';

$codePaie = isset($_GET['codePaie']) ? $_GET['codePaie'] : 'codePaie';



if($controller == 'customer'){
    $customerController = new customerController();
    

    if(method_exists($customerController, $action)){

        if($action == "createUpdate"){
            $customerController->$action($codeCli);

        }elseif($action == "createFacture"){

            $customerController->$action($codeCli);

        }elseif($action == "viewGenFact"){
            $customerController->$action($codeCli, $_POST);
        }
        elseif($action == "update"){
            $customerController->$action($codeCli , $_POST);
        }
        elseif($action == "createDelete"){  
            $customerController->$action($codeCli);
        }
        elseif($action == 'delete'){
            $customerController->$action($codeCli);
        }
        elseif($_SERVER["REQUEST_METHOD"]=="POST"){
            $customerController->$action($_POST);
        }
        elseif ($action == 'afficheRetard') {
            $customerController->$action($codeCli, $_POST);
        }
        elseif ($action == 'mailWarning') {
            $customerController->$action($codeCli);
        }
        else{
            $customerController->$action();
        }
    }
    else{
        echo 'action introuvable';
    }
}
elseif ($controller == 'Compteur') {                             // Activation controller pour le compteur +++++++++++++++++++++++++++++++++++++++++++
    $compteurController = new CompteurController();
    if(method_exists($compteurController, $action)){

        if($action == "createUpdate"){
            $compteurController->$action($codeComp);
        }
        elseif($action == "update"){
            $compteurController->$action($codeComp , $_POST);
        }
        elseif($action == "createDelete"){  
            $compteurController->$action($codeComp);
        }
        elseif($action == 'delete'){
            $compteurController->$action($codeComp);
        }
        elseif($_SERVER["REQUEST_METHOD"]=="POST"){
            $compteurController->$action($_POST);
        }
        else{
            $compteurController->$action();
        }
    }else{
        echo 'action introuvable';
    }
}
elseif ($controller == 'Eau') {                             // Activation controller pour le compteur +++++++++++++++++++++++++++++++++++++++++++
    $EauController = new EauController();
    if(method_exists($EauController, $action)){

        if($action == "createUpdate"){
            $EauController->$action($codeEau);
        }
        elseif($action == "update"){
            $EauController->$action($codeEau , $_POST);
        }
        elseif($action == "createDelete"){  
            $EauController->$action($codeEau);
        }
        elseif($action == 'delete'){
            $EauController->$action($codeEau);
        }
        elseif($_SERVER["REQUEST_METHOD"]=="POST"){
            $EauController->$action($_POST);
        }
        else{
            $EauController->$action();
        }
    }else{
        echo 'action introuvable';
    }
}elseif ($controller == 'Elec') {                             // Activation controller pour le compteur +++++++++++++++++++++++++++++++++++++++++++
        $ElecController = new ElecController();
        if(method_exists($ElecController, $action)){
    
            if($action == "createUpdate"){
                $ElecController->$action($codeElec);
            }
            elseif($action == "update"){
                $ElecController->$action($codeElec , $_POST);
            }
            elseif($action == "createDelete"){  
                $ElecController->$action($codeElec);
            }
            elseif($action == 'delete'){
                $ElecController->$action($codeElec);
            }
            elseif($_SERVER["REQUEST_METHOD"]=="POST"){
                $ElecController->$action($_POST);
            }
            else{
                $ElecController->$action();
            }
        }else{
            echo 'action introuvable';
        }
}elseif ($controller == 'Paie') {                             // Activation controller pour le compteur +++++++++++++++++++++++++++++++++++++++++++
    $PaieController = new PaieController();
    if(method_exists($PaieController, $action)){

        if($action == "createUpdate"){
            $PaieController->$action($codePaie);
        }
        elseif($action == "update"){
            $PaieController->$action($codePaie , $_POST);
        }
        elseif($action == "createDelete"){  
            $PaieController->$action($codePaie);
        }
        elseif($action == 'delete'){
            $PaieController->$action($codePaie);
        }
        elseif($_SERVER["REQUEST_METHOD"]=="POST"){
            $PaieController->$action($_POST);
        }
        else{
            $PaieController->$action();
        }
    }else{
        echo 'action introuvable';
    }
}
elseif($controller == 'search'){
    $searchController = new searchController();
    if(method_exists($searchController, $action)) {
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $searchController->$action($_POST);
        }
    }else{
        echo 'action introuvable';
    }
}
elseif ($controller == 'Facture') {
    $factureController = new factureController();
    if(method_exists($factureController, $action)) {
        if ($action == "historique") {
            $factureController->$action($_POST);
        }elseif ($action == "viewThreeFactHistorique") {
            $factureController->$action($_POST);
        }
        elseif($_SERVER["REQUEST_METHOD"] == "POST"){
            $factureController->$action($_POST);
        }
    }else{
        echo 'action introuvable';
    }
}
else{
    echo 'controller introuvable';
}

?>