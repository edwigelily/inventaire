<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activite_model extends CI_Model
{
    
    public $nom_act;
    public $id_cat;

    // Nom de la table
    private $table = 'activite';

    // Cle primaire de la table
    private $id = 'code_act';

    public function __construct()
    {
        $this->load->database();
    }

    public function toutes_les_activite() // fonction pour lister toutes les activités
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ajouter_activite($params) //fonction pour ajouter activité
    {

        return $this->db->insert($this->table, $params);
    }

}