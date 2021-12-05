<?php

namespace controller;

class Controller
{

    private $dbEntityRepository;

    public $reservationCall;

    public function __construct()
    {
        session_start();
        $this->dbEntityRepository = new \model\EntityRepository;
    }
    public function handleRequest()
    {
        $route = isset($_GET['route']) ? $_GET['route'] : NULL;

        (isset($_POST['sign'])) && $this->sign($_POST);

        (isset($_POST['sign_up'])) && $this->sign_up($_POST);

        // if (isset($_POST['contact'])) $this->contact($_POST);



        switch ($route) {
            case 'accueil':

                if ((!isset($_POST['prix_journalier']) || !$_POST['prix_journalier']) && (!isset($_POST['id_agence']) || !$_POST['id_agence'])) $this->accueil();

                elseif ((!isset($_POST['prix_journalier']) || !$_POST['prix_journalier']) && $this->reservationCall) $this->reservation($_POST);

                elseif ((!isset($_POST['id_agence']) || !$_POST['id_agence']) && $_POST['prix_journalier']) $this->TriParPrix($_POST);

                elseif ($this->reservationCall && $_POST['prix_journalier']) $this->reservation($_POST); //TODO envoyer vers autre chose que accueil...

                else $this->accueil();
                break;

            case 'vehicules':
                if (!$_POST || $_POST['id_agence'] == 0) $this->pageVehicules();

                elseif ($_POST['id_agence'] !== 0 && !isset($_POST['titre'])) $this->selectPageVehicule($_POST);

                elseif ($_POST['id_agence'] !== 0 && (isset($_POST['titre']) && $_POST['titre'])) $this->postVehicule($_POST);
                break;

            case 'agences':
                $this->pageAgences();

                if ($_POST) $this->postAgence($_POST);
                break;

            case 'membres':
                $this->pageMembres();

                if ($_POST) $this->postMembre($_POST);
                break;

            case 'commandes':
                !$_POST ? $this->pageCommandes() : $this->selectPageCommande($_POST);
                break;

            case 'logout':
                $this->logout();
                header('Location: http://127.0.0.1/Location_Veville/?route=accueil');
                break;

            case []:
                $this->retourAccueil();
                break;

            case 'reservation':
                $id_vehicule = $_GET['id_vehicule'];
                $membre = $_GET['id_membre'];
                $this->detailVehicule($membre, $id_vehicule);
                break;
        }
    }

    public function detailVehicule($membre, $id_vehicule)
    {
        $this->render('layout.php', 'detail.php', [
            'user' => $this->dbEntityRepository->fetchCurrentMembre($membre),
            'currentVehicule' => $this->dbEntityRepository->fetchCurrentVehicule($id_vehicule)
        ]);
    }

    public function retourAccueil()
    {
        $this->render('layout.php', 'accueil.php', []);
    }

    public function sign_up($values)
    {
        $this->dbEntityRepository->sign_up($values);
    }

    public function sign($values)
    {
        $this->dbEntityRepository->sign($values);
    }

    // public function contact($values)
    // {
    //     $this->dbEntityRepository->contact($values);
    // }

    public function logout()
    {
        session_destroy();
    }

    // ------------------------------------------------------------------
    // ---------------------------- Page ACCUEIL -----------------------
    // ------------------------------------------------------------------

    public function accueil()
    {
        $this->render('layout.php', 'accueil.php', [
            'title' => 'Accueil',
            'allVehicules' => $this->dbEntityRepository->selectAllVehicules()
        ]);
    }

    public function TriParPrix($values)
    {
        if ($_POST) {
            var_dump($this->reservationCall);
            if (intval($values['prix_journalier']) == 1) {
                $this->render('layout.php', 'accueil.php', [
                    'title' => 'Accueil',
                    'allVehicules' => $this->dbEntityRepository->selectAllVehicules()
                ]);
            } elseif (intval($values['prix_journalier']) == 2) {
                $this->render('layout.php', 'accueil.php', [
                    'title' => 'Accueil',
                    'allVehicules' => $this->dbEntityRepository->selectAllVehiculesDesc()
                ]);
            }
        }
    }

    public function reservation($values)
    {
        (isset($_POST['id_agence']) && $_POST['id_agence'] && isset($_POST['date_debut']) && $_POST['date_debut'] && isset($_POST['date_fin']) && $_POST['date_fin'])
            ? $this->reservationCall = $_POST['id_agence'] && $_POST['date_debut'] && $_POST['date_fin']
            : $this->reservationCall = null;
        var_dump($this->reservationCall);

        if ($_POST) {
            var_dump($values);
            if (!isset($values['prix_journalier']) || (intval($values['prix_journalier']) == 1)) {
                $this->render('layout.php', 'accueil.php', [
                    'title' => 'Accueil',
                    'allVehicules' => $this->dbEntityRepository->reservation($values)
                ]);
            } elseif (intval($values['prix_journalier']) == 2) {
                $this->render('layout.php', 'accueil.php', [
                    'title' => 'Accueil',
                    'allVehicules' => $this->dbEntityRepository->reservationDesc($values)
                ]);
            }
        }
    }

    // ------------------------------------------------------------------
    // ---------------------------- Page VEHICULE -----------------------
    // ------------------------------------------------------------------

    public function pageVehicules()
    {
        $this->render('layout.php', 'vehicule.php', [
            'title' => 'Véhicules',
            'allVehicules' => $this->dbEntityRepository->selectAllVehicules()
        ]);
    }

    public function selectPageVehicule($values)
    {
        if ($_POST) {
            (intval($values['id_agence']) === 0)
                ? $this->render('layout.php', 'vehicule.php', [
                    'title' => 'Véhicules',
                    'allVehicules' => $this->dbEntityRepository->selectAllVehicules()
                ])
                : $this->render('layout.php', 'vehicule.php', [
                    'title' => 'Véhicules',
                    'allVehicules' => $this->dbEntityRepository->selectVehicule($values)
                ]);
        }
    }

    public function postVehicule($values)
    {
        if ($_POST) $this->dbEntityRepository->postVehicule($values);
    }

    // ------------------------------------------------------------------
    // ---------------------------- Page AGENCES ------------------------
    // ------------------------------------------------------------------

    public function pageAgences()
    {
        $this->render('layout.php', 'agence.php', [
            'title' => 'Agences',
            'allAgences' => $this->dbEntityRepository->selectAllAgences()
        ]);
    }

    public function postAgence($values)
    {
        if ($_POST) $this->dbEntityRepository->postAgence($values);
    }

    // ------------------------------------------------------------------
    // ---------------------------- Page MEMBRE -------------------------
    // ------------------------------------------------------------------

    public function pageMembres()
    {
        $this->render('layout.php', 'membre.php', [
            'title' => 'Membres',
            'allMembres' => $this->dbEntityRepository->selectAllMembres()
        ]);
    }

    public function postMembre($values)
    {
        if ($_POST) $this->dbEntityRepository->postMembre($values);
    }

    // ------------------------------------------------------------------
    // ---------------------------- Page COMMANDE -----------------------
    // ------------------------------------------------------------------

    public function postCommande()
    {
    }

    public function pageCommandes()
    {

        $this->render('layout.php', 'commande.php', [
            'title' => 'Commandes',
            'allCommandes' =>  $this->dbEntityRepository->selectAllCommandes()
        ]);
    }

    public function selectPageCommande($values)
    {
        if ($_POST) {
            (intval($values['id_agence']) === 0)
                ? $this->render('layout.php', 'commande.php', [
                    'title' => 'Commandes',
                    'allCommandes' => $this->dbEntityRepository->selectAllCommandes()
                ])
                : $this->render('layout.php', 'commande.php', [
                    'title' => 'Commandes',
                    'allCommandes' => $this->dbEntityRepository->selectCommande($values)
                ]);
        }
    }

    // ------------------------------------------------------------------
    // ---------------------------- RENDER ------------------------------
    // ------------------------------------------------------------------

    public function render($layout, $template, $parameters = [])
    {
        // permet d'extraire chaque indice d un array sous forme de variable
        extract($parameters); // $parameters['employes] --> $employes (title , data)

        ob_start();
        // mise en tampon, on commence à garder en mémoire des données.

        // require_once " view/view-vehicule.php
        require_once "view/$template";
        // cette inclusion est stockée directement dans la variable $content

        // $content = le fichier vehicule.php
        $content = ob_get_clean();
        // on stocke la mise en mémoire, c'est à dire que l'on stocke dans la variable 
        // $content, le template lui-même, c'est à dire le résultat du require

        ob_start(); // temporise la sortie d'affichage

        // require_once "view/layout.php
        require_once "view/$layout";

        // on inclue le layout qui est le gabarit de base (header/nav/footer )
        return ob_end_flush();
        //  libère l'affichage et fait tout apparaitre sur le navigateur / Envoie les données de la mise en mémoire, mise en tampon de sortie.
    }
}
