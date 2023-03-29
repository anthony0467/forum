<?php

$posts = $result["data"]['posts'];
$topics = $result["data"]['topics']; 
?>


<h1>Posts Topic</h1>

<?php 

if($topics->getLocked() == 1){
 echo '<p>Topic verouillé, vous ne pouvez plus envoyer de message.</p>';
}else if (isset($_SESSION['user'])){ ?>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topics->getId() ?>" method="POST">
    <label for="">Message :</label>
    <textarea name="textPost" id="textPost" cols="50" rows="10" placeholder="Message"></textarea>
    <input name="submit" type="submit" value="Envoyer">
</form>


 <?php }  ?>

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

                <?php // afficher si admin ou auteur
                if(App\Session::isAdmin() || App\Session::getUser() == $post->getUser()){ 
                    ?>
                <a href="index.php?ctrl=forum&action=postDelete&id=<?= $post->getId() ?>">Supprimer</a>

                <?php } else{ echo '';} ?>
            </li>
           
               
        
    
    <?php
} ?>

</ul>

