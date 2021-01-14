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
            <div class="header">  Administrateur <br> G043 </div>
               
           
            <form action="<?= site_url('admin/traitement_connexion') ?>" method="POST">
                <label for="identifiant">Email</label>
                <input type="text" name="email" id="identifiant">

                <label for="mdp">mot de passe</label>
                <input type="password" name="password" id="mdp">
                <button type="submit">Connexion</button>
            </form>
        </div>
    </main>
</body>
</html>