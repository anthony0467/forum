

<h1>Profile</h1>

<?php // afficher si connecté
                if(App\Session::getUser()){ 
                    ?>
<div>
    <h2>Pseudo : <?= App\Session::getUser()?></h2>
    <p>Email : <?= App\Session::getUser()->getEmail() ?></p>
    <p>Role: <?= App\Session::getUser()->getRole() ?></p>
    <p>Date de création du profile : <?= App\Session::getUser()->getDateCreationMember() ?></p>
</div>


<?php } else{
    echo "<p>Erreur, vous n'êtes pas conecté. Veuillez vous connecter pour avoir accès à cette page.</p>";
} ?>