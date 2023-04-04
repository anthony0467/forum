<?php

$topics = $result["data"]['topics'];
$ListCategory = $result["data"]['category'];

?>

<h1>Liste topics</h1>

<form class="search-form" action="index.php?ctrl=forum&action=topicSearch" method="POST">
    <input class="max-width-400" type="search" name="search" minlength="2" placeholder="Rechercher un topic">
    <input class="btn" type="submit" name="submit" value="Rechercher">
</form>

<?php if (isset($_SESSION['user'])){  ?>

<form class="topic-form" action="index.php?ctrl=forum&action=addTopicGeneral" method="POST">
    <div class="flex-row">
        <div>
            <label for="">Titre : </label>
            <input class="max-width-400" type="text" name="title" minlength="2" required >
        </div>
        <div>
            <label for="">Catégorie : </label>
            <select class="max-width-400" name="category_id" id="nameCategory">
                <?php
                foreach ($ListCategory as $category) { ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getNameCategory() ?></option>
                <?php
                } ?>
            </select>
        </div>
    </div>
    <label for="">Message :</label>
    <textarea name="textPost" id="textPost"  rows="10" minlength="2"required placeholder="Message"></textarea>
    <div><input class="btn" name="submit" type="submit" value="Envoyer"></div>
</form>

<?php } ?>

<ul class="topic-placement">

<li class="topic-line visibility border">
        <p class="line-1">Titre du Topic</p>
        <p class="line-2">Catégorie</p>
        <p class="line-3">Date création</p>
        <p>Messages</p>
        <p>Pseudo</p>
        <p class="line-4">Dernier message</p>
        <?php
         if(App\Session::isAdmin() ){ ?>
            <p>Verrouiller</p>
            <p>Dévérrouiller</p>
        <?php } ?>
        <?php // afficher si admin ou auteur bouton supprimer
                if(App\Session::isAdmin()){ 
                    ?>
                    <p>Supprimer</p>
         <?php } ?>
    </li>

    <?php
    if (!empty($topics)) { // en cas de recherche à 0
    foreach ($topics as $topic) {

    ?>


        <li class="topic-line">
            <a class="line-1" href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
                <p><?= $topic->getTitle() ?></p>
            </a>
    
                <a class="line-2" href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $topic->getCategory()->getId() ?>">
                <p><?= $topic->getCategory()->getNameCategory() ?></p></a>
            
                <p class="line-3"><?= $topic->getDateCreationTopic() ?></p>
            <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
                <p ><i class="fa-regular fa-message"></i> <?= $topic->getNbPosts() ?></p>
            </a>
                <p class="line-5"><?= $topic->getUser()->getPseudo() ?></p>
                <p class="line-4"> <?= $topic->getLastDate()   ?></p>

            <?php if(App\Session::isAdmin()){ //verrouiller deverouiller topic ?> 
                <a class="line-6" href="index.php?ctrl=forum&action=topicLocked&id=<?= $topic->getId() ?>"><i class="fa-solid fa-lock"></i></a>
                <a class="line-7" href="index.php?ctrl=forum&action=topicUnlocked&id=<?= $topic->getId() ?>"><i class="fa-solid fa-unlock"></i></a>
                <?php } ?>

            <?php // afficher si admin ou auteur supprimer post
                if(App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()){ 
                    ?>
                <a class="line-8" href="index.php?ctrl=forum&action=topicDeleteGeneral&id=<?= $topic->getId() ?>"><i class="fa-solid fa-trash"></i></a>

                <?php } ?>

        </li>

    <?php
    } }else{ echo '<p>Aucun résultat trouvé pour votre recherche</p>'; }?>

</ul>