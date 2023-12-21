<?php
require_once('./utils/routes.php');

//session_start();
require_once './controllers/PageControllers.php';
$url = $_SERVER['REQUEST_URI'];

$urltrim = ltrim($url, '/Ecommerc_2/project2_Araujo');
$explodeUrl = explode('/', $url);
var_dump($explodeUrl[3]);
switch ($explodeUrl[3]) {

    case 'products':

        $page = new PageController;
        $page->products();

        break;


    case 'product':
        // Récupérer l'ID du produit à partir de la requête GET
        $productId = isset($explodeUrl[4]) ? $explodeUrl[4] : null;
        if ($productId) {
            $page = new PageController;
            $page->products($productId);
            // echo " je suis dans product";
        } else {
            echo "Product ID is missing.";
        }

        break;

?>