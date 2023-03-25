<?php

$posts = $result["data"]['posts'];
    
?>

<h1>Posts Topic</h1>


<?php
foreach($posts as $post ){

    ?>
    
   
     
            <p><?=$post->getPost() ?></p>    
        
    
    <?php
} ?>

