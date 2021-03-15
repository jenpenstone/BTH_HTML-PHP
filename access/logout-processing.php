<h2><?=$page["title"]?></h2>

<?php
/**
 * A processing page that does a redirect.
 */
if ($_POST["logout"] ?? false) {
    // Do some processing of the form data
    // for example write to the database.

    unset($_SESSION["user"]);


}

// Redirect to a result page.
$url = "access.php?page=login";
header("Location: $url");
