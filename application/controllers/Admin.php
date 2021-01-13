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

    public function listing_gamme()
    {
        $produits = $this->produit_model->lister_tout_produit();

        var_dump($produits);
    }

    public function modifier_prix_produit()
    {
        $prix = $this->input->post('prix');
        $folio = $this->input->post('folio');

        if (empty($folio)) {
            echo "Is none";
        } else {
            var_dump($folio);
        }
        die;
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