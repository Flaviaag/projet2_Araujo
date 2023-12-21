<?php
require_once('userController.php');
require_once('./Models/userModel.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $userModel = new UserModel();

    $email = $_POST['email'];
    $password = $_POST['mot_de_passe'];

    $result = $userController->login($email, $password);

    if ($result === true) {
       
        $user = $userModel->getUserByEmail($email);
        $role = $user['role_id'];

        switch ($role) {
            case 1: // Superadmin
            case 2: // Admin
                header("Location:  ../views/admin_dashboard.php");
                break;
            case 3: // Client
                header("Location:  ../views/product.php");
                break;
            default:
                
                header("Location:  ../views/login.php");
        }

        exit();
    } else {
        
        echo $result;
    }
} else {
    
    header("Location: login.php");
    exit();
}
?>