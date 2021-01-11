# Contribution Inventaire 

:star2: Merci d'avance pour votre contribution :grin:
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

## Organisation 

### Developpement Front-end
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
