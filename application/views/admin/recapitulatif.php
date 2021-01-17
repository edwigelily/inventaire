<!DOCTYPE html>
<html>
<head>
	<title>Fiche récapitulative</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?= theme_url() ?>assets/css/recap.css">
</head>
<body>
	<div id="main_content">
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
			<!-- <table class="table_data">
                <div class="nom_activite">
                    <h3>ACTIVITÉ 03 "NOM DE L'ACTIVITÉ"</h3>
                </div>
				<thead>
					<tr>
						<th>CODE RAYON</th>
						<th>RAYONS</th>
						<th>MONTANT MARCHANDISE</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>010</td>
						<td>Biscottes, pains gris</td>
						<td>60000 francs</td>
					</tr>
					<tr>
						<td>010</td>
						<td>Biscottes, pains gris</td>
						<td>60000 francs</td>
					</tr>
					<tr>
						<td>010</td>
						<td>Biscottes, pains gris</td>
						<td>60000 francs</td>
					</tr>
					<tr>
						<td>010</td>
						<td>Biscottes, pains gris</td>
						<td>60000 francs</td>
					</tr>
					<tr>
						<td>010</td>
						<td>Biscottes, pains gris</td>
						<td>60000 francs</td>
					</tr>
					<tr>
						<td>010</td>
						<td>Biscottes, pains gris</td>
						<td>60000 francs</td>
					</tr>
					<tr>
						<td>010</td>
						<td>Biscottes, pains gris</td>
						<td>60000 francs</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">TOTAL PAR ACTIVITÉ</td>
					</tr>
				</tfoot>
            </table> -->

            <?php if (!empty($activites)) : 
                foreach ($activites as $activite) :?>

                    <table class="table_data">
                        <div class="nom_activite">
                            <h3>ACTIVITÉ <?= $activite->code_act ?> "<?= $activite->nom_act ?>"</h3>
                        </div>
                        <thead>
                            <tr>
                                <th>CODE RAYON</th>
                                <th>RAYONS</th>
                                <th>MONTANT MARCHANDISE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($activite->familles as $famille): ?>
                                <tr>
                                    <td><?= $famille->code_fam ?></td>
                                    <td><?= $famille->nom ?></td>
                                    <td><?= isset($famille->montant) ? number_format($famille->montant, 0, ',', ' ') : 0 ?> FCFA</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">TOTAL PAR ACTIVITÉ: <?= $activite->total_montant ?></td>
                            </tr>
                        </tfoot>
                    </table>

                <?php endforeach; ?>
            <?php endif; ?>

			<table class="table_totaux">
				<thead>
					<tr>
						<th>TOTAUX INVENTAIRES</th>
						<th>MONTANTS</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>FOND DE CAISSE</td>
						<td></td>
					</tr>
					<tr>
						<td>MARCHANDISES (sommes des activités + fond de caisse)</td>
						<td></td>
					</tr>
					<tr>
						<td>EMBALLAGES</td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL GENERAL INVENTAIRE MAGASIN</th>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</main>
		<footer></footer>
	</div>
</body>
</html>