<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/nom_gamme.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
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
                    <h2>nom de gamme</h2>
                    <span class="btn">déconnexion <i class="fa fa-trash" aria-hidden="true"></i></span>
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
            </header>
            <!-- ============================* liste *========================= -->
            <div class="table">
                <table>
                    <thead>
                        <tr class="first-head">
                            <th colspan="2">code famille: 000</th>
                            <th colspan="8"> nom de la famille: nourriture pour chien</th>
                         
                        </tr>
                        <tr class="first-head">
                            <th colspan="2">folio</th>
                            <th colspan="4">libellé</th>
                            <th>Prix de vente</th>
                            <th>quantité en rayon</th>
                            <th>quantité en stock</th>
                            <th>total</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                        <tr>
                            <!-- <td>code famille</td> -->
                            <td colspan="2">folio</td>
                            <td colspan="4">libellé</td>
                            <!-- <td></td> -->
                            <td>Prix de vente</td>
                            <td>quantité en rayon</td>
                            <td>quantité en stock</td>
                            <td>total</td>
                        </tr>

                        <tr>
                            <!-- <td>code famille</td> -->
                            <td colspan="2">folio</td>
                            <td colspan="4">libellé</td>
                            <!-- <td></td> -->
                            <td>Prix de vente</td>
                            <td>quantité en rayon</td>
                            <td>quantité en stock</td>
                            <td>total</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>

</html>