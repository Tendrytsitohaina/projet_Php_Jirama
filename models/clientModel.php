<?php

    // require 'config/connexion.php';
    require 'config/registreCode.php';

    class ClientModel {
        private $db;

        public function __construct(){
            $this->db = Database::connect();
            $this->registre = Registre::connect();
        }

        public function getAllCustomer(){
            $statement = $this->db->query("select * from clients");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllCustomer2(){
            $statement = $this->db->query("select * from clients order by quartier ASC");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUserMail($data){
            $statement = $this->db->query("select * from clients where codeCli = $data");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getRetard($data){

            $mois = (int)$data['mois'];
            $annee = (int)$data['an'];

            $dateActuel = date('Y-m-d');

            $start_date = $annee . '-' . $mois . '-01';
            $end_date = date("Y-m-t", strtotime($start_date));


            $stmt = $this->db->query("SELECT codeCompteur from compteur where type='eau'");
            $existEau = $stmt->fetch();

            $stmt1 = $this->db->query("SELECT codeCompteur from compteur where type='elec'");
            $existElec = $stmt1->fetch();

            if($existEau && $existElec){
                $statement = $this->db->query("SELECT c.codeCli, c.nom, c.quartier, c.mail, rE.date_limite2 as warning from clients c join compteur co 
                                                    on co.codeCli = c.codeCli left join releve_eau rE on co.codeCompteur = rE.codeCompteur 
                                                    left join payer p on c.codeCli=p.codeCli and (MONTH(p.datePaie) = '$mois' and YEAR(p.datePaie) = '$annee')
                                                    where MONTH(rE.date_limite2) = '$mois' and (codePaie IS NULL)");
                // $statement->execute(array($mois, $annee, $mois));
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);

            }
            if(!$existElec){
                $statement = $this->db->query("SELECT c.codeCli, c.nom, c.quartier, c.mail, rE.date_limite2 as warning from clients c join compteur co 
                                                    on co.codeCli = c.codeCli left join releve_eau rE on co.codeCompteur = rE.codeCompteur 
                                                    left join payer p on c.codeCli=p.codeCli and (MONTH(p.datePaie) = '$mois' and YEAR(p.datePaie) = '$annee')
                                                    where MONTH(rE.date_limite2) = '$mois' and (codePaie IS NULL)");
                // $statement->execute(array($mois, $annee, $mois));
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);

            }else{
                $statement = $this->db->query("SELECT c.codeCli, c.nom, c.quartier, c.mail , rC.date_limite as warning from clients c join compteur co 
                                                    on co.codeCli = c.codeCli left join releve_elec rC on co.codeCompteur = rC.codeCompteur 
                                                    left join payer p on c.codeCli=p.codeCli and (MONTH(p.datePaie) = '$mois' and YEAR(p.datePaie) = '$annee')
                                                    where MONTH(rC.date_limite) = '$mois' and (codePaie IS NULL)");
                // $statement->execute(array($mois, $annee, $mois));
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);

            }

            return $res + $res + $res;

            
        }

        public function getRetardAvertir($data){

            $mois = (int)$data['mois'];
            $annee = (int)$data['an'];

            $dateActuel = date('Y-m-d');

            $start_date = $annee . '-' . $mois . '-01';
            $end_date = date("Y-m-t", strtotime($start_date));


            $stmt = $this->db->query("SELECT codeCompteur from compteur where type='eau'");
            $existEau = $stmt->fetch();

            $stmt1 = $this->db->query("SELECT codeCompteur from compteur where type='elec'");
            $existElec = $stmt1->fetch();

            if($existEau && $existElec){

                $statement1 = $this->db->query("SELECT c.codeCli, c.nom, c.quartier, c.mail from clients c join compteur co 
                                                    on co.codeCli = c.codeCli left join releve_eau rE on co.codeCompteur = rE.codeCompteur 
                                                    left join payer p on c.codeCli=p.codeCli and (MONTH(p.datePaie) = '$mois' and YEAR(p.datePaie) = '$annee')
                                                    where MONTH(rE.date_limite2) = '$mois' and (codePaie IS NULL) and rE.date_limite2 <= CURDATE()");
                // $statement->execute(array($mois, $annee, $mois));
                $res1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                // return $res; 
            }
            if(!$existElec){

                $statement1 = $this->db->query("SELECT c.codeCli, c.nom, c.quartier, c.mail from clients c join compteur co 
                                                    on co.codeCli = c.codeCli left join releve_eau rE on co.codeCompteur = rE.codeCompteur 
                                                    left join payer p on c.codeCli=p.codeCli and (MONTH(p.datePaie) = '$mois' and YEAR(p.datePaie) = '$annee')
                                                    where MONTH(rE.date_limite2) = '$mois' and (codePaie IS NULL) and rE.date_limite2 <= CURDATE()");
                // $statement->execute(array($mois, $annee, $mois));
                $res1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
            
                // return $res; 
            }else{

                $statement1 = $this->db->query("SELECT c.codeCli, c.nom, c.quartier, c.mail from clients c join compteur co 
                                                    on co.codeCli = c.codeCli left join releve_elec rC on co.codeCompteur = rC.codeCompteur 
                                                    left join payer p on c.codeCli=p.codeCli and (MONTH(p.datePaie) = '$mois' and YEAR(p.datePaie) = '$annee')
                                                    where MONTH(rC.date_limite) = '$mois' and (codePaie IS NULL) and rC.date_limite <= CURDATE()");
                // $statement->execute(array($mois, $annee, $mois));
                $res1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
            
                // return $res; 
            }

            return $res1 + $res1 + $res1;

            
        }

        public function getNomClientCompteur($codeCli){
            $stmt = $this->db->prepare("SELECT nom, prenom from clients where codeCli = ?");
            $stmt->execute(array($codeCli));
            $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result2;

        }
        public function getClientCompteur($codeCli){
            $statement = $this->db->prepare("SELECT * from compteur where codeCli = ?");
            $statement->execute(array($codeCli));
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            // require 'views/facture/viewClientCompteur.php';
            return $data; 
        }
        public function getClientCompteurEau($codeCli){
            $statement = $this->db->prepare("SELECT * from compteur where codeCli = ? and type='eau'");
            $statement->execute(array($codeCli));
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            // require 'views/facture/viewClientCompteur.php';
            return $data; 
        }
        public function getClientCompteurElec($codeCli){
            $statement = $this->db->prepare("SELECT * from compteur where codeCli = ? and type='elec'");
            $statement->execute(array($codeCli));
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            // require 'views/facture/viewClientCompteur.php';
            return $data; 
        }

        public function getMontantFactEau($codeCli){
            $statement = $this->db->prepare("SELECT (c.pu * r.valeur2) as montant from compteur c join releve_eau r on c.codeCompteur = r.codeCompteur where c.codeCli = ? order by codeEau DESC");
            $statement->execute(array($codeCli));
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            // require 'views/facture/viewClientCompteur.php';
            return $data; 
        }

        public function getMontantFactElec($codeCli){
            $statement = $this->db->prepare("SELECT (c.pu * r.valeur1) as montant from compteur c join releve_elec r on c.codeCompteur = r.codeCompteur where c.codeCli = ? order by codeElec DESC");
            $statement->execute(array($codeCli));
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return $data; 
    
        }

        public function getClientFact($codeCli){
            $stmt = $this->db->prepare("SELECT codeCli, nom, prenom, quartier from clients where codeCli = ?");
            $stmt->execute(array($codeCli));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data; 
        }

        public function getInfoFactureEau($codeCli, $data){

            $oldmois = $this->checkInput($data['mois']);

            preg_match('/(\d+)/', $oldmois, $match);
            $newmois = (int)$match[0];
            $mois = str_pad($newmois, 2, '0', STR_PAD_LEFT);
            
            
            $annee = $this->checkInput($data['an']);

            // var_dump($annee);
            // die();

            $eau = $this->db->prepare("SELECT codeCompteur, pu from compteur where codeCli = ? AND type='eau'");
            $eau->execute(array($codeCli));
            $Neweau = $eau->fetch(PDO::FETCH_ASSOC);

            $codeCompEau = $Neweau;

            $start_date = $annee . '-' . $mois . '-01';
            $end_date = date("Y-m-t", strtotime($start_date));

            // $start_date = date("Y-m-d", $start_date);
            
            // var_dump($start_date, $end_date);
            // die();
            if($codeCompEau){
                
                $statement2 = $this->db->prepare("SELECT * FROM releve_eau where codeCompteur = ? AND date_presentation2 BETWEEN ? AND ?");
                $statement2->execute(array($codeCompEau['codeCompteur'], $start_date, $end_date));
                
                $res = $statement2->fetch(PDO::FETCH_ASSOC);
                
                // var_dump($codeCompEau['codeCompteur']);
                // var_dump($res);
                // die();
                // $statement1->execute()
                return $res;
            }
        }
        public function getInfoFactureElec($codeCli, $data){

            $oldmois = $this->checkInput($data['mois']);

            preg_match('/(\d+)/', $oldmois, $match);
            $newmois = (int)$match[0];
            $mois = str_pad($newmois, 2, '0', STR_PAD_LEFT);
            
            
            $annee = $this->checkInput($data['an']);

            $elec = $this->db->prepare("SELECT codeCompteur,pu from compteur where codeCli = ? AND type='elec'");
            $elec->execute(array($codeCli));
            $Newelec = $elec->fetch(PDO::FETCH_ASSOC);

            $codeCompElec = $Newelec;

            $start_date = $annee . '-' . $mois . '-01';
            $end_date = date("Y-m-t", strtotime($start_date));

            // $start_date = date("Y-m-d", $start_date);
            
            
            $statement1 = $this->db->prepare("SELECT * FROM releve_elec where codeCompteur = ? AND date_presentation BETWEEN ? AND ?");
            $statement1->execute(array($codeCompElec['codeCompteur'], $start_date, $end_date));

        
            $res =  $statement1->fetch(PDO::FETCH_ASSOC);
            return $res;

        }

        public function addCustomer(){

            $data['nom'] = $data['prenom'] = $data['sexe'] = $data['quartier'] = $data['mail'] = $data['niveau'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['nom'] = $this->checkInput($_POST['nom']);
                $data['prenom'] = $this->checkInput($_POST['prenom']);
                $data['sexe'] = $this->checkInput($_POST['sexe']);
                $data['quartier'] = $this->checkInput($_POST['quartier']);
                $data['mail'] = $this->checkInput($_POST['mail']);
                $data['niveau'] = $this->checkInput($_POST['niveau']);
                $isSuccess = true;

                $data['mail'] = strtolower($data['mail']);

                if(empty($data['nom'])){
                    $errors["nameError"] = "Veuillez entrez le nom!";
                    $isSuccess = false;
                }
                if(empty($data['prenom'])){
                    $errors["firstnameError"] = "Veuillez entrez le prénom!";
                    $isSuccess = false;
                }
                if(empty($data['sexe'])){
                    $isSuccess = false;
                }
                if(empty($data['quartier'])){
                    $errors["quartierError"] = "Veuillez entrez le quartier!";
                    $isSuccess = false;
                }
                if(empty($data['mail'])){
                    $errors["mailError"] = "Veuillez entrez le mail!";
                    $isSuccess = false;
                }
                if(!$this->isMail($data['mail'])){
                    $errors["mailError"] = "Veuillez entrez une mail valide";
                    $isSuccess = false;
                }

                if($isSuccess){


                    $data['codeCli'] = $this->gen_codeCli();

                    $registre = $this->registre->prepare("INSERT INTO registreClient ( codeCli, nom, prenom) VALUES (?, ?, ?)");
                    $registre->execute(array($data['codeCli'], $data['nom'], $data['prenom']));

                    $statement = $this->db->prepare("INSERT INTO clients ( codeCli, nom, prenom, sexe, quartier, mail, niveau) VALUES (?, ?, ?, ?, ?, ?, ?) ");
                    $statement->execute(array($data['codeCli'], $data['nom'], $data['prenom'], $data['sexe'], $data['quartier'], $data['mail'], $data['niveau']));
                    header("Location: deb.php?controller=customer&action=index");
                    exit();
                }else{
                    require 'views/clients/create.php';
                    return;
                }
            }
        }
        public function gen_codeCli(){
            $statement = $this->registre->query("SELECT codeCli from registreClient ORDER BY codeCli DESC LIMIT 1");
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

        public function isMail($var){
            return filter_var($var, FILTER_VALIDATE_EMAIL);
        }


        public function viewUpdate($codeCli){
           try{
                $statement = $this->db->prepare("SELECT nom, prenom, sexe, quartier, mail, niveau from clients where codeCli = ?");
                $statement->execute([$codeCli]);
                $item = $statement->fetch(PDO::FETCH_ASSOC);
                $data = [];
                $data['nom'] = $data['prenom'] = $data['sexe'] = $data['quartier'] = $data['mail'] = $data['niveau'] = "";
                $data['nom'] = $item['nom'];
                $data['prenom'] = $item['prenom'];
                $data['sexe'] = $item['sexe'];
                $data['quartier'] = $item['quartier'];
                $data['mail'] = $item['mail'];
                $data['niveau'] = $item['niveau'];
            }catch(PFOException $e){
                    echo "Erreur SQL: " .$e->getMessage();
                    return false;
            }
            require 'views/clients/update.php';
        }

        public function updateCustomer($codeCli, $data){

            $data['nom'] = $data['prenom'] = $data['sexe'] = $data['quartier'] = $data['mail'] = $data['niveau'] = "";
            $errors = [];

            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                $data['nom'] = $this->checkInput($_POST['nom']);
                $data['prenom'] = $this->checkInput($_POST['prenom']);
                $data['sexe'] = $this->checkInput($_POST['sexe']);
                $data['quartier'] = $this->checkInput($_POST['quartier']);
                $data['mail'] = $this->checkInput($_POST['mail']);
                $data['niveau'] = $this->checkInput($_POST['niveau']);
                $isSuccess = true;

                if(empty($data['nom'])){
                    $errors["nameError"] = "Veuillez entrez le nom!";
                    $isSuccess = false;
                }
                if(empty($data['prenom'])){
                    $errors["firstnameError"] = "Veuillez entrez le prénom!";
                    $isSuccess = false;
                }
                if(empty($data['quartier'])){
                    $errors["quartierError"] = "Veuillez entrez le quartier!";
                    $isSuccess = false;
                }
                if(empty($data['mail'])){
                    $errors["mailError"] = "Veuillez entrez le mail!";
                    $isSuccess = false;
                }
                if(!$this->isMail($data['mail'])){
                    $errors["mailError"] = "Veuillez entrez une mail valide";
                    $isSuccess = false;
                }

                if($isSuccess){
                    $statement = $this->db->prepare("UPDATE clients SET nom = ? , prenom = ?, sexe = ?, quartier = ?, mail = ?, niveau = ? where codeCli = ?");
                    $statement->execute(array($data['nom'], $data['prenom'], $data['sexe'], $data['quartier'], $data['mail'], $data['niveau'], $codeCli));
                    header("Location: deb.php?controller=customer&action=index");
                    exit();
                }else{
                    require 'views/clients/update.php';
                    return;
                }
            }   
        }

        public function viewDelete($codeCli){
            try{
                 $statement = $this->db->prepare("SELECT nom, prenom from clients where codeCli = ?");
                 $statement->execute([$codeCli]);
                 $item = $statement->fetch(PDO::FETCH_ASSOC);
                 $data = [];
                 $data['nom'] = $data['prenom'] = "";
                 $data['nom'] = $item['nom']; 
                 $data['prenom'] = $item['prenom'];
             }catch(PFOException $e){
                     echo "Erreur SQL: " .$e->getMessage();
                     return false;
             }
             require 'views/clients/delete.php';
 
 
         }

        public function deleteCustomer($codeCli){
            $statement = $this->db->prepare("DELETE FROM clients where codeCli = ?");
            $statement->execute(array($codeCli));
            return $statement;
        }
    }
?>