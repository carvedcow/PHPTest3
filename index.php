<?php
session_start();

// composer autoload
require "vendor/autoload.php";

// create f3 variable
$f3 = Base::instance();

// Twig
$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment( $loader, ['debug' => true] );

// Additional twig setup can be done here with $twig
$twig->addGlobal("twig_message", "");

// Set twig within F3
$f3->set("twig", $twig);

// Add server config to F3
$f3->config('inc/setup.ini');

// ROUTES
$f3->route("GET /", 'tasksController->list');
$f3->route('POST /complete/@id', 'tasksController->complete');
$f3->route("POST /delete/@id", "tasksController->delete");

$f3->route("GET /add", 'tasksController->add');
$f3->route('POST /add', 'tasksController->create');

$f3->route("GET /details", 'tasksController->details');



// execute my f3
$f3->run();
?>