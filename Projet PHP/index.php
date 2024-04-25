<?php


require_once "Modele/modeleMedoc.php";
require_once "Controleur/controleur.php";


if (empty($_GET["action"])) 
    displayMedocs();
else
    if ($_GET["action"] == "LG")
    {
        $login = $_POST["username"];
        $password = $_POST["password"];
        loginUser($login, $password);
    }
    else
        if ($_GET["action"] == "LO")
            logoutUser();
        else 
            if ($_GET["action"] == "DET"){
               
                if(isset($_POST['id_medicament'])) {
                    $id_medicament = $_POST['id_medicament'];
                  
                details($id_medicament);
                }
            }
            else
                if ($_GET["action"] == "REJ")
                    rejoindreAct();
                else
                    if ($_GET["action"] == "CO")
                        conferences();
                    else
                        if ($_GET["action"] == "JU")
                            juridique();
                        else
                            if ($_GET["action"] == "CH")
                                chercheurs();
                    
