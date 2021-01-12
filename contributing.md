# Contribution Inventaire 

:star2: Merci d'avance pour votre contribution.:grin: 

Les instructions suivantes décrivent comment contribuer au projet en tant que front-end, back-end ou DBA.

## Configuration
Pour ce projet , il faut configurer votre environnement afin de travailler aisément et sans conflit.
Pour ce faire, il faut:
1. Fork et Clone le depot 
2. Creer un remote upstream a partir de mon depot
  ```bash
      git remote add upstream https://github.com/dynamo63/inventaire.git
  ```
3. Creer une autre branche a partir de **develop**
  - On peut par exemple creer une branche *mohammed/controller_inventoriste*
  - Le nom de la branche doit être cohérente avec votre tâche
4. Creer un **pull request** sur la branche develop.

*NB: Penser a faire des pull request de votre branche develop de temps a autre afin d'eviter les conflits*

### configurer l'url du projet

Pour pouvoir voir les modifications via l'url de votre navigateur, pensez a modifier la variable _base_url_ dans le fichier **application/config/config.php**

```bash
  $config['base_url'] = 'url_du_projet';
```

- Si vous deployez avec Apache, l'url de votre projet peut se former du nom de votre dossier, exemple
```bash
  http://localhost/[nom_du_projet]
```
- Si vous utilisez le serveur web integre de php, mettez l'url que vous generez
```bash
 php -S localhost:3000
```
Cet code permet d'acceder au projet via *http://localhost:3000/* et ce peut importe ou se trouve le dossier

## Organisation 

Le suivi des taches se fera sur Trello, pensez a etre dans notre [tableau](https://trello.com/b/8y7D5iSA/projet-inventaire).

Une tache vous sera assigne ou vous pourrez creer vos propres taches.

### Front-end
Ici le developpement se fera dans les repertoires suivants:
- views pour les vues php
- theme pour les assets

### Back-end
Les controllers auront le controle des **helpers**, **hooks**, etc ...

### DBA
Ils travailleront les modeles dans le dossier **models** et devront suivre la syntaxe *[NomDuModele]_model.php*

## Avertissement:exclamation::exclamation::exclamation:

Pensez a committez que l'essentiel, inutile de commiter les fichiers suivants:
- database.php
