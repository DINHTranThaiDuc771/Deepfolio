<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);


    require ("../server/DB.inc.php");
    require "../server/Competence.inc.php";
    require "../server/Projet.inc.php";


    session_start();

    global $db;

    $db = DB::getInstance();

    if(isset($_POST['action'])) {
        if ($_POST['action'] == 'userExists') { userExists(); }
        if ($_POST['action'] == 'getPortfolios') { getPortfolios(); }
        if ($_POST['action'] == 'getMessages') { getMessages(); }
        if ($_POST['action'] == 'deleteMessage') { deleteMessage(); } 
        if ($_POST['action'] == 'deletePortfolio') { deletePortfolio(); }
        if ($_POST['action'] == 'getPage') { getPage(); }
        if ($_POST['action'] == 'uploadFiles') { dlImg(); }
        if ($_POST['action'] == 'updatePage') { updatePage(); }
        if ($_POST['action'] == 'copyPortfolio') { copyPortfolio(); }
        if ($_POST['action'] == 'renamePortfolio') { renamePortfolio(); }
        if ($_POST['action'] == 'changeAccessibility') { changeAccessibility(); }
        if ($_POST['action'] == 'getAccessibility') { getAccessibility(); }
    }

    if(isset($_POST['nom'])) {

        $nomE       = htmlspecialchars($_POST['nom']);
        $prenomE    = htmlspecialchars($_POST['prenom']);
        $mailE      = htmlspecialchars($_POST['mail']);
        $objet      = htmlspecialchars($_POST['objet']);
        $message    = htmlspecialchars($_POST['message']);
        $cle        = htmlspecialchars($_POST['cle']);

        $username = $_COOKIE['proprio_portfolio'];

        if($db->messageExists($username, $mailE) != 0 ){
            envoyerMessage($username, $mailE, $nomE, $prenomE, $objet, $message);           
        }else{
            updateMessage($username, $mailE, $nomE, $prenomE, $objet, $message);            
        }
        //$cle = substr($cle, 1, -1);
        header("Location: ./visualisation.php?cle=$cle");
        exit(); 
    }




    function userExists() {
        global $db;

        $user = htmlspecialchars($_POST["username"]);

        if(count($db->userExists($user)) > 0) {
            echo "true";
        } else {
            echo "false";
        }   
    }

    function getPortfolios() {

        global $db;

        $user = $_SESSION["user"];

        $portfolios = $db->getPortfolios($user->getNomUtilisateur());

        echo json_encode($portfolios);
    }

    function getMessages() {

        global $db;

        $user = $_SESSION["user"];

        $messages = $db->getMessages($user->getNomUtilisateur());

        echo json_encode($messages);
    }

    function envoyerMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message) {

        global $db;

        return $db->envoyerMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message);
    }

    function updateMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message) {

        global $db;

        return $db->updateMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message);
    }

    function deleteMessage() {
        global $db;
        
        $nomEnvoyeur = htmlspecialchars($_POST['nomUtilisateur']);
        $mailEnvoyeur = $_POST['mail'];

        $db->deleteMessage($nomEnvoyeur, $mailEnvoyeur);
    }

    function deletePortfolio() {
        global $db;

        $user = $_SESSION["user"];
        $idPortfolio = htmlspecialchars($_POST['idPortfolio']);

        $db->deletePortfolio($user->getNomUtilisateur(), $idPortfolio);
    }

    function getPage() {
        global $db;

        $user = $_SESSION["user"];
        $idPortfolio = htmlspecialchars($_POST['idPortfolio']);
        $type = htmlspecialchars($_POST['type']);

        $page = $db->getPage($user->getNomUtilisateur(), $idPortfolio, $type);

        echo json_encode($page);
    }

    function updatePage() {
        global $db;

        $auteur = htmlspecialchars($_POST["auteur"]);
        $idPortfolio = htmlspecialchars($_POST["idPortfolio"]);
        $type = htmlspecialchars($_POST["type"]);

        $pages = $db->getPage($auteur, $idPortfolio, $type);

        $nomAttr = $_POST["nomAttr"];
        $text    = htmlspecialchars($_POST["text"]);

        $json = json_decode($pages[0]->getJson(), true);   

        //-----------------------//
        // COMPETENCE            //
        //-----------------------//

        if ( $nomAttr == "competence") {

            if ( $_POST["delete"] == "true") {

                $ancienNom = $_POST["ancienneValeur"];

                $indexSuppr = 0;
                foreach ( $json["competences"] as $comp) {
                    if ( $comp['nom'] == $ancienNom) {
                        $indexSuppr = array_search($comp, $json["competences"], true);
                    }
                }

                unset($json["competences"][$indexSuppr]);

                $db->changePage($auteur, $idPortfolio, $pages[0]->getIdPage(), json_encode($json));

                return;
            }

            $tabStr = explode(";", $text);

            $nomComp = $tabStr[0];
            $description = $tabStr[1];
            $lien = $tabStr[2];

            $competence = new Competence($nomComp, $description, $lien);

            if ( $_POST["nouveau"] == "false")
            {
                $ancienNom = $_POST["ancienneValeur"];

                $indexSuppr = 0;
                foreach ( $json["competences"] as $comp) {
                    if ( $comp['nom'] == $ancienNom) {
                        $indexSuppr = array_search($comp, $json["competences"], true);
                    }
                }

                unset($json["competences"][$indexSuppr]);

                array_splice($json["competences"], $indexSuppr, 0, [$competence]);
                
            } else {
                array_push($json['competences'], $competence);
            }

            $db->changePage($auteur, $idPortfolio, $pages[0]->getIdPage(), json_encode($json));

            return;
        }


        //-----------------------//
        // PROJET                //
        //-----------------------//

        if ( $nomAttr == "projet") {

            if ( $_POST["delete"] == "true") {


                $ancienNom = $_POST["ancienneValeur"];

                var_dump($ancienNom);

                $indexSuppr = 0;
                foreach ( $json["projets"] as $proj) {
                    if ( $proj['nom'] == $ancienNom) {
                        $indexSuppr = array_search($proj, $json["projets"], true);
                    }
                }

                unset($json["projets"][$indexSuppr]);


                $db->changePage($auteur, $idPortfolio, $pages[0]->getIdPage(), json_encode($json));

                return;
            }

            $tabStr = explode(";", $text);

            $nomPeojet = $tabStr[0];
            $description = $tabStr[1];
            $tailleEquipe = $tabStr[2];
            $lien = $tabStr[3];
            $image = $tabStr[4];

            $projet = new Projet($nomPeojet, $description, $tailleEquipe, $lien, $image);


            if ( $_POST["nouveau"] == "false")
            {
                $ancienNom = $_POST["ancienneValeur"];

                var_dump($ancienNom);
                var_dump($json["projets"]);

                $indexSuppr = 0;
                foreach ( $json["projets"] as $proj) {
                    if ( $proj['nom'] == $ancienNom) {
                        $indexSuppr = array_search($proj, $json["projets"], true);
                    }
                }
                
                unset($json["projets"][$indexSuppr]);

                array_splice($json["projets"], $indexSuppr, 0, [$projet]);
                
            } else {
                array_push($json['projets'], $projet);
            }

            $db->changePage($auteur, $idPortfolio, $pages[0]->getIdPage(), json_encode($json));

            return;
        }

        if ( $nomAttr == "nomPortfolio" && $type = "infos") {
            $db->changePortfolioName($auteur, $idPortfolio, $text);
        }

        if ( array_key_exists($nomAttr, $json)) {
            $json[$nomAttr] = $text;
        } else {
            $json[$nomAttr] = $text;
        }

        $db->changePage($auteur, $idPortfolio, $pages[0]->getIdPage(), json_encode($json));
    }


    function dlImg() {
        $target_dir = "img_user/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;

        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "false";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    function copyPortfolio(){
        global $db;

        $user = $_SESSION["user"];
        $idPortfolio = htmlspecialchars($_POST['idPortfolio']);

        $db->copierPortfolio($user->getNomUtilisateur(), $idPortfolio);
    }

    function renamePortfolio(){
        global $db;

        $user = $_SESSION["user"];
        $idPortfolio = htmlspecialchars($_POST['idPortfolio']);
        $newName = htmlspecialchars($_POST['newName']);

        $db->renamePortfolio($user->getNomUtilisateur(), $idPortfolio, $newName);
    }

    function changeAccessibility(){
        global $db;

        $user = $_SESSION["user"];
        $idPortfolio = htmlspecialchars($_POST['idPortfolio']);
        $accessibilityvalue = $_POST['accessible'];

        $result = $db->changeAccesibility($user->getNomUtilisateur(), $idPortfolio, $accessibilityvalue);
        echo $result;
    }

    function getAccessibility(){
        global $db;

        $user = $_SESSION["user"];
        $idPortfolio = htmlspecialchars($_POST['idPortfolio']);

        $accessibilityvalue = $db->isPortfolioAccessible($user->getNomUtilisateur(), $idPortfolio);

        echo $accessibilityvalue;
    }
?>