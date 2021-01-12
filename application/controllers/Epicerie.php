<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epicerie extends CI_Controller {

    public function __construct(){

        parent::__construct();

        $client = new \Google_Client();
        
        // On choisit l'application
        $client->setApplicationName(NOM_APPLICATION);
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . '/credentials.json');

        // Declaration du service
        $service = new Google_Service_Sheets($client);
        
        $this->spreadsheetId = LIEN_SHEET_EPICERIE;
        $this->service = $service;

    }

    public function index(){
        // Creation des donnees Epicerie
        if ($this->creation_activite()) {
            if ($this->creation_famille()) {
                if ($this->creation_produits()) {
                    return $this->output
                                ->set_content_type('application/json')
                                ->set_output(json_encode(array('message' => 'Epicerie: Creation des donnees effectues avec succes')));
                }
            }
        }

        echo "Un probleme est survenu";
    }

    public function creation_activite(){

        $activite_epicerie = [
            "nom_act" => "Epicerie",
            "code_act" => 1,
            "id_cat" => 1
        ];

        return $this->activite_model->ajouter_activite($activite_epicerie);
    }

    public function creation_famille(){
        // Lecture des donnees - Famille epicerie
        $range = "Famille!A4:C32";

        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            echo "<h1>Aucune donnees recoltes !!</h1>";
            return FALSE;
        } else {
            foreach ($values as $row) {
                $famille = [
                    "nom" => $row[0],
                    "code_fam" => $row[1],
                    "code_act" => 1
                ];

                if (!$this->famille_model->ajouter_famille($famille)) {
                    echo $row;
                    return FALSE;
                }
            }

            return TRUE;
        }
    }

    public function creation_produits(){
        // Lecture des donnees - Famille epicerie
        $range = "Produit!A4:D1006";

        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            echo "<h1>Aucune donnees recoltes !!</h1>";
        } else {

            foreach ($values as $row) {
                $produit = [
                    "code_fam" => $row[0],
                    "folio" => $row[1],
                    "libelle_prod" => $row[2],
                    "prix" => $row[3]
                ];

                // var_dump($produit);

                if (!$this->produit_model->creer($produit)) {
                    echo $row;
                    die;
                }
            }

            return TRUE;
        }
    }
}