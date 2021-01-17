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
    <link rel="stylesheet" href="<?= theme_url() ?>assets/css/fiche_gamme.css">
    <title>INVENTAIRE G043</title>
    <script>
        // window.print();
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#" onclick="window.print(); return false">Telecharger le PDF <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
        </ul>
        <span class="navbar-text">
            Cette Page montre l'ensemble de la Gamme 
        </span>
    </div>
    </nav>
    <header>
			<div id="main_container">
				<div class="container">
					<div class="logoceca"><img src="<?= theme_url() ?>assets/img/logo.png"></div>
					<div class="boxleft">
						<p>CECA GADIS</p>
						<p>LIBREVILLE</p>
						<p>GABOPRIX</p>
					</div>
				</div>
				<div class="container">
					<div class="box">
						<P><strong>Récapitulatif d'inventaire</strong></P>
						<P><strong>G043 - CACADO ADL - AEROPORT</strong></P>
					</div>
					<div class="box">
						<P>Nom du gérant</P>
						<P>KOLEVI COLLEY GAVA</P>
					</div class="box">
					<div class="box">
						<P>Date d'édition</P>
						<P>14/01/2021</P>
					</div>
				</div>
			</div>
		</header>
    <main>
        <div class="main-contenair">
            <!-- ============================* liste *========================= -->
            <div class="table">
                <table>
                    <thead>
                        <tr class="first-head">
                            <th colspan="2">folio</th>
                            <th colspan="4">libellé</th>
                            <th>Prix de vente</th>
                            <th>quantité en reserve</th>
                            <th>quantité en magasin</th>
                            <th>total</th>
                        </tr>

                        
                    </thead>
                    <tbody>
                        <?php if (!empty($familles)): 
                            foreach($familles as $famille) :?>
                                <?php if (!empty($famille->produits)) : ?>
                                    <tr class="first-head">
                                        <th colspan="2">code famille: <?= $famille->code_fam ?></th>
                                        <th colspan="8"> nom de la famille: <?= $famille->nom ?></th>
                                    </tr>
                                    <?php foreach($famille->produits as $produit): ?>
                                        <tr>
                                            <td colspan="2"><?= show_folio($produit->folio) ?></td>
                                            <td colspan="4"><?= $produit->libelle_prod ?></td>
                                            <td><?= $produit->prix ?></td>
                                            <td><?= $produit->q_res ?></td>
                                            <td><?= $produit->q_surf ?></td>
                                            <td><?= number_format(($produit->q_surf + $produit->q_res) * $produit->prix, 0, ',', ' ') ?> FCFA</td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="8">MONTANT TOTAL:</td>
                                        <td colspan="2" class="font-weight-bold"><?= number_format($famille->montant, 0, ',', ' ') ?> FCFA</td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>