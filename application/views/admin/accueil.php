<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/choix_gamme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./theme/assets/icone/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/accueil_admin.css">
    <title>Accueil Administrateur</title>
</head>

<body>
    <main>
        <div class="main-contenair">
            <div class="header">
                <div class="symbole">Inventaire - Administrateur <br> <span style="margin-left: 1.5rem;">G043</span></div>
                <span class="btn">déconnexion <i class="fa fa-running" aria-hidden="true"></i></span>
            </div>
            <div class="block-main">
                <h3>Bienvenue Mr. XXXX</h3>
                <p class="text-center text-white font-size mb-2">Que voulez vous faire ?</p>
                <div class="choix">
                    <ul>
                        <li> <a href="<?= site_url('admin/listing_gamme') ?>">Administrer une gamme</a> </li>
                        <li><a href="">Gestionnaire de compte</a></li>
                        <li><a href="<?= site_url('admin/inventaire') ?>">Lancer un inventaire</a></li>
                        <li><a href="">archives</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</body>

</html>