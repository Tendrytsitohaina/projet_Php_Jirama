<?php

    class searchModel{
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        public function searchClient($search){

            $res = $search['search'];
            

            switch ($search['typeSearch']) {
                case 'Nom':
                    $statement = $this->db->query("SELECT * from clients WHERE nom LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'Prenom':
                    $statement = $this->db->query("SELECT * from clients WHERE prenom LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'Niveau':
                    $statement = $this->db->query("SELECT * from clients WHERE niveau LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'Sexe':
                    $statement = $this->db->query("SELECT * from clients WHERE sexe LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'CodeCli':
                    $statement = $this->db->query("SELECT * from clients WHERE codeCli LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'Mail':
                    $statement = $this->db->query("SELECT * from clients WHERE mail LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'Quartier':
                    $statement = $this->db->query("SELECT * from clients WHERE quartier LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                
                default:
                    return false;
                    break;
            }
            
            require 'views/clients/index.php';
        }

        public function searchCompteur($search){

            $res = $search['search'];

            switch ($search['typeSearch']) {
                case 'codeComp':
                    $statement = $this->db->query("SELECT * from compteur join clients on compteur.codeCli = clients.codeCli WHERE codeCompteur LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'pu':
                    $statement = $this->db->query("SELECT * from compteur join clients on compteur.codeCli = clients.codeCli WHERE pu LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'type':
                    $statement = $this->db->query("SELECT * from compteur join clients on compteur.codeCli = clients.codeCli WHERE type LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'Sexe':
                    $statement = $this->db->query("SELECT * from compteur join clients on compteur.codeCli = clients.codeCli WHERE sexe LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'nom':
                    $statement = $this->db->query("SELECT * from compteur join clients on compteur.codeCli = clients.codeCli WHERE clients.nom LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC); 
                    break;
                case 'prenom':
                    $statement = $this->db->query("SELECT * from compteur join clients on compteur.codeCli = clients.codeCli WHERE clients.prenom LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC); 
                    break;
                
                default:
                    return false;
                    break;
            }
            
            require 'views/compteurs/index.php';
        }

        public function searchEau($search){

            $res = $search['search'];

            switch ($search['typeSearch']) {
                case 'codeEau':
                    $statement = $this->db->query("SELECT * from releve_eau WHERE codeEau LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'dateReleve':
                    $statement = $this->db->query("SELECT * from releve_eau WHERE DATE_FORMAT(dateReleve2, '%d/%m/%Y' ) LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'dateLimite':
                    $statement = $this->db->query("SELECT * from releve_eau WHERE DATE_FORMAT(date_limite2, '%d/%m/%Y' ) LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'datePres':
                    $statement = $this->db->query("SELECT * from releve_eau WHERE DATE_FORMAT(date_presentation2, '%d/%m/%Y' ) LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'valeur':
                    $statement = $this->db->query("SELECT * from releve_eau WHERE valeur2 LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC); 
                    break;
                case 'codeComp':
                    $statement = $this->db->query("SELECT * from releve_eau WHERE codeCompteur LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC); 
                    break;
                
                default:
                    return false;
                    break;
            }
            
            require 'views/releveEau/index.php';
        }

        public function searchElec($search){

            $res = $search['search'];

            switch ($search['typeSearch']) {
                case 'codeElec':
                    $statement = $this->db->query("SELECT * from releve_elec WHERE codeElec LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'dateReleve':
                    $statement = $this->db->query("SELECT * from releve_elec WHERE DATE_FORMAT(dateReleve1, '%d/%m/%Y' ) LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'dateLimite':
                    $statement = $this->db->query("SELECT * from releve_elec WHERE DATE_FORMAT(date_limite, '%d/%m/%Y' ) LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'datePres':
                    $statement = $this->db->query("SELECT * from releve_elec WHERE DATE_FORMAT(date_presentation, '%d/%m/%Y' ) LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'valeur':
                    $statement = $this->db->query("SELECT * from releve_elec WHERE valeur1 LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC); 
                    break;
                case 'codeComp':
                    $statement = $this->db->query("SELECT * from releve_elec WHERE codeCompteur LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break; 
                
                default:
                    return false;
                    break;
            }
            
            require 'views/releveElec/index.php';
        }

        public function searchPaie($search){

            $res = $search['search'];

            switch ($search['typeSearch']) {
                case 'codePaie':
                    $statement = $this->db->query("SELECT * from payer WHERE codePaie LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'datePaie':
                    $statement = $this->db->query("SELECT * from payer WHERE DATE_FORMAT(datePaie, '%d/%m/%Y' ) LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'codeCli':
                    $statement = $this->db->query("SELECT * from payer WHERE codeCli LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'montant':
                    $statement = $this->db->query("SELECT * from payer WHERE montant LIKE '%$res%'");
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                    break;
                
                default:
                    return false;
                    break;
            }
            
            require 'views/paie/index.php';
        }

        public function checkInput($data){
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            return $data;
        }

    }

?>