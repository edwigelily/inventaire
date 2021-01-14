<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./theme/assets/icone/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/connexion.css">
    <title>Connexion</title>
</head>

<body>
    <main>
        <div class="contenair">
            <div class="header"> inventaire <br> G043 </div>
            <?php if ($this->session->flashdata('message')) : ?>
                <p style="padding: 5px 10px; font-weight: bold; color: red; margin:0;"><?= $this->session->flashdata('message'); ?></p>
            <?php endif; ?>
            <?php if ($this->session->flashdata('message-success')) : ?>
                <p style="padding: 5px 10px; font-weight: bold; color: #008148; margin:0;"><?= $this->session->flashdata('message-success'); ?></p>
            <?php endif; ?>

            <form action="<?= site_url('inventoriste/traitement_connexion_inventoriste') ?>" method="post">
                <label for="identifiant">identifiant</label>
                <input type="text" name="identtifiant" id="identifiant">

                <label for="mdp">mot de passe</label>
                <input type="password" name="mdp" id="mdp">
                <button type="submit">se connecter</button>
            </form>
        </div>
    </main>
</body>

</html>