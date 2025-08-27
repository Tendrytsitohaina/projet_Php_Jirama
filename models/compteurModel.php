<?php

    require 'config/connexion.php';
    require_once 'config/registreCode.php';

    class CompteurModel {
        private $db;
        private $registre;

        public function __construct(){
            $this->db = Database::connect();
            $this->registre = Registre::connect();
        }
            
        public function getAllCompteur(){
            $statement = $this->db->query("SELECT c.codeCompteur, cli.nom, cli.prenom, c.pu, c.type from compteur c join clients cli on c.codeCli = cli.codeCli ORDER BY c.codeCompteur ASC");
            $item = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }

        public function getIDCompteur($codeCli){
            $statement = $this->db->prepare("select * from Compteurs where codeCli = ? ");
            $statement->execute(array($codeCli));
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function addCompteur(){

            $data['codeComp'] = $data['pu'] = $data['type'] = $data['codeCli'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['pu'] = $this->checkInput($_POST['pu']);
                $data['type'] = $this->checkInput($_POST['type']);
                $data['codeCli'] = $this->checkInput($_POST['codeCli']);
                $isSuccess = true;
                
                if(empty($data['pu'])){
                    $errors["puError"] = "Veuillez entrez le prix!";
                    $isSuccess = false;
                }
                if(empty($data['type'])){
                    $isSuccess = false;
                }
                if(empty($data['codeCli'])){
                    $isSuccess = false;
                }   

                $stmt = $this->db->prepare("SELECT codeCompteur from compteur where codeCli = ? and type = ?");
                $stmt->execute(array($data['codeCli'], $data['type']));
                $res = $stmt->fetch();

                if($res){
                    $errors['codeCli'] = 'Ce client a déjà un compteur de type '.$data['type'].' sur son quartier';
                    $isSuccess = false;
                }
                
                if($isSuccess){

                    if($data['type'] == 'eau'){
                        $data['codeComp'] = $this->gen_codeCompEau($data['type']);
                    }else{
                        $data['codeComp'] = $this->gen_codeCompElec($data['type']);
                    }

                    $registre = $this->registre->prepare("INSERT INTO registre ( codeComp, type) VALUES (?, ?)");
                    $registre->execute(array($data['codeComp'], $data['type']));

                    $statement = $this->db->prepare("INSERT INTO compteur ( codeCompteur, pu, type, codeCli) VALUES (?, ?, ?, ?) ");
                    $statement->execute(array($data['codeComp'], $data['pu'], $data['type'], $data['codeCli']));
                    header("Location: deb.php?controller=Compteur&action=index");
                    exit();
                }else{
                    require 'views/Compteurs/create.php';
                    return;
                }
            }
        }

        public function gen_codeCompEau($type){
            $statement = $this->registre->prepare("SELECT codeComp from registre  WHERE type = ? ORDER BY codeComp DESC LIMIT 1");
            $item = $statement->execute(array($type));
            $item = $statement->fetchColumn();
            if(!$item){
                return 'E00000001';
            }

            preg_match('/(\d+)/', $item, $matches);
            $itemN = (int) $matches[0];
            $newNumber = str_pad($itemN + 1, 8, '0', STR_PAD_LEFT);

            return 'E'.$newNumber;
        }
        public function gen_codeCompElec($type){
            $statement = $this->registre->prepare("SELECT codeComp from registre WHERE type= ? ORDER BY codeComp DESC LIMIT 1");
            $item = $statement->execute(array($type));
            $item = $statement->fetchColumn();
            if(!$item){
                return 'C00000001';
            }

            preg_match('/(\d+)/', $item, $match);
            $item = (int)$match[0];
            $newNumber = str_pad($item + 1, 8, '0', STR_PAD_LEFT);

            return 'C'.$newNumber ;
        }
    
        public function checkInput($data){
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            return $data;
        }

        public function isMail($var){
            return filter_var($var, FILTER_VALIDATE_EMAIL);
        }


        public function viewUpdate($codeComp){
           try{
                $statement = $this->db->prepare("SELECT codeCompteur, pu, type, codeCli from Compteur where codeCompteur = ?");
                $statement->execute(array($codeComp));
                $item = $statement->fetch(PDO::FETCH_ASSOC);

                $data['codeComp'] = $data['pu'] = $data['type'] = $data['codeCli'] = "";
                $errors = [];

                $data['codeComp'] = $item['codeCompteur']; 
                $data['pu'] = $item['pu'];
                $data['type'] = $item['type'];
                $data['codeClient'] = $item['codeCli'];
                
            }catch(PFOException $e){
                    echo "Erreur SQL: " .$e->getMessage();
                    return false;
            }
            require 'views/Compteurs/update.php';   
        }

        public function updateCompteur($codeComp, $data){

            $data['codeComp'] = $data['pu'] = $data['type'] = $data['codeCli'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                
                $data['pu'] = $this->checkInput($_POST['pu']);
                $data['type'] = $this->checkInput($_POST['type']);
                $data['codeCli'] = $this->checkInput($_POST['codeCli']);
               
                $isSuccess = true;

                if(empty($data['pu'])){
                    $errors["puError"] = "Veuillez entrez le nouveau prix!";
                    $isSuccess = false;
                }

                $statement = $this->db->prepare('select type from compteur where codeCompteur = ?');
                $statement->execute(array($codeComp));
                $type = $statement->fetch(PDO::FETCH_ASSOC);

                if($isSuccess){

                    if($type['type'] == $data['type']){
                        $statement = $this->db->prepare("UPDATE compteur SET pu = ?, type = ?, codeCli = ? where codeCompteur = ?");
                        $statement->execute(array( $data['pu'], $data['type'], $data['codeCli'], $codeComp));
                        header("Location: deb.php?controller=Compteur&action=index");
                        exit();
                    }else {

                        if($data['type'] == 'eau'){
                            $data['codeComp'] = $this->gen_codeCompEau($data['type']);
                        }else{
                            $data['codeComp'] = $this->gen_codeCompElec($data['type']);
                        }
                        
                        $statement = $this->db->prepare("UPDATE compteur SET codeCompteur = ?, pu = ?, type = ?, codeCli = ? where codeCompteur = ?");
                        $statement->execute(array($data['codeComp'], $data['pu'], $data['type'], $data['codeCli'], $codeComp));
                        header("Location: deb.php?controller=Compteur&action=index");
                        exit();
                    }

                }else{
                    require 'views/Compteurs/update.php';
                    return;
                }
            }   
        }

        public function viewDelete($codeComp){
            try{
                 $statement = $this->db->prepare("SELECT c.nom, c.prenom, com.codeCompteur from compteur com join clients c on com.codeCli=c.codeCli where codeCompteur = ?");
                 $statement->execute([$codeComp]);
                 $item = $statement->fetch(PDO::FETCH_ASSOC);
                 $data = [];
                 $data['codeComp'] = $data['nom'] = $data['prenom'] = "";

                 $data['codeComp'] = $item['codeCompteur'];
                 $data['nom'] = $item['nom']; 
                 $data['prenom'] = $item['prenom'];
             }catch(PFOException $e){
                     echo "Erreur SQL: " .$e->getMessage();
                     return false;
             }
             require 'views/Compteurs/delete.php';
 
 
         }

        public function deleteCompteur($codeComp){
            $statement = $this->db->prepare("DELETE FROM compteur where codeCompteur = ?");
            $statement->execute(array($codeComp));
            return $statement;
        }
    }
?>