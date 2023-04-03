<?php

$listcategory = $result["data"]['category'];
    
?>

<h1>Liste Catégories</h1>
<ul class="category-placement">
<?php
foreach($listcategory as $category ){

    ?>
    
        <li>
            <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
            <?= $category->getNameCategory() ?>
            </a>
        </li>
        
    <?php
} ?>

</ul>