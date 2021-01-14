<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/choix_gamme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./theme/assets/icone/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/accueil.css">
    <title>Choix de Gamme</title>
</head>

<body>
    <main>
        <div class="main-contenair">
            <div class="header">
                <div class="symbole">inventaire <br> <span style="margin-left: 1.5rem;">G043</span></div>
                <span class="btn"><a href="<?= site_url('inventoriste/deconnexion') ?>">déconnexion</a> <i class="fa fa-running" aria-hidden="true"></i></span>
            </div>
            <div class="block-main">
                <h3>CHOISIR UNE GAMME</h3>
                <div class="choix">
                    <ul>
                        <?php foreach ($categories as $categorie) : ?>

                            <li><a href="<?= site_url('inventoriste/listing/' . $categorie->id_cat) ?>"><?= $categorie->nom_cat ?></a></li>

                        <?php endforeach; ?>

                        <!-- <li><a href="">libellé</a></li>
                        <li><a href="">quantité en stock</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </main>
</body>

</html>