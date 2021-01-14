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

    public function listing_gamme($id_cat=1)
    {
        if (!$this->est_connecte()) {
            redirect('admin/connexion');
        }

        // Configuration de la pagination
        $this->load->library('pagination');

		$config['base_url'] = site_url('admin/listing_gamme');
		$config['total_rows'] = $this->famille_model->nombre_famille_categorie($id_cat);
		$config["per_page"] = 2;
        $config["uri_segment"] = 3;
        
        // var_dump($this->famille_model->nombre_famille_categorie($id_cat));

        $this->pagination->initialize($config);
        
        $page = empty($this->input->get('p')) ? 0 : $this->input->get('p');
        $familles = $this->famille_model->famille_categorie_intervalle($id_cat, $config['per_page'], $page);


        foreach($familles as $famille){
            // On recupere les produits d'une famille
            $famille->produits = $this->produit_model->lister_produit_famille($famille->code_fam);
        }


        $data = [
            "familles" => $familles,
            "liens" => $this->pagination->create_links()
        ];

        $this->load->view('admin/liste_gamme', $data);
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
        }


        $data = [
            "familles" => $familles,
        ];

        $this->load->view('admin/listing', $data);
    }

}