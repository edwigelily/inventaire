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
    <style>

@import url('https://fonts.googleapis.com/css2?family=Inconsolata&display=swap');



*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Inconsolata', monospace;
}

.main-contenair header{
    background-color: rgb(26, 59, 122,1);
}

.main-contenair .header{
    display: flex;
    justify-content: space-between;
}

.main-contenair .header .symbole{
    color: rgb(26, 59, 122,1);
    background-color: #fff;
    text-transform: uppercase;
    font-size: .7rem;
    padding: 5px 40px;
}

/* .main-contenair .header .btn{
    text-transform: capitalize;
    padding: 5px 10px;
    border: none;
    outline: none;
    color: #fff;
    background-color: #d75e5e;
    cursor: pointer;
} */
.main-contenair .header .btn i{
    color: #d75e5e;
    background-color: #fff; 
    margin-left: 0.8rem; 
}

.main-contenair .header h2{
    color: #fff;
    text-transform: uppercase;
}

.main-contenair  .second-section-header{
    display: flex;
    justify-content: center;
    margin: 2rem auto 0;
    padding-bottom: 2rem;
}


.main-contenair  .second-section-header ul{
    list-style: none;
    display: flex;
   
}

.main-contenair  .second-section-header ul li{
    border-radius: 3px;
    background: rgba(238,238,238,1);
    margin: 0.1rem;
    padding: 7px 30px;
}

.main-contenair  .second-section-header ul li:nth-of-type(3){
    padding: 7px 120px;
}

.main-contenair  .second-section-header ul li a{
    color: rgba(112,112,112,0.6000000238418579);
    text-decoration: none;
    text-transform: uppercase;
    font-size: .9rem;
}

.main-contenair  .second-section-header form{
    border: 1px solid #fff;
    border-radius: 3px;
    padding: 0 5px;
    width: 12%;
    position: relative;
}

.main-contenair  .second-section-header form input{
    background: transparent none;
    border: none;
    outline: none;
    width: 90%;
    position: relative;
    top: 8px;
}

.main-contenair  .second-section-header form button{
    background: transparent none;
    border: none;
    outline: none;
    line-height: normal;
    font-size: 1.5rem;
    color: #fff;
    position: absolute;
    right: 10px;
    top: 5px;
}
.main-contenair  .second-section-header form button i{
    font-size: 1rem;
    position: relative;
    top: -5px;
}
::-webkit-input-placeholder{
    color: rgba(255, 255, 255, 0.774);
    font-size: .8rem;
}

:-ms-input-placeholder{
    color: rgba(255, 255, 255, 0.603);
    font-size: .8rem;
}

:-moz-placeholder{
    color: rgba(255, 255, 255, 0.603);
    font-size: .8rem;
}

/* ==================== menu ================= */

.banner-footer{
    display: flex;
    margin-bottom: 0;
}

.banner-footer .banner-link{
    margin-bottom: 0;
    flex: 1;
    border: 1px solid #ffffff;
    text-align: center;
    padding: .5em 0;
    text-decoration: none;
    color: #ffffff;
}

/* ===================== * Pagination * ============ */
.pagination{
    position: fixed;
    bottom: 8px;
    right: 3px;
    opacity: .6;
}

/* -=================== * bouton hors champ *===================- */

.btn-champ{
    border: 1px solid #fff;
    border-radius: 3px;
    line-height: normal;
    margin-left: .4rem;
    padding: 5px;
}

.btn-champ a{
    text-decoration: none;
    color: #fff;
    padding: 20px;
    margin: .4rem;
}


table{
	border: 1px solid black;
	border-collapse: collapse;
    /* margin: 5px auto 10px; */
    margin-top: 0;
    width: 100%;
}

table, td{
 	border: 2px solid #fff;
    padding: 10px;	
    background: rgba(238,238,238,1);
    color: rgba(26,59,122,1);
    text-align: center;
    text-transform: uppercase;
    /* width: 100%; */
 }

 th{
    padding: 10px;
    border: 2px solid #fff;
    text-align: center;	
 }
.first-head{
    background: rgba(26,59,122,1);
    color: #fff;   
    margin-bottom: 1em;
 }

 .product{
     cursor: pointer;
 }

 .alert{
     position: absolute;
     bottom: 10px;
     width: 40%;
     left: 5%;
 }

 /* =================== Correctifs ================= */
.title{
    font-size: 1.8em;
}

a.active{
    background-color: #ffffff;
    color: rgb(28,62,128) !important;
}
 /* ---==========================* RESPONSIVE *=========================== */
 @media (min-width: 992px) { 
    body{
        margin: 0;
    }
 }


@import url('https://fonts.googleapis.com/css2?family=Inconsolata&display=swap');



*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Inconsolata', monospace;
}

.main-contenair header{
    background-color: rgb(26, 59, 122,1);
}

.main-contenair .header{
    display: flex;
    justify-content: space-between;
}

.main-contenair .header .symbole{
    color: rgb(26, 59, 122,1);
    background-color: #fff;
    text-transform: uppercase;
    font-size: .7rem;
    padding: 5px 40px;
}

/* .main-contenair .header .btn{
    text-transform: capitalize;
    padding: 5px 10px;
    border: none;
    outline: none;
    color: #fff;
    background-color: #d75e5e;
    cursor: pointer;
} */
.main-contenair .header .btn i{
    color: #d75e5e;
    background-color: #fff; 
    margin-left: 0.8rem; 
}

.main-contenair .header h2{
    color: #fff;
    text-transform: uppercase;
}

.main-contenair  .second-section-header{
    display: flex;
    justify-content: center;
    margin: 2rem auto 0;
    padding-bottom: 2rem;
}


.main-contenair  .second-section-header ul{
    list-style: none;
    display: flex;
   
}

.main-contenair  .second-section-header ul li{
    border-radius: 3px;
    background: rgba(238,238,238,1);
    margin: 0.1rem;
    padding: 7px 30px;
}

.main-contenair  .second-section-header ul li:nth-of-type(3){
    padding: 7px 120px;
}

.main-contenair  .second-section-header ul li a{
    color: rgba(112,112,112,0.6000000238418579);
    text-decoration: none;
    text-transform: uppercase;
    font-size: .9rem;
}

.main-contenair  .second-section-header form{
    border: 1px solid #fff;
    border-radius: 3px;
    padding: 0 5px;
    width: 12%;
    position: relative;
}

.main-contenair  .second-section-header form input{
    background: transparent none;
    border: none;
    outline: none;
    width: 90%;
    position: relative;
    top: 8px;
}

.main-contenair  .second-section-header form button{
    background: transparent none;
    border: none;
    outline: none;
    line-height: normal;
    font-size: 1.5rem;
    color: #fff;
    position: absolute;
    right: 10px;
    top: 5px;
}
.main-contenair  .second-section-header form button i{
    font-size: 1rem;
    position: relative;
    top: -5px;
}
::-webkit-input-placeholder{
    color: rgba(255, 255, 255, 0.774);
    font-size: .8rem;
}

:-ms-input-placeholder{
    color: rgba(255, 255, 255, 0.603);
    font-size: .8rem;
}

:-moz-placeholder{
    color: rgba(255, 255, 255, 0.603);
    font-size: .8rem;
}

/* ==================== menu ================= */

.banner-footer{
    display: flex;
    margin-bottom: 0;
}

.banner-footer .banner-link{
    margin-bottom: 0;
    flex: 1;
    border: 1px solid #ffffff;
    text-align: center;
    padding: .5em 0;
    text-decoration: none;
    color: #ffffff;
}

/* ===================== * Pagination * ============ */
.pagination{
    position: fixed;
    bottom: 8px;
    right: 3px;
    opacity: .6;
}

/* -=================== * bouton hors champ *===================- */

.btn-champ{
    border: 1px solid #fff;
    border-radius: 3px;
    line-height: normal;
    margin-left: .4rem;
    padding: 5px;
}

.btn-champ a{
    text-decoration: none;
    color: #fff;
    padding: 20px;
    margin: .4rem;
}


table{
	border: 1px solid black;
	border-collapse: collapse;
    /* margin: 5px auto 10px; */
    margin-top: 0;
    width: 100%;
}

table, td{
 	border: 2px solid #fff;
    padding: 10px;	
    background: rgba(238,238,238,1);
    color: rgba(26,59,122,1);
    text-align: center;
    text-transform: uppercase;
    /* width: 100%; */
 }

 th{
    padding: 10px;
    border: 2px solid #fff;
    text-align: center;	
 }
.first-head{
    background: rgba(26,59,122,1);
    color: #fff;   
    margin-bottom: 1em;
 }

 .product{
     cursor: pointer;
 }

 .alert{
     position: absolute;
     bottom: 10px;
     width: 40%;
     left: 5%;
 }

 /* =================== Correctifs ================= */
.title{
    font-size: 1.8em;
}

a.active{
    background-color: #ffffff;
    color: rgb(28,62,128) !important;
}
 /* ---==========================* RESPONSIVE *=========================== */
 @media (min-width: 992px) { 
    body{
        margin: 0;
    }
 }

 @media print {
    #main_container{
        display: block;
    }

    body{
        color: #d75e5e;
    }
 }

#main_container {
	display: flex;
	flex-direction: row;
    justify-content: space-between;
    justify-content: center;
    margin-bottom: 1em;
    margin-top: .7em;
}
.logoceca img {
    width: 90px;
	height: auto;
}
.container {
	display: flex;
	flex-direction: row;
	/* height: 70px; */
}
.box {
	border: 1px dotted #000;
	display: flex;
	flex-direction: column;
	justify-content: center;
	padding: 10px 30px;
}
.boxleft {
	display: flex;
	flex-direction: column;
	justify-content: center;
	padding: 10px 30px;
}
.box p {
	padding: 5px 0px;
}
    </style>
</head>

<body>
    
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