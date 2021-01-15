<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quantite_model extends CI_Model
{   
    public $q_surf;
    public $q_res;
    public $s_surf;
    public $s_res;
    public $folio;

    // Nom de la table
    private $table = 'quantite';

    // Cle primaire de la table
    private $id = 'id_quant';

    public function __construct()
    {
        $this->load->database();
    }

    // Recoit un tableau qui contient les valeurs pour sauvegarder des quantités
    public function creer($params)
    {
       return $this->db->insert($this->table, $params);
        
    }

    public function rechercher($folio)
    {
        $query = $this->db->get_where($this->table, array('folio' => $folio));
        return $query->row();
    }

     public function modifier($id)
    {
        return $this->db->update($this->table, $this, array($this->id => $id));
    }
}

?>
