<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Entities\User;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        // view s'inscrire 
        return [
            "view" => VIEW_DIR . "security/register.php",

        ];
    }

    public function formLogin(){ // formulaire se connecter
        
        // view se connecter
        return [
            "view" => VIEW_DIR . "security/login.php",

        ];
    }

    public function userLogout(){ // se deconnecter
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion
    $this->redirectTo('security', 'formLogin'); // redirection vers la page concerné
}


    public function profile(){ // utilisateur detail
            return [
                "view" => VIEW_DIR."security/profile.php",
               
            ];
    }


    public function users(){
        $userManager = new UserManager();
            
            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $userManager->findAll()
                
                ]
            ];
    }


   
    public function userLogin(){
        $userManager = new UserManager();

        if(isset($_POST['submit'])) {
            //var_dump($_POST);die;
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($email && $password){
                //var_dump($password);die;
                //retrouver le mot de passe de l'utilisateur correspondant au mail
                $dbPass = $userManager->retrievePassword($email);
                //var_dump($dbPass);die;
                //Si le mot de passe est retrouvé
                if($dbPass){

                    //recupération du mot de passe
                    $hash = $dbPass->getPassword();
                    //var_dump($hash);die;
                    //retrouver l'utilisateur par son email
                    $user = $userManager->findOneByEmail($email);
                    //comparaison du hash de la base de données et le mot de passe renseigné
                    if(password_verify($password, $hash)){
                        Session::setUser($user);
                        $this->redirectTo('forum', 'listTopics'); // redirection vers la page concerné
                    }
                    
                    
                }
                
            }
        }
    }



    public function addUser(){ // ajouter un utilisateur

    if (isset($_POST['submit'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $verifPassword = filter_input(INPUT_POST, "verifPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if ($email && $pseudo && $password) {
            $userManager = new UserManager();

            // si le mail n'existe pas
            if (!$userManager->findOneByEmail($email)) {
                // si le pseudo n'existe pas 
                if (!$userManager->findOneByUser($pseudo)) {
                    //si le mot de passe correspond et fait plus ou égal à 8 cara
                    if (($password == $verifPassword) and strlen($password) >= 8) {
                        $pass= password_hash($password, PASSWORD_DEFAULT);
                        $userManager->add(['email'=> $email, 'pseudo'=> $pseudo, 'password' => $pass]);
                        $_SESSION['success_message'] = "Votre compte a été créé avec succès.";
                    } else {
                        $_SESSION['error_message'] =  "Les mots de passe ne correspondent pas ou font moins de 8 caractères.";
                        
                    }
                } else {
                    $_SESSION['error_message'] =  "Pseudo déjà utilisé.";
                }
            } else {
                $_SESSION['error_message'] =  "Email déjà utilisé.";
            }
            $this->redirectTo('security', 'register'); // redirection vers la page concerné
        }
    }


}



}
