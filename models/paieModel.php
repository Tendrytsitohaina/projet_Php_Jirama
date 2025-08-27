<?php
    class PaieModel{
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        public function getAllPaie(){
            $stmt = $this->db->query('SELECT * from payer');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getMontantTotal($codeCli){
            $stmt = $this->db->prepare("SELECT (c.pu *  r.valeur2) as montant from compteur c join releve_eau r on c.codeCompteur = r.codeCompteur where c.codeCli = ? and c.type='eau' order by codeEau DESC");
            $stmt->execute(array($codeCli));
            $res1 = $stmt->fetch();

            $stmt = $this->db->prepare("SELECT (c.pu *  r.valeur1) as montant from compteur c join releve_elec r on c.codeCompteur = r.codeCompteur where c.codeCli = ? and c.type='elec' order by codeElec DESC");
            $stmt->execute(array($codeCli));
            $res2 = $stmt->fetch();

            if($res1 && $res2){
                $res3 = $res1['montant'] + $res2['montant'];
                return $res3;
            }elseif ($res1) {
                return $res1['montant'];
            }else {
                return $res2['montant'];
            }


        }

        public function addPaie($data){
            // $data['codePaie'] = $data['codeCli'] = $data['montant'] = $data['datePaie'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                // $data['codePaie'] = $this->checkInput($_POST['codePaie']);
                $code = $this->checkInput($_POST['codeCli']);
                $res = $this->checkInput($_POST['montant']);
                $data['datePaie'] = $this->checkInput($_POST['datePaie']);
                $isSuccess = true;

                if(empty($data['codeCli'])){
                    $isSuccess = false;
                    
                }

                if(empty($res)){
                    $errors["montantError"] = "Veuillez remplir le montant!";
                    $isSuccess = false;
                    
                }

                if(empty($data['datePaie'])){
                    $errors["dateError"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                    
                }

                if($isSuccess){
                   

                    $data['codePaie'] = $this->gen_codePaie();

                    // $registre = $this->registre->prepare("INSERT INTO registrePaie (codePaie) VALUES (?, ?, ?)");
                    // $registre->execute(array($data['codeCli']));

                    $statement = $this->db->prepare("INSERT INTO payer VALUES (?, ?, ?, ?) ");
                    $statement->execute(array($data['codePaie'], $data['datePaie'], $data['codeCli'], $res));

                    header("Location: deb.php?controller=Paie&action=index");
                    exit();

                }else{
                    require 'views/paie/create.php';
                    return;
                }
            }
        }

        public function viewUpdate($codePaie){
            try{
                $statement = $this->db->prepare("SELECT codePaie, montant, codeCli, datePaie from payer where codePaie = ?");
                $statement->execute(array($codePaie));
                $item = $statement->fetch(PDO::FETCH_ASSOC);

                $data['codePaie'] = $data['montant'] = $data['codeCli'] = $data['datePaie'] = "";
                $errors = [];
                $data['montant'] =  $item['montant'];
                $data['codeCli'] =  $item['codeCli'];
                $data['datePaie'] = $item['datePaie'];
        
                 
            }catch(PFOException $e){
                    echo "Erreur SQL: " .$e->getMessage();
                    return false;
            }
            require 'views/Paie/update.php';   
        }

        public function updatePaie($codePaie, $data){
           
            $data['codePaie'] = $data['montant'] = $data['codeCli'] = $data['datePaie'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['montant'] = $this->checkInput($_POST['montant']);
                // $data['codeCli'] = $this->checkInput($_POST['codeCli']);
                $data['datePaie'] = $this->checkInput($_POST['datePaie']);
                $isSuccess = true;

                if(empty($data['montant'])){
                    $errors["montantError"] = "Veuillez remplir le montant!";
                    $isSuccess = false;
                }
                if(empty($data['datePaie'])){
                    $errors["dateError"] = "Veuillez remplir le date!";
                    $isSuccess = false;
                }

                $data['codePaie'] = $codePaie;
               

                if($isSuccess){

                    $statement = $this->db->prepare("UPDATE payer SET datePaie = ?, montant =? WHERE codePaie = ?");
                    $statement->execute(array( $data['datePaie'], $data['montant'], $codePaie ));

                    header("Location: deb.php?controller=Paie&action=index");
                    exit();

                }else{
                    require 'views/Paie/create.php';
                    return;
                }
            }
        }

        public function deletePaie($codePaie){
            $statement = $this->db->prepare("DELETE FROM payer where codePaie = ?");
            $statement->execute(array($codePaie));
            return $statement;
        }

        public function gen_codePaie(){
            $statement = $this->db->query("SELECT codePaie from payer ORDER BY codePaie DESC LIMIT 1");
            $item = $statement->fetchColumn();
            if(!$item){
                return '0001';
            }

            preg_match('/(\d+)/', $item, $match);
            $item = (int)$match[0];
            $newNumber = str_pad($item + 1, 4, '0', STR_PAD_LEFT);

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