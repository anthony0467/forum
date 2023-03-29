<?php

$topics = $result["data"]['topics'];
$ListCategory = $result["data"]['category'];
?>

<h1>liste topics</h1>


<?php if (isset($_SESSION['user'])){  ?>

<form action="index.php?ctrl=forum&action=addTopicGeneral" method="POST">
    <label for="">Titre : </label>
    <input type="text" name="title">
    <select name="category_id" id="nameCategory">
        <?php
        foreach ($ListCategory as $category) { ?>
            <option value="<?= $category->getId() ?>"><?= $category->getNameCategory() ?></option>
        <?php
        } ?>
    </select>
    <label for="">Message :</label>
    <textarea name="textPost" id="textPost" cols="50" rows="10" placeholder="Message"></textarea>
    <input name="submit" type="submit" value="Envoyer">
</form>

<?php } ?>

<ul>

    <?php
    foreach ($topics as $topic) {

    ?>


        <li>
            <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
                <p><?= $topic->getTitle() ?></p>
                <p><?= $topic->getCategory()->getNameCategory() ?></p>
                <p><?= $topic->getDateCreationTopic() ?></p>
                <p><?= $topic->getUser()->getPseudo() ?></p>
            </a>

            <?php if(App\Session::isAdmin()){ ?>
                <a href="index.php?ctrl=forum&action=topicLocked&id=<?= $topic->getId() ?>">Verrouiller le topic</a>

                <?php } ?>

                <a href="">Supprimer</a>

        </li>

    <?php
    } ?>

</ul>