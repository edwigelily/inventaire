<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Famille_model extends CI_Model
{
    public $nom;
    public $code_fam;
    public $code_act;

    // Nom de la table
    private $table = 'famille';

    // Cle primaire de la table
    private $id = 'id_fam';

    public function __construct()
    {
        $this->load->database();
    }

    public function toutes_les_familles() // fonction pour lister tous les familles
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ajouter_famille($params) //fonction pour ajouter une famille
    {

        return $this->db->insert($this->table, $params);
    }

}