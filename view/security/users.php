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
                <p>Status : <?php if( $user->getStatus() == 0){
                    echo 'ok';
                }else{
                    echo 'Banni';
                } ?></p>
                <p><?= $user->getDateCreationMember() ?></p>

                <?php if(App\Session::isAdmin()){ ?>
                <form  action="index.php?ctrl=security&action=addBan&id=<?= $user->getId() ?>" method="POST">
                    <select name="statusBan" id="statusBan">
                        <option disabled selected>Choisir</option>
                        <option value="0">Ok</option>
                        <option value="1">Bannir</option>
                    </select>
                    <input class="btn" type="submit" name="submit" value="Valider">
                </form>
                <?php } ?>

            </li>
           
               
        
    
    <?php
} ?>

</ul>
