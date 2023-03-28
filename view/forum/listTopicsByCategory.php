<?php

$topics = $result["data"]['topics'];
$listCategory = $result["data"]['category'];

?>

<h1>Liste topic</h1>

<?php if (isset($_SESSION['user'])){  ?>

    <form action="index.php?ctrl=forum&action=addTopic&id=<?= $listCategory->getId() ?>" method="POST">
    <label for="">Titre : </label>
    <input type="text" name="title">
        <label for="">Message :</label>
        <textarea name="textPost" id="textPost" cols="50" rows="10" placeholder="Message"></textarea>
        <input name="submit" type="submit" value="Envoyer">
    </form>

<?php }  ?>








<ul>
<?php

if($topics == null){
    echo "Topic vide";
   }else{
foreach($topics as $topic ){

    ?>
    
 
    <li>
        <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
            <p><?=$topic->getTitle() ?></p>
            <p><?= $topic->getCategory()->getNameCategory() ?></p>
            <p><?= $topic->getDateCreationTopic() ?></p>
            <p><?= $topic->getUser()->getPseudo() ?></p></a>
            
            
                <a href="index.php?ctrl=forum&action=topicLocked&id=<?= $topic->getId() ?>">Verrouiller le topic</a>
           
            
            
        </li> 
        
    
    <?php
} }?>

</ul>
