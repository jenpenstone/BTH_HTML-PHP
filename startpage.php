<?php
// Pagecontoller

$title = "Nättraby vägmuseum - startsida";
//No subpages to show
$page = null;

include(__DIR__ . "/src/functions.php");
include(__DIR__ . "/config.php");
include(__DIR__ . "/view/start-header.php");
include(__DIR__ . "/view/navbar.php");

//Connect to database.
$db = connectToDatabase($dsn);

//Set which table to search in.
$table = 'page';

// Get pointer to what article to show
$subpage = 'startpage';

if ($db != null and isset($subpage)) {
    //Get table data from db.
    $res = getWholeTable($db, $table);

    //create a html formatted article
    $pageContent = createPage($res, $subpage);
}
?>

<!-- Instead of subpage nav, en emty navbar -->
<nav class='sub-nav'></nav>

<!-- Content on page -->
<main>
    <article>
        <header>
            <h1><?=$title?></h1>
        </header>

        <article class='artiklar'>

            <?php
            echo $pageContent;
            ?>

        </article>

        <footer>

        </footer>
    </article>
</main>
<?php include(__DIR__ . "/view/footer.php");
