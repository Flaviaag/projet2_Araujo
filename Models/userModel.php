<?php
require_once('./Model.php');


class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $params = array(':email' => $email);
        $user = $this->getSingleResult($query, $params);
    
        return $user;
    }

    public function registerUser($data)
    {
        $query = "INSERT INTO user (email, username, fname, lname, pwd, pwd_algorithm, billing_address_id, shipping_address_id, role_id) 
                  VALUES (:email, :username, :fname, :lname, :pwd, :pwd_algorithm, :billing_address, :shipping_address, :role_id)";
    
        $params = array(
            ':email' => $data['email'],
            ':username' => $data['username'],
            ':fname' => $data['fname'],
            ':lname' => $data['lname'],
            ':pwd' => $data['password'],
            ':pwd_algorithm' => $data['password_algorithm'],
            ':billing_address' => $data['billing_address'],
            ':shipping_address' => $data['shipping_address'],
            ':role_id' => $data['role_id']
        );
    
        return $this->executeQuery($query, $params);
    }
    
    public function updateUserDetails($data) {
        $id = $data['id'];
        $username = $data['username'];
        $email = $data['email'];
        $role_id = $data['role_id'];
        $password = $data['password']; 
    
        
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
        $query = "UPDATE user SET username = :username, email = :email, pwd = :password, role_id = :role_id WHERE id = :id";
        $params = array(
            ':id' => $id,
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password, 
            ':role_id' => $role_id
            
        );
    
        $stmt = $this->connexion->prepare($query);
        $stmt->execute($params);
    
        return $stmt->rowCount() > 0; 
    }

    public function getAllUsers(): array {
        $query = "SELECT u.*, r.name AS role FROM user u INNER JOIN role r ON u.role_id = r.id";
        $PDOStatement = $this->connexion->query($query);
        $users = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function getUserById($id){
    $query = "SELECT * FROM user WHERE id = :id";
    $params = array(':id' => $id);
    return $this->getSingleResult($query, $params);
    }
}
?>
