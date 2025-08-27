<?php

    require 'config/connexion.php';
    class dashModel{
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        public function clientDash(){
            $stmt = $this->db->query('SELECT count(*) as nb from clients');
            return $stmt->fetch();
        }

        public function compteurDash(){
            $stmt = $this->db->query('SELECT count(*) as nb from compteur');
            return $stmt->fetch();
        }

        public function retardDash(){
            $statement1 = $this->db->query("SELECT count(*) as nb from clients c join compteur co 
            on co.codeCli = c.codeCli left join releve_eau rE on co.codeCompteur = rE.codeCompteur 
            left join payer p on c.codeCli=p.codeCli where rE.date_limite2 <= CURDATE()");

            return $statement1->fetch(PDO::FETCH_ASSOC);
            
        }

        public function factureDash(){
            $statement = $this->db->query("SELECT count(*) as nb from clients c join compteur co 
                                                    on co.codeCli = c.codeCli left join releve_eau rE on co.codeCompteur = rE.codeCompteur 
                                                    left join payer p on c.codeCli=p.codeCli
                                                    where (codePaie IS NULL)");
                // $statement->execute(array($mois, $annee, $mois));
            return  $statement->fetch(PDO::FETCH_ASSOC);

        }


    }


?>