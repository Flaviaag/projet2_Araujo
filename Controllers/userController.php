<?php
    require_once('./Models/userModel.php');

    class UserController{
        
        protected $userModel;

        function __construct(){

            $this->model = new userModel();
        }

        public function login($email, $mot_de_passe){
        $user = $this->userModel->getUserByEmail($email);
    
        if ($user) {
            
            if (password_verify($mot_de_passe, $user['pwd'])) {
                
                return true;
            } else {
                
                var_dump("Mot de passe incorrect.", $mot_de_passe, $user['pwd']);
                return "Mot de passe incorrect!";
            }
        } else {
            
            return "Utilisateur non trouvé!";
        }
        }

        private function verifyPassword($password, $hashedPassword, $hashAlgorithm){
       
        switch ($hashAlgorithm) {
            case 'bcrypt':
                return password_verify($password, $hashedPassword);
                break;
            
            default:
                return false;
        }
        }

        public function register($data){
        if (!isset($data['role_id'])) {
            $data['role_id'] = 3; 
        }

        
        $data['pwd'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['pwd_algorithm'] = 'bcrypt';

        $result = $this->userModel->registerUser($data);

        if ($result) {
            echo "Inscription effectuée avec succès!";
            header("Location: ../views/login.php");
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'inscription";
        }
    }
    public function getUsers() {
        return $this->userModel->getAllUsers(); 
    }

    public function getUserById($id){
    // Utilisez votre modèle UserModel pour obtenir les détails de l'utilisateur par son ID
    return $this->userModel->getUserById($id);
    }

    public function updateUser($data){
    // Vérifiez si l'ID de l'utilisateur à mettre à jour est présent dans les données
    if (!isset($data['id'])) {
        echo "l'ID utilisateur n'a pas été spécifié pour la mise à jour!";
        exit();
    }

    // Appel de la méthode updateUserDetails du modèle pour effectuer la mise à jour
    $updated = $this->userModel->updateUserDetails($data);

    if ($updated) {
        // Après la mise à jour, redirigez vers la page manage_users
        header("Location: ../views/manage_users.php");
        exit();
    } else {
        echo "Échec de la mise à jour des informations de l'utilisateur!";
        // Gérez l'erreur ou redirigez vers une page appropriée en cas d'échec de la mise à jour
    }
    }
}
?>

