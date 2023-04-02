<?php

$posts = $result["data"]['posts'];
$topics = $result["data"]['topics']; 
?>


<h1>Posts Topic</h1>


<?php 

if ($topics && !$topics->getLocked()){
    if(isset($_SESSION['user'])){
     ?>
  

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topics->getId() ?>" method="POST">
    <label for="">Message :</label>
    <textarea name="textPost" id="textPost" cols="50" rows="10" minlength="2" required placeholder="Message"></textarea>
    <input class="btn" name="submit" type="submit" value="Envoyer">
</form>
<?php } ?>
<h2>Titre topic : <?= $topics->getTitle() ?></h2>

 <?php 
 if($posts == null){
    echo "Aucun message dans le topic";
   
 } }else{
    echo "<p>Topic vérouillé</p>";
} ?>

<ul>
<?php
foreach($posts as $post ){

    ?>

            

            <li>
                <div>
                    <p><?= $post->getUser()->getPseudo() ?></p>
                    <p><?= $post->getDateCreationMessage() ?></p>
                </div>
                <p><?=$post->getTextPost() ?></p>
                <p><a href="index.php?ctrl=forum&action=postLike&id=<?= $post->getId() ?>">J'aime <?= $post->getLikePost() ?></a>
                <?php
                if(App\Session::getUser() != null){
                    $userId = $_SESSION['user']->getId();
                    if (isset($_SESSION['liked_posts'][$userId]) && in_array($post->getId(), $_SESSION['liked_posts'][$userId])) { ?>
                <i class="fa fa-thumbs-up"></i>
                <?php } }  ?>
                </p>
                <?php // afficher si admin ou auteur
                if(App\Session::isAdmin() || App\Session::getUser() == $post->getUser()){ 
                    ?>
                <a href="index.php?ctrl=forum&action=postDelete&id=<?= $post->getId() ?>">Supprimer</a>

                <?php } ?>
            </li>
           
               
        
    
    <?php
} ?>

</ul>
