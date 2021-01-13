<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public $nom_ad;
    public $email_ad;
    public $mot_passe_ad;
    public $id_surc;

    // Nom de la table
    private $table = 'admin';

    // Cle primaire de la table
    private $id = 'id_ad';

    public function __construct()
    {
        $this->load->database();
    }

    // fonction pour lister tous les admins
    public function tous_les_admin()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //fonction pour ajouter un admin
    public function ajouter_admin($params) 
    {
        return $this->db->insert($this->table, $params);
    }

    //connexion admin
    public function connexion($params)
    {
        $this->email_ad   = $params['email_ad'];
        $this->mot_passe_ad  = $params['mot_passe_ad'];
        $query = $this->db->get_where($this->table, array('email_ad' => $params['email_ad'], 'mot_passe_ad' => $params['mot_passe_ad']));

        return $query->row();
    }

    //Supprimer admin
    public function supprimer_admin($params)
    {
        return $this->db->delete($this->table, array('id' => $params['id']));
    }

}