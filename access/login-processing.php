<h2><?=$page["title"]?></h2>

<?php
/**
 * A processing page that does a redirect.
 */
if ($_POST["login"] ?? false) {
    // Do some processing of the form data
    // for example write to the database.

    //Incoming variables from form
    $user = $_POST["user"] ?? null;
    $password = $_POST["password"] ?? null;

    //Check if user and password matches


    //Set valid user in session.
    $_SESSION["user"] = $user;
}

// Redirect to a result page.
$url = "access.php?page=logout";
header("Location: $url");
