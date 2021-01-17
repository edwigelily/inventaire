<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bazar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $client = new \Google_Client();
        
        // On choisit l'application
        $client->setApplicationName(NOM_APPLICATION);
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . '/credentials.json');

        // Declaration du service
        $service = new Google_Service_Sheets($client);
        
        $this->service = $service;
    }

    public function cece_bazar()
    {
        $spreadsheetId = "15JRiClCR2zwVXqJs-0rzEGyKi0CGFFHX5mrwohw5RTo";

        $activite_epicerie = [
            "nom_act" => "Bazar",
            "code_act" => 5,
            "id_cat" => 4
        ];

        if (!$this->activite_model->rechercher(5)) {
            // Insertion de l'activite
            $this->activite_model->ajouter_activite($activite_epicerie);
        }

        // Lecture des donnees - Famille epicerie
        $range = "Famille!A4:C13";

        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();  
        
        foreach ($values as $row)
        {
            if (!$this->famille_model->rechercher($row[1])) {
                $famille = [
                    "nom" => $row[0],
                    "code_fam" => $row[1],
                    "code_act" => 5
                ];

                $this->famille_model->ajouter_famille($famille);
            }
        }

        // Insertion des produits
        // Lecture des donnees - Famille epicerie
        $range2 = "Produit!A4:D327";

        $response2 = $this->service->spreadsheets_values->get($spreadsheetId, $range2);
        $values2 = $response2->getValues();  
        
        foreach ($values2 as $row2)
        {
            $produit = [
                "code_fam" => $row2[0],
                "folio" => $row2[1],
                "libelle_prod" => $row2[2],
                "prix" => (int)str_replace(" ", "", $row2[3])
            ];

            if (!$this->produit_model->creer($produit)) {
                echo $row;
                die;
            }
        }

    }

    public function jc_bazar()
    {
        // On prend le lien du formulaire
        $spreadsheetId = "1ID0_7GoaNW8TdNYTewcgACf71J66LHaTAe8NhmUdQuo";

        // Insertion des categories 
        $range_activite = "Activité!A4:C6";

        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range_activite);
        $activites = $response->getValues();         

        foreach ($activites as $activite) 
        {
            if (!$this->activite_model->rechercher($activite[1])) {

                $activite_temp= [
                    "nom_act" => $activite[0],
                    "code_act" => $activite[1],
                    "id_cat" => 4
                ];
                
                $this->activite_model->ajouter_activite($activite_temp);
            }
        }

        // Insertion des familles
        $range_famille = "Famille!A4:C15";

        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range_famille);
        $familles = $response->getValues();

        foreach ($familles as $famille)
        {
            if (!$this->famille_model->rechercher($famille[1])) {
                $famille = [
                    "nom" => $famille[0],
                    "code_fam" => $famille[1],
                    "code_act" => $famille[2]
                ];

                $this->famille_model->ajouter_famille($famille);
            }
        }


        // Insertion des produits
        $range_produit = "Produit!A4:D311";

        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range_produit);
        $produits = $response->getValues();  
        
        foreach ($produits as $value)
        {
            $produit = [
                "code_fam" => $value[0],
                "folio" => $value[1],
                "libelle_prod" => $value[2],
                "prix" => (int)$value[3]
            ];

            if (!$this->produit_model->creer($produit)) {
                echo $value;
                die;
            }
        }

    }

    public function lyde_bazar()
    {
        // On prend le lien du formulaire
        $spreadsheetId = "1Grtb3_3z4dhQeIrD4oJrubOFV--EIIJ2kR9RzmHQPNE";

        // Insertion des activites
        $activite = [
            "nom_act" => "DROGUERIE PAR",
            "code_act" => 4,
            "id_cat" => 4
        ];

        if (!$this->activite_model->rechercher($activite['code_act'])) {
            // Insertion de l'activite
            $this->activite_model->ajouter_activite($activite);
        }
        

        // Insertion des familles
        $famille_1 = [
            "nom" => "Soins et beauté de la chevelure, produits capil",
            "code_fam" => 640,
            "code_act" => 4
        ];

        $famille_2 = [
            "nom" => "Soins et beauté du corps",
            "code_fam" => 650,
            "code_act" => 4
        ];

        $this->famille_model->ajouter_famille($famille_1);
        $this->famille_model->ajouter_famille($famille_2);


        // Insertion des produits
        $range_produit = "Produit!A4:D418";

        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range_produit);
        $produits = $response->getValues();  
        
        foreach ($produits as $value)
        {
            $produit = [
                "code_fam" => $value[0],
                "folio" => $value[1],
                "libelle_prod" => $value[2],
                "prix" => (int)$value[3]
            ];

            if (!$this->produit_model->creer($produit)) {
                echo $value;
                die;
            }
        }

    }
}