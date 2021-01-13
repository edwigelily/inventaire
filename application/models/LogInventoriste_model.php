<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogInventoriste_model extends CI_Model
{
    public $date_action;
    public $message_inv;
    public $id_inv;

    // Nom de la table
    private $table = 'logInventoriste';

    // Cle primaire de la table
    private $id = 'id_log_inv';

    public function __construct()
    {
        $this->load->database();
    }

    // fonction pour lister tous les logInventoriste
    public function tous_les_logInventoriste()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //fonction pour ajouter logInventoriste
    public function ajouter_logInventoriste($params)
    {
        return $this->db->insert($this->table, $params);
    }
}
