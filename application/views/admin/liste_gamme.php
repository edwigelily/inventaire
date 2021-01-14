<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/listing_admin.css">
    <title>Liste des produits ~ Dashboard Admin</title>
</head>

<body>
    <main>
        <div class="main-contenair">
            <header>
                <div class="header">
                    <a href="<?= site_url('admin') ?>" class="symbole">Retour au menu <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    <h2>ADMINISTRATEUR</h2>
                    <div class="btn-group-vertical " role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger rounded-0">
                            Déconnexion<i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        <button type="button" data-toggle="modal" data-target="#ModalAjouterProduit" class="btn btn-success mt-1 rounded-0">
                            Ajouter un produit
                        </button>
                    </div>
                    <!-- <span class="btn">déconnexion <i class="fa fa-trash" aria-hidden="true"></i></span> -->
                </div>
                <div class="second-section-header">
                    <ul>
                        <li> <a href="#">code famille</a> </li>
                        <li><a href="">folio</a></li>
                        <li><a href="">libellé</a></li>
                        <li><a href="">quantité en stock</a></li>
                    </ul>
                    <form>
                        <div class="recheche">
                            <input type="search" name="" id="recherche" placeholder="RECHERCHE">
                            <button type="submit"> <i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                    <span class="btn-champ"><a href="">Hors Champ</a></span>
                </div>
                <div class="banner-footer">
                    <a class="banner-link" href="#">Epicerie</a>
                    <a class="banner-link" href="#">Bazar</a>
                    <a class="banner-link" href="#">Liquides</a>
                    <a class="banner-link" href="#">Vivre Frais</a>
                    <a class="banner-link" href="#">Hors Gamme</a>
                </div>
            </header>
            <!-- =========================* modal ajouter un produit ===================== -->
            <!-- Modal -->
            <div class="modal fade" id="ModalAjouterProduit" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" action="<?= site_url('admin/ajouter_produit') ?>" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Ajouter ce Produit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="number" name="code" required class="form-control" placeholder="Code Famille">
                                </div>
                                <div class="col">
                                    <input type="number" name="prix" required class="form-control" placeholder="Prix de Vente">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="libelle" required class="form-control" placeholder="Libelle du Produit">
                                </div>
                                <div class="col">
                                    <input type="number" name="folio" required class="form-control" placeholder="Folio">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ================== Pagination ================= -->
            <?= $liens ?>
            <!-- ============================* liste *========================= -->
            <div class="table">
                <?php if ($this->session->flashdata('message-success')) :?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $this->session->flashdata('message-success') ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <table>
                    <thead>
                        <tr class="first-head">
                            <th>folio</th>
                            <th colspan="2">libellé</th>
                            <th>Prix de vente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($familles)): 
                            foreach($familles as $famille) :?>
                                <?php if (!empty($famille->produits)) : ?>
                                    <tr class="first-head">
                                        <th colspan="4" ><?= $famille->nom ?> - <?= $famille->code_fam ?></th>
                                    </tr>
                                    <?php foreach($famille->produits as $produit): ?>
                                        <tr>
                                            <td class="product"><?= $produit->folio ?></td>
                                            <td class="product" colspan="2"><?= $produit->libelle_prod ?></td>
                                            <td><?= $produit->prix ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalModifierProduit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= site_url('admin/modifier_produit') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier ce Produit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" name="folio" class="form-control" placeholder="Folio">
                        </div>
                        <div class="col">
                            <input type="number" name="prix" class="form-control" placeholder="Prix de Vente">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="libelle" class="form-control" placeholder="Libelle du Produit">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Valider</button>
                </div>
            </form>
        </div>
    </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
        $('.product').click((e) => {
            // On affiche la fenetre
            $('#ModalModifierProduit').modal('show');
            // On recupere le parent
            const parent = e.target.parentElement;

            // Recuperation des informations de la ligne
            const folio = parent.querySelector('td:first-child').textContent;
            const libelle = parent.querySelector('td:nth-child(2)').textContent;
            const prix = parent.querySelector('td:last-child').textContent;

            // Insertion des elements dans le placeholder
            document.forms[2].folio.value = folio;
            document.forms[2].libelle.value = libelle;
            document.forms[2].prix.value = prix;
        })
    </script>
</body>

</html>