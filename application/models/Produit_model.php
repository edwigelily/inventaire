<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produit_model extends CI_Model
{   
    public $id_prod;
    public $libelle_prod;
    public $prix;
    public $code_fam;


    // Nom de la table
    private $table = 'produit';

    // Cle primaire de la table
    private $id = 'folio';

    public function __construct()
    {
        $this->load->database();
    }

    // Recoit un tableau qui contient les valeurs pour creer un produit
    public function creer($params)
    {
       return $this->db->insert($this->table, $params);
        
    }

    //Lister des produits
    public function lister_tout_produit()
    {
        $sql = "SELECT * FROM produit";
        return $this->db->query($sql)-> result();
    }

    public function lister_produit_famille($id)
    {
        $sql = "SELECT * FROM produit WHERE code_fam=?";
        return $this->db->query($sql,$id)-> result();
    }

    public function lister_produit_activite($id)
    {
        $sql = "SELECT * FROM produit INNER JOIN famille ON famille.code_fam = produit.code_fam
                WHERE code_act = ?";
         return $this->db->query($sql, $id)-> result();
    }

    public function lister_produit_categorie($id)
    {
        $sql = "SELECT * FROM produit INNER JOIN(SELECT code_fam FROM famille
                INNER JOIN activite ON famille.code_act = activite.code_act WHERE id_cat = ?";
         return $this->db->query($sql,$id)-> result();
    }
    
    //modifier le prix
    public function modifier_prix($id, $prix)
    {
        return $this->db->update($this->table, array('prix' => $prix), array($this->id => $id));
    }

    //supprimr un produit
    public function supprimer($id)
    {
        return $this->db->delete($this->table, array($this->id => $id));
    }
}