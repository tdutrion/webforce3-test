# Analyse technique formateur

Le projet est une demonstration d'un savoir faire minimum pour un formateur en développement.

Avant toute chose, les librairies tierces doivent être installées en utilisant la commande suivante:

```
composer install -o
```

## Lancer le project avec le serveur PHP built-in


Executez la commande suivante :

```
php -S localhost:8080 -t public public/index.php
```

Puis rendez-vous sur [http://localhost:8080](http://localhost:8080)

## Lancer la documentation

Executez la commande suivante :

```
php -S localhost:8000 -t vendor/webforce3/w/docs/tuto
```

Puis rendez-vous sur [http://localhost:8000](http://localhost:8000)


## Modifications par rapport au projet fourni

* utilisation de [chdir]() dans l'`index.php` pour simplifier la gestion des adresses de fichiers lors de l'utilisation du
serveur intégré de PHP
* ajout de lignes permettant de servir les fichiers et dossiers existant en routant le projet via l'`index.php`
* utilisation de `W` en tant que framework et non skeleton/distribution
* ajout de l'autoload des fonctions via composer
* modification des fichiers de configuration pour une inclusion plus facile à lire
* ajout d'un test permettant l'utilisation d'un fichier de configuration local (non versionné)
* déplacement des fichiers de configuration dans leur propre dossier


## Refatoring nécessaire

* faire en sorte que le framework reconnaisse les vues par défaut
* supprimer les vues de base
* autoriser un namespace `App` au lieu de polluer le namespace global
* ajouter la documentation dans une branche `gh-pages`, eventuellement en ajoutant un utilitaire pour la génération