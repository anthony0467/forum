<?php

$topics = $result["data"]['topics'];
?>

<h1>Liste topic</h1>

<ul>
<?php
foreach($topics as $topic ){

    ?>
    
    <h2>Topic <?= $topic->getCategory()->getNameCategory() ?></h2>
     
    <li>
        <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
            <p><?=$topic->getTitle() ?></p>
            <p><?= $topic->getCategory()->getNameCategory() ?></p>
            <p><?= $topic->getDateCreationTopic() ?></p>
            <p><?= $topic->getUser()->getPseudo() ?></p></a>
            
        </li> 
        
    
    <?php
} ?>

</ul>
