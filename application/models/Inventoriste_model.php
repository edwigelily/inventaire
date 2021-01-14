<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventoriste_model extends CI_Model
{
    public $nom_inv;
    public $email_inv;
    public $mot_passe_inv;
    public $id_surc;
    public $id_cat;

    // Nom de la table
    private $table = 'inventoriste';

    // Cle primaire de la table
    private $id = 'id_inv';

    public function __construct()
    {
        $this->load->database();
    }

    // fonction pour lister tous les inventoristes
    public function tous_les_inventoriste()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //fonction pour ajouter un inventoriste
    public function ajouter_inventoriste($params)
    {
        return $this->db->insert($this->table, $params);
    }

    //connexion inventoriste
    public function connexion($params)
    {
        $this->email_inv   = $params['email_inv'];
        $this->mot_passe_inv  = $params['mot_passe_inv'];
        $query = $this->db->get_where($this->table, array('email_inv' => $params['email_inv'], 'mot_passe_inv' => $params['mot_passe_inv']));

        return $query->row();
    }

    //Recupérer un inventoriste en fonction de son adresse e-mail
    public function par_email($email)
    {
        $query = $this->db->get_where($this->table, array('email_inv' => $email));
        return $query->row();
    }

    //Supprimer inventoriste
    public function supprimer_inventoriste($params)
    {
        return $this->db->delete($this->table, array('id' => $params['id']));
    }
}
