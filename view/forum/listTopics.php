<?php

$topics = $result["data"]['topics'];
$ListCategory = $result["data"]['category'];

?>

<h1>liste topics</h1>

<form action="index.php?ctrl=forum&action=topicSearch" method="POST">
    <input type="search" name="search" minlength="2" placeholder="Rechercher un topic">
    <input type="submit" name="submit" value="Rechercher">
</form>

<?php if (isset($_SESSION['user'])){  ?>

<form action="index.php?ctrl=forum&action=addTopicGeneral" method="POST">
    <label for="">Titre : </label>
    <input type="text" name="title" minlength="2" required >
    <select name="category_id" id="nameCategory">
        <?php
        foreach ($ListCategory as $category) { ?>
            <option value="<?= $category->getId() ?>"><?= $category->getNameCategory() ?></option>
        <?php
        } ?>
    </select>
    <label for="">Message :</label>
    <textarea name="textPost" id="textPost" cols="50" rows="10" minlength="2"required placeholder="Message"></textarea>
    <input name="submit" type="submit" value="Envoyer">
</form>

<?php } ?>

<ul>

    <?php
    if (!empty($topics)) { // en cas de recherche à 0
    foreach ($topics as $topic) {

    ?>


        <li>
            <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
                <p><?= $topic->getTitle() ?></p>
                <p><?= $topic->getCategory()->getNameCategory() ?></p>
                <p><?= $topic->getDateCreationTopic() ?></p>
                <p><?= $topic->getUser()->getPseudo() ?></p>
                <p>Nombre de postes :<?= $topic->getNbPosts() ?></p>
                
                
            </a>

            <?php if(App\Session::isAdmin()){ ?>
                <a href="index.php?ctrl=forum&action=topicLocked&id=<?= $topic->getId() ?>">Verrouiller le topic</a>
                <a href="index.php?ctrl=forum&action=topicUnlocked&id=<?= $topic->getId() ?>">Déverrouiller le topic</a>
                <?php } ?>

            <?php // afficher si admin ou auteur
                if(App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()){ 
                    ?>
                <a href="index.php?ctrl=forum&action=topicDeleteGeneral&id=<?= $topic->getId() ?>">Supprimer</a>

                <?php } ?>

        </li>

    <?php
    } }else{ echo '<p>Aucun résultat trouvé pour votre recherche</p>'; }?>

</ul>