<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface
{

    public function index()
    {




        return [
            "view" => VIEW_DIR . "security/register.php",

        ];
    }


    public function addUser()
{
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
                        $userManager->add(['email'=> $email, 'pseudo'=> $pseudo, 'password' => $password]);
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
