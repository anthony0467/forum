<?php

$topics = $result["data"]['topics'];
$listCategory = $result["data"]['category'];

?>

<h1>Liste topic</h1>

<form class="search-form" action="index.php?ctrl=forum&action=topicSearch" method="POST">
    <input class="max-width-400" type="search" name="search" minlength="2" placeholder="Rechercher un topic">
    <input class="btn" type="submit" name="submit" value="Rechercher">
</form>

<?php if (isset($_SESSION['user'])){  ?>

    <form class="topic-form" action="index.php?ctrl=forum&action=addTopic&id=<?= $listCategory->getId() ?>" method="POST">
    <label for="">Titre : </label>
    <input class="max-width-400" type="text" name="title" minlength="2" required >
        <label for="">Message :</label>
        <textarea  name="textPost" id="textPost"  rows="10" minlength="2" required placeholder="Message"></textarea>
        <input class="btn" name="submit" type="submit" value="Envoyer">
    </form>

<?php }  ?>








<ul class="topic-placement">
    <li class="topic-line visibility border">
        <p class="line-1">Titre du Topic</p>
        <p class="line-2">Catégorie</p>
        <p class="line-3">Date</p>
        <p>Messages</p>
        <p>Pseudo</p>
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
foreach($topics as $topic ){

    ?>
    
 
    <li class="topic-line">
        <a class="line-1"  href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
            <p><?=$topic->getTitle() ?></p>
        </a>
            <p class="line-2" ><?= $topic->getCategory()->getNameCategory() ?></p>
            <p class="line-3" ><?= $topic->getDateCreationTopic() ?></p>
            <p class="line-4" ><?= $topic->getUser()->getPseudo() ?></p>
            <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
                <p><i class="fa-regular fa-message"></i> <?= $topic->getNbPosts() ?></p>
            </a>
                <?php if(App\Session::isAdmin() ){  // verrouiller deverouiller topic ?>
                <a href="index.php?ctrl=forum&action=topicLocked&id=<?= $topic->getId() ?>"><i class="fa-solid fa-lock"></i></a>
                <a href="index.php?ctrl=forum&action=topicUnlocked&id=<?= $topic->getId() ?>"><i class="fa-solid fa-unlock"></i></a>
                <?php } ?>
                
                <?php // afficher si admin ou auteur bouton supprimer
                if(App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()){ 
                    ?>
                <a href="index.php?ctrl=forum&action=topicDelete&id=<?= $topic->getId() ?>"><i class="fa-solid fa-trash"></i></a>

                <?php } ?>
            
        </li> 
        
    
    <?php
} }else{ echo '<p>Aucun résultat trouvé pour votre recherche</p>'; }?>

</ul>
