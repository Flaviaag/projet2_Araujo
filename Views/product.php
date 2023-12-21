<?php foreach($products as $product): ?>

<h2><a href="/articles/lire/<?= $article['slug'] ?>"><?=$article['titre'] ?></a></h2>

<h2><?= $article['titre'] ?></h2>
<p><?= $article['contenu'] ?></p>
<?php endforeach ?>

<?php 
define('ROOT',
str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT'./Models/Model.php');
require_once(ROOT'./Controllers/Controller.php');

$params=explode('/', $_GET['p']);

if($params[0] !=""){
    $controller=ucfirst($params[0]);
    $action = isset($params[1] ? $params[1]:'index');

    require_once(ROOT.'Controllers/'.$controller.'.php');

    $controller = new $controller();

    if(method_exists($controller, $action)){
        unset($params[0]);
        unset($params[1]);

        call_user_func_array([$controller,$action], $params);
    }else{
        http_response_code(404);
        echo "la page recherchée n`existe pas";
    }
    {else{
        require_once(ROOT'.controllers/Main.php');

        $controller = new Main();

        $controller->index();
    }

    }
}
?>