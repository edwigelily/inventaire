<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <h2>nom de gamme</h2>
                    <span class="btn">déconnexion <i class="fa fa-trash" aria-hidden="true"></i></span>
                </div>
                <div class="second-section-header">
                    <!-- <ul>
                        <li> <a href="#">code famille</a> </li>
                        <li><a href="">folio</a></li>
                        <li><a href="">libellé</a></li>
                        <li><a href="">quantité en stock</a></li>
                    </ul> -->
                    <form>
                        <h3>gestionnaire de compte</h3>
                        <div class="content_form">
                            <h3>créer un compte</h3>
                            <div class="compte_creer">
                                <input type="text" name="" id="nom" placeholder="Nom et Prénom">
                                <input type="email" name="" id="email" placeholder="Adresse mail">
                                <select name="" id="compte" class="selectionne">
                                    <!-- <label for="compte">Type de Compte</label> -->
                                    <option value="">Type de Compte</option>
                                    <option value="">Inventoriste</option>
                                    <option value="">Administrateur</option>
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
                <table>
                    <thead>
                        <tr class="first-head">
                            <th colspan="10">LISTE DES COMPTES</th>
                        </tr>
                        <tr class="first-head">
                            <th colspan="2">nom et prénom</th>
                            <th colspan="4">addres email</th>
                            <th>type de compte</th>
                            <th class="supprimer">supprimer</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">nom et prénom</td>
                            <td colspan="4">addresse email</td>
                            <td>type de compte</td>
                            <td class="supprimer">supprimer</td>
                        </tr>
                        <tr>
                            <td colspan="2">nom et prénom</td>
                            <td colspan="4">addresse email</td>
                            <td>type de compte</td>
                            <td class="supprimer">supprimer</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>

</html>