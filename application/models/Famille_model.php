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

    public function famille_categorie($id_cat)
    {
        $sql = "SELECT * FROM famille
        INNER JOIN activite ON famille.code_act = activite.code_act WHERE id_cat = ?";

        return $this->db->query($sql, $id_cat)-> result();
    }

    public function famille_categorie_intervalle($id_cat, $limit, $debut)
    {
        $this->db->limit($limit, $debut);
        $this->db->join('activite', 'activite.code_act=famille.code_act');

        return $this->db->get_where($this->table, array('famille.code_act' => $id_cat) ,$limit, $debut)-> result();
    }
    
    public function nombre_famille_categorie($id_cat)
    {
        $sql = "SELECT * FROM famille
        INNER JOIN activite ON famille.code_act = activite.code_act WHERE id_cat = ?";

        return $this->db->query($sql, $id_cat)->num_rows();
    }

    public function ajouter_famille($params) //fonction pour ajouter une famille
    {

        return $this->db->insert($this->table, $params);
    }

}