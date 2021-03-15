<h2><?=$page["title"]?></h2>

<fieldset class="accessField">
    <form class="access" id="logoutForm" method="post" action="?page=logout-processing">

        <?php
            echo("Du är inloggad som: ");
            $user = $_SESSION["user"];
            echo($user);
        ?>

        <input type=submit name="logout" value="Logga ut">
    </form>

</fieldset>
