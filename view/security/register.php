
<?php 

if (isset($_SESSION['error_message'])) {
    echo "<p style='color:red'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    echo "<p style='color:green'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']);
}
?>




<h1>Inscription</h1>



<form action="index.php?ctrl=security&action=addUser" method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="pseudo" id="pseudo" placeholder="Identifiant">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="password" name="verifPassword" placeholder="Entrer à nouveau le mot de passe">
    <input type="submit" name="submit" value="Valider">
</form>