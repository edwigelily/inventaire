<form class="form-inline row" action="<?= site_url('admin/recherche_produit') ?>">
    <div class="col-lg-10">
        <input class="form-control w-100" value="<?= isset($value) ? $value : '' ?>" name="q" type="search" placeholder="Entrer le libelle ou le folio d'un produit" aria-label="Search">
    </div>
    <button class="btn btn-primary my-2 my-sm-0" type="submit">
        <i class="fa fa-search" aria-hidden="true"></i>
    </button>
</form>