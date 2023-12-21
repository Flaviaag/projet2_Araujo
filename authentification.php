<?php

$this->render('register')

public function login()
{
    $this->render('login');
    if(isset($_POST["envoyer"])){
        $this->loadModel("Auth");
        $errors = $this->Auth->testData($_POST);
        $email[`email`]=$_POST[`email`];
        //var_dump($errors);
        $utilisateur =$this->Auth->verifieremail($_POST["email"]);
        if($utilisateur){
            if(password_verify($_POST[`password`], utilisateur[`password`]))
            {
                $this->loadModel("Role");
                $this->Role->_nom=$this->Role::ADMIN;
                $resultat=$this->Role->getIdNom();
                if($this->Auth->isAdmin($utilisateur[`id_role`] ,$resultat[`role_id`])){
                    echo "Admin";
                }
                else{
                    echo "Client";
                }             
            }
        }
    }
}

?>