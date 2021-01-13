<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogAdmin_model extends CI_Model
{
    public $date_action;
    public $message_ad;
    public $id_ad;

    // Nom de la table
    private $table = 'logAdmin';

    // Cle primaire de la table
    private $id = 'id_log_ad';

    public function __construct()
    {
        $this->load->database();
    }

    // fonction pour lister tous les logAdmin
    public function tous_les_logAdmin()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //fonction pour ajouter logAdmin
    public function ajouter_logAdmin($params)
    {
        return $this->db->insert($this->table, $params);
    }
}
