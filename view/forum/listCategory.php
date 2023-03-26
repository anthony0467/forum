<?php

$listcategory = $result["data"]['category'];
    
?>

<h1>liste Catégories</h1>

<?php
foreach($listcategory as $category ){

    ?>
    <ul>
        <li>
            <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
            <?= $category->getNameCategory() ?>
            </a>
        </li>
    </ul>
    <?php
}