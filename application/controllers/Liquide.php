<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liquide extends CI_Controller {

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
        
        $this->spreadsheetId = LIEN_SHEET_LIQUIDE;
        $this->service = $service;

    }

    public function creation_activite(){

        $activite_liquide = [
            "nom_act" => "Liquide",
            "code_act" => 2,
            "id_cat" => 2
        ];

        if ($this->activite_model->ajouter_activite($activite_liquide)) {
            echo "<h1>Insertion avec succes</h1>";
        }
    }

    public function creation_famille(){
        // Lecture des donnees - Famille epicerie
        $range = "Famille!A4:C12";

        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            echo "<h1>Aucune donnees recoltes !!</h1>";
        } else {

            foreach ($values as $row) {

                $famille = [
                    "nom" => $row[0],
                    "code_fam" => $row[1],
                    "code_act" => $row[2]
                ];

                if (!$this->famille_model->ajouter_famille($famille)) {
                    echo "Erreur d'insertion \n";
                    echo $row;
                    die;
                }
            }

            echo "<h1>Insertion des familles avec succes</h1>";
        }
    }

    public function creation_produits(){
        // Lecture des donnees - Famille epicerie
        $range = "Produit!A4:D748";

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
                    echo "Erreur d'insertion du produit \n";
                    echo $row;
                    die;
                }
            }

            echo "<h1>Insertion des produits avec succes</h1>";
        }
    }
}