<?php
    class ElecModel{
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        public function getAllElec(){
            $stmt = $this->db->query('SELECT * from releve_Elec');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addElec(){
            $data['codeElec'] = $data['dateReleve1'] = $data['valeur1'] = $data['date_presentation'] = $data['date_limite'] = $data['codeCompteur'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['dateReleve1'] = $this->checkInput($_POST['dateReleve1']);
                $data['valeur1'] = $this->checkInput($_POST['valeur1']);
                $data['date_presentation'] = $this->checkInput($_POST['date_presentation']);
                $data['date_limite'] = $this->checkInput($_POST['date_limite']);
                $data['codeCompteur'] = $this->checkInput($_POST['codeCompteur']);
                $isSuccess = true;

                if($data['dateReleve1'] >= $data['date_presentation']){
                    $errors["dateError1"] = "La date du rélévé ne doit pas supérieur au date de presentation ";
                    $isSuccess = false;
                }
                if(empty($data['dateReleve1'])){
                    $errors["dateError1"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['valeur1'])){
                    $errors['valeurError'] = "Veuillez entrez le valeur de l'index!";
                    $isSuccess = false;
                }
                if(empty($data['date_presentation'])){
                    $errors["dateError2"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['date_limite'])){
                    $errors["dateError3"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }

                if($data['date_presentation'] >= $data['date_limite']){
                    $errors["dateError3"] = "La date limite ne doit pas inferieur au date de presentation ";
                    $isSuccess = false;
                }

                $test = $this->db->prepare("SELECT month(date_presentation) AS mois from releve_Elec where codeCompteur = ? order by codeElec DESC limit 1");
                $test->execute(array($data['codeCompteur']));
                $result = $test->fetch(PDO::FETCH_ASSOC);
                $moisActuel = date('n');
                $moisPresentation = date('n', strtotime($data['date_presentation']));

                $moisNoms = [
                    1=> 'janvier', 2=> 'février',3=> 'mars',4=> 'avril',5=> 'mai',6=> 'juin',
                    7=> 'juillet', 8=> 'aout',9=> 'septembre',10=> 'octobre',11=> 'novembre', 12=> 'décembre'
                ];
                $nomMois = $moisNoms[$moisActuel];
                if ($moisActuel != $moisPresentation) {
                    $errors["dateError2"] = "On remplit le rélévé mois de ".$nomMois;
                    $isSuccess = false;
                }

                // var_dump($result && isset($result['mois']) && $result['mois']  == $moisPresentation );
                // var_dump($result, $moisPresentation);
                // die();
                if($result && isset($result['mois']) && $result['mois'] == $moisPresentation ){
                    $errors["dateError2"] = "Ce compteur a été déjà ajouter pour ce mois.";
                    $isSuccess = false;
                }

                if($isSuccess){


                    $data['codeElec'] = $this->gen_codeElec();

                    // $registre = $this->registre->prepare("INSERT INTO registreElec (codeElec) VALUES (?, ?, ?)");
                    // $registre->execute(array($data['codeCli']));

                    $statement = $this->db->prepare("INSERT INTO releve_Elec ( codeElec, dateReleve1, valeur1, date_presentation, date_limite, codeCompteur) VALUES (?, ?, ?, ?, ?, ?) ");
                    $statement->execute(array($data['codeElec'], $data['dateReleve1'], $data['valeur1'], $data['date_presentation'], $data['date_limite'], $data['codeCompteur']));

                    header("Location: deb.php?controller=Elec&action=index");
                    exit();

                }else{
                    require 'views/releveElec/create.php';
                    return;
                }
            }
        }

        public function viewUpdate($codeElec){
            try{
                $statement = $this->db->prepare("SELECT dateReleve1, valeur1, date_presentation, date_limite, codeCompteur from releve_Elec where codeElec = ?");
                $statement->execute(array($codeElec));
                $item = $statement->fetch(PDO::FETCH_ASSOC);

                $data['codeElec'] = $data['dateReleve1'] = $data['valeur1'] = $data['date_presentation'] = $data['date_limite'] = $data['codeCompteur'] = "";
                $errors = [];
                $data['dateReleve1'] =  $item['dateReleve1'];
                $data['valeur1'] =      $item['valeur1'];
                $data['date_presentation'] =   $item['date_presentation'];
                $data['date_limite'] = $item['date_limite'];
                $data['codeCompteur'] = $item['codeCompteur'];
        
                 
            }catch(PFOException $e){
                    echo "Erreur SQL: " .$e->getMessage();
                    return false;
            }
            require 'views/releveElec/update.php';   
        }

        public function updateElec($codeElec, $data){
            $data['codeElec'] = $data['dateReleve1'] = $data['valeur1'] = $data['date_presentation'] = $data['date_limite'] = $data['codeCompteur'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['dateReleve1'] = $this->checkInput($_POST['dateReleve1']);
                $data['valeur1'] = $this->checkInput($_POST['valeur1']);
                $data['date_presentation'] = $this->checkInput($_POST['date_presentation']);
                $data['date_limite'] = $this->checkInput($_POST['date_limite']);
                $data['codeCompteur'] = $this->checkInput($_POST['codeCompteur']);
                $isSuccess = true;

                if($data['dateReleve1'] >= $data['date_presentation']){
                    $errors["dateError1"] = "La date du rélévé ne doit pas supérieur au date de presentation ";
                    $isSuccess = false;
                }
                if(empty($data['dateReleve1'])){
                    $errors["dateError1"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['valeur1'])){
                    $errors['valeurError'] = "Veuillez entrez le valeur de l'index!";
                    $isSuccess = false;
                }
                if(empty($data['date_presentation'])){
                    $errors["dateError2"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }
                if(empty($data['date_limite'])){
                    $errors["dateError3"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }

                if($data['date_presentation'] >= $data['date_limite']){
                    $errors["dateError3"] = "La date limite ne doit pas inferieur au date de presentation ";
                    $isSuccess = false;
                }

                $test = $this->db->prepare("SELECT month(date_presentation) AS mois from releve_Elec where codeCompteur = ?");
                $test->execute(array($data['codeCompteur']));
                $result = $test->fetch(PDO::FETCH_ASSOC);
                $moisActuel = date('n');
                $moisPresentation = date('n', strtotime($data['date_presentation']));

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

                    $statement = $this->db->prepare("UPDATE releve_Elec SET dateReleve1 = ?, valeur1 =? , date_presentation = ?, date_limite = ? , codeCompteur= ? WHERE codeElec = ?");
                    $statement->execute(array( $data['dateReleve1'], $data['valeur1'], $data['date_presentation'], $data['date_limite'], $data['codeCompteur'], $codeElec ));

                    header("Location: deb.php?controller=Elec&action=index");
                    exit();

                }else{
                    require 'views/releveElec/update.php';
                    return;
                }
            }
        }

        public function deleteElec($codeElec){
            $statement = $this->db->prepare("DELETE FROM releve_Elec where codeElec = ?");
            $statement->execute(array($codeElec));
            return $statement;
        }

        public function gen_codeElec(){
            $statement = $this->db->query("SELECT codeElec from releve_Elec ORDER BY codeElec DESC LIMIT 1");
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