<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/gestion_comptes.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../icone/css/font-awesome.min.css">
    <title>Gestion Des Comptes</title>
</head>

<body>
    <main>
        <div class="main-contenair">
            <header>
                <div class="header">
                    <div class="symbole">inventaire <br> <span style="margin-left: 1.5rem;">G043</span></div>
                    <h2>Gestionnaire de Compte</h2>
                    <span class="btn">déconnexion <i class="fa fa-trash" aria-hidden="true"></i></span>
                </div>
                <div class="second-section-header">
                    <form  action="<?= site_url('admin/creer_compte') ?>" method="POST">
                        <div class="content_form">
                            <h3>créer un compte</h3>
                            <div class="compte_creer">
                                <input type="text" name="nom_complet" id="nom" placeholder="Nom et Prénom">
                                <input type="email" name="email" id="email" placeholder="Adresse mail">
                                <select name="type" id="compte" class="selectionne">
                                    <!-- <label for="compte">Type de Compte</label> -->
                                    <option >Type de Compte</option>
                                    <option value="1">Inventoriste</option>
                                    <option value="2">Administrateur</option>
                                </select>
                                <button type="submit">valider</button>
                            </div>
                        </div>
                    </form>
                    <!-- <span class="btn-champ"><a href="">Hors Champ</a></span> -->
                </div>
            </header>
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
                            <th colspan="10">LISTE DES COMPTES</th>
                        </tr>
                        <tr class="first-head">
                            <th colspan="2">nom et prénom</th>
                            <th colspan="4">addresse email</th>
                            <th colspan="2">type de compte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($utilisateurs)) : ?>
                            <?php foreach($utilisateurs as $user) : ?>
                                <?php if (empty($user->id_inv)) : ?>
                                    <tr data-key="<?= $user->id_ad ?>">
                                        <td colspan="2"><?= $user->nom_ad ?></td>
                                        <td colspan="4"><?= $user->email_ad ?></td>
                                        <td>Administrateur</td>
                                        <?php if ($user->id_ad !== $admin->id_ad) : ?>
                                            <td class="supprimer">supprimer</td>
                                        <?php else: ?>
                                            <td>supprimer</td>
                                        <?php endif; ?>
                                    </tr>
                                <?php else : ?>
                                    <tr data-key="<?= $user->id_inv ?>">
                                        <td colspan="2"><?= $user->nom_inv ?></td>
                                        <td colspan="4"><?= $user->email_inv ?></td>
                                        <td>Inventoriste</td>
                                        <td class="supprimer">supprimer</td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal de confirmation -->
        <div class="modal fade" id="ModalConfirmerSuppression" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" action="<?= site_url('admin/supprimer_compte') ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation de Suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûrs de vouloir supprimer ?
                        <input type="hidden" name="key">
                        <input type="hidden" name="type">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Oui, je confirme</button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
        $('.supprimer').click(e => {
            $('#ModalConfirmerSuppression').modal('show')

            // On recupere le parent
            const parent = e.target.parentElement;

            // Recuperation des informations
            const typeAccount = parent.querySelector('td:nth-child(3)').textContent === "Inventoriste" ? 1 : 0;

            
            // Remplisage du formulaire
            document.forms[1].key.value = parent.getAttribute('data-key');
            document.forms[1].type.value = typeAccount;
        })
    </script>
</body>

</html>