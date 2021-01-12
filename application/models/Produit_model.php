<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produit_model extends CI_Model
{
    // Nom de la table
    private $table = 'produit';

    // Cle primaire de la table
    private $id = 'id_prod';

    public function __construct()
    {
        $this->load->database();
    }

    // Recoit un tableau qui contient les valeurs pour creer un produit
    public function creer($params)
    {
        $this->db->insert($this->table, $params);
    }
}