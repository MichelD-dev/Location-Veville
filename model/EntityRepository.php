<?php

namespace model;

use controller\Controller;

class EntityRepository
{
    private $db; // (1)

    // -----------------------------------------------------------------------------------

    public function getDb() // (2)
    {
        if (!$this->db) // (3)
        {
            try {
                $xml = simplexml_load_file('App/config.xml'); //(4)
                // echo '<pre>';
                // print_r($xml);
                // echo '</pre>';
                try { // (5)
                    $this->db = new \PDO(
                        "mysql:host=" . $xml->host . ";dbname=" . $xml->db,
                        $xml->user,
                        $xml->password,
                        array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING, \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') // (8)
                    ); // (9)
                } catch (\Exception $e) {
                    echo 'Problème connexion BDD: ' . $e->getMessage();
                }
            } catch (\Exception $e) {
                echo 'Problème fichier config.xml manquant: ' . $e->getMessage();
            }
        }
        return $this->db; // (4)
    }

    // -----------------------------------------------------------------------------------

    public function fetchCurrentMembre($id)

    {
        $id = intval($id);
        $req = $this->getDb()->query("SELECT *
        FROM membre
        WHERE id_membre = $id
         ");

        $result = $req->fetchAll(\PDO::FETCH_ASSOC); // ÉTAPE SELECT (5) ON UTILISE LA FUNCTION 		fetchAll() POUR RÉCUPÉRER TOUS LES RÉSULTATS QU'IL TROUVE DANS NOTRE BDD.
        return $result;
    }

    public function fetchCurrentVehicule($id)

    {
        $id = intval($id);
        $req = $this->getDb()->query("SELECT *
        FROM vehicule
        WHERE id_vehicule = $id
            ");

        $result = $req->fetchAll(\PDO::FETCH_ASSOC); // ÉTAPE SELECT (5) ON UTILISE LA FUNCTION 		fetchAll() POUR RÉCUPÉRER TOUS LES RÉSULTATS QU'IL TROUVE DANS NOTRE BDD.
        return $result;
    }

    public function sign_up($values)
    {
        $req = $this->getDb()->query(
            "SELECT * FROM membre WHERE pseudo = '$values[pseudo]'"
        );

        if ($req->rowCount() >= 1) { //alors pseudo déjà pris
            return false;
        } else {
            $mdp = password_hash($values['mdp'], PASSWORD_DEFAULT);
            $membre = "Membre";
            $req = $this->getDb()->prepare(
                "INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement)
        VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, '$membre', now())"
            );

            $req->bindParam(':pseudo', $values['pseudo'], \PDO::PARAM_STR);
            $req->bindParam(':mdp', $mdp, \PDO::PARAM_STR);
            $req->bindParam(':nom', $values['nom'], \PDO::PARAM_STR);
            $req->bindParam(':prenom', $values['prenom'], \PDO::PARAM_STR);
            $req->bindParam(':email', $values['email'], \PDO::PARAM_STR);
            $req->bindParam(':civilite', $values['civilite'], \PDO::PARAM_STR);
            $req->execute();
        }
    }

    public function sign($values)
    {
        $pseudo = trim($values['pseudo']);
        $mdp = trim($values['mdp']);

        $req = $this->getDb()->prepare(
            "SELECT *
            FROM membre
            WHERE pseudo = ?" // ? = placeholder (évite les injections SQL)
        );
        $req->execute([$pseudo]);
        $user = $req->fetch(\PDO::FETCH_ASSOC);
        /*      FETCH_ASSOC = renvoie la valeur d'un tableau sans indexation;
        exemple sans FETCH_ASSOC : 
        [0] => prenom
        [prenom] => prenom 
        [1] => nom
        [nom] => nom
        exemple avec  FETCH_ASSOC : 
        [prenom] => prenom 
        [nom] => nom
        */


        // On verifie si le tableau est comptable
        // et si il est comptable on verifie si le compte est supérieur a 0
        // ce qui signifie qu'un utilisateur a ete trouvé
        if (is_countable($user) && count($user) > 0) {
            if (password_verify($mdp, $user['mdp']))  // verifie si le mot de passe saisi correspond à celui en BDD
            {
                foreach ($user as $key => $value) { //$value = $user
                    $_SESSION['membre'][$key] = $value; // on génère une session membre avec toutes les données de l'utilisateur qui veut se connecter
                }
            } else {
                echo "password ne correspond pas";
            }
        } else {
            var_dump($user);
        }
    }

    // -----------------------------------------------------------------------------------

    public function reservation($values)
    {
        $req = $this->getDb()->query(
            "SELECT vehicule.*, ville, agences.titre as agences_titre
            FROM vehicule
            INNER JOIN agences
            USING (id_agence)
            WHERE id_agence = {$values["id_agence"]}
            ORDER BY prix_journalier ASC
            "
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function reservationDesc($values)
    {
        $req = $this->getDb()->query(
            "SELECT vehicule.*, ville, agences.titre as agences_titre
            FROM vehicule
            INNER JOIN agences
            USING (id_agence)
            WHERE id_agence = {$values["id_agence"]}
            ORDER BY prix_journalier DESC
            "
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function disponibilite($values)
    {
        $dispo = 1;
        $req = $this->getDb()->prepare(
            "INSERT INTO vehicule (disponible)
                WHERE id_vehicule = {$values['id_vehicule']}
VALUE  (:disponible )"
        );
        $req->bindParam(':disponible', $dispo, \PDO::PARAM_INT);
        $req->execute();
    }


    public function selectAllVehicules()
    {
        $req = $this->getDb()->query(
            'SELECT vehicule.*, ville, agences.titre as agences_titre
            FROM vehicule
            INNER JOIN agences
            USING (id_agence)
            ORDER BY prix_journalier ASC'
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectAllVehiculesDesc()
    {
        $req = $this->getDb()->query(
            'SELECT vehicule.*, ville, agences.titre as agences_titre
            FROM vehicule
            INNER JOIN agences
            USING (id_agence)
            ORDER BY prix_journalier DESC'
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectVehicule($values)
    {
        $req = $this->getDb()->query(
            "SELECT vehicule.*, ville, agences.titre as agences_titre FROM vehicule
            INNER JOIN agences
            USING (id_agence)
            WHERE id_agence = {$values['id_agence']}"
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    // -----------------------------------------------------------------------------------

    public function selectAllAgences()
    {
        $req = $this->getDb()->query(
            'SELECT * FROM agences'
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    // -----------------------------------------------------------------------------------

    public function selectAllMembres()
    {
        $req = $this->getDb()->query(
            "SELECT *, DATE_FORMAT(date_enregistrement, '%d/%m/%Y - %Hh%i') as date
            FROM membre"
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    // -----------------------------------------------------------------------------------

    public function selectAllCommandes()
    {
        $req = $this->getDb()->query(
            "SELECT id_commande, id_vehicule, commande.id_agence as id_agence, membre.prenom, membre.nom, membre.email, statut, vehicule.titre as vehicule_titre, agences.titre as agences_titre, DATE_FORMAT(date_heure_depart, '%d/%m/%Y<br/>%Hh%i') as date_depart, DATE_FORMAT(date_heure_fin, '%d/%m/%Y<br/>%Hh%i') as date_fin, prix_journalier, DATE_FORMAT(commande.date_enregistrement, '%d/%m/%Y<br/>%Hh%i') as date_enregistrement, DATEDIFF(date_heure_fin, date_heure_depart) as nbr_jours
        FROM commande
        INNER JOIN membre USING (id_membre)
        INNER JOIN vehicule USING (id_vehicule)
        INNER JOIN agences ON agences.id_agence = commande.id_agence"
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    // -----------------------------------------------------------------------------------

    public function selectCommande($values)

    {
        $req = $this->getDb()->query(
            "SELECT id_commande, id_vehicule, commande.id_agence as id_agence, membre.prenom, membre.nom, membre.email, statut, vehicule.titre as vehicule_titre, agences.titre as agences_titre, DATE_FORMAT(date_heure_depart, '%d/%m/%Y - %Hh%i') as date_depart, DATE_FORMAT(date_heure_fin, '%d/%m/%Y - %Hh%i') as date_fin, prix_journalier, DATE_FORMAT(commande.date_enregistrement, '%d/%m/%Y - %Hh%i') as date_enregistrement, DATEDIFF(date_heure_fin, date_heure_depart) as nbr_jours
        FROM commande
        INNER JOIN membre USING (id_membre)
        INNER JOIN vehicule USING (id_vehicule)
        INNER JOIN agences ON agences.id_agence = commande.id_agence
        WHERE commande.id_agence = {$values["id_agence"]}
        "
        );

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    // -----------------------------------------------------------------------------------

    public function postVehicule($values)
    {
        $req = $this->getDb()->prepare(
            'INSERT INTO vehicule (titre, modele, marque, description, prix_journalier, photo, id_agence)
        VALUES  (:titre, :modele, :marque, :description, :prix_journalier,:photo, :id_agence )'
        );

        $req->bindParam(':titre', $values['titre'], \PDO::PARAM_STR);
        $req->bindParam(':modele', $values['modele'], \PDO::PARAM_STR);
        $req->bindParam(':marque', $values['marque'], \PDO::PARAM_STR);
        $req->bindParam(':description', $values['description'], \PDO::PARAM_STR);
        $req->bindParam(':prix_journalier', $values['prix_journalier'], \PDO::PARAM_INT);
        $req->bindParam(':photo', $values['photo'], \PDO::PARAM_STR);
        $req->bindParam(':id_agence', $values['id_agence'], \PDO::PARAM_INT);
        $req->execute();
        $this->selectAllVehicules();
    }

    // -----------------------------------------------------------------------------------

    public function postAgence($values)
    {
        $req = $this->getDb()->prepare(
            "INSERT INTO agences (titre, adresse, ville, cp, description, photo)
        VALUES (:titre, :adresse, :ville, :cp, :description, :photo)"
        );

        $req->bindParam(':titre', $values['titre'], \PDO::PARAM_STR);
        $req->bindParam(':adresse', $values['adresse'], \PDO::PARAM_STR);
        $req->bindParam(':ville', $values['ville'], \PDO::PARAM_STR);
        $req->bindParam(':cp', $values['cp'], \PDO::PARAM_INT);
        $req->bindParam(':description', $values['description'], \PDO::PARAM_STR);
        $req->bindParam(':photo', $values['photo'], \PDO::PARAM_STR);
        $req->execute();
        $this->selectAllAgences();
    }

    // -----------------------------------------------------------------------------------

    public function postMembre($values)
    {
        setlocale(LC_TIME, 'fra_fra');
        $date = strftime('%Y-%m-%d %H:%M');
        $req = $this->getDb()->prepare(
            "INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement)
        VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut, :date_enregistrement)"
        );

        $req->bindParam(':pseudo', $values['pseudo'], \PDO::PARAM_STR);
        $req->bindParam(':mdp', $values['mdp'], \PDO::PARAM_STR);
        $req->bindParam(':nom', $values['nom'], \PDO::PARAM_STR);
        $req->bindParam(':prenom', $values['prenom'], \PDO::PARAM_STR);
        $req->bindParam(':email', $values['email'], \PDO::PARAM_STR);
        $req->bindParam(':civilite', $values['civilite'], \PDO::PARAM_STR);
        $req->bindParam(':statut', $values['statut'], \PDO::PARAM_STR);
        $req->bindValue(':date_enregistrement', $date, \PDO::PARAM_STR);
        $req->execute();
    }
}

/*
  1 - Permet de stocker un objet issu de la classe PDO, C'est à dire la connexion à la BDD.
  2 - Fonction permettant de construire la connexion à la BDD.
  3 - Si dans la variable $db, il n'y a pas de connexion PDO, alors on entre dans le IF et on la construit.
  4 - Si la propriété $db contient bien une connexion BDD, un objet PDO, on retourne la connexion.
*/
