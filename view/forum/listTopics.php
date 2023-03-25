<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<ul>

<?php
foreach($topics as $topic ){

    ?>
    
   
        <li>
            <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?=$topic->getTitle() ?></a></p>
            <p><a href=""><?= $topic->getCategory()->getNameCategory() ?></a></p>
            <p><a href=""><?= $topic->getDateCreationTopic() ?></a></p>
            <p><a href=""><?= $topic->getUser()->getPseudo() ?></a></p>
            
        </li>
    
    <?php
} ?>

</ul>


  
