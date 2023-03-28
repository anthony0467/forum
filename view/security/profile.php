

<h1>Profile</h1>


<div>
    <h2>Pseudo : <?= App\Session::getUser()?></h2>
    <p>Email : <?= App\Session::getUser()->getEmail() ?></p>
    <p>Role: <?= App\Session::getUser()->getRole() ?></p>
    <p>Date de création du profile : <?= App\Session::getUser()->getDateCreationMember() ?></p>
</div>


</ul>