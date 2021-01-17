<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Chargement des modeles
        $this->load->model('admin_model');
    }

    private function est_connecte()
	{
		$CI = &get_instance();

		$token_admin = $CI->session->userdata('token_admin');

		return $token_admin != null;
	}

    public function index()
    {
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        $this->load->view('admin/accueil');

    }

    public function connexion()
    {
        $this->load->view('admin/connexion');
    }

    public function traitement_connexion()
    {
        // On récupère les informations venant du formulaire
		$email     = $this->input->post('email');
        $mot_passe = $this->input->post('password');
        
        $admin_info = [
            'email_ad' => $email,
            'mot_passe_ad' => $mot_passe
        ];

        $admin = $this->admin_model->connexion($admin_info);
        
        if ($admin) {
            $this->session->set_userdata('token_admin', md5(time()));
            $this->session->set_userdata('nom_admin', $admin->nom_ad);
            $this->session->set_userdata('email_admin', $admin->email_ad);

            redirect('admin');
        }
    }

    public function fiche_recapitulatif()
    {
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        // Chargement du modele
        // $this->load->model('activite_model');

        $activites = $this->activite_model->toutes_les_activite();

        $montant_final = 0;

        foreach ($activites as $activite)
        {
            $total_montant = 0;
            $activite->familles = $this->famille_model->famille_activite($activite->code_act);
            // Ajout des produits par quantite
            foreach($activite->familles as $famille)
            {
                $produits = $this->produit_model->lister_produit_qte_famille($famille->code_fam);

                $produits = array_map(function ($produit){
                    return ($produit->q_surf + $produit->q_res) * $produit->prix;
                }, $produits);

                $famille->montant = array_sum($produits);
                $total_montant += $famille->montant;
            }

            $activite->total_montant = $total_montant;
            $montant_final += $total_montant;
        }

        $data = [
            "activites" => $activites,
            "montant_total" => $montant_final
        ];

        $this->load->view('admin/recapitulatif', $data);
    }

    public function listing_gamme($id_cat=1)
    {
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        // Configuration de la pagination
        $this->load->library('pagination');

		$config['base_url'] = site_url('admin/listing_gamme/' . $id_cat);
		$config['total_rows'] = $this->famille_model->nombre_famille_categorie($id_cat);
		$config["per_page"] = 2;
        $config["uri_segment"] = 3;
        
        // var_dump($this->famille_model->nombre_famille_categorie($id_cat));

        $this->pagination->initialize($config);
        
        $page = empty($this->input->get('p')) ? 0 : $this->input->get('p');
        $familles = $this->famille_model->famille_categorie_intervalle($id_cat, $config['per_page'], $page);

        if (!empty($familles)) {
            foreach($familles as $famille){
                // On recupere les produits d'une famille
                $famille->produits = $this->produit_model->lister_produit_famille($famille->code_fam);
            }
        }


        $data = [
            "familles" => $familles,
            "liens" => $this->pagination->create_links()
        ];

        $this->load->view('admin/liste_gamme', $data);
    }

    public function recherche_produit()
    {
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
            $value = (int)str_replace(" ", "", $value);
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
                'value' => show_folio($value)
            ];

        }


        $this->load->view('admin/resultats.php', $data);
    }

    public function modifier_produit()
    {
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        // Recuperation des informations
        $prix = $this->input->post('prix');
        $libelle = $this->input->post('libelle');
        $folio = $this->input->post('folio');

        $produit = [
            'prix' => $prix,
            'libelle_prod' => $libelle,
        ];

        if($this->produit_model->modifier($folio, $produit))
        {
            $this->session->set_flashdata('message-success', "Mis a jour correcte du produit $folio !!");
            redirect('admin/listing_gamme');
        }
    }

    public function ajouter_produit()
    {
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        // Recuperation des informations
        $prix = $this->input->post('prix');
        $libelle = $this->input->post('libelle');
        $folio = $this->input->post('folio');
        $code_famille = $this->input->post('code');

        $produit = [
            'folio' => $folio,
            'prix' => $prix,
            'code_fam' => $code_famille,
            'libelle_prod' => $libelle
        ];

        if ($this->produit_model->creer($produit)) {
            $this->session->set_flashdata('message-success', "Nouveau!!: Le produit $folio a ete ajoute");
            redirect('admin/listing_gamme');
        }
    }

    public function inventaire($id_cat=1)
    {
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        // Penser a filtrer les familles qui n'appartiennent pas a la categorie
        $familles = $this->famille_model->famille_categorie($id_cat);


        foreach($familles as $famille){

            // On recupere les produits d'une famille
            $famille->produits = $this->produit_model->lister_produit_qte_famille($famille->code_fam);

            // On recupere le montant total

            $prix_produits = array_map(function($prod){
                return ($prod->q_surf + $prod->q_res) * $prod->prix;
            }, $famille->produits);

            $famille->montant = array_sum($prix_produits);
        }


        $data = [
            "familles" => $familles,
        ];

        $this->load->view('admin/listing', $data);
    }

    public function gestion_compte()
    {
        // Authentification
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        $admin_actuelle = $this->admin_model->par_email($this->session->userdata('email_admin'));

        // Chargement des models
        $this->load->model('admin_model');

        // Recuperation des inventoristes
        $inventoristes = $this->inventoriste_model->tous_les_inventoriste();
        $admins = $this->admin_model->tous_les_admin();

        $data = [
            "utilisateurs" => array_merge($inventoristes, $admins),
            "admin" => $admin_actuelle
        ];

        $this->load->view('admin/gestion_comptes', $data);
    }

    public function creer_compte()
    {
        // Authentification
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        // Recuperation des donnees
        $nom_complet = $this->input->post('nom_complet');
        $email = $this->input->post('email');

        $type = $this->input->post('type');

        // Creation des comptes
        if ($type === "1") {
            // Creation inventoriste
            $inventoriste = [
                'nom_inv' => $nom_complet,
                'email_inv' => $email,
                'mot_passe_inv' => 1234,
                'id_surc' => 1
            ];

            if ($this->inventoriste_model->ajouter_inventoriste($inventoriste)) {
                $this->session->set_flashdata('message-success', "Inventoriste ajoute");
                redirect('admin/gestion_compte');
            }
        }

    }

    public function supprimer_compte()
    {
        // Authentification
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        } 

        // Recuperation des donnees
        $type_compte = $this->input->post('type');
        $id = $this->input->post('key');

        if ($type_compte === "1") {
            if ($user = $this->inventoriste_model->supprimer_inventoriste($id)) {
                $this->session->set_flashdata('message-success', "Compte supprime !!");
                redirect('admin/gestion_compte');
            }
        } else {
            if ($user = $this->admin_model->supprimer_admin($id)) {
                $this->session->set_flashdata('message-success', "Admin $user->nom_ad supprime !!");
                redirect('admin/gestion_compte');
            }
        }
    }

}