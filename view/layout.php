<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="./<?= PUBLIC_DIR ?>/js/style.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./<?= PUBLIC_DIR ?>/css/style.css">
    <title>FORUM</title>
</head>

<body>
    <div id="wrapper">

        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h4 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h4>
            <h4 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h4>
            <header>
                <nav>
                    <div class="container-nav">
                        <div id="nav-left">
                            <a class="logo" href="index.php">My Forum</a>   
                        </div>
                        <div id="nav-right" class="none-menu-ecran">
                        <?php
                            if (App\Session::isAdmin()) {
                            ?>
                                <a href="index.php?ctrl=security&action=users">Voir la liste des gens</a>

                            <?php
                            }
                            ?>
                            <?php

                            if (App\Session::getUser()) {
                            ?>


                                <a href="index.php?ctrl=forum&action=listCategory">Catégories</a>
                                <a href="index.php?ctrl=forum&action=listTopics">La liste des topics</a>
                                <a href="index.php?ctrl=security&action=profile"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser() ?></a>
                                <a href="index.php?ctrl=security&action=userLogout">Déconnexion</a>
                            <?php
                            } else {
                            ?>


                                <a href="index.php?ctrl=forum&action=listCategory">Catégories</a>
                                <a href="index.php?ctrl=forum&action=listTopics">La liste des topics</a>
                                <a href="index.php?ctrl=security&action=formLogin">Connexion</a>
                                <a href="index.php?ctrl=security&action=register">Inscription</a>
                            <?php
                            }


                            ?>
                        </div>
                    </div>
                </nav>

                            <!-- menu ecran mobile -->
                <nav class="header__nav none-small-ecran">
                    <div class="toggle-menu">
                        <div class="line line1"></div>
                        <div class="line line2"></div>
                        <div class="line line3"></div>
                    </div>
                    <div class="nav-list"> 
                    <?php
                            if (App\Session::isAdmin()) {
                            ?>
                                <a href="index.php?ctrl=security&action=users">Voir la liste des gens</a>

                            <?php
                            }
                            ?>
                        <?php

                        if (App\Session::getUser()) {
                        ?>


                            <a href="index.php?ctrl=forum&action=listCategory">Catégories</a>
                            <a href="index.php?ctrl=forum&action=listTopics">La liste des topics</a>
                            <a href="index.php?ctrl=security&action=profile"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser() ?></a>
                            <a href="index.php?ctrl=security&action=userLogout">Déconnexion</a>
                        <?php
                        } else {
                        ?>


                            <a href="index.php?ctrl=forum&action=listCategory">Catégories</a>
                            <a href="index.php?ctrl=forum&action=listTopics">La liste des topics</a>
                            <a href="index.php?ctrl=security&action=formLogin">Connexion</a>
                            <a href="index.php?ctrl=security&action=register">Inscription</a>
                        <?php
                        }


                        ?>
                    </div>
                </nav>


            </header>

            <main id="forum">
                <div class="container animation">
                    <?= $page ?>
                </div>
            </main>
        </div>
        <footer>
            <p>&copy; 2023 - Forum AS - <a href="index.php?ctrl=home&action=forumRules">Règlement du forum</a> - <a href="index.php?ctrl=home&action=noticeLegale">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(".message").each(function() {
                if ($(this).text().length > 0) {
                    $(this).slideDown(500, function() {
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function() {
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })



        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>

</html>