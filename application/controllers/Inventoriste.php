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
        $this->load->view('accueil');
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
