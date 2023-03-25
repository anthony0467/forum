<?php

$listcategory = $result["data"]['category'];
    
?>

<h1>liste Catégories</h1>

<?php
foreach($listcategory as $category ){

    ?>
    <ul>
        <li>
            <a href="">
            <?= $category->getNameCategory() ?>
            </a>
        </li>
    </ul>
    <?php
}