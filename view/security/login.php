

<h1>Se connecter</h1>

<?php // afficher si pas connecté
                if(!App\Session::getUser()){ 
                    ?>
<form action="index.php?ctrl=security&action=userLogin" method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">
    <input class="btn" type="submit" name="submit" value="Valider">
</form>
<p class="txt-right"><a href="index.php?ctrl=security&action=register">Pas encore membre? Par ici</a></p>


<?php }else{
    echo '<p>Vous êtes connecté. <br> <a class="txt-right" href="index.php?ctrl=security&action=userLogout">Je souhaite me déconnécter</a></p>';
} ?>