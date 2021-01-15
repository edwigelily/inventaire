<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventaire_model extends CI_Model
{   
    public $date_debut;
    public $date_fin;
    public $gamme;
    public $fiche_recap;
    public $id_surc;
    public $id_ad;


    // Nom de la table
    private $table = 'inventaire';

    // Cle primaire de la table
    private $id = 'id_in';

    public function __construct()
    {
        $this->load->database();
    }

    public function debut_inv($params)
    {
       return $this->db->insert($this->table, $params);
        
    }

    public function fin_inv($id_in, $gamme, $fiche_recap, $date_fin)
    {
        return $this->db->update($this->table, array($this->id => $id_in), array('gamme' => $gamme),
                                 array('fiche_recap' => $fiche_recap), array('date_fin' => $date_fin));
    }
}
?>