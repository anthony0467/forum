<?php
$users = $result["data"]['users'];
?>


<h1>Liste des utilisateurs</h1>

<?php if(App\Session::isAdmin()){ ?>

<?php
foreach($users as $user ){

    ?>

        <form class="user-form"  action="index.php?ctrl=security&action=addBan&id=<?= $user->getId() ?>" method="POST">
            <ul>
                <li class="user-placement">
                    <p><?= $user->getPseudo() ?></p>
                    <p>Status : <?php if( $user->getStatus() == 0){
                    echo 'ok <i class="green fa-solid fa-check"></i>';
                }else{
                    echo 'Banni <i class="red fa-sharp fa-solid fa-skull-crossbones"></i>';
                } ?></p>
                    <p><?= $user->getDateCreationMember() ?></p>

                </li>
            </ul>
            
                
                    <select class="txt-center" name="statusBan" id="statusBan">
                        <option disabled selected>Choisir</option>
                        <option value="0">Ok</option>
                        <option value="1">Bannir</option>
                    </select>
                    
                    <div class="txt-center">
                        <input class="btn" type="submit" name="submit" value="Valider">
                    </div>
                
                <?php } ?>
           
               
        
    
        </form>
    <?php
}else{
    echo "<p>Vous ne disposez pas des droits nécessaires pour accéder à cette page.</p>";
} ?>

