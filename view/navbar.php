<?php

$uri = $_SERVER["REQUEST_URI"];
$uriFile = basename($uri);
$user = $_SESSION["user"] ?? null;
?>
<!-- Navbar in the top for logging in and out on the page. Shows the name of the user if logged in.
If user is logged in they only see 'Log out' and otherwise only 'Log in' -->
<nav class="nav-inlogg">
    <?php
    if ($user) :
        ?>
        <p>
            Inloggad som:  <?= $user ?>
        </p>
        <a class="" href="access.php?page=logout">Logga ut</a>
        <?php
    else :
        ?>
        <a class="" href="access.php?page=login">Logga in</a>
        <?php
    endif;
    ?>

</nav>
<nav class="head-nav">
    <a class="<?= $uriFile == "vagmuseum.php" ? "selected" : ""; ?>" href="roadmuseum.php">Nättraby vägmuseum</a>
    <a class="<?= $uriFile == "roads.php" ? "selected" : ""; ?>" href="roads.php">Besöksmål</a>
    <a class="<?= $uriFile == "roadhistory.php" ? "selected" : ""; ?>" href="roadhistory.php">Väghistoria</a>
    <a class="<?= $uriFile == "gallery.php" ? "selected" : ""; ?>" href="gallery.php">Galleri</a>
    <a class="<?= $uriFile == "articles.php" ? "selected" : ""; ?>" href="articles.php">Artiklar</a>
    <a class="<?= $uriFile == "about.php" ? "selected" : ""; ?>" href="about.php">Om</a>
    <?php
    if ($user) :
        ?>
        <a class="<?= $uriFile == "admin.php" ? "selected" : ""; ?>" href="admin.php">Admin</a>
        <?php
    endif;
    ?>
</nav>
