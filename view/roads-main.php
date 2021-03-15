<!-- Instead of subpage nav, en emty navbar -->
<nav class='sub-nav'></nav>

<div class="wrap-main">
    <?php

    //Connect to database.
    $db = connectToDatabase($dsn);

    //Set which table to search in.
    $table = 'object';

    // Get pointer to what road to show
    $subpageRef = $_GET["subpage"] ?? null;

    //The collection of valid subpages
    $subpages = [
        "halvagen",
        "via-regia",
        "varendsvagen",
        "skillinge",
        "milstolparna",
        "ryttarliden",
        "riks-4",
        "e22",
        "cykelvagen",
        "kustbanan",
        "krosnabanan",
        "nattrabyan",
        "isvagen",
        "stenbron"
    ];

    //If subpageRef is in subpages, set subpage to subpageRef, otherwise keep it to null.
    $subpage = null;
    $subpagePos = null;
    foreach ($subpages as $key => $value) {
        if ($subpageRef == $value) {
            $subpage = $subpageRef;
            $subpagePos = $key;
        }
    }

    ?>

    <main class="multi-main">
        <article>
            <header>
                <h1><?=$title?></h1>
                <?php include(__DIR__ . "/roads-nav.php"); ?>
            </header>

            <!-- Main content included from subpage -->

            <!-- If a valid page has been entered by the user, the file is included on webpage. -->
            <?php if ($page) : ?>
                <?php include $file ?>
            <?php else : ?>
                <p>You have requested a page that doesn't exist: '<?= htmlentities($pageReference) ?>' </p>
            <?php endif; ?>


        </article>
    </main>

</div>
