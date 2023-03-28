<?php
$users = $result["data"]['users'];
?>


<h1>Liste des utilisateurs</h1>

<ul>
<?php
foreach($users as $user ){

    ?>
            <li>
                <p><?= $user->getPseudo() ?></p>
                <p><?= $user->getDateCreationMember() ?></p>
            </li>
           
               
        
    
    <?php
} ?>

</ul>
