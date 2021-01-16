<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventoriste extends CI_Controller
{
    // methode générale
    public function index()
    {

        if (!$this->est_connecte()) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $inventoriste = $this->inventoriste_model->par_email($this->session->userdata('email_invent'));


        if (!$inventoriste) {
            redirect('inventoriste/connexion_inventoriste');
        }
        //listing des produits
        $categories = $this->produit_model->lister_tout_categorie();


        $this->load->view('accueil', ['categories' => $categories]);
    }

    //listing des categorie par choix inventoriste
    public function listing($id_cat)
    {
        if (!$this->est_connecte()) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $inventoriste = $this->inventoriste_model->par_email($this->session->userdata('email_invent'));

        if (!$inventoriste) {
            redirect('inventoriste/connexion_inventoriste');
        }

        // Chargement du model 
        $this->load->model('quantite_model');

        //Phase 1:  On attribue la categorie a un inventoriste si c'est possible
        $autres_inventoristes = $this->inventoriste_model->tous_les_inventoriste();

        foreach ($autres_inventoristes as $autre_inv)
        {
            // Si un autre inventoriste gere la gamme, on est redirige
            if ($autre_inv->id_cat === $id_cat && $autre_inv->id_inv !== $inventoriste->id_inv) {
                $this->session->set_flashdata('message', "Cette Categorie est deja gere par $autre_inv->nom_inv");
                redirect('inventoriste');
            }
        }

        // Attribution de la categorie
        if (!$this->inventoriste_model->attribuer_categorie($inventoriste->id_inv, $id_cat)) {
            $this->session->set_flashdata('message-error', "Une erreur s'est produite");
            redirect('inventoriste');
        }

        // Phase 2: Listing des produits de la categorie

        // Gestion de la pagination
        // Configuration de la pagination
        $this->load->library('pagination');

		$config['base_url'] = site_url('inventoriste/listing/' . $id_cat);
		$config['total_rows'] = $this->famille_model->nombre_famille_categorie($id_cat);
		$config["per_page"] = 2;
        $config["uri_segment"] = 3;
        
        // Initialisation
        $this->pagination->initialize($config);
        
        $page = empty($this->input->get('p')) ? 0 : $this->input->get('p');
        $familles = $this->famille_model->famille_categorie_intervalle($id_cat, $config['per_page'], $page);


        foreach($familles as $famille){
            // Etape 2 : On recupere les produits d'une famille
            $famille->produits = $this->produit_model->lister_produit_famille($famille->code_fam);

            // Il faut filtrer les produit hors_gamme
            $famille->produits = array_filter($famille->produits, function ($prod){
                return $prod->h_gamme == 1;
            });

            // Etape 3 : On trouve les quantites de ces produits sinon on attribue 0 partout
            foreach($famille->produits as $produit)
            {
                if($quantite = $this->quantite_model->rechercher($produit->folio))
                {
                    $produit->q_surf = $quantite->q_surf;
                    $produit->q_res = $quantite->q_res;
                } else {
                    $produit->q_surf = 0;
                    $produit->q_res = 0;
                }
            }

        }

        // Nom de la gamme
        $categorie_actuelle = $this->produit_model->recherche_categorie($id_cat);

        // Creation de la donnee pour le template
        $data = [
            "familles" => $familles,
            "nom_categorie" => $categorie_actuelle->nom_cat,
            "liens" => $this->pagination->create_links()
        ];


        $this->load->view('listing', $data);
    }

    public function listing_hors_gamme($id_cat)
    {
        if (!$this->est_connecte()) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $inventoriste = $this->inventoriste_model->par_email($this->session->userdata('email_invent'));

        if (!$inventoriste) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $produits = $this->produit_model->lister_hors_gamme();

        var_dump($produits);
    }

    public function ajouter_quantite($folio)
    {
        // Verification utilisateur
        if (!$this->est_connecte()) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $inventoriste = $this->inventoriste_model->par_email($this->session->userdata('email_invent'));

        if (!$inventoriste) {
            redirect('inventoriste/connexion_inventoriste');
        }

        // Chargement des modeles
        $this->load->model('quantite_model');

        // Recuperation des quantites
        $quantite_res = $this->input->post('q_res');
        $quantite_surf = $this->input->post('q_surf');

        if (!empty($this->input->post('hors_gamme'))) {
            
            $this->produit_model->mettre_produit_hors_gamme($folio);
        }

        if ($this->quantite_model->rechercher($folio)) {
            // Mis a jour
            $produit = [
                "q_res" => empty($quantite_res) ? 0 : $quantite_res,
                "q_surf" => empty($quantite_surf) ? 0 : $quantite_surf
            ];

            if ($this->quantite_model->modifier($folio, $produit)) {
                $this->session->set_flashdata('message-success', "Produit " . show_folio($folio) . " mis a jour");
                redirect('inventoriste/listing/' . $inventoriste->id_cat);
            }

        } else {
            $produit = [
                "folio" => $folio,
                "q_res" => empty($quantite_res) ? 0 : $quantite_res,
                "q_surf" => empty($quantite_surf) ? 0 : $quantite_surf
            ];

            if ($this->quantite_model->creer($produit)) {
                $this->session->set_flashdata('message-success', "Produit $folio mis a jour");
                redirect('inventoriste/listing/' . $inventoriste->id_cat);
            }
        }
    }

    // Ajouter un produit hors gamme
    public function ajouter_hors_gamme()
    {
        // Verification utilisateur
        if (!$this->est_connecte()) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $inventoriste = $this->inventoriste_model->par_email($this->session->userdata('email_invent'));

        if (!$inventoriste) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $produit = [
            'code_fam' => $this->input->post('code'),
            'prix' => $this->input->post('prix'),
            'libelle_prod' => $this->input->post('libelle'),
            'folio' => $this->input->post('folio'),
            'h_gamme' => 0
        ];

        if ($this->produit_model->creer($produit)) {
            $folio = $this->input->post('folio');

            // Chargement des modeles
            $this->load->model('quantite_model');

            // Recuperation des quantites
            $quantite_res = $this->input->post('q_res');
            $quantite_surf = $this->input->post('q_surf');

            if ($this->quantite_model->rechercher($folio)) {
                // Mis a jour
                $produit = [
                    "q_res" => empty($quantite_res) ? 0 : $quantite_res,
                    "q_surf" => empty($quantite_surf) ? 0 : $quantite_surf
                ];
                if ($this->quantite_model->modifier($folio, $produit)) {
                    $this->session->set_flashdata('message-success', "Produit " . show_folio($folio) . " mis a jour");
                    redirect('inventoriste/listing/' . $inventoriste->id_cat);
                }
            } else {
                $produit = [
                    "folio" => $folio,
                    "q_res" => empty($quantite_res) ? 0 : $quantite_res,
                    "q_surf" => empty($quantite_surf) ? 0 : $quantite_surf
                ];
    
                if ($this->quantite_model->creer($produit)) {
                    $this->session->set_flashdata('message-success', "Produit $folio mis a jour");
                    redirect('inventoriste/listing/' . $inventoriste->id_cat);
                }
            }
        }
    }

    // Rechercher produit
    public function recherche_produit()
    {
        // Verification utilisateur
        if (!$this->est_connecte()) {
            redirect('inventoriste/connexion_inventoriste');
        }

        $inventoriste = $this->inventoriste_model->par_email($this->session->userdata('email_invent'));

        if (!$inventoriste) {
            redirect('inventoriste/connexion_inventoriste');
        }

        // Chargement des modeles
        $this->load->model('quantite_model');

        // Etape 1: On recupere la valeur
        $value = $this->input->get("q");

        // On filtre, on verifie si c'est un folio ou pas
        $pattern = '/^[\d ]{2,7}$/';
        preg_match($pattern, $value, $matches);

        $data = [];

        if (empty($matches)) {
            // Si c'est un libelle
            $produits_similaires = $this->produit_model->rechercher_produits_similaire_libelle($value);

            // Etape 3 : On trouve les quantites de ces produits sinon on attribue 0 partout
            if (!empty($produits_similaires)) {
                foreach($produits_similaires as $produit)
                {
                    if($quantite = $this->quantite_model->rechercher($produit->folio))
                    {
                        $produit->q_surf = $quantite->q_surf;
                        $produit->q_res = $quantite->q_res;
                    } else {
                        $produit->q_surf = 0;
                        $produit->q_res = 0;
                    }
                }
            }

            $data = [
                'produits_similaires' => $produits_similaires,
                'value' => $value
            ];

        } else {
            $value = (int)str_replace(" ","", $value);
            // Si c'est un numero
            $produit_exacte = $this->produit_model->rechercher_produit_folio($value);
            $produits_similaires = $this->produit_model->rechercher_produits_similaire_folio($value);

            // Etape 3 : On trouve les quantites de ces produits sinon on attribue 0 partout
            if (!empty($produit_exacte)) {
                if ($quantite = $this->quantite_model->rechercher($produit_exacte->folio)) {
                    $produit_exacte->q_surf = $quantite->q_surf;
                    $produit_exacte->q_res = $quantite->q_res;
                } else {
                    $produit_exacte->q_surf = 0;
                    $produit_exacte->q_res = 0;
                }
    
            }

            if (!empty($produits_similaires)) {
                foreach($produits_similaires as $produit)
                {
                    if($quantite = $this->quantite_model->rechercher($produit->folio))
                    {
                        $produit->q_surf = $quantite->q_surf;
                        $produit->q_res = $quantite->q_res;
                    } else {
                        $produit->q_surf = 0;
                        $produit->q_res = 0;
                    }
                }
            }

            $data = [
                'produit' => $produit_exacte,
                'produits_similaires' => $produits_similaires,
                'value' => $value
            ];

        }

        $this->load->view('resultat_folio', $data);

    }

    //gestion de l'inventoriste connecté

    private function est_connecte()
    {
        $CI = &get_instance();

        $CI->load->library('session');

        $token_invent = $CI->session->userdata('token_invent');

        return  $token_invent != null;
    }

    // connexion de l'inventoriste
    public function connexion_inventoriste()
    {
        $this->session->sess_destroy();
        $this->load->view('connexion');
    }
    // deconnexion de l'inventoriste
    public function deconnexion()
    {
        $this->session->sess_destroy();
        redirect('inventoriste/connexion_inventoriste');
    }

    //traitement connexion de l'invotoriste

    public function traitement_connexion_inventoriste()
    {
        //récupération des données
        $email_util   = $this->input->post('identtifiant');
        $mot_passe  = $this->input->post('mdp');
        $param =  [
            'email_inv' => $email_util,
            'mot_passe_inv' => $mot_passe
        ];
        // Validation des données

        //insertion d'information
        $inventoriste = $this->inventoriste_model->connexion($param);

        if ($inventoriste) {
            $this->session->set_userdata('token_invent', md5(time()));
            $this->session->set_userdata('nom_invent', $inventoriste->nom_inv);
            $this->session->set_userdata('email_invent', $inventoriste->email_inv);

            redirect('inventoriste');
        } else {
            $this->session->set_flashdata('message', "Nom d'utilisateur ou mot de passe incorrect");
            $this->session->set_flashdata('nom_util', $email_util);
            redirect('inventoriste/connexion_inventoriste');
        }
    }
}
