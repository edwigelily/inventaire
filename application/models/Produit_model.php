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
        return $this->db->query($sql)->result();
    }
    // lister les catégories
    public function lister_tout_categorie()
    {
        $sql = "SELECT * FROM categorie";
        return $this->db->query($sql)->result();
    }

    // Renvoyer une categorie
    public function recherche_categorie($id_cat)
    {
        $sql = "SELECT * FROM categorie WHERE id_cat = ?";
        return $this->db->query($sql, $id_cat)->row();   
    }

    public function lister_produit_qte()
    {
        $sql = "SELECT code_fam,produit.folio,libelle_prod,prix,q_surf,q_res,s_surf,s_res
                 FROM produit INNER JOIN quantite ON produit.folio = quantite.folio";
        return $this->db->query($sql)->result();
    }

    public function lister_produit_qte_famille($code_fam)
    {
        $sql = "SELECT code_fam,produit.folio,libelle_prod,prix,q_surf,q_res,s_surf,s_res
                 FROM produit INNER JOIN quantite ON produit.folio = quantite.folio WHERE code_fam=?";
        return $this->db->query($sql, $code_fam)-> result(); 
    }

    public function lister_produit_famille($id)
    {
        $sql = "SELECT * FROM produit WHERE code_fam=?";
        return $this->db->query($sql, $id)->result();
    }

    public function lister_produit_activite($id)
    {
        $sql = "SELECT * FROM produit INNER JOIN famille ON famille.code_fam = produit.code_fam
                WHERE code_act = ?";
        return $this->db->query($sql, $id)->result();
    }

    public function lister_produit_categorie($id)
    {
        $sql = "SELECT * FROM produit INNER JOIN(SELECT code_fam FROM famille
                INNER JOIN activite ON famille.code_act = activite.code_act WHERE id_cat = ?)AS alpha";
         return $this->db->query($sql,$id)-> result();
    }

    public function rechercher_produit_folio($folio)
    {
        return $this->db->get_where($this->table, array('folio' => $folio))->row();
    }
    
    public function rechercher_produits_similaire_libelle($libelle)
    {
        $this->db->like('libelle_prod', $libelle);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function rechercher_produits_similaire_folio($folio)
    {
        $this->db->like('folio', $folio);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    //modifier le prix
    public function modifier_prix($id, $prix)
    {
        return $this->db->update($this->table, array('prix' => $prix), array($this->id => $id));
    }

    //modifier le prix
    public function modifier($folio, $params)
    {
        return $this->db->update($this->table, $params, array($this->id => $folio));
    }

    //supprimr un produit
    public function supprimer($id)
    {
        return $this->db->delete($this->table, array($this->id => $id));
    }

    //modifier le prix
    public function mettre_produit_hors_gamme($id)
    {
        return $this->db->update($this->table, array('code_fam' => 0), array($this->id => $id));
    }
}
