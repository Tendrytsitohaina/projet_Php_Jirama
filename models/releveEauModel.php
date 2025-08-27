<?php
    class EauModel{
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        public function getAllEau(){
            $stmt = $this->db->query('SELECT * from releve_eau');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addEau(){
            $data['codeEau'] = $data['dateReleve2'] = $data['valeur2'] = $data['date_presentation2'] = $data['date_limite2'] = $data['codeCompteur'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['dateReleve2'] = $this->checkInput($_POST['dateReleve2']);
                $data['valeur2'] = $this->checkInput($_POST['valeur2']);
                $data['date_presentation2'] = $this->checkInput($_POST['date_presentation2']);
                $data['date_limite2'] = $this->checkInput($_POST['date_limite2']);
                $data['codeCompteur'] = $this->checkInput($_POST['codeCompteur']);
                $isSuccess = true;

                if($data['dateReleve2'] >= $data['date_presentation2']){
                    $errors["dateError1"] = "La date du rélévé ne doit pas supérieur au date de presentation ";
                    $isSuccess = false;
                }
                if(empty($data['dateReleve2'])){
                    $errors["dateError1"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['valeur2'])){
                    $errors['valeurError'] = "Veuillez entrez le valeur de l'index!";
                    $isSuccess = false;
                }
                if(empty($data['date_presentation2'])){
                    $errors["dateError2"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['date_limite2'])){
                    $errors["dateError3"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }

                if($data['date_presentation2'] >= $data['date_limite2']){
                    $errors["dateError3"] = "La date limite ne doit pas inferieur au date de presentation ";
                    $isSuccess = false;
                }

                $test = $this->db->prepare("SELECT month(date_Presentation2) AS mois from releve_eau where codeCompteur = ? order by codeEau DESC limit 1");
                $test->execute(array($data['codeCompteur']));
                $result = $test->fetch(PDO::FETCH_ASSOC);

               
                $moisActuel = date('n');
                $moisPresentation = date('n', strtotime($data['date_presentation2']));
                
                $moisNoms = [
                    1=> 'janvier', 2=> 'février',3=> 'mars',4=> 'avril',5=> 'mai',6=> 'juin',
                    7=> 'juillet', 8=> 'aout',9=> 'septembre',10=> 'octobre',11=> 'novembre', 12=> 'décembre'
                ];
                $nomMois = $moisNoms[$moisActuel];
                if ($moisActuel != $moisPresentation) {
                    $errors["dateError2"] = "On remplit le rélévé mois de ".$nomMois;
                    $isSuccess = false;
                }
                

                if($result && isset($result['mois']) && $result['mois'] == $moisPresentation ){
                    $errors["dateError2"] = "Ce compteur a été déjà ajouter pour ce mois.";
                    $isSuccess = false;
                }

                if($isSuccess){


                    $data['codeEau'] = $this->gen_codeEau();

                    // $registre = $this->registre->prepare("INSERT INTO registreEau (codeEau) VALUES (?, ?, ?)");
                    // $registre->execute(array($data['codeCli']));

                    $statement = $this->db->prepare("INSERT INTO releve_eau ( codeEau, dateReleve2, valeur2, date_presentation2, date_limite2, codeCompteur) VALUES (?, ?, ?, ?, ?, ?) ");
                    $statement->execute(array($data['codeEau'], $data['dateReleve2'], $data['valeur2'], $data['date_presentation2'], $data['date_limite2'], $data['codeCompteur']));

                    header("Location: deb.php?controller=Eau&action=index");
                    exit();

                }else{
                    require 'views/releveEau/create.php';
                    return;
                }
            }
        }

        public function viewUpdate($codeEau){
            try{
                $statement = $this->db->prepare("SELECT dateReleve2, valeur2, date_presentation2, date_limite2, codeCompteur from releve_eau where codeEau = ?");
                $statement->execute(array($codeEau));
                $item = $statement->fetch(PDO::FETCH_ASSOC);

                $data['codeEau'] = $data['dateReleve2'] = $data['valeur2'] = $data['date_presentation2'] = $data['date_limite2'] = $data['codeCompteur'] = "";
                $errors = [];
                $data['dateReleve2'] =  $item['dateReleve2'];
                $data['valeur2'] =      $item['valeur2'];
                $data['date_presentation2'] =   $item['date_presentation2'];
                $data['date_limite2'] = $item['date_limite2'];
                $data['codeCompteur'] = $item['codeCompteur'];
        
                 
            }catch(PFOException $e){
                    echo "Erreur SQL: " .$e->getMessage();
                    return false;
            }
            require 'views/releveEau/update.php';   
        }

        public function updateEau($codeEau, $data){
            $data['codeEau'] = $data['dateReleve2'] = $data['valeur2'] = $data['date_presentation2'] = $data['date_limite2'] = $data['codeCompteur'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['dateReleve2'] = $this->checkInput($_POST['dateReleve2']);
                $data['valeur2'] = $this->checkInput($_POST['valeur2']);
                $data['date_presentation2'] = $this->checkInput($_POST['date_presentation2']);
                $data['date_limite2'] = $this->checkInput($_POST['date_limite2']);
                $data['codeCompteur'] = $this->checkInput($_POST['codeCompteur']);
                $isSuccess = true;

                if($data['dateReleve2'] >= $data['date_presentation2']){
                    $errors["dateError1"] = "La date du rélévé ne doit pas supérieur au date de presentation ";
                    $isSuccess = false;
                }
                if(empty($data['dateReleve2'])){
                    $errors["dateError1"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['valeur2'])){
                    $errors['valeurError'] = "Veuillez entrez le valeur de l'index!";
                    $isSuccess = false;
                }
                if(empty($data['date_presentation2'])){
                    $errors["dateError2"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['date_limite2'])){
                    $errors["dateError3"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }

                if($data['date_presentation2'] >= $data['date_limite2']){
                    $errors["dateError3"] = "La date limite ne doit pas inferieur au date de presentation ";
                    $isSuccess = false;
                }

                $test = $this->db->prepare("SELECT month(date_Presentation2) AS mois from releve_eau where codeCompteur = ?");
                $test->execute(array($data['codeCompteur']));
                $result = $test->fetch(PDO::FETCH_ASSOC);

                $moisActuel = date('n');
                $moisPresentation = date('n', strtotime($data['date_presentation2']));

                $moisNoms = [
                    1=> 'janvier', 2=> 'février',3=> 'mars',4=> 'avril',5=> 'mai',6=> 'juin',
                    7=> 'juillet', 8=> 'aout',9=> 'septembre',10=> 'octobre',11=> 'novembre', 12=> 'décembre'
                ];
                $nomMois = $moisNoms[$moisActuel];
                if ($moisActuel != $moisPresentation) {
                    $errors["dateError2"] = "On remplit le rélévé mois de ".$nomMois;
                    $isSuccess = false;
                }
               

                if($isSuccess){

                    $statement = $this->db->prepare("UPDATE releve_eau SET dateReleve2 = ?, valeur2 =? , date_presentation2 = ?, date_limite2 = ? , codeCompteur= ? WHERE codeEau = ?");
                    $statement->execute(array( $data['dateReleve2'], $data['valeur2'], $data['date_presentation2'], $data['date_limite2'], $data['codeCompteur'], $codeEau ));

                    header("Location: deb.php?controller=Eau&action=index");
                    exit();

                }else{
                    require 'views/releveEau/update.php';
                    return;
                }
            }
        }

        public function deleteEau($codeEau){
            $statement = $this->db->prepare("DELETE FROM releve_eau where codeEau = ?");
            $statement->execute(array($codeEau));
            return $statement;
        }

        public function gen_codeEau(){
            $statement = $this->db->query("SELECT codeEau from releve_eau ORDER BY codeEau DESC LIMIT 1");
            $item = $statement->fetchColumn();
            if(!$item){
                return '00000001';
            }

            preg_match('/(\d+)/', $item, $match);
            $item = (int)$match[0];
            $newNumber = str_pad($item + 1, 8, '0', STR_PAD_LEFT);

            return $newNumber;
        }

        public function checkInput($data){
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);

            return $data;
        }
    }
?>