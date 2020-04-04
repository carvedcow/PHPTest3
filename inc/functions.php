<?php

// composer
require_once 'vendor/autoload.php';

// setup our twig template location
//$loader = new Twig_Loader_Filesystem('templates');
$loader = new \Twig\Loader\FilesystemLoader('templates');

// setup twig environment
//$twig = new Twig_Environment($loader);
$twig = new  \Twig\Environment( $loader );

// global variables
$twig->addGlobal( "bottleCount", 7 );
$twig->addGlobal("twig_message", "");

?>