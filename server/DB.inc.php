
<?php

require "Portfolio.inc.php";
require "Utilisateur.inc.php";
require "Page.inc.php";



class DB {
      private static $instance = null; //mémorisation de l'instance de DB pour appliquer le pattern Singleton
      private $connect=null; //connexion PDO à la base
      

      /************************************************************************/
      //	Constructeur gerant  la connexion à la base via PDO
      //	NB : il est non utilisable a l'exterieur de la classe DB
      /************************************************************************/	
      private function __construct() {
        $login="lp212835";
        $mdpBD="1234";

      	      // Connexion à la base de données
	      $connStr = 'pgsql:host=woody port=5432 dbname='. $login;  
	      try {
		  // Connexion à la base
	      	  $this->connect = new PDO($connStr, $login, $mdpBD);
		  // Configuration facultative de la connexion
		  $this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
		  $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); 
	      }
	      catch (PDOException $e) {
      	      	    echo "probleme de connexion :".$e->getMessage();
		    return null;    
	      }
      }

      /************************************************************************/
      //	Methode permettant d'obtenir un objet instance de DB
      //	NB : cet objet est unique pour l'exécution d'un même script PHP
      //	NB2: c'est une methode de classe.
      /************************************************************************/
      public static function getInstance() {
      	     if (is_null(self::$instance)) {
 	     	try { 
		      self::$instance = new DB(); 
 		} 
		catch (PDOException $e) {
			echo $e;
 		}
            } //fin IF
 	    $obj = self::$instance;

	    if (($obj->connect) == null) {
	       self::$instance=null;
	    }
	    return self::$instance;
      } //fin getInstance	 

      /************************************************************************/
      //	Methode permettant de fermer la connexion a la base de données
      /************************************************************************/
      public function close() {
      	     $this->connect = null;
      }

      /************************************************************************/
      //	Methode uniquement utilisable dans les méthodes de la class DB 
      //	permettant d'exécuter n'importe quelle requête SQL
      //	et renvoyant en résultat les tuples renvoyés par la requête
      //	sous forme d'un tableau d'objets
      //	param1 : texte de la requête à exécuter (éventuellement paramétrée)
      //	param2 : tableau des valeurs permettant d'instancier les paramètres de la requête
      //	NB : si la requête n'est pas paramétrée alors ce paramètre doit valoir null.
      //	param3 : nom de la classe devant être utilisée pour créer les objets qui vont
      //	représenter les différents tuples.
      //	NB : cette classe doit avoir des attributs qui portent le même que les attributs
      //	de la requête exécutée.
      //	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
      //	que d'éléments dans le tableau passé en second paramètre.
      //	NB : si la requête ne renvoie aucun tuple alors la fonction renvoie un tableau vide
      /************************************************************************/
      private function execQuery($requete,$tparam,$nomClasse) {
      	     //on prépare la requête
	     $stmt = $this->connect->prepare($requete);
	     //on indique que l'on va récupére les tuples sous forme d'objets instance de Client
	     $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $nomClasse); 
	     //on exécute la requête
	     if ($tparam != null) {
	     	$stmt->execute($tparam);
	     }
	     else {
	     	$stmt->execute();
	     }
	     //récupération du résultat de la requête sous forme d'un tableau d'objets
	     $tab = array();
	     $tuple = $stmt->fetch(); //on récupère le premier tuple sous forme d'objet
	     if ($tuple) {
	     	//au moins un tuple a été renvoyé
     	      	 while ($tuple != false) {
		       $tab[]=$tuple; //on ajoute l'objet en fin de tableau
      	    	       $tuple = $stmt->fetch(); //on récupère un tuple sous la forme
						//d'un objet instance de la classe $nomClasse	       
    		 } //fin du while	           	     
             }
	     return $tab;    
      }
  
       /************************************************************************/
      //	Methode utilisable uniquement dans les méthodes de la classe DB
      //	permettant d'exécuter n'importe quel ordre SQL (update, delete ou insert)
      //	autre qu'une requête.
      //	Résultat : nombre de tuples affectés par l'exécution de l'ordre SQL
      //	param1 : texte de l'ordre SQL à exécuter (éventuellement paramétré)
      //	param2 : tableau des valeurs permettant d'instancier les paramètres de l'ordre SQL
      //	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
      //	que d'éléments dans le tableau passé en second paramètre.
      /************************************************************************/
      private function execMaj($ordreSQL,$tparam) {
      	     $stmt = $this->connect->prepare($ordreSQL);
	     $res = $stmt->execute($tparam); //execution de l'ordre SQL      	     
	     return $stmt->rowCount();
      }

      /*************************************************************************
       * Fonctions qui peuvent être utilisées dans les scripts PHP
       *************************************************************************/

       public function userExists($nomutilisateur){
            $requete = 'select * from utilisateur where nomUtilisateur = ?';
            $nomutilisateurP = array( $nomutilisateur);
            return $this->execQuery($requete, $nomutilisateurP, ''); 
       }


       public function getMdp($nomutilisateur){
            $requete = 'select mdphash from utilisateur where nomUtilisateur = ?';
            $nomutilisateurP = array( $nomutilisateur);
            $result = $this->execQuery($requete, $nomutilisateurP, '');
            return $result[0]['mdphash'];
            
       }

      //*********************************************************//
      //                     GET                                 //
      //*********************************************************//
      
      
      public function getUser($login, $pwd) {
            $requete = 'select * from utilisateur where nomUtilisateur = ? and mdphash = ? ';
            $tparam = array( $login, $pwd );
	      return $this->execQuery($requete,$tparam, "Utilisateur");
      }

        public function getUserInfos($login) {
            $requete = 'select * from utilisateur where nomUtilisateur = ? ';
            $tparam = array( $login );
            $result = $this->execQuery($requete,$tparam, '');
            return $result[0];
        }

        public function getUsername() {
                $requete = 'select nomUtilisateur from utilisateur';
                return $this->execQuery($requete,null, '');
        }

      public function getPortfolio($username, $id) {
            $requete = 'select * from portfolio where nomUtilisateur = ? and idPortfolio = ?';
            $tparaam = array( $username, $id);
            return $this->execQuery($requete, $tparaam, '');
      }

        public function getPortfolios($username) {
                $requete = 'select * from portfolio where nomUtilisateur = ?';
                $tparaam = array( $username);
                return $this->execQuery($requete, $tparaam, '');
        }

        public function getMessages($username) {
                $requete = 'select * from message where nomUtilisateur = ?';
                $tparaam = array( $username);
                return $this->execQuery($requete, $tparaam, '');
        }

        public function getNewestPortfolioId($username){
            $requete = 'select idportfolio from portfolio where idportfolio = (select max(idportfolio) from portfolio where nomutilisateur = ?);';
            $tparam = array($username);
            $result = $this->execQuery($requete, $tparam, '');
            return $result[0]['idportfolio'];
        }

        public function getPages($username, $idportfolio){
            $requete = 'select * from page where nomutilisateur = ? and idportfolio = ?';
            $tparam = array($username, $idportfolio);
            return $this->execQuery($requete, $tparam, 'Page');
        }

      
      
      //*********************************************************//
      //                     ADD                                 //
      //*********************************************************//

      public function addUtilisateur($username, $mdp) {
        $requete = 'insert into utilisateur (nomUtilisateur, mdphash) values(?,?)';
        $tparam = array($username, $mdp);
        return $this->execMaj($requete,$tparam);
      }
      
      public function addMessage($username, $mail, $nom, $prenom, $objet, $message) {
        $requete = 'insert into message values(?,?,?,?,?,?)';
        $tparam = array($username, $mail, $nom, $prenom, $objet, $message);
        return $this->execMaj($requete,$tparam);
      }

        public function addPortfolio($username,$nomPortfolio, $accesible) {
            $requete = 'insert into portfolio (nomUtilisateur, nomPortfolio, accesible) values(?,?,?)';
            $tparam = array($username, $nomPortfolio, $accesible);
            $result = $this->execMaj($requete,$tparam);
            if(strcmp($result,"int(1)")){
                return true;
            }else{return false;}
        }

        public function addPage($username,$idPortfolio, $jsonPage, $typePage) {
            $requete = 'insert into page (nomutilisateur, idportfolio, jsonPage, type) values (?, ?, ?, ?)';
            $tparam = array($username,$idPortfolio, $jsonPage, $typePage);
            return $this->execMaj($requete,$tparam);
        }


        
        //*********************************************************//
        //                     UPDATE                              //
        //*********************************************************//

        public function changeAccesibility($username, $idPortfolio, $accesibilite) {
            $requete = 'update portfolio set accesible = ? where nomUtilisateur = ? and idPortfolio = ?';
            $tparam = array($username, $idPortfolio, $accesibilite);
            return $this->execMaj($requete,$tparam);
        }

        public function changePersonalInfo($username, $nom, $prenom, $age, $ville, $universite, $mailutilisateur ) {
            $requete = 'update utilisateur set nom = ?, prenom = ?, age = ?, ville = ?, universite = ?, mailutilisateur = ?  where nomUtilisateur = ?';
            $tparam = array( $nom, $prenom, $age, $ville, $universite, $mailutilisateur, $username);
            return $this->execMaj($requete,$tparam);
        }

        public function changePage($username, $idPortfolio, $idPage, $jsonPage) {
            $requete = 'update page set jsonPage = ? where nomUtilisateur = ? and idPortfolio = ? and idPage = ?';
            $tparam = array( $jsonPage, $username, $idPortfolio, $idPage);
            return $this->execMaj($requete,$tparam);
        }

        public function changePortfolioName($username, $idPortfolio, $nomPortfolio) {
            $requete = 'update page set nomPortfolio = ? where nomUtilisateur = ? and idPortfolio = ?';
            $tparam = array( $nomPortfolio, $username, $idPortfolio);
            return $this->execMaj($requete,$tparam);
        }


        //*********************************************************//
        //                     DELETE                              //
        //*********************************************************//

        public function deletePortfolio( $username, $idPortfolio) {
            $requete = 'delete from portfolio where nomUtilisateur = ? and idPortfolio = ?';
            $tparam = array( $username, $idPortfolio);
            return $this->execMaj($requete,$tparam);
        }

        public function deleteMessage($username, $mail) {
            $requete = 'delete from message where nomUtilisateur = ? and mailMessage = ?';
            $tparam = array( $username, $mail);
            return $this->execMaj($requete,$tparam);
        }


} //fin classe DB

?>
