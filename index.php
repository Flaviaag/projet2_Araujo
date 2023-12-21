<?php
    case 'cart':
        $page = new PageController;
        $page->cart();
        break;

    case 'signup':
        $page = new PageController;
        $page->signup();
        break;


    case 'login':
        $page = new PageController;
        $page->login();
        // ou PageController::login

        break;

    case 'users':
        $page = new PageController;
        $userId = isset($explodeUrl[4]) ? $explodeUrl[4] : null;
        if (isset($_SESSION['auth']['role_id']) && ($_SESSION['auth']['role_id'] === 2 || $_SESSION['auth']['role_id'] === 1)) {

            if ($userId) {
                $page->deleteUserById($explodeUrl[4]);
                echo " je suis dans user ";
            } else {
                $page->users();
            }
        }
        break;

?>