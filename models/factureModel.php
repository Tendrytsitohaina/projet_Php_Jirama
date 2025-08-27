<?php

    class factureModel{
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }
        
        public function historiqueFacture($data){
            $codeCli = $data['codeCli'];
            $stmt = $this->db->query("SELECT nom, codeCli from clients where codeCli = $codeCli");
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function getNomClientCompteur($codeCli){
            $stmt = $this->db->prepare("SELECT nom, prenom from clients where codeCli = ?");
            $stmt->execute(array($codeCli));
            $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result2;

        }
        public function getClientCompteur($codeCli){
            $statement = $this->db->prepare("SELECT * from compteur where codeCli = ? ");
            $statement->execute(array($codeCli));
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            // require 'views/facture/viewClientCompteur.php';
            return $data; 
        }
        public function getClientCompteurEau($codeCli){
            $statement = $this->db->prepare("SELECT * from compteur where codeCli = ? and type='eau' order by codeCompteur DESC limit 3");
            $statement->execute(array($codeCli['codeCli']));
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            // require 'views/facture/viewClientCompteur.php';
            return $data; 
        }
        public function getClientCompteurElec($codeCli){
            $statement = $this->db->prepare("SELECT * from compteur where codeCli = ? and type='elec' order by codeCompteur DESC limit 3");
            $statement->execute(array($codeCli['codeCli']));
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            // require 'views/facture/viewClientCompteur.php';
            return $data; 
        }

        public function getMontantFactEau($codeCli){
            $totalEau = 0;
            $statement = $this->db->prepare("SELECT (c.pu * r.valeur2) as montant from compteur c join releve_eau r on c.codeCompteur = r.codeCompteur where c.codeCli = ? order by codeEau DESC limit 3");
            $statement->execute(array($codeCli['codeCli']));
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)){
                $totalEau += $data['montant']; 
            }
            // require 'views/facture/viewClientCompteur.php';
            return $totalEau; 
        }

        public function getMontantFactElec($codeCli){
            $totalElec = 0;
            $statement = $this->db->prepare("SELECT (c.pu * r.valeur1) as montant from compteur c join releve_elec r on c.codeCompteur = r.codeCompteur where c.codeCli = ? order by codeElec DESC limit 3");
            $statement->execute(array($codeCli['codeCli']));
            while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                $totalElec += $data['montant']; 
            }
            
            return $totalElec; 
        }

        public function getClientFact($codeCli){
            $stmt = $this->db->prepare("SELECT codeCli, nom, prenom, quartier from clients where codeCli = ?");
            $stmt->execute(array($codeCli['codeCli']));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data; 
        }

        public function getInfoFactureEau($codeCli){

            // $oldmois = $this->checkInput($data['mois']);

            // preg_match('/(\d+)/', $oldmois, $match);
            // $newmois = (int)$match[0];
            // $mois = str_pad($newmois, 2, '0', STR_PAD_LEFT);
            
            
            // $annee = $this->checkInput($data['an']);

            // var_dump($annee);
            // die();

            $eau = $this->db->prepare("SELECT codeCompteur, pu from compteur where codeCli = ? AND type='eau'");
            $eau->execute(array($codeCli['codeCli']));
            $Neweau = $eau->fetch(PDO::FETCH_ASSOC);

            $codeCompEau = $Neweau;

            // $start_date = $annee . '-' . $mois . '-01';
            // $end_date = date("Y-m-t", strtotime($start_date));

            // $start_date = date("Y-m-d", $start_date);
            
            // var_dump($start_date, $end_date);
            // die();
            if($codeCompEau){
                
                $statement2 = $this->db->prepare("SELECT * FROM releve_eau where codeCompteur = ? order by codeEau DESC limit 3");
                $statement2->execute(array($codeCompEau['codeCompteur']));
                
                $res = $statement2->fetchAll(PDO::FETCH_ASSOC);
                
                // var_dump($codeCompEau['codeCompteur']);
                // var_dump($res);
                // die();
                // $statement1->execute()
                return $res;
            }
        }
        public function getInfoFactureElec($codeCli){

            // $oldmois = $this->checkInput($data['mois']);

            // preg_match('/(\d+)/', $oldmois, $match);
            // $newmois = (int)$match[0];
            // $mois = str_pad($newmois, 2, '0', STR_PAD_LEFT);
            
            
            // $annee = $this->checkInput($data['an']);

            $elec = $this->db->prepare("SELECT codeCompteur,pu from compteur where codeCli = ? AND type='elec'");
            $elec->execute(array($codeCli['codeCli']));
            $Newelec = $elec->fetch(PDO::FETCH_ASSOC);

            $codeCompElec = $Newelec;

            // $start_date = $annee . '-' . $mois . '-01';
            // $end_date = date("Y-m-t", strtotime($start_date));

            // $start_date = date("Y-m-d", $start_date);
            
            
            $statement1 = $this->db->prepare("SELECT * FROM releve_elec where codeCompteur = ? order by codeElec DESC limit 3 ");
            $statement1->execute(array($codeCompElec['codeCompteur']));

        
            $res =  $statement1->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($res);
            // die();
            return $res;

        }

    }

?>