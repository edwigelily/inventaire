<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/archives.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme_url() ?>assets/icone/css/font-awesome.min.css">
    <title>archives</title>
</head>

<body>
    <main>
        <div class="main-contenair">
            <header>
                <div class="header">
                    <div class="head_first">
                        <div class="symbole">inventaire <br> <span style="margin-left: 1.5rem;">G043</span></div>
                        <div class="menu"><span>menu</span></div>
                    </div>
                    <h3>ADMINISTRATEUR</h3>
                    <div class="head_second">
                        <span class="btn">déconnexion <i class="fa fa-trash" aria-hidden="true"></i></span>
                    </div>
                </div>

                <form>
                    <h3>rechercher une archive</h3>
                    <div class="recherche">
                        <input type="text" name="" id="" placeholder="Date de début" class="date-recherche">
                        <span class="btn_recherche"><input type="text" name="" id="" placeholder="Recherche"><button
                                type="submit"> <i class="fa fa-search" aria-hidden="true"></i></button></span>
                    </div>
                </form>
            </header>
            <div class="main_body">
                <h3>archives</h3>
                <div class="space_admin">
                    <h3>administrateur en charge</h3>
                    <div class="contenair_date">
                        <h3 class="title_b">administrateur</h3>
                        <div class="item_date">
                            <div class="date_debut">
                                <span class="titre">date de début</span>
                                <div class="items"><span>date de début</span></div>
                                <span class="titre">bazars</span>
                                <div class="items"><span>inventoriste 1</span></div>
                                <span class="titre">liquides</span>
                                <div class="items"><span>inventoriste 2</span></div>
                                <div class="pdf">
                                    <span>pdf de la gamme</span><i class="fa fa-download" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="date_fin">
                                <span class="titre">date de fin</span>
                                <div class="items"><span>date de fin</span></div>
                                <span class="titre">bazars</span>
                                <div class="items"><span>inventoriste 3</span></div>
                                <span class="titre">liquides</span>
                                <div class="items"><span>inventoriste 4</span></div>
                                <div class="pdf">
                                    <span>pdf fiche récapitulative</span><i class="fa fa-download" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>