<?php

class Autoload
{                               // controller\Controller
    public static function inclusionAuto($className)
    {
        // (2) str_replace() : 
        // (3) /Applications/MAMP/htdocs/Php_Poo/mvc/controller/Controller.php                         
        require_once  __DIR__ . "/" . str_replace("\\", "/", $className . ".php");
    }
}

spl_autoload_register(array('Autoload', 'inclusionAuto')); // (1) spl_autoload_register():

/*
  1 - Lorsque l'on utilise l'autoload sur une classe, il faut passer un array et la méthode doit être static.
      spl_autoload_register() : permet d'executer une fonction lorsque l'interpreteur voit passer un "new" dans le code.

      Lorsque l'on instancie une classe, la function 'inclusionAuto' de la classe 'Autoload' s'execute automatiquement
      et tout ce qu'il y a après le 'new' (namespace\class) est envoyé directement en argument a la fonction 'inclusionAuto'
      On se sert du namespace 'controller' pour entrer dans le dossier controller  du dossier 'CRUD'
      et du nom de la classe 'Controller' pour inclure le fichier Controller.php
      Il faut bien respecter la convention de nommage pour les dossiers et les fichiers.

  2 - str_replace() : fonction prédéfinie qui permet ici de remplacer les '\' pas des '/' afin de définir le bon chemin

  3 - Chemin de la page wex controller.php
*/
