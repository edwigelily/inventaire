<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/nom_gamme.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/listing.css">
    <title>Listing</title>
</head>

<body>
    <main>
        <div class="main-contenair">
            <header>
                <div class="header">
                    <div class="symbole">inventaire <br> <span style="margin-left: 1.5rem;">G043</span></div>
                    <h2>Resultats</h2>
                    <span class="btn">déconnexion <i class="fa fa-trash" aria-hidden="true"></i></span>
                </div>
                <div class="container my-4 py-3">
                    <form class="form-inline row" action="<?= site_url('inventoriste/recherche_produit') ?>">
                        <div class="col-lg-8">
                            <input class="form-control w-100" value="<?= isset($value) ? $value : '' ?>" name="q" type="search" placeholder="Entrer le libelle ou le folio d'un produit" aria-label="Search">
                        </div>
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </header>
            <!-- ============================* liste *========================= -->
            <div class="table">
                <!-- ================== Pagination ================= -->
                <!-- <?= $liens ?> -->

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
                            <th>quantité en rayon</th>
                            <th>quantité en stock</th>
                            <th>total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- le produit identique -->
                        <?php if (!empty($produit)) : ?>
                            <tr class="bg-blue" data-key="<?= $produit->code_fam ?>">
                                <td class="product"><?= $produit->folio ?></td>
                                <td colspan="2" class="product" colspan="2"><?= $produit->libelle_prod ?></td>
                                <td><?= $produit->prix ?></td>
                                <td><?= $produit->q_surf ?></td>
                                <td><?= $produit->q_res ?></td>
                                <td><?= number_format(($produit->q_surf + $produit->q_res) * $produit->prix, 0, ',', ' ') ?> FCFA</td>
                            </tr>
                        <?php endif; ?>

                        <!-- fin -->

                        <?php if (!empty($produits_similaires) && count($produits_similaires) > 1): ?>
                            <?php foreach($produits_similaires as $produit): ?>
                                <tr data-key="<?= $produit->code_fam ?>">
                                    <td class="product"><?= $produit->folio ?></td>
                                    <td colspan="2" class="product" colspan="2"><?= $produit->libelle_prod ?></td>
                                    <td><?= $produit->prix ?></td>
                                    <td><?= $produit->q_surf ?></td>
                                    <td><?= $produit->q_res ?></td>
                                    <td><?= number_format(($produit->q_surf + $produit->q_res) * $produit->prix, 0, ',', ' ') ?> FCFA</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="ModalModifierProduit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= site_url('inventoriste/ajouter_quantite/') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier ce Produit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="code" disabled class="form-control" placeholder="Code">
                        </div>
                        <div class="col">
                            <input type="text" name="prix" disabled class="form-control" placeholder="Prix de Vente">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="folio" disabled class="form-control" placeholder="Folio">
                        </div>
                        <div class="col">
                            <input type="text" name="libelle" disabled class="form-control" placeholder="Prix de Vente">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" name="q_surf" class="form-control" placeholder="Quantite en Surface">
                        </div>
                        <div class="col">
                            <input type="number" name="q_res" class="form-control" placeholder="Quantite en Stock">
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
            const prix = parent.querySelector('td:nth-child(3)').textContent;
            const qSurf = parent.querySelector('td:nth-child(4)').textContent;
            const qRes = parent.querySelector('td:nth-child(5)').textContent;
            const famille = parent.getAttribute('data-key');

            // Insertion des elements dans le placeholder
            document.forms[1].folio.value = `Folio: ${folio}`;
            document.forms[1].libelle.value = libelle;
            document.forms[1].prix.value = `Prix: ${prix} FCFA`;
            document.forms[1].code.value = `Code Famille: ${famille}`;
            if (qSurf !== "0") {
                document.forms[1].q_surf.value = qSurf;
            }

            if (qRes !== "0") {
                document.forms[1].q_res.value = qRes;
            }

            document.forms[1].action += `${folio}`;
        })
    </script>
</body>

</html>